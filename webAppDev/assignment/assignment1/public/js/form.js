$(document).ready(function() {
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    const validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        const justification = $('textarea[name="justification"]');
        const justificationTxt = $(justification).val();
        const wordLen = justificationTxt.trim().split(' ').length;

        if (wordLen < 5) {
          document.querySelector('textarea[name="justification"]').setCustomValidity('Please enter at least 5 words.');
        } else {
          document.querySelector('textarea[name="justification"]').setCustomValidity('')
        }
        
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();

          let formData = new FormData(form);
          for(let field of form.elements) {
            if ((field.type === 'text' || field.type === 'textarea') && !field.validity.valid) {
              $(field).parent().find('.invalid-feedback').html(field.validationMessage);
            }
          }
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})