const categorySearch = {
    init: function () {
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
