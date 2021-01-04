var navUser = document.querySelector('.user-navigation');
var UserToggle = document.querySelector('.user-navigation__toggle');

if (navUser != null) {
  navUser.classList.remove('user-navigation--nojs');
}

if (navUser != null) {
  UserToggle.addEventListener('click', function () {
    if (navUser.classList.contains('user-navigation--closed')) {
      navUser.classList.remove('user-navigation--closed');
      navUser.classList.add('user-navigation--opened');
    } else {
      navUser.classList.add('user-navigation--closed');
      navUser.classList.remove('user-navigation--opened');
    }
  });
}

var profileMenu = document.querySelector('.profile-menu');
var ProfileBtn = document.querySelector('.profile-menu__button');

if (profileMenu != null) {
  profileMenu.classList.remove('profile-menu--nojs');
  profileMenu.classList.add('profile-menu--closed');


  ProfileBtn.addEventListener('click', function () {
    if (profileMenu.classList.contains('profile-menu--closed')) {
      profileMenu.classList.remove('profile-menu--closed');
      profileMenu.classList.add('profile-menu--opened');
    } else {
      profileMenu.classList.add('profile-menu--closed');
      profileMenu.classList.remove('profile-menu--opened');
    }
  });
}
window.addEventListener("keydown", function (evt) {
  if (evt.keyCode === 27) {
    evt.preventDefault();

    if (profileMenu.classList.contains("profile-menu--opened")) {
      profileMenu.classList.remove("profile-menu--opened");
      profileMenu.classList.add("profile-menu--closed");
    }
  }
});

document.addEventListener('click', function (event) {
  if (!profileMenu.contains(event.target) && profileMenu.classList.contains("profile-menu--opened")) {
    profileMenu.classList.remove("profile-menu--opened");
    profileMenu.classList.add("profile-menu--closed");
  }
});
