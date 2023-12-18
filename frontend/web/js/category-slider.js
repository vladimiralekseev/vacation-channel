function initSliders() {
    $('.js-section-slider').each(function () {
        let attractionSlider = new Splide('#' + $(this).find('section').attr('id'), {
            perPage: perPageCount(),
            rewind: true,
        });
        attractionSlider.on('resize', function () {
            attractionSlider.options = {
                perPage: perPageCount(),
            };
        });
        attractionSlider.mount();
    });
}
