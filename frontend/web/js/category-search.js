const categorySearch = {
    searchTimeoutId: null,
    init: function () {
        let _self = this
        $('#category-search input').on('keyup', function () {
            window.clearTimeout(_self.searchTimeoutId)
            _self.searchTimeoutId = window.setTimeout(() => {
                $('#category-search').submit();
            }, 600)
        });
        $('#category-search').on('submit', function() {
            $('.js-loader').addClass('spinner-border-show')
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (result) {
                    $('.js-video-list').html(result)
                    $('.js-loader').removeClass('spinner-border-show')
                }
            });
            return false;
        });
        $('.js-submit-form').on('click', function () {
            $('#category-search').submit();
            return false;
        })
    }
}
