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


