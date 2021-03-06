// document.addEventListener('DOMContentLoaded',function() {
  if(window.matchMedia('(min-width: 768px)').matches) {
    var overlay = document.querySelector(".overlay");
    var storage = localStorage.getItem("user-name");
    
    var registrationLink = document.querySelector(".registration-link");
    if (registrationLink != null) {
    var registrationForm = document.querySelector(".login__reg");
    var registrationClose = document.querySelector(".login__close-reg");
    var registrationlogin = registrationForm.querySelector(".reg-name");
    var registrationEmail = registrationForm.querySelector(".reg-email");
    
    
      registrationLink.addEventListener("click", function (evt) {
        evt.preventDefault();
        registrationForm.classList.add("modal-show");
        overlay.classList.add("modal-show");
        if (storage) {
          registrationlogin.value = storage;
          registrationEmail.focus();
        } else {
          registrationlogin.focus();
        }
      });
    
    
    registrationClose.addEventListener("click", function (evt) {
      evt.preventDefault();
      registrationForm.classList.remove("modal-show");
      overlay.classList.remove("modal-show");
    });
    
    window.addEventListener("keydown", function (evt) {
      if (evt.keyCode === 27) {
        evt.preventDefault();
    
        if (registrationForm.classList.contains("modal-show")) {
          registrationForm.classList.remove("modal-show");
          overlay.classList.remove("modal-show");
        }
      }
    });
    }
    
    var loginLink = document.querySelector(".login-link");
    var loginForm = document.querySelector(".login__log");
    var loginClose = document.querySelector(".login__close-log");

    if (loginLink != null) {
    var loginLogin = loginForm.querySelector("[name=username]");
    var loginPassword = loginForm.querySelector("[name=password]");
    
      loginLink.addEventListener("click", function (evt) {
        evt.preventDefault();
        loginForm.classList.add("modal-show");
        overlay.classList.add("modal-show");
        if (storage) {
          loginLogin.value = storage;
          loginPassword.focus();
        } else {
          loginLogin.focus();
        }
      });
    
    loginClose.addEventListener("click", function (evt) {
      evt.preventDefault();
      loginForm.classList.remove("modal-show");
      overlay.classList.remove("modal-show");
    });
    
    window.addEventListener("keydown", function (evt) {
      if (evt.keyCode === 27) {
        evt.preventDefault();
    
        if (loginForm.classList.contains("modal-show")) {
          loginForm.classList.remove("modal-show");
          overlay.classList.remove("modal-show");
        }
      }
    });
    
    overlay.addEventListener("click", function (evt) {
      evt.preventDefault();
      registrationForm.classList.remove("modal-show");
      loginForm.classList.remove("modal-show");
      overlay.classList.remove("modal-show");
    });
  }
  }
// });