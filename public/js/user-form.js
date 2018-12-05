/**
 * Script of the user registration page
 * @since 03/12/2018
 * @author Douglasx <douglasantana007@gmail.com>
 */


/**
 * Hide all form for anyone profile.
 * @since 01/12/2018
 */
function hideAll()
{
    $('.form-all').hide('fast');
    $('.form-alu').hide('fast');
    $('.form-sup').hide('fast');
    $('.all-profile').hide('fast');
}

/**
 *
 */
function requiredForAluno() {
    $('#nu_half').attr('required', true);
    $('#id_supervisor').attr('required', true);
    $("#nu_half").attr('maxlength', '2');
}

/**
 *
 */
function requiredForSupervisor() {
    $('#id_theoretical_line').attr('required', true);
    $('#nu_crp').attr('required', true);
    $("#nu_crp").attr('maxlength', '7');
}
/**
 * Check all fields for each profile.
 * @param {*} pfl => profile selected 
 * @since 03/12/2018
 */
function checkFields(pfl)
{

    if(pfl == 3){
        hideAll();
        $('.form-sup').show('slow');
        $('.all-profile').show('slow');
        $('.form-all').show('slow');
        requiredForSupervisor();

    }else if(pfl == 2){
        hideAll();
        $('.all-profile').show('slow');
        $('.form-alu').show('slow');
        $('.form-all').show('slow');
        requiredForAluno();
    }else {
        // requiredForOthers();
        hideAll();
        $('.all-profile').show('slow');
        $('.form-all').show('slow');
    }
}

$(document).ready(function(){
    hideAll();

    $('#username').attr('maxlength', 11);

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