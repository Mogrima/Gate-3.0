let wrapper = document.querySelector('.substrate');
let upButton = document.createElement('button');

upButton.classList.add('up-button');
if(window.matchMedia('(min-width: 767px)').matches) {
  upButton.textContent ='Вверх';
}
wrapper.appendChild(upButton);

window.onscroll = function () {
  if (window.pageYOffset > 600) {
    upButton.classList.add('shown');
  } else {
    upButton.classList.remove('shown');
    }

};

// jquery
$(document).ready(function() {
  $(function() {
    $(".up-button").click(function() {
      $("body,html").animate({
        scrollTop: 0
      }, 500);
      return false;
    });
  });
});