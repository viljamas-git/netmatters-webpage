(() => {
  // Infinite-scrolling partner/client logo carousel with hover/focus pause support.
  const mediaQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
  const carousels = [];

  const getOuterWidth = (element) => {
    // Include margins so cloned loops align seamlessly in the track.
    const styles = window.getComputedStyle(element);
    const marginLeft = Number.parseFloat(styles.marginLeft) || 0;
    const marginRight = Number.parseFloat(styles.marginRight) || 0;

    return element.getBoundingClientRect().width + marginLeft + marginRight;
  };

  const createCarousel = (list) => {
    // Build isolated state per list so multiple carousels can run independently.
    const container = list.closest(".mc-sliding-imgs");

    if (!container) {
      return null;
    }

    const originalItems = [...list.children].filter(
      (item) => !item.hasAttribute("data-carousel-clone")
    );

    if (!originalItems.length) {
      return null;
    }

    list.classList.add("mc-logo-carousel-track");

    const state = {
      list,
      container,
      originalItems,
      cycleWidth: 0,
      offset: 0,
      speed: 35,
      lastTimestamp: null,
      paused: false,
      frameId: null,
    };

    const clearClones = () => {
      // Remove previously generated clones before recalculating loop content.
      list
        .querySelectorAll("[data-carousel-clone='true']")
        .forEach((clone) => clone.remove());
    };

    const updateMeasurements = () => {
      // Width of one complete "original items" cycle.
      state.cycleWidth = state.originalItems.reduce(
        (total, item) => total + getOuterWidth(item),
        0
      );
    };

    const ensureLoopContent = () => {
      // Clone items until the track is long enough to scroll continuously.
      clearClones();
      updateMeasurements();

      if (state.cycleWidth <= 0) {
        return;
      }

      const minLoopWidth = Math.max(state.container.clientWidth * 2, state.cycleWidth * 2);
      let currentWidth = state.cycleWidth;

      while (currentWidth < minLoopWidth) {
        state.originalItems.forEach((item) => {
          const clone = item.cloneNode(true);
          clone.setAttribute("data-carousel-clone", "true");
          clone.setAttribute("aria-hidden", "true");
          list.appendChild(clone);
        });

        currentWidth += state.cycleWidth;
      }

      state.offset %= state.cycleWidth;
      list.style.transform = `translate3d(${-state.offset}px, 0, 0)`;
    };

    const animate = (timestamp) => {
      // Frame loop: move track unless paused or reduced-motion is requested.
      if (state.lastTimestamp === null) {
        state.lastTimestamp = timestamp;
      }

      if (!state.paused && !mediaQuery.matches && state.cycleWidth > 0) {
        const elapsed = (timestamp - state.lastTimestamp) / 1000;
        state.offset += elapsed * state.speed;

        if (state.offset >= state.cycleWidth) {
          state.offset -= state.cycleWidth;
        }

        list.style.transform = `translate3d(${-state.offset}px, 0, 0)`;
      }

      state.lastTimestamp = timestamp;
      state.frameId = window.requestAnimationFrame(animate);
    };

    const pause = () => {
      state.paused = true;
    };

    const resume = () => {
      state.paused = false;
    };

    const handleResize = () => {
      ensureLoopContent();
    };

    state.destroy = () => {
      // Cleanup hook for future page lifecycle usage.
      if (state.frameId) {
        window.cancelAnimationFrame(state.frameId);
      }
      clearClones();
      list.classList.remove("mc-logo-carousel-track");
      list.style.transform = "";
      list.removeEventListener("mouseenter", pause);
      list.removeEventListener("mouseleave", resume);
      list.removeEventListener("focusin", pause);
      list.removeEventListener("focusout", resume);
      window.removeEventListener("resize", handleResize);
    };

    ensureLoopContent();

    list.addEventListener("mouseenter", pause);
    list.addEventListener("mouseleave", resume);
    list.addEventListener("focusin", pause);
    list.addEventListener("focusout", resume);
    window.addEventListener("resize", handleResize);

    state.frameId = window.requestAnimationFrame(animate);

    return state;
  };

  const setup = () => {
    // Initialize tooltips and then attach carousels for partners/clients rows.
    const tooltipHideDelay = 220;
    let activeLogoBox = null;

    document.querySelectorAll(".mc-clients .mc-sliding-img-box").forEach((logoBox) => {
      const tooltip = logoBox.querySelector(".mc-logo-tooltip");

      if (!tooltip) {
        return;
      }

      let hideTimerId = null;

      const clearHideTimer = () => {
        if (hideTimerId !== null) {
          window.clearTimeout(hideTimerId);
          hideTimerId = null;
        }
      };

      const showTooltip = () => {
        clearHideTimer();

        if (activeLogoBox && activeLogoBox !== logoBox) {
          activeLogoBox.classList.remove("mc-tooltip-visible");
        }

        logoBox.classList.add("mc-tooltip-visible");
        activeLogoBox = logoBox;
      };

      const hideTooltip = () => {
        clearHideTimer();
        hideTimerId = window.setTimeout(() => {
          logoBox.classList.remove("mc-tooltip-visible");

          if (activeLogoBox === logoBox) {
            activeLogoBox = null;
          }
        }, tooltipHideDelay);
      };

      logoBox.addEventListener("mouseenter", showTooltip);
      logoBox.addEventListener("mouseleave", hideTooltip);
      tooltip.addEventListener("mouseenter", showTooltip);
      tooltip.addEventListener("mouseleave", hideTooltip);

      logoBox.addEventListener("focusin", showTooltip);
      logoBox.addEventListener("focusout", (event) => {
        if (!logoBox.contains(event.relatedTarget)) {
          hideTooltip();
        }
      });
    });

    document
      .querySelectorAll(".mc-partners .mc-sliding-list, .mc-clients .mc-sliding-list")
      .forEach((list) => {
        const carousel = createCarousel(list);

        if (carousel) {
          carousels.push(carousel);
        }
      });
  };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", setup);
  } else {
    setup();
  }
})();
