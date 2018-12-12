/***
 * Arquivo de editar Linha teórica.
 *
 * @since 12/12/2018
 * @author Douglas <douglasantana007@gmail.com>
 */

$(document).ready(function () {
    var elem = document.querySelector('.js-switch');
    var switchery = new Switchery(elem, { color: '#1AB394' });

    if(elem.checked === false) {
        $('#status').val('I');
    }else{
        $('#status').val('A');
    }

    $('#status').change(function () {

        if(elem.checked === true){
            $('#status').val('A');
        }else{
            $('#status').val('I');
        }

    });

});