(function () {
  // Client-side validation for the contact form to provide immediate feedback.
  const form = document.querySelector('#mc-contact-form');

  if (!form) {
    return;
  }

  const fields = {
    name: 'Please enter your name.',
    company: 'Please enter your company name.',
    email: 'Please enter your email address.',
    telephone: 'Please enter your telephone number.',
    message: 'Please enter your message.'
  };

  const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  const setError = (field, message) => {
    // Apply error styling and show the field-specific message.
    const input = form.elements[field];

    if (!input) {
      return;
    }

    const wrapper = input.closest('label');
    const errorElement = wrapper ? wrapper.querySelector('.mc-input-error') : null;

    input.classList.add('mc-field-error');

    if (errorElement) {
      errorElement.textContent = message;
    }
  };

  const clearError = (field) => {
    // Remove error styling/message once the field becomes valid.
    const input = form.elements[field];

    if (!input) {
      return;
    }

    const wrapper = input.closest('label');
    const errorElement = wrapper ? wrapper.querySelector('.mc-input-error') : null;

    input.classList.remove('mc-field-error');

    if (errorElement) {
      errorElement.textContent = '';
    }
  };

  const validateField = (field) => {
    // Required-field validation plus a simple email format check.
    const input = form.elements[field];

    if (!input) {
      return true;
    }

    const value = String(input.value || '').trim();

    if (!value) {
      setError(field, fields[field]);
      return false;
    }

    if (field === 'email' && !emailPattern.test(value)) {
      setError(field, 'Please enter a valid email address.');
      return false;
    }

    clearError(field);
    return true;
  };

  Object.keys(fields).forEach((field) => {
    const input = form.elements[field];

    if (!input) {
      return;
    }

    input.addEventListener('input', function () {
      validateField(field);
    });

    input.addEventListener('blur', function () {
      validateField(field);
    });
  });

  form.addEventListener('submit', function (event) {
    // Prevent submit if any field fails validation.
    let isValid = true;

    Object.keys(fields).forEach((field) => {
      if (!validateField(field)) {
        isValid = false;
      }
    });

    if (!isValid) {
      event.preventDefault();
    }
  });
})();
