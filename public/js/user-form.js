/**
 * Script da página de registro de usuário.
 * @since 03/12/2018
 * @author Douglasx <douglasantana007@gmail.com>
 */

/**
 * Atribui tamanho e obrigatoriedade ao formulario.
 * @since 05/12/2018
 */
function defineRequired()
{
    $('#matricula').attr('maxlength', 11);
    $('#nu_telephone').attr('maxlength', 15);
    $('#nu_cellphone').attr('maxlength', 15);
    $('#tx_email').attr('maxlength', 100);
    $('#id_perfil').attr('required', true);
}

/**
 * Esconde todos os campos do formulário independente do perfil.
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
 *
 */
function requiredAluno() {
    $('#nu_half').attr('required', true);
    $('#id_supervisor').attr('required', true);
    $("#nu_half").attr('maxlength', '2');
}

/**
 *
 */
function requiredSupervisor() {
    $('#id_theoretical_line').attr('required', true);
    $('#nu_crp').attr('required', true);
    $("#nu_crp").attr('maxlength', '7');
}
/**
 * Verifica todos os campos de acordo com o perfil selecionado.
 * @param {*} pfl => Perfil Selecionado
 * @since 03/12/2018
 */
function checkFields(pfl)
{

    if(pfl == 3){
        escondeTodos();
        $('.form-sup').show('slow');
        $('.all-profile').show('slow');
        $('.form-all').show('slow');
        requiredSupervisor();

    }else if(pfl == 2){
        escondeTodos();
        $('.all-profile').show('slow');
        $('.form-alu').show('slow');
        $('.form-all').show('slow');
        requiredAluno()();
    }else {
        // requiredForOthers();
        escondeTodos();
        $('.all-profile').show('slow');
        $('.form-all').show('slow');
    }
}

$(document).ready(function(){
    escondeTodos();

    defineRequired();

    // Faz validação se a matrícula informada existe.
    $('#username').keyup(function () {
        var mat = $(this).val();

        if (mat !== '') {
            // Permite ao usuário informar sua senha.
            $('#password').prop('disabled', false);
        } else {
            $('#password').prop('disabled', true);
        }
    });

    if( $('#username').val() !== ''){
        $('#password').prop('disabled', false);
    }else{
        $('#password').prop('disabled', true);
    }

    $('#password').prop('title', 'Informe uma matrícula !');

    $('.inteiro').keyup(function () {
        $($(this)).val($(this).val().replace(/[^0-9]/g, ''));
    });

    $("#id_perfil").change(function(){
        var pfl = $(this).val();
        checkFields(pfl);
    });

    $('.btn-register').prop('disabled', 'true');

    $('#password').change(function(){

        var pfl = $("#id_perfil").val();
        // Validate that all forms have been successfully completed
        $('.btn-register').prop('disabled', false);
    });

});