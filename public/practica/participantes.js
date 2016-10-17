
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
    
    var doce= $('#doce').val();  
    console.log(doce);
    var docente= $('#docente').val();
    var tipo_docente= ('docente');
    var programa= $('#programa').val();
   
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Participantes/guardarparticipante', {doce:doce, docente:docente, tipo_docente:tipo_docente, programa:programa});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
     // window.location='/facultades/listarfacultad';
  });
    
    
    });
    
    
}
participantes.agregarauxiliar = function(){
    //Validación de que los campos no se vayan vacios
    //on hace la asignación de un evento..
    $('#agregar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    
    var aux= $('#aux').val();  
    console.log(aux);
   var auxiliar= $('#auxiliar').val();
   var tipo_auxiliar= $('#tipo_auxiliar').val();
    var program= $('#program').val();
   
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Participantes/guardarparticipante', {aux:aux, auxiliar:auxiliar, tipo_auxiliar:tipo_auxiliar, program:program});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
     // window.location='/facultades/listarfacultad';
  });
    
    
    });
    
      
}
participantes.agregarasesor = function(){
    //Validación de que los campos no se vayan vacios
    //on hace la asignación de un evento..
    $('#agregar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    
    var ase= $('#ase').val();  
    console.log(ase);
   var asesor= $('#asesor').val();
   var tipo_asesor= $('#tipo_asesor').val();
   var progra= $('#progra').val();
   
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Participantes/guardarparticipante', {ase:ase, asesor:asesor, tipo_asesor:tipo_asesor, progra:progra});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
     // window.location='/facultades/listarfacultad';
  });
    
    
    });
    
    
    
}




