document.addEventListener('DOMContentLoaded', function () {
    let splide = new Splide('.js-main-slider', {
        perPage: 3,
        rewind: true,
    });
    splide.on('resize', function () {
        let perPage = $(window).width() > 1383 ? 3 : 2
        if ($(window).width() < 558) {
            perPage = 1;
        }
        splide.options = {
            perPage: perPage,
        };
    });
    splide.mount();

    let attractionSlider = new Splide('.js-attraction-slider', {
        perPage: perPageCount(),
        rewind: true,
    });
    attractionSlider.on('resize', function () {
        attractionSlider.options = {
            perPage: perPageCount(),
        };
    });
    attractionSlider.mount();

    let foodSlider = new Splide('.js-food-slider', {
        perPage: perPageCount(),
        rewind: true,
    });
    foodSlider.on('resize', function () {
        foodSlider.options = {
            perPage: perPageCount(),
        };
    });
    foodSlider.mount();
});

let perPageCount = function () {
    let perPage = $(window).width() > 1383 ? 4 : 3;
    if ($(window).width() < 974) {
        perPage = 2;
    }
    if ($(window).width() < 750) {
        perPage = 1;
    }
    return perPage;
}

$('#menu-up-control').click(function () {
    let menuGeneral = $('#menu-general');
    if ($(this).hasClass('menu-up-control-is-close')) {
        $(this).removeClass('menu-up-control-is-close');
        $(this).addClass('menu-up-control-is-open');
        menuGeneral.removeClass('menu-general-control-is-close');
        menuGeneral.addClass('menu-general-control-is-open');
        $('header').addClass('header-menu-is-open');
    } else {
        $(this).removeClass('menu-up-control-is-open');
        $(this).addClass('menu-up-control-is-close');
        menuGeneral.removeClass('menu-general-control-is-open');
        menuGeneral.addClass('menu-general-control-is-close');
        $('header').removeClass('header-menu-is-open');
    }
});