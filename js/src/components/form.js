document.addEventListener('DOMContentLoaded', function() {
  const ercodingForm = document.querySelector('.ercoding-form');
  if (!ercodingForm) return;
  const ercodingFormName = document.querySelector('.ercoding-form-name');
  const ercodingFormSurname = document.querySelector('.ercoding-form-surname');
  const ercodingFormEmail = document.querySelector('.ercoding-form-email');
  const ercodingFormPhone = document.querySelector('.ercoding-form-phone');
  const ercodingFormTextarea = document.querySelector('.ercoding-form-textarea');
  const ercodingFormAcceptance = document.querySelector('.ercoding-form-acceptance');
  const ercodingFormSubmit = document.querySelector('input[type="submit"]');

  function ercodingShowError(container, message) {
    if (!container) return;
    let errorEl = container.querySelector('.ercoding-error-message');
    if (!errorEl) {
      errorEl = document.createElement('div');
      errorEl.classList.add('ercoding-error-message');
      errorEl.style.color = 'red';
      errorEl.style.fontSize = '13px';
      errorEl.style.marginTop = '3px';
      errorEl.style.position = 'absolute';
      container.appendChild(errorEl);
    }
    errorEl.textContent = message;
  }

  function ercodingRemoveError(container) {
    if (!container) return;
    const errorEl = container.querySelector('.ercoding-error-message');
    if (errorEl) errorEl.remove();
  }

  function ercodingValidateName() {
    const input = ercodingFormName.querySelector('input');
    input.value = input.value.replace(/[^A-Za-z\s]/g, '');
    const value = input.value.trim();
    if (value.length < 3) {
      ercodingShowError(ercodingFormName, 'Imię nie może być krótsze niż 3 znaki.');
      return false;
    } else {
      ercodingRemoveError(ercodingFormName);
      return true;
    }
  }
  
  function ercodingValidateSurname() {
    const input = ercodingFormSurname.querySelector('input');
    input.value = input.value.replace(/[^A-Za-z\s]/g, '');
    const value = input.value.trim();
    if (value.length < 3) {
      ercodingShowError(ercodingFormSurname, 'Nazwisko nie może być krótsze niż 3 znaki.');
      return false;
    } else {
      ercodingRemoveError(ercodingFormSurname);
      return true;
    }
  }
   

  function ercodingValidateEmail() {
    if (!ercodingFormEmail) return true;
    const input = ercodingFormEmail.querySelector('input');
    const value = input ? input.value.trim() : '';
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!value.match(emailPattern)) {
      ercodingShowError(ercodingFormEmail, 'Proszę wprowadzić prawidłowy adres email.');
      return false;
    } else {
      ercodingRemoveError(ercodingFormEmail);
      return true;
    }
  }

  function ercodingValidatePhone() {
    if (!ercodingFormPhone) return true;
    const input = ercodingFormPhone.querySelector('input');
    const value = input ? input.value.trim() : '';
    if (!/^[+0-9\s]+$/.test(value) || (value.replace(/\D/g, '').length < 9)) {
      ercodingShowError(ercodingFormPhone, 'Wprowadź prawidłowy numer telefonu.');
      return false;
    } else {
      ercodingRemoveError(ercodingFormPhone);
      return true;
    }
  }

  function ercodingValidateTextarea() {
    if (!ercodingFormTextarea) return true;
    const textarea = ercodingFormTextarea.querySelector('textarea');
    const value = textarea ? textarea.value.trim() : '';
    if (value.length < 15) {
      ercodingShowError(ercodingFormTextarea, 'Wiadomość powinna mieć co najmniej 15 znaków.');
      return false;
    } else {
      ercodingRemoveError(ercodingFormTextarea);
      return true;
    }
  }

  function ercodingValidateAcceptance() {
    if (!ercodingFormAcceptance) return true;
    const checkbox = ercodingFormAcceptance.querySelector('input[type="checkbox"]');
    if (!checkbox.checked) {
      ercodingShowError(ercodingFormAcceptance, 'Musisz wyrazić zgodę, aby kontynuować.');
      return false;
    } else {
      ercodingRemoveError(ercodingFormAcceptance);
      return true;
    }
  }

  function ercodingValidateAllFields() {
    let valid = true;
    valid = ercodingValidateName() && valid;
    valid = ercodingValidateSurname() && valid;
    valid = ercodingValidateEmail() && valid;
    valid = ercodingValidatePhone() && valid;
    valid = ercodingValidateTextarea() && valid;
    valid = ercodingValidateAcceptance() && valid;
    return valid;
  }

  if (ercodingFormName) { 
    ercodingFormName.querySelector('input').addEventListener('input', ercodingValidateName); 
  
  }

  if (ercodingFormSurname) { 
    ercodingFormSurname.querySelector('input').addEventListener('input', ercodingValidateSurname); 
  }

  if (ercodingFormEmail) { 
    ercodingFormEmail.querySelector('input').addEventListener('input', ercodingValidateEmail); 
  }

  if (ercodingFormPhone) { 
    ercodingFormPhone.querySelector('input').addEventListener('input', ercodingValidatePhone); 
  }

  if (ercodingFormTextarea) { 
    ercodingFormTextarea.querySelector('textarea').addEventListener('input', ercodingValidateTextarea); 
  }

  if (ercodingFormAcceptance) { 
    ercodingFormAcceptance.querySelector('input[type="checkbox"]').addEventListener('change', ercodingValidateAcceptance); 
  }

  if (ercodingFormSubmit) {
    ercodingFormSubmit.addEventListener('mouseenter', function() {
      ercodingValidateAllFields();
    });
  }

  ercodingForm.addEventListener('submit', function() {
    ercodingValidateAllFields();
  });
});
