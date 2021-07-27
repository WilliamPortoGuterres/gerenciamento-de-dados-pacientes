var CountProds = 1;

  var data;

function AddInput() {
  h = CountProds;
var especialidade = ' <select type="select" onchange="AddInput()"class="form-control"   id="especialidade" name="especialidade[]" placeholder="" value="" ><option value=""></option><option value="Acolhimento inicial">Acolhimento inicial</option><option value="Atendimento psiquiátrico">Atendimento psiquiátrico</option><option value="Atendimento clinico">Atendimento clinico</option><option value="Assistente social">Assistente social</option><option value="Atendimento pscológico">Atendimento pscológico</option><option value="Assistencia social">Assistencia social</option><option value="Enfermagem">Enfermagem</option><option value="Terapeuta ocupacional">Terapeuta ocupacional</option><option value="Educador físico ">Educador físico </option><option value="Permanencia noturna">Permanencia noturna</option><option value="Oficineiro">Oficineiro</option></select> <div id="marcador"></div>' ;
$( especialidade ).appendTo( "#marcadorespecialidade" );
var atendente=' <select type="select" class="form-control nomecolaborador" id="nomecolaborador'+h+'" name="nomecolaborador[]" placeholder="" value=""></select>';
$( atendente ).appendTo( "#marcadoratendente" );
$.post( "controler/buscadoratendente.php", function( data ) {
 
prim='<option value=""></option>'
data= prim+data
 $( "#nomecolaborador"+h ).html( data );
  CountProds++;


});

}

  