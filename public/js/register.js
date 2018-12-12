/**
 * Arquivo de js da página de registro de usuário.
 *
 * @since 09/12/2018
 * @author Douglas <douglasantana007@gmail.com>
 */

/**
 * Limpa os campos do formulário.
 */
function limpaCampos()
{
    $('#password').val('');
    $('#password-confirm').val('');
}
/**
 * Esconde o formulário toodo para qualquer perfil.
 *
 * @since 01/12/2018
 */
function escondeTodos()
{
    $('.form-all').hide('fast');
    $('.form-alu').hide('fast');
    $('.form-sup').hide('fast');
    $('.all-profile').hide('fast');
}

/**
 * Verifica o tipo de perfil para permitir inserir dados.
 *
 * @since 01/12/2018
 * @param perfil
 */
function verificaCampos(perfil)
{
    // Verifica se o perfil é de Supervisor.
    if(perfil == 3){
        escondeTodos();
        $('.form-sup').show('slow');
        $('.all-profile').show('slow');
        $('.form-all').show('slow');
        $('#nu_crp').attr('maxlength', 7);

        // Verifica se o perfil é de Aluno.
    }else if(perfil == 2){
        escondeTodos();
        $('.all-profile').show('slow');
        $('.form-alu').show('slow');
        $('.form-all').show('slow');
        $('#nu_half').attr('maxlength', 2);
    }else {

        // Mostra só os campos que não sejam de aluno ou supevisor.
        escondeTodos();
        $('.all-profile').show('slow');
        $('.form-all').show('slow');
    }
}

$(document).ready(function () {

    escondeTodos();

    $('#matricula').attr('maxlength', 11);
    $('#password').prop('disabled', true);
    // Faz validação se a matrícula informada existe.
    $('#matricula').keyup(function () {
        var mat = $(this).val();

        if (mat === '' || mat === null) {
            // Permite ao usuário informar sua senha.
            $('#password').prop('title', 'Informe uma matrícula !');

        } else {
            $('#password').prop('disabled', false);
        }
    });

    $("#id_perfil").change(function(){
        var pfl = $(this).val();
        verificaCampos(pfl);
    });

    $('.btn-register').prop('disabled', true);

    // Validar se a senha de confirmação é a mesma inserida no campo de senha.
    $('#password-confirm').change(function(){

        var confirm = $(this).val();
        var password = $('#password').val();

        if( (password !== null && password !== '') && (confirm !== null && confirm !== '') ){
            if(confirm === password){
                $('.btn-register').prop('disabled', false);
            }else{
                // @todo adicionar swall aqui.
                alert('Confirmação de senha inválida');
                limpaCampos();
                $('.btn-register').prop('disabled', true);
                return false;
            }
        }else{
            return false;
        }

    });
});