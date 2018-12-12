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

});