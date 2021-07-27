

$('#cep').click(function() {
$( "#logradouro" ).empty();
 var rua=  $( "#endereco" ).val();
 var cidade=  $( "#cidade" ).val();
var uf=  $( "#uf" ).val();

if(rua!="" && cidade!="" && uf!="" && rua.length>=3){


$.getJSON("http://viacep.com.br/ws/"+ uf +"/"+ cidade + "/"+ rua + "/json", function(data) {
var teste =data[0].cep;
var cont =data.length;
var c=0;
  
$('#cep').val(teste);
while(cont>c){
$('#logradouro').append('"<option value="'+c+'">'+data[c].logradouro+' '+data[c].complemento+'</option>')
c++;
}

$('#logradouro').click(function(){
var correct= $("#logradouro").val();
$('#cep').val(data[correct].cep);
$("#endereco").val(data[correct].logradouro)
});
});
}
       
});
