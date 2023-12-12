const mainSearch = {
    searchTimeoutId: null,
    init: function () {
        let _self = this
        $('#main-search-block input').on('keyup', function () {
            window.clearTimeout(_self.searchTimeoutId)
            _self.searchTimeoutId = window.setTimeout(() => {
                $('#main-search-block').submit();
            }, 600)
        });
        $('#main-search-block').on('submit', function () {
            $('.js-loader').addClass('spinner-border-show');
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (result) {
                    $('.js-video-list').html(result);
                    $('.js-loader').removeClass('spinner-border-show');
                    _self.initSliders();
                }
            });
            return false;
        });
        $('.js-submit-form').on('click', function () {
            $('#main-search-block').submit();
            return false;
        })
        _self.initSliders();
    },
    initSliders() {
        $('.js-section-slider').each(function () {
            console.log($(this).find('section').attr('id'))
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
}
