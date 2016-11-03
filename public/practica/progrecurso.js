
var progrecurso={};
progrecurso.init = function(){
 // console.log('Hola Kami'); 
progrecurso.agregarprogrecurso();

 
}
$(progrecurso.init);

//Creo un Metodo de Agregar Facultad...
progrecurso.agregarprogrecurso = function(){
    //Validación de que los campos no se vayan vacios
    //on hace la asignación de un evento..
    $('#rec').on('click', function(){
       // console.log('Hola') 
   var valor= $('#valor').val(); 
       console.log(valor);
    var valid= true;
   //console.log(valid);
    if(valor > 0){
       //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Progrecurso/guardarprogrecurso', {valor:valor});
  
  }else{
        valid = false;
        alert('Los Datos Son Incorrectos');
        
    }
   
    });
    
    
}






