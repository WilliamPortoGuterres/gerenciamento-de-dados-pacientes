
$(function(){
    $('.mascaradata').mask('00/00/0000', {reverse: false});
    $('.mascaradataentrada').mask('00/00/0000', {reverse: false});
    $('.cns').mask('000-0000-0000-0000', {reverse: false});
    $('.cbo').mask('000000', {reverse: false});
    $('.cpf').mask('000.000.000-00', {reverse: false}); 
    $('.rg').mask('0000000000', {reverse: false});       
    $('.telefone').mask('(00)00000-0000', {reverse: false});  
    $('.telefoneconvencinal').mask('(00)0000-0000', {reverse: false});  
$('.cep').mask('00000-000', {reverse: false});   
/*
    $('.dinheiro').mask('#.##0,00', {reverse: true});
    $('.referencia').mask('###000', {reverse: true});*/



});