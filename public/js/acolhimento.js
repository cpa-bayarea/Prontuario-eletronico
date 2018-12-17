$(document).ready(function () {

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    var i = ($('#date').val()).replace('/', '');
    var id = i.replace('/', '');
    var ida = id.substr(-4); // Pega o ano informado no campo de nascimento.
    // implementar aqui o ano do nascimento.
    console.log(ida);
});