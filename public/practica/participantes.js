
var participantes={};
participantes.init = function(){
 // console.log('Hola Kami'); 
participantes.agregardocente();
participantes.agregarauxiliar();
participantes.agregarasesor();
 
}
$(participantes.init);

//Creo un Metodo de Agregar Facultad...
participantes.agregardocente = function(){
    //Validación de que los campos no se vayan vacios
    //on hace la asignación de un evento..
    $('#agregar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    
    var nombre= $('#doce').val();  
    console.log(nombre);
    var identificacion= $('#docente').val();
    var tipo_participante= ('docente');
    var programa= $('#programa').val();
    
   
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Participantes/guardarparticipante', {nombre:nombre, identificacion:identificacion, tipo_participante:tipo_participante, programa:programa});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(data){
      //pintar una nueva opción
      var html= "";
      html= '<option value='+ data.id_participante +'>'+ data.nombre_participante +'</option>';
      $('#docen').append(html);
      //Para que se pueda seleccionar el selector
      $('#docen').find('option[value='+ data.id_participante +']').attr('selected', true);
      $('#docen').triggerHandler('change');
      
     // window.location='/facultades/listarfacultad';
  });
    
    
    });
    
    
}
participantes.agregarauxiliar = function(){
    //Validación de que los campos no se vayan vacios
    //on hace la asignación de un evento..
    $('#agrega').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    
    var nombre= $('#aux').val();  
    console.log(nombre);
   var identificacion= $('#auxiliar').val();
   var tipo_participante= ('auxiliar');
    var programa= $('#program').val();
   
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Participantes/guardarparticipante', {nombre:nombre, identificacion:identificacion, tipo_participante:tipo_participante, programa:programa});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
     // window.location='/facultades/listarfacultad';
  });
    
    
    });
    
      
}
participantes.agregarasesor = function(){
    //Validación de que los campos no se vayan vacios
    //on hace la asignación de un evento..
    $('#agre').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    
    var nombre= $('#ase').val();  
    console.log(nombre);
   var identificacion= $('#asesor').val();
   var tipo_participante= ('asesor');
   var programa= $('#progra').val();
   
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Participantes/guardarparticipante', {nombre:nombre, identificacion:identificacion, tipo_participante:tipo_participante, programa:programa});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
      
     // window.location='/facultades/listarfacultad';
  });
    
    
    });
    
    
    
}




