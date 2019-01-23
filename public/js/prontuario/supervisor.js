/**
 * Arquivo de script da página de Supervisor.
 *
 * @since 22/01/2019
 * @author Douglas <douglasantana007@gmail.com>
 */

$(document).ready(function () {

    var token = $('input[name="_token"]').val();
    var id_super = $('#supervisor_id').val();

    $('#crp').change(function () {
        var crp = $(this).val();

        if( crp !== '' || crp !== null){
            validarCrpAjax(token, crp);
        }
    });

    $('#matricula').change(function () {
        var mat = $(this).val();

        if( mat !== '' || mat !== null){
            validarMatriculaAjax(token, mat);
        }
    });

    if( id_super == null || id_super == '' ){
        $('#password').attr('required', true);
    }

});

/**
 * Verifica se o número do registro do crp informado existe no sistema.
 * @param token
 * @param crp
 */
function validarCrpAjax(token, crp){

    $.ajax({
        type: 'POST',
        url: '/supervisor/validarCrp',
        data: {_token: token, crp: crp},
        success: function (data) {

            if(data.error){
                swal("Atenção!", data.error, "error");
                $('#crp').val('');
            }else{
                console.log(data.success)
            }
        }
    });
}

/**
 * Verifica se a matrícula informada existe no sistema.
 * @param token
 * @param matricula
 */
function validarMatriculaAjax(token, matricula){

    $.ajax({
        type: 'POST',
        url: '/user/validarMatricula',
        data: {_token: token, nu_matricula: matricula},
        success: function (data) {

            if(data.error){
                swal("Atenção!", data.error, "error");
                $('#matricula').val('');
            }else{
                console.log(data.success)
            }
        }
    });
}
