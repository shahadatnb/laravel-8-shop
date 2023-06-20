//Menu
jQuery("document").ready(function ($) {

        var header = $(".menus");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 60) {
            header.removeClass('menus').addClass("fix-nav");
            //$('.navbar .navbar-brand img').attr('src', 'img/menu-icon.png');
        } else {
            header.removeClass("fix-nav").addClass('menus');
            //$('.navbar .navbar-brand img').attr('src', 'img/menu.png');
        }
    });
});
//Fix Menus Css End

jQuery(function ($) {
    $("#owl-slider").owlCarousel({
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true,
        autoplaySpeed: 1000,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 2,
                dots: true
            },
            600: {
                items: 5,
                dots: false
            },
            1000: {
                items: 7,
                dots: false,
            }
        },
        lazyLoad: true,
        nav: true,
        navText: [
'<i class="fa fa-long-arrow-left" aria-hidden="true"></i>',
'<i class="fa fa-long-arrow-right" aria-hidden="true"></i>'
],
        dots: true,
        dotData: false,
    });
});

jQuery(function ($) {
    $("#owl-clients").owlCarousel({
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true,
        autoplaySpeed: 1000,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                dots: true
            },
            600: {
                items: 2,
                dots: true
            },
            1000: {
                items: 2,
                dots: true,
            }
        },
        lazyLoad: true,
        nav: false,
        navText: [
'<i class="fa fa-angle-left" aria-hidden="true"></i>',
'<i class="fa fa-angle-right" aria-hidden="true"></i>'
],
        dots: true,
        dotData: false,
    });
});


jQuery(function ($) {
    $("#owlquickView").owlCarousel({
        autoplay: true,
        autoplayTimeout: 10000,
        autoplayHoverPause: true,
        autoplaySpeed: 1000,
        loop: true,
        margin: 10,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                dots: true
            },
            600: {
                items: 2,
                dots: true
            },
            1000: {
                items: 2,
                dots: true,
            }
        },
        lazyLoad: true,
        nav: false,
        navText: [
'<i class="fa fa-angle-left" aria-hidden="true"></i>',
'<i class="fa fa-angle-right" aria-hidden="true"></i>'
],
        dots: true,
        dotData: false,
    });
});


// Rang Js
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".slider .progress");
let priceGap = 1000;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

// Rang Js