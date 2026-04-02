(function () {
  // Progressive-enhancement banner slider with autoplay, dots, keyboard focus, and drag gestures.
  const banner = document.querySelector('.mc-banner');

  if (!banner) {
    return;
  }

  banner.setAttribute('tabindex', '0');

  const slides = Array.from(banner.querySelectorAll('.mc-banner-slide'));

  if (slides.length <= 1) {
    return;
  }

  let currentIndex = Math.max(
    0,
    slides.findIndex((slide) => !slide.classList.contains('is-hidden-for-now'))
  );
  let autoplayTimer = null;
  let allowHoverPause = false;
  let pointerStartX = null;
  let activeDragIndex = null;
  let activeDragDirection = 0;
  let isDragging = false;
  let isAnimating = false;

  const DRAG_THRESHOLD = 50;
  const TRANSITION_DURATION_MS = 850;
  const AUTOPLAY_INTERVAL_MS = 5000;

  const controls = document.createElement('div');
  controls.className = 'mc-banner-controls';
  controls.setAttribute('aria-label', 'Banner slide controls');

  const dots = slides.map(function (_, index) {
    const dot = document.createElement('button');
    dot.type = 'button';
    dot.className = 'mc-banner-dot';
    dot.dataset.slideIndex = String(index);
    dot.setAttribute('aria-label', 'Go to slide ' + (index + 1));
    controls.appendChild(dot);
    return dot;
  });

  banner.appendChild(controls);

  function renderDots() {
    // Keep dot UI and aria-current in sync with active slide.
    dots.forEach(function (dot, index) {
      const isCurrent = index === currentIndex;
      dot.classList.toggle('is-active', isCurrent);
      dot.setAttribute('aria-current', isCurrent ? 'true' : 'false');
    });
  }

  function clearAutoplay() {
    // Always clear before re-starting so only one interval is active.
    window.clearInterval(autoplayTimer);
    autoplayTimer = null;
  }

  function startAutoplay() {
    clearAutoplay();
    autoplayTimer = window.setInterval(function () {
      goToSlide(currentIndex + 1, 1);
    }, AUTOPLAY_INTERVAL_MS);
  }

  function scheduleAutoplayResume() {
    // Resume autoplay after transitions complete to avoid fighting user interactions.
    window.setTimeout(startAutoplay, TRANSITION_DURATION_MS);
  }

  function getWrappedIndex(index) {
    return (index + slides.length) % slides.length;
  }

  function getDirectionForTarget(targetIndex) {
    // Choose the shortest route around the circular slide list.
    if (targetIndex === currentIndex) {
      return 0;
    }

    const forwardDistance = (targetIndex - currentIndex + slides.length) % slides.length;
    const backwardDistance = (currentIndex - targetIndex + slides.length) % slides.length;

    return forwardDistance <= backwardDistance ? 1 : -1;
  }

  function placeSlides() {
    // Establish a deterministic starting layout before any animations run.
    slides.forEach(function (slide, index) {
      const isCurrent = index === currentIndex;
      slide.classList.remove('is-hidden-for-now');
      slide.classList.toggle('is-active', isCurrent);
      slide.style.transition = 'none';
      slide.style.transform = isCurrent
        ? 'translate3d(0%, 0, 0)'
        : 'translate3d(100%, 0, 0)';
      slide.style.pointerEvents = isCurrent ? 'auto' : 'none';
      slide.setAttribute('aria-hidden', String(!isCurrent));
    });

    window.requestAnimationFrame(function () {
      slides.forEach(function (slide) {
        slide.style.transition = '';
      });
    });

    renderDots();
  }

  function goToSlide(index, explicitDirection) {
    // Animate from current slide to the target slide in the chosen direction.
    const nextIndex = getWrappedIndex(index);

    if (isAnimating || nextIndex === currentIndex) {
      return;
    }

    const direction = explicitDirection || getDirectionForTarget(nextIndex) || 1;
    const previousIndex = currentIndex;
    const outgoingSlide = slides[previousIndex];
    const incomingSlide = slides[nextIndex];
    const incomingStart = direction > 0 ? 'translate3d(100%, 0, 0)' : 'translate3d(-100%, 0, 0)';
    const outgoingEnd = direction > 0 ? 'translate3d(-100%, 0, 0)' : 'translate3d(100%, 0, 0)';

    isAnimating = true;
    currentIndex = nextIndex;
    renderDots();

    slides.forEach(function (slide, slideIndex) {
      if (slideIndex !== previousIndex && slideIndex !== nextIndex) {
        slide.classList.remove('is-active');
        slide.style.transition = 'none';
        slide.style.transform = 'translate3d(100%, 0, 0)';
        slide.style.pointerEvents = 'none';
        slide.setAttribute('aria-hidden', 'true');
      }
    });

    incomingSlide.classList.remove('is-hidden-for-now');
    incomingSlide.classList.add('is-active');
    incomingSlide.style.transition = 'none';
    incomingSlide.style.transform = incomingStart;
    incomingSlide.style.pointerEvents = 'auto';
    incomingSlide.setAttribute('aria-hidden', 'false');

    outgoingSlide.classList.add('is-active');
    outgoingSlide.style.pointerEvents = 'none';
    outgoingSlide.setAttribute('aria-hidden', 'false');

    void incomingSlide.offsetWidth;

    incomingSlide.style.transition = '';
    outgoingSlide.style.transition = '';

    window.requestAnimationFrame(function () {
      outgoingSlide.style.transform = outgoingEnd;
      incomingSlide.style.transform = 'translate3d(0%, 0, 0)';
    });

    window.setTimeout(function () {
      outgoingSlide.classList.remove('is-active');
      outgoingSlide.style.transition = 'none';
      outgoingSlide.style.transform = 'translate3d(100%, 0, 0)';
      outgoingSlide.style.pointerEvents = 'none';
      outgoingSlide.setAttribute('aria-hidden', 'true');
      isAnimating = false;
    }, TRANSITION_DURATION_MS);
  }

  function finishDragSlide(nextIndex, direction) {
    // Complete a drag-initiated transition using the current in-flight transforms.
    if (isAnimating) {
      return;
    }

    const wrappedIndex = getWrappedIndex(nextIndex);
    const previousIndex = currentIndex;
    const outgoingSlide = slides[previousIndex];
    const incomingSlide = slides[wrappedIndex];
    const outgoingEnd = direction > 0 ? 'translate3d(-100%, 0, 0)' : 'translate3d(100%, 0, 0)';

    isAnimating = true;
    currentIndex = wrappedIndex;
    renderDots();

    slides.forEach(function (slide, slideIndex) {
      if (slideIndex !== previousIndex && slideIndex !== wrappedIndex) {
        slide.classList.remove('is-active');
        slide.style.transition = 'none';
        slide.style.transform = 'translate3d(100%, 0, 0)';
        slide.style.pointerEvents = 'none';
        slide.setAttribute('aria-hidden', 'true');
      }
    });

    incomingSlide.classList.remove('is-hidden-for-now');
    incomingSlide.classList.add('is-active');
    incomingSlide.style.pointerEvents = 'auto';
    incomingSlide.setAttribute('aria-hidden', 'false');

    outgoingSlide.classList.add('is-active');
    outgoingSlide.style.pointerEvents = 'none';
    outgoingSlide.setAttribute('aria-hidden', 'false');

    void incomingSlide.offsetWidth;

    incomingSlide.style.transition = '';
    outgoingSlide.style.transition = '';

    window.requestAnimationFrame(function () {
      outgoingSlide.style.transform = outgoingEnd;
      incomingSlide.style.transform = 'translate3d(0%, 0, 0)';
    });

    window.setTimeout(function () {
      outgoingSlide.classList.remove('is-active');
      outgoingSlide.style.transition = 'none';
      outgoingSlide.style.transform = 'translate3d(100%, 0, 0)';
      outgoingSlide.style.pointerEvents = 'none';
      outgoingSlide.setAttribute('aria-hidden', 'true');
      isAnimating = false;
    }, TRANSITION_DURATION_MS);
  }

  function beginDrag(event) {
    // Start pointer-based dragging and pause autoplay while user interacts.
    if (isAnimating) {
      return;
    }

    pointerStartX = event.clientX;
    activeDragDirection = 0;
    activeDragIndex = null;
    isDragging = false;
    clearAutoplay();
    banner.setPointerCapture(event.pointerId);
  }

  function updateDrag(event) {
    // Update outgoing/incoming slide positions to match pointer movement.
    if (pointerStartX === null || isAnimating) {
      return;
    }

    const width = banner.clientWidth || 1;
    const distance = event.clientX - pointerStartX;

    if (Math.abs(distance) < 1) {
      return;
    }

    isDragging = true;

    const direction = distance < 0 ? 1 : -1;
    if (activeDragDirection !== direction) {
      activeDragDirection = direction;
      activeDragIndex = getWrappedIndex(currentIndex + direction);
      const dragSlide = slides[activeDragIndex];
      dragSlide.classList.remove('is-hidden-for-now');
      dragSlide.classList.add('is-active');
      dragSlide.style.transition = 'none';
      dragSlide.style.pointerEvents = 'none';
      dragSlide.setAttribute('aria-hidden', 'false');
    }

    const distancePercent = Math.max(-100, Math.min(100, (distance / width) * 100));
    const currentSlide = slides[currentIndex];
    const dragSlide = slides[activeDragIndex];

    currentSlide.classList.add('is-active');
    currentSlide.style.transition = 'none';
    currentSlide.style.transform = 'translate3d(' + distancePercent + '%, 0, 0)';
    currentSlide.style.pointerEvents = 'none';
    currentSlide.setAttribute('aria-hidden', 'false');

    if (activeDragDirection === 1) {
      dragSlide.style.transform = 'translate3d(' + (100 + distancePercent) + '%, 0, 0)';
    } else {
      dragSlide.style.transform = 'translate3d(' + (-100 + distancePercent) + '%, 0, 0)';
    }
  }

  function cancelDragState() {
    pointerStartX = null;
    activeDragIndex = null;
    activeDragDirection = 0;
    isDragging = false;
  }

  function handlePointerEnd(event) {
    if (pointerStartX === null || isAnimating) {
      return;
    }

    const distance = event.clientX - pointerStartX;
    const shouldSlide =
      activeDragIndex !== null &&
      activeDragDirection !== 0 &&
      Math.abs(distance) >= DRAG_THRESHOLD;

    if (shouldSlide) {
      finishDragSlide(activeDragIndex, activeDragDirection);
      cancelDragState();
      scheduleAutoplayResume();
      return;
    }

    placeSlides();
    cancelDragState();
    startAutoplay();
  }

  function handleManualNavigation(targetIndex, direction) {
    clearAutoplay();
    goToSlide(targetIndex, direction);
    scheduleAutoplayResume();
  }

  dots.forEach(function (dot) {
    dot.addEventListener('click', function () {
      const dotIndex = Number(dot.dataset.slideIndex);
      if (!Number.isNaN(dotIndex)) {
        handleManualNavigation(dotIndex);
      }
    });
  });

  banner.addEventListener('mouseenter', function () {
    if (!allowHoverPause) {
      return;
    }
    clearAutoplay();
  });

  banner.addEventListener('mouseleave', startAutoplay);

  banner.addEventListener('keydown', function (event) {
    if (event.key === 'ArrowRight') {
      handleManualNavigation(currentIndex + 1, 1);
    }

    if (event.key === 'ArrowLeft') {
      handleManualNavigation(currentIndex - 1, -1);
    }
  });

  banner.addEventListener('pointerdown', function (event) {
    if (event.pointerType !== 'mouse' || event.button !== 0) {
      return;
    }

    if (event.target.closest('.mc-banner-controls')) {
      return;
    }

    beginDrag(event);
  });

  banner.addEventListener('pointermove', function (event) {
    updateDrag(event);
  });

  banner.addEventListener('pointerup', function (event) {
    handlePointerEnd(event);
  });

  banner.addEventListener('pointercancel', function () {
    if (pointerStartX !== null) {
      placeSlides();
      cancelDragState();
      startAutoplay();
    }
  });

  banner.addEventListener('click', function (event) {
    if (isDragging) {
      event.preventDefault();
      isDragging = false;
    }
  });

  placeSlides();
  startAutoplay();
  window.setTimeout(function () {
    allowHoverPause = true;
  }, 0);
})();
