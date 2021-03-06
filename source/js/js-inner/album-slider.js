// Элементы слайдера
var album_wrapper = document.querySelector(".slider__list");
var sliderElem = document.querySelector('.slider__container');
var slideItem = document.querySelectorAll('.slider__item');
var slideTitle = document.querySelectorAll('.album-slider__title');
var navList = document.querySelector('.slider__dots');
var links;
var pos;
// элементы превью слайдера
var contrWidth_preview = document.querySelector('.slider__container-preview');
var wrapper_previw = document.querySelector(".slider__list-preview");
var slide_previw = document.querySelectorAll('.slider__item-preview');
// Кнопки вперед, назад
var next = document.querySelector('.slider__next');
var prev = document.querySelector('.slider__prev');

let url = new URL(document.location.href);

// Убираю класс no-js

var gallery = document.querySelector('.gallery');

if (gallery.classList.contains('gallery-no-js')) {
    gallery.classList.remove('gallery-no-js');
}

// Подсчет отступов слайда исходя из размера его/изображения и размера контейнера
var slideOffset = 0; // по-умолчанию отступы равны 0 и изображение тянется на весь контейнер
var contrWidth = document.querySelector('.slider__container').offsetWidth; // ширина контейнера, она указана в css
var slideImg = document.querySelectorAll('.slider__img'); // берем все изображения слайдера
console.log(contrWidth);
for (var i = 0; i < slideImg.length; i++) {
    var imgWidth = slideImg[i].offsetWidth; // вычисляем ширину каждого изображения, ширина задается в теге img для каждого изображения
    // вычисляем равный отступ для каждой из сторон, чтобы изображение центровалось
    slideOffset = (contrWidth - imgWidth) / 2;
    console.log(slideOffset);
    slideImg[i].style.marginLeft = slideOffset + 'px';
    slideImg[i].style.marginRight = slideOffset + 'px';
}

// Размеры слайдера
// var slideWidth = 768;
var contentWidth = contrWidth;// slideWidth + (slideOffset * 2);
// рассчитываю от количества слайдов ширину большого контейнера
var widthWrapper = slideItem.length * contentWidth + 'px';
// присываиваю полученную ширину обертке
album_wrapper.style.width = widthWrapper;
// размеры слайдов превью
var slide_previwWidth = 150; // самостоятельно устанавливаем значение
var slide_previwOffset = 15; // самостоятельно устанавливаем значение
var content_previwWidth = slide_previwWidth + (slide_previwOffset * 2);
if(wrapper_previw) {
    wrapper_previw.style.width = widthWrapper; // ширину контейнера превью делаем такой же как и ширина длинного контейнера основного слайдера  
}

// Динамически создаю пункты навигации в зависимости
// от количества слайдов, передвая функцию в цикл перебора массива слайдов и расчета позицию left
var createDots = function (el, pos) {
    var newDot = document.createElement(el);
    document.body.appendChild(newDot);
    //при каждой итерации цикла вместо i подставляется номер слайда
    // pos = i * -contentWidth;
    // newDot.setAttribute("data-pos", pos + "px");
    newDot.classList.add("slider__dot");
    navList.appendChild(newDot);
    if(el == "button") {
        newDot.setAttribute("type", "button");
    }
};

var addDataPosSlide = function () {
    for (var i = 0; i < slideItem.length; i++) {
        pos = i * -contentWidth; // вычисляем data-pos
        slideItem[i].setAttribute("data-pos", pos + "px"); // присваиваем каждому слайду data-pos
        if(slideItem.length < 16) {
            createDots("li"); // создаем дотсы для каждого слайда // Но если слайдов не больше 16
        }
    }
};

addDataPosSlide();

// когда дотсы созданы, можем взять их из DOM
links = document.querySelectorAll(".slider__dot");
// вычисление data-pos для превью слайдов
var a = content_previwWidth;
var p = (content_previwWidth * 3) - 50; // начальная точка подбиралась методом подбора
for (let i = 0; i < slide_previw.length; i++) {
    p = p - a;
    slide_previw[i].setAttribute("data-pos", p + "px");
}

// размер контейнера дотсов зависит от количества дотсов и всегда центруется (это в css)
if((slideItem.length < 16) && (window.matchMedia('(min-width: 768px)').matches)){
    navList.style.width = (links.length * 12) * 2 + 'px';
}

var slideIndex = 1;

// Подсчет слайдов

let BlockCount = document.querySelector('.count');
let totalCount = document.querySelector('.count__total');
let currentCount = document.querySelector('.count__current');
let totalSlides = slideItem.length;
totalCount.innerHTML = totalSlides;

if(url.hash != '') {
    let urlIndex = Number(url.hash.slice(1)) 
    slideIndex = urlIndex + 1;
    console.log(slideIndex);
}

showSlides(slideIndex);

function autoHeightImg(add) {
            var imgHeight = Math.ceil(slideImg[slideIndex - 1].getBoundingClientRect().height); // вычисляем точную высоту каждого изображения и округляем до большего целога числа
            console.log(imgHeight);
            var BlockCount_Height = Math.ceil(BlockCount.getBoundingClientRect().height);
            var BlockCount_marginTop = parseInt(getComputedStyle(BlockCount, true).marginTop);
            album_wrapper.style.height = imgHeight + add + BlockCount_Height + BlockCount_marginTop + slideTitle[slideIndex - 1].getBoundingClientRect().height + 80 + "px";
            // album_wrapper.style.height = 500 + "px";
    }

function showSlides(n) {
    // Если дошли до последнего слайда - вернуться на первый
    if (n > slideItem.length) {
        slideIndex = 1;
    }
    // Чтобы попасть с первого на последний, листая назад
    if (n < 1) {
        slideIndex = slideItem.length;
    }

    links.forEach((item) => item.classList.remove("slider__dot--active"));
    album_wrapper.style.left = slideItem[slideIndex - 1].getAttribute("data-pos");
    if(wrapper_previw) {
        wrapper_previw.style.left = slide_previw[slideIndex - 1].getAttribute("data-pos");
    }

    if(slideItem.length < 16) {
        links[slideIndex - 1].classList.add('slider__dot--active');
    }
    // выводим номер текущего слайда для подсчета
    currentCount.innerHTML = slideIndex;

    autoHeightImg(50);
    
    // if(window.matchMedia('(max-width: 767px)').matches){
    //         var imgHeight = Math.ceil(slideImg[slideIndex - 1].getBoundingClientRect().height); // вычисляем точную высоту каждого изображения и округляем до большего целога числа
    //         console.log(imgHeight);
    //         var BlockCount_Height = Math.ceil(BlockCount.getBoundingClientRect().height);
    //         var BlockCount_marginTop = parseInt(getComputedStyle(BlockCount, true).marginTop);
    //         album_wrapper.style.height = imgHeight + BlockCount_Height + BlockCount_marginTop + slideTitle[slideIndex - 1].getBoundingClientRect().height + "px";
    // }
    // if(window.matchMedia('(max-width: 1200px)').matches){
    //         var imgHeight = Math.ceil(slideImg[slideIndex - 1].getBoundingClientRect().height); // вычисляем точную высоту каждого изображения и округляем до большего целога числа
    //         console.log(imgHeight);
    //         var BlockCount_Height = Math.ceil(BlockCount.getBoundingClientRect().height);
    //         var BlockCount_marginTop = parseInt(getComputedStyle(BlockCount, true).marginTop);
    //         album_wrapper.style.height = imgHeight + BlockCount_Height + BlockCount_marginTop + slideTitle[slideIndex - 1].getBoundingClientRect().height + "px";
    // }

}

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

prev.addEventListener('click', function () {
    plusSlides(-1);
});

next.addEventListener('click', function () {
    plusSlides(1);
});

// Прокрутка слайдов с помощью стрелок на клавиатуре

window.addEventListener("keydown", function (evt) {
    if (evt.keyCode === 39) {
        evt.preventDefault();
        plusSlides(1);
    }
    if (evt.keyCode === 37) {
        evt.preventDefault();
        plusSlides(-1);
    }
});

var imgNavlgth = document.querySelectorAll('.slider__img-nav');

var ClickDots = function (clickTarget, itemlngh, targetClass) {
    clickTarget.addEventListener('click', function (event) {
        for (let i = 0; i < itemlngh.length + 1; i++) {
            if (event.target.classList.contains(targetClass) && event.target == itemlngh[i - 1]) {
                currentSlide(i);
            }
        }
    });
};

ClickDots(navList, links, 'slider__dot');
ClickDots(wrapper_previw, imgNavlgth, 'slider__img-nav');
ClickDots(album_wrapper, slideImg, 'slider__img');
