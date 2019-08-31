window.addEventListener('DOMContentLoaded', function () {
    'use strict';

    let tab = document.querySelectorAll('.profile__toggle');
    let info = document.querySelector('.profile__toggles');
    let tabContent = document.querySelectorAll('.profile__content');

    function hideTabContent(a) {
        for (let i = a; i < tabContent.length; i++) {
            tabContent[i].classList.remove('show');
            tab[i].classList.remove('profile__toggle--active');
            tabContent[i].classList.add('hide');
        }
    }

    hideTabContent(1);

    function showTabContent(b) {
        if (tabContent[b].classList.contains('hide')) {
            tabContent[b].classList.remove('hide');
            tabContent[b].classList.add('show');
            tab[b].classList.add('profile__toggle--active');
        }
    }

    info.addEventListener('click', function (event) {
        let target = event.target;
        if (target && target.classList.contains('profile__toggle')) {
            for (let i = 0; i < tab.length; i++) {
                if (target == tab[i]) {
                    hideTabContent(0);
                    showTabContent(i);
                    break;
                }
            }
        }
    });

    var openTab = document.querySelector('.profile__toggles-open');

    openTab.addEventListener('click', function() {
        if(info.classList.contains('profile__toggles--closed')) {
            info.classList.remove('profile__toggles--closed');
            info.classList.add('profile__toggles--opened');
        } else {
            info.classList.remove('profile__toggles--opened');
            info.classList.add('profile__toggles--closed');
            
        }
       
    });
});