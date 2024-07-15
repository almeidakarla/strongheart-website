document.querySelector('.php-email-form').addEventListener('submit', function (e) {
  e.preventDefault();
  
  var form = this;
  var action = form.getAttribute('action');
  var formData = new FormData(form);

  var loading = form.querySelector('.loading');
  var error = form.querySelector('.error-message');
  var success = form.querySelector('.sent-message');

  loading.style.display = 'block';
  error.style.display = 'none';
  success.style.display = 'none';

  fetch(action, {
      method: 'POST',
      body: formData,
  })
  .then(response => response.text())
  .then(data => {
      loading.style.display = 'none';
      if (data.trim() === 'Your information has been sent. Thank you!') {
          success.style.display = 'block';
          form.reset();
      } else {
          error.style.display = 'block';
          error.textContent = data.trim();
      }
  })
  .catch(() => {
      loading.style.display = 'none';
      error.style.display = 'block';
      error.textContent = 'An error occurred. Please try again later.';
  });
});
