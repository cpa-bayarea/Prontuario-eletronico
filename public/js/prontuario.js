/**
 * Arquivo global do sistema.
 *
 * @author Douglas <douglasantana007@gmail.com>
 * @since 11/12/2018
 **/

$(document).ready(function () {

    // Mascara com regex para ser inserido somente números.
    $('.inteiro').keyup(function () {
        $($(this)).val($(this).val().replace(/[^0-9]/g, ''));
    });

    // Datatables iniciar por marcador 10.
    $('.dataTables').DataTable({
        pageLength: 10,
        responsive: true,
    });

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