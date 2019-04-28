$( document ).ready(function() {

    $('#myphone').mask('+7(000)00-00-000');

    $('.check').bind('input',function(){
        $.ajax({
            url: 'php/main.php',
            data: {
                command: 'check',
                name   : $(this).data('check'),
                value  : $(this).val(),
            },
            success: ( res ) => {
                res = JSON.parse( res );
                if ( res.success ){
                    $('#alert' + $(this).data('check')).hide();
                    $('#my' + $(this).data('check')).css('border-color','#C9C9C9');
                } else {
                    $('#alert' + $(this).data('check')).show();
                    $('#my' + $(this).data('check')).css('border-color','red');
                }
            } 
        });
    })

    $('#mysubmit').click(function(){
        $.ajax({
            url: 'php/main.php',
            data: {
                command: 'send',
                phone  : $('#myphone').val(),
                name   : $('#myname').val(),
            },
            success: function( res ){
                res = JSON.parse( res );
                if ( res.success ){
                    $('.alert-success').show();
                    $('.alert-danger').hide();
                } else {
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                }
            } 
        });
    })
} )