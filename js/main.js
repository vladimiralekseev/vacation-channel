document.addEventListener( 'DOMContentLoaded', function() {
    let splide = new Splide('.js-main-slider', {
        perPage: 3,
        rewind: true,
    });
    // splide.on( 'resize', function ( isOverflow ) {
    //     splide.options = {
    //         perPage: 2,
    //     };
    // } );
    splide.mount();
    let attractionSlider = new Splide('.js-attraction-slider', {
        perPage: 4,
        rewind: true,
    });
    attractionSlider.mount();

    let foodSlider = new Splide('.js-food-slider', {
        perPage: 4,
        rewind: true,
    });
    foodSlider.mount();
});

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
