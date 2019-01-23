/**
 * Arquivo de script da página de Aluno.
 *
 * @since 23/01/2019
 * @author Douglas <douglasantana007@gmail.com>
 */

$(document).ready(function () {

    var token = $('input[name="_token"]').val();
    var id_alu = $('#aluno_id').val();

    $('#matricula').change(function () {
        var mat = $(this).val();

        if( mat !== '' || mat !== null) {
            validarMatriculaAjax(token, mat);
        }
    });

    if( id_alu == null || id_alu == '' ){
        $('#password').attr('required', true);
    }

});

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
