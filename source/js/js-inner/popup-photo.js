var overlayDark = document.querySelector(".overlay--dark");
var photoLink_1 = document.querySelector(".about__open-photo-1");
var photoLink_2 = document.querySelector(".about__open-photo-2");
var photoLink_3 = document.querySelector(".about__open-photo-3");
var popupPhoto_1 = document.querySelector(".popup__photo--1");
var popupPhoto_2 = document.querySelector(".popup__photo--2");
var popupPhoto_3 = document.querySelector(".popup__photo--3");
var photoClose_1 = document.querySelector(".photo-close-1");
var photoClose_2 = document.querySelector(".photo-close-2");
var photoClose_3 = document.querySelector(".photo-close-3");

photoLink_1.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_1.classList.add("modal-show--fadeIn");
		overlayDark.classList.add("modal-show--fadeIn");
	});

photoClose_1.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_1.classList.remove("modal-show--fadeIn");
		overlayDark.classList.remove("modal-show--fadeIn");
	});

window.addEventListener("keydown", function(evt) {
		if (evt.keyCode === 27) {
			evt.preventDefault();

			if (popupPhoto_1.classList.contains("modal-show--fadeIn")) {
				popupPhoto_1.classList.remove("modal-show--fadeIn");
				overlayDark.classList.remove("modal-show--fadeIn");
			}
		}
	});

/* ----------------------------------------------------------------------------------------------- */

photoLink_2.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_2.classList.add("modal-show--fadeIn");
		overlayDark.classList.add("modal-show--fadeIn");
	});

photoClose_2.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_2.classList.remove("modal-show--fadeIn");
		overlayDark.classList.remove("modal-show--fadeIn");
	});

window.addEventListener("keydown", function(evt) {
		if (evt.keyCode === 27) {
			evt.preventDefault();

			if (popupPhoto_2.classList.contains("modal-show--fadeIn")) {
				popupPhoto_2.classList.remove("modal-show--fadeIn");
				overlayDark.classList.remove("modal-show--fadeIn");
			}
		}
	});
/* ----------------------------------------------------------------------------------------------- */

photoLink_3.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_3.classList.add("modal-show--fadeIn");
		overlayDark.classList.add("modal-show--fadeIn");
	});

photoClose_3.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_3.classList.remove("modal-show--fadeIn");
		overlayDark.classList.remove("modal-show--fadeIn");
	});

window.addEventListener("keydown", function(evt) {
		if (evt.keyCode === 27) {
			evt.preventDefault();

			if (popupPhoto_3.classList.contains("modal-show--fadeIn")) {
				popupPhoto_3.classList.remove("modal-show--fadeIn");
				overlayDark.classList.remove("modal-show--fadeIn");
			}
		}
	});

/* ------------------------------------------------------------------------------------------------- */

overlayDark.addEventListener("click", function(evt) {
		evt.preventDefault();
		popupPhoto_1.classList.remove("modal-show--fadeIn");
		popupPhoto_2.classList.remove("modal-show--fadeIn");
		popupPhoto_3.classList.remove("modal-show--fadeIn");
		overlayDark.classList.remove("modal-show--fadeIn");
	});