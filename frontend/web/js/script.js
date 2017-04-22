(function($){
    var $checked_counter = 0,
        $counter_span = $('div.info span'),
        $modal = $('#modalMessage');

    $('.ingridient-block :checkbox').on('change', function(){
        $checked_counter = $('.ingridient-block :checkbox:checked').length;
        $counter_span.text($checked_counter);
    });

    $('#order-form').on('submit', function(ev){
        ev.preventDefault();

        if( $checked_counter < 3 || $checked_counter > 5 ) {
            $modal.find('.modal-body').html('<p>Необходимо выбрать от 3 до 5 ингридиентов!</p>');
            $modal.modal('show');
        } else {
            //$(this).submit();
            $.post($(this).attr('action'), $(this).serialize(), function(data){
                if( data.error !== undefined ) {
                    $modal.find('.modal-body').html('<p>' + data.error + '</p>');
                    $modal.modal('show');
                } else {
                    $('#chosen-dish').html(data.dishes);
                }
            }, 'json')
            .fail(function(error){
                $modal.find('.modal-body').html('<p>' + + error.responseText + + '</p>');
                $modal.modal('show');
            });
        }
    });
})(jQuery)