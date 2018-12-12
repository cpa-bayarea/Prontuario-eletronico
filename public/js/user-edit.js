/**
 * Arquivo de script da página de edição do usuário.
 *
 * @author Douglas <douglasantana007@gmail.com>
 * @since 09/12/2018
 * @param pfl => perfil
 */

/**
 * Define o tamanho de cada campo na hora da edição.
 */
function defineMaxlength() {

    $('#tx_name').attr('maxlength', 100);
    $('#username').attr('maxlength', 11);
    $('#nu_half').attr('maxlength', 2);
    $('#nu_crp').attr('maxlength', 7);
    $('#password').attr('maxlength', 50);

    // @todo adicionar masked_input nos campos abaixo.
    $('#nu_telephone').attr('maxlength', 15);
    $('#nu_cellphone').attr('maxlength', 15);
}
/**
 * Traz os campos que serão preenchidos de acordo com o perfil.
 * @param pfl -> perfil
 */
function mostraCampos(pfl)
{
    // Caso seja perfil Supervisor.
    if(pfl == 3){
        $('.form-alu').hide('fast');
        // Caso seja perfil Aluno.
    }else if(pfl == 2){
        $('.form-sup').hide('fast');
    }else{
        $('.form-sup').hide('fast');
        $('.form-alu').hide('fast');
    }
}

$(function () {



});
/**
 *
 */
$(document).ready(function () {

    var pfl = $('#val-pfl').val();
    var status = $('#status').val();

    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, { color: '#1AB394' });

    var status = $('#status').val();

    defineMaxlength();
    mostraCampos(pfl);

    $('#id_perfil').val(pfl);

    $('#status').change(function () {

        if(elem.checked === true){
            $(this).val('A');
        }else{
            $(this).val('I');
        }

    });

});