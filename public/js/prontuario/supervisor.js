/**
 * Arquivo de script da página de Supervisor.
 *
 * @since 22/01/2019
 * @author Douglas <douglasantana007@gmail.com>
 */

$(document).ready(function () {
    $('#crp').change(function () {
        var token = $('input[name="_token"]').val();
        var crp = $(this).val();

        if( crp !== '' || crp !== null){

            $.ajax({
                type: 'POST',
                url: '/supervisor/validaCrp',
                data: {_token: token, crp: crp},
                success: function (data) {
                    if(data.error){
                        alert(data.error);
                        $('#crp').val('');
                    }else{
                        console.log(data.success)
                    }
                }
            });

        }
    });

});