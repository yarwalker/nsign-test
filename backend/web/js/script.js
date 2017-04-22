(function($){
    $('.ingridient').draggable({
        containment: ".ingridients",
        scroll: false,
        cursor: 'move',
        helper: 'clone',
        appendTo: 'body',
    });

    $('.dish-ingridients').droppable({
        drop: function( event, ui ) {
            var $ingridient_id = ui.draggable.data('id');

            if( ! $('.dish-ingridients').find('div[data-id=' + $ingridient_id + ']').length ) {
                ui.draggable.append('<input type="checkbox" name="Dishes[ingridients][]" value="' + $ingridient_id + '" checked="checked" >');
                $(this).children('.list-view').append('<div data-key="0"></div>');
                $(this).find('.list-view div[data-key=0]').last().append(ui.draggable);
                $('.available-ingridients').find('div[data-key=' + $ingridient_id + ']').remove();
            }
        }
    });

    $('.available-ingridients').droppable({
        drop: function( event, ui ) {
            var $ingridient_id = ui.draggable.data('id');



            if( ! $(this).find('div[data-id=' + $ingridient_id + ']').length ) {
                ui.draggable.find(':input:checkbox').remove();
                $(this).children('.list-view').append('<div data-key="' + $ingridient_id + '"></div>');
                $(this).find('.list-view div[data-key=' + $ingridient_id + ']').last().append(ui.draggable);
            }

            $('.dish-ingridients').find('div[data-id=' + $ingridient_id + ']').parent().remove();

        }
    });



    $('#ingridients-form-pjax .del-image').on('click', function() {
        var $this = $(this);

        $.post( 'del-image', { 'id': $this.data('id') }, function(data){

            if( data.error !== undefined ) {
                $('#modalMessage .modal-body').html('<p>' + data.error + '</p>');
                $('#modalMessage').modal('show');
            } else {
                $('#modalMessage .modal-body').html('<p>' + data.result + '</p>');
                $('#modalMessage').modal('show');

                // обновим форму
                $.pjax.reload({container: '#ingridients-form-pjax'});
            }

        }, "json")
            .fail(function(error){
                $('#modalMessage .modal-body').html('<p>' + error.responseText + '</p>');
                $('#modalMessage').modal('show');
            });
    });

    $('#dishes-form-pjax .del-image').on('click', function() {
        var $this = $(this);

        $.post( 'del-image', { 'id': $this.data('id') }, function(data){

            if( data.error !== undefined ) {
                $('#modalMessage .modal-body').html('<p>' + data.error + '</p>');
                $('#modalMessage').modal('show');
            } else {
                $('#modalMessage .modal-body').html('<p>' + data.result + '</p>');
                $('#modalMessage').modal('show');

                // обновим форму
                $.pjax.reload({container: '#dishes-form-pjax'});
            }

        }, "json")
            .fail(function(error){
                $('#modalMessage .modal-body').html('<p>' + error.responseText + '</p>');
                $('#modalMessage').modal('show');
            });
    });
})(jQuery)