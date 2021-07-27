
$('#form1').keyup(function() {
   
    var localizador = $('input[name="localizador"]').val()
    var selecionador = $( "#selecionador option:selected" ).val()//form select é capturado desta forma
 if(localizador==""){
localizador="tttttttttttttttttttttttttttttttttttttttttttttt"
 $.ajax({
        url: 'controler/listarpacientes.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({localizador: localizador, selecionador: selecionador}),
        success: function(response) {
            $('#resultado').html(response);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}else{
//console.log(selecionador)
//console.log(localizador)
    
    $.ajax({
        url: 'controler/listarpacientes.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({localizador: localizador, selecionador: selecionador}),
        success: function(response) {
            $('#resultado').html(response);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
    return false;
});

$('#emailcolaborador').keyup(function() {
   
    var emailcolaborador = $('input[name="emailcolaborador"]').val()
    console.log(emailcolaborador);
 if(emailcolaborador==""){}else{
//console.log(selecionador)
//console.log(localizador)
    
    $.ajax({
        url: 'controler/verificaemail.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({emailcolaborador: emailcolaborador}),//parametro
       success: function(response) {
            $('#respostaemail').html(response);
   
// $('#resultado').html(response);
        },
        //error: function(xhr, status, error) {
        //    alert(xhr.responseText);
    //    }
    });
}
    return false;
});
$('#tr').keyup(function() {
  
    var tr = $('input[name="tr"]').val()
    console.log(tr);
 if(tr==""){$('#respostatr').html('');}else{
//console.log(selecionador)
//console.log(localizador)
    
    $.ajax({
        url: 'controler/verificatr.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({tr: tr}),//parametro
       success: function(response) {
            $('#respostatr').html(response);   
           

             },
      
    });
}
    return false;
});

//colaboradores


$('#formcolaboradores').keyup(function() {
   
    var localizador = $('input[name="localizadorcolaborador"]').val()
    
 if(localizador==""){
localizador="tttttttttttttttttttttttttttttttttttttttttt"
 $.ajax({
        url: 'controler/listarcolaboradores.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({localizador: localizador}),
        success: function(response) {
            $('#resultadocolaborador').html(response);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}else{
//console.log(selecionador)
//console.log(localizador)
    
    $.ajax({
        url: 'controler/listarcolaboradores.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({localizador: localizador}),
        success: function(response) {
            $('#resultadocolaborador').html(response);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}
    return false;
});


$('#presenca1').click(function() {
   var id = $(this).parent().data('id');
   
    
 console.log(id)

 $.ajax({
        url: 'controler/listarpacientes.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({id: id}),
        success: function(response) {
            $(alert()).html(response);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });

    return false;
});
$('#cns').keyup(function() {
  
    var cns = $('#cns').val()
    console.log(cns);
 if(cns==""){$('#respostacns').html('');}else{
//console.log(selecionador)
//console.log(localizador)
    
    $.ajax({
        url: 'controler/verificacns.php', // caminho para o script que vai processar os dados
        type: 'POST',
        data: ({cns: cns}),//parametro
       success: function(response) {
            $('#respostacns').html(response);   
           

             },
      
    });
}
    return false;
});