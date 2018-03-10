/**
 * Created by Caldeira on 24/06/2017.
 */

$(document).ready(function () {
    $("#nu_fone").mask("(99) 9999-9999?9");
});
$(document).ready(function () {
    $("#nu_cep").mask("99999-999");
});
$(document).ready(function () {
    $("#nu_fone2").mask("(99) 9999-9999?9");
});
$(document).ready(function () {
    $("#nu_fone1").mask("(99) 9999-9999?9");
});

$(document).ready(function () {
    $("#nu_cpf").mask("999.999.999-99");
});

$(document).ready(function () {
    $("#nu_rg").mask("99999-999");
});
function tirarAcentos($string)
{
    return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "(ç)", "(Ç)", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U c C n N"), $string);
}
