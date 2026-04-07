document.addEventListener('DOMContentLoaded', () => {
  // Toggle the out-of-hours support panel using an accessible accordion pattern.
  const accordion = document.querySelector('[data-accordion]');

  if (!accordion) {
    return;
  }

  const trigger = accordion.querySelector('.mc-contact-support-btn');
  const panel = accordion.querySelector('.mc-contact-support-panel');

  if (!trigger || !panel) {
    return;
  }

  const toggleAccordion = () => {
    // Keep aria-expanded and hidden state synchronized for assistive technologies.
    const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
    trigger.setAttribute('aria-expanded', String(!isExpanded));
    panel.hidden = isExpanded;
  };

  trigger.addEventListener('click', toggleAccordion);
});
