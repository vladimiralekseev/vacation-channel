const schedule = {
    url: null,
    init: function (url) {
        const _self = this;
        _self.url = url;
        $('.js-datepicker').datepicker({startDate: '+0d', orientation: 'bottom'}).on('changeDate', function (e) {
            _self.loadSchedule();
            $(this).datepicker('hide');
        });
        // $('.js-open-schedule').click(function () {
        //     console.log($(this).data('modal-id'))
        //     $('#' + $(this).data('modal-id')).modal('show');
        //     _self.url = $(this).data('url');
        // })
        _self.loadSchedule();
    },
    loadSchedule() {
        const _self = this;
        $('.js-modal-content').html('<div class=\"text-center\"><div class=\"spinner-border text-turquoise\"></div></div>');
        $.ajax({
            url: _self.url,
            data: {date: $('.js-datepicker').val()},
            method: 'GET',
            success: function (result) {
                $('.js-modal-content').html(result);
            }
        });
    }
}
