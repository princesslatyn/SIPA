
var conductor={};
conductor.init = function(){
 // console.log('Hola Kami'); 
 conductor.agregarconductor();
 conductor.editarconductor();
 conductor.eliminarconductor();
}
$(conductor.init);

//Creo un Metodo de Agregar Conductor...
conductor.agregarconductor = function(){
  //Validación de que los campos no se vayan vacios
    $( "#con" ).validate({
  rules: {
    nom: {
      required: true
       },
       ape: {
      required: true
       },
       ide: {
      required: true
       },
       tele: {
      required: true
       },
       dir: {
      required: true
       }
      }
   });
    //on hace la asignación de un evento..
    $('#agregar').on('click', function(){
       console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    if($('#con').valid()){
    var nom= $('#nom').val(); 
    console.log(nom);
    var ape= $('#ape').val();
    console.log(ape);
    var ide= $('#ide').val();
    console.log(ide);
    var tele= $('#tele').val();
    console.log(tele);
    var dir= $('#dir').val();
    console.log(dir);
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/conductor/guardarconductor', {nom:nom, ape:ape, ide:ide, tele:tele, dir:dir});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
    //  window.location='/facultades/listarfacultad';
  });
    }
    
    });
    
}
conductor.editarconductor = function(){
     //Validación de que los campos no se vayan vacios
    $( "#fac" ).validate({
  rules: {
    facultad: {
      required: true
       }
      }
   });
    //on hace la asignación de un evento..
    $('#editar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    //Valido los campos
    if($('#fac').valid()){
    var facultad= $('#facultad').val(); 
    //Guardar el id de facultades
    var id=$('#id_facultad').val();
    
            
   // console.log(facultad);
    //Metodo Para enviar los datos al controlador
 var ajax=  $.post('/facultades/actualizarfacultad', {facultad:facultad, id:id});
       //Actualizar Facultad
        ajax.done(function(){
      window.location='/facultades/listarfacultad';
  });    
    }
    });
    
}
conductor.eliminarconductor = function(){
//Asignación de eventos por delegados
$(document).on('click', '.eliminar_facultad', function(e){
  //No se comporte por defecto viene, de mandarme a otra pagina  
  e.preventDefault(); 
   //Elemnto cliqueado
 var elementocliqueado= this;
 //console.log('HOla'); 
    bootbox.dialog({
  message: "Esta Seguro de Borrar La Facultad",
  title: "Confirmar Facultad",
  buttons: {
    default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
       // Example.show("Se realizo con Exito");
        var facultad_id=$(elementocliqueado).data('facultad');
// console.log(facultad_id);

 var ajax= $.post('/facultades/eliminarfacultad', {facultad_id:facultad_id});
 
 ajax.error(function(){
     alert('Error, No puede Borrar, Por que hay una llave foranea de programas a facultad');
 });
 //Codigo para actualizar automaticamente la pagina..
 ajax.done(function(){
  location.reload();   
 });
      }
    },
    danger: {
      label: "Cancelar",
      className: "btn-danger",
      callback: function() {
       // Example.show("oh, Error!");
      }
    }
    
  }
});
 
 });   
    
}








