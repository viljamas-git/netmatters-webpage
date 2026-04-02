(function () {
  // Handle sticky-header visibility based on scroll direction and hero/banner boundaries.
  const stickyHeader = document.querySelector('.mc-sticky-header');
  const mainHead = document.querySelector('.mc-head');
  const banner = document.querySelector('.mc-banner');

  if (!stickyHeader) {
    return;
  }

  let lastScrollY = window.scrollY;
  let ticking = false;
  let hasScrolledPastBannerTop = false;


  function setMainHeadStickyState(isStickyActive) {
    // Mirror sticky state on the main header for coordinated styling.
    if (!mainHead) {
      return;
    }

    mainHead.classList.toggle('mc-sticky-active', isStickyActive);
  }

  function showStickyHeader() {
    // jQuery path keeps behaviour consistent with pages that still rely on jQuery effects.
    if (window.jQuery) {
      window.jQuery(stickyHeader)
        .removeClass('mc-is-hidden mc-hidden-header')
        .addClass('mc-visible-header')
        .attr('aria-hidden', 'false');
      setMainHeadStickyState(true);
      return;
    }

    stickyHeader.classList.remove('mc-is-hidden', 'mc-hidden-header');
    stickyHeader.classList.add('mc-visible-header');
    stickyHeader.setAttribute('aria-hidden', 'false');
    setMainHeadStickyState(true);
  }

  function hideStickyHeader() {
    // Hide while preserving accessible state for screen readers.
    if (window.jQuery) {
      window.jQuery(stickyHeader)
        .removeClass('mc-visible-header')
        .addClass('mc-hidden-header')
        .attr('aria-hidden', 'true');
      setMainHeadStickyState(false);
      return;
    }

    stickyHeader.classList.remove('mc-visible-header');
    stickyHeader.classList.add('mc-hidden-header');
    stickyHeader.setAttribute('aria-hidden', 'true');
    setMainHeadStickyState(false);
  }

  function updateStickyHeader() {
    // Compute scroll context once per frame, then decide whether header should show or hide.
    const currentScrollY = window.scrollY;
    const isScrollingUp = currentScrollY < lastScrollY;
    const bannerTop = banner ? banner.offsetTop : 0;
    const bannerTopInViewport = banner ? banner.getBoundingClientRect().top : 0;
    const stickyHeaderHeight = stickyHeader.offsetHeight;
    const maxHiddenTop = Math.min(0, bannerTopInViewport - stickyHeaderHeight);
    const mainHeadBottomInViewport = mainHead ? mainHead.getBoundingClientRect().bottom : 0;
    const isWithinMainHeadBoundary = mainHead && mainHeadBottomInViewport > 0;

    if (currentScrollY >= bannerTop) {
      hasScrolledPastBannerTop = true;
    }

    if (isScrollingUp && currentScrollY <= 0) {
      hasScrolledPastBannerTop = false;
    }

    if (isWithinMainHeadBoundary) {
      const mainHeadHeight = mainHead.offsetHeight;
      const progressiveHiddenTop = -Math.min(currentScrollY, mainHeadHeight);

      stickyHeader.style.setProperty('--mc-sticky-hidden-top', `${progressiveHiddenTop}px`);

      if (currentScrollY <= 0 || (isScrollingUp && hasScrolledPastBannerTop)) {
        stickyHeader.classList.remove('mc-no-transition');
        showStickyHeader();
      } else {
        stickyHeader.classList.add('mc-no-transition');
        hideStickyHeader();
      }

      lastScrollY = currentScrollY;
      ticking = false;
      return;
    }

    stickyHeader.style.setProperty('--mc-sticky-hidden-top', `${maxHiddenTop}px`);
    stickyHeader.classList.remove('mc-no-transition');

    if (currentScrollY < bannerTop) {
      showStickyHeader();
      lastScrollY = currentScrollY;
      ticking = false;
      return;
    }

    if (currentScrollY <= 0 || (isScrollingUp && hasScrolledPastBannerTop) || maxHiddenTop === 0) {
      showStickyHeader();
    } else {
      hideStickyHeader();
    }

    lastScrollY = currentScrollY;
    ticking = false;
  }

  function requestStickyUpdate() {
    // Throttle scroll/resize work to animation frames for smoother performance.
    if (!ticking) {
      window.requestAnimationFrame(updateStickyHeader);
      ticking = true;
    }
  }

  if (mainHead) {
    mainHead.setAttribute('aria-hidden', 'true');
  }

  showStickyHeader();
  requestStickyUpdate();

  window.addEventListener('scroll', requestStickyUpdate, { passive: true });

  window.addEventListener('resize', requestStickyUpdate);
})();
