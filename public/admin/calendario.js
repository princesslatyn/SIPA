
var calendario={};
calendario.init = function(){
 // console.log('Hola Kami'); 
 calendario.agregarcalendario();
 calendario.editarcalendario();
 calendario.eliminarcalendario();
}
$(calendario.init);

//Creo un Metodo de Agregar Facultad...
calendario.agregarcalendario = function(){
    //Validación de que los campos no se vayan vacios
  
  $( "#cale" ).validate({
  rules: {
    annio: {
      required: true
       },
       per: {
      required: true
       },
       ini: {
      required: true
       },
      fin: {
      required: true
       }
      }
   });
    //on hace la asignación de un evento..
    $('#agregar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    if($('#cale').valid()){
    var annio= $('#annio').val();  
    var per= $('#per').val(); 
    var ini= $('#ini').val(); 
    var fin= $('#fin').val();
    console.log(fin);
   // console.log(facultad);
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Calendario/guardarcalendario', {annio:annio, per:per, ini:ini, fin:fin});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
    //  window.location='/Calendario/listarcalendario';
  });
    }
    
    });
    
}
calendario.editarcalendario = function(){
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
calendario.eliminarcalendario = function(){
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





