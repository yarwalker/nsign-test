(function($){

    $('#create-order-form #orders-good_id').on('change', function(){
        $.get('/goods/get-price', {'good_id': $(this).val()}, function(data){
            $('#create-order-form #orders-price').val(data);
        });
    });

    $('#orders-update #orders-good_id').on('change', function(){
        $.get('/goods/get-price', {'good_id': $(this).val()}, function(data){
            $('#orders-update #orders-price').val(data);
        });
    });

})(jQuery);