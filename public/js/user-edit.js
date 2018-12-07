function showForm(pfl)
{
    // when user is supervisor.
    if(pfl == 3){
        $('.form-alu').hide('fast');
        // when user is aluno.
    }else if(pfl == 2){
        $('.form-sup').hide('fast');
    }else{
        $('.form-sup').hide('fast');
        $('.form-alu').hide('fast');
    }
}

/**
 *
 */
$(document).ready(function () {

    var pfl = $('#val-pfl').val();
    showForm(pfl);

    $('#id_perfil').val(pfl);

});