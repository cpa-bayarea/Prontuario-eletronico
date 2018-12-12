/**
 * Arquivo de script da página de login de usuário.
 *
 * @since 09/12/2018
 * @author Douglas <douglasantana007@gmail.com>
 */

$(document).ready(function () {

    $('#username').attr('maxlength', 11);
    var matricula = $('#username').val();

    $('#password').prop('title', 'Informe uma matrícula !');
    $('#password').prop('disabled', true);

    // Faz validação para permitir informar senha somente após inserir matrícula.
    $('#username').keyup(function () {
        var mat = $(this).val();

        if (mat !== '' && mat !== null) {
            // Permite ao usuário informar sua senha.
            $('#password').prop('disabled', false);
        } else {
            $('#password').prop('disabled', true);
        }
    });

    // Mascara com regex para ser inserido somente números.
    $('.inteiro').keyup(function () {
        $($(this)).val($(this).val().replace(/[^0-9]/g, ''));
    });

});