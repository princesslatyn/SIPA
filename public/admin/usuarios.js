
var usuarios={};
usuarios.init = function(){
  //console.log('Hola Kami'); 
usuarios.agregarusuario();
usuarios.editarusuario();
//usuarios.eliminarusuario();
}
$(usuarios.init);

  usuarios.agregarusuario = function(){
    //Validación de que los campos no se vayan vacios
    $( "#usu" ).validate({
  rules: {
    nom: {
      required: true 
       },
       ape:{
       required: true    
       },
       ide:{
       required: true    
       },
       correo:{
       required: true    
       },
       usuario:{
       required: true    
       },
       pass:{
       required: true    
       },
       programa:{
       required: true    
       },
       rol:{
       required: true    
       }
      }
   });
  //on hace la asignación de un evento..
    $('#agregar').on('click', function(){
        //console.log('Hola')
    if($('#usu').valid()){
    //Declaro las variables que se van a enviar por ajax  
    var nom= $('#nom').val();
    var ape= $('#ape').val();
    var ide= $('#ide').val();
    var correo= $('#correo').val();
    var usuario= $('#usuario').val();
    var pass= $('#pass').val();
    var programa= $('#programa').val();
    var rol= $('#rol').val();
    //console.log(facultad);
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos 
    //console.log(programa);
    
    //Metodo Para enviar los datos al controlador
 var ajax= $.post('/usuarios/guardarusuario', {nom:nom, ape:ape, ide:ide, correo:correo, usuario:usuario, pass:pass, programa:programa, rol:rol});  
     
    ajax.done(function(){
      window.location='/usuarios/listarusuario';   
     }); 
    }
    }); 
 
    
} 
 usuarios.editarusuario = function(){
   //Validación de campos vacios
    $( "#usu" ).validate({
  rules: {
    nom: {
      required: true 
       },
       ape:{
       required: true    
       },
       ide:{
       required: true    
       },
       correo:{
       required: true    
       },
       usuario:{
       required: true    
       },
       pass:{
       required: true    
       },
       programa:{
       required: true    
       },
       rol:{
       required: true    
       }
      }
   }); 
   //Creo una variable que me guarde el dato de la facultad para este caso el id..   
   var programa= $('#programa').data('programa');   
 
      $('#programa').val(programa);
    //Se actualice el valor del selector cuando elija un programa que este asociado a su facultad.
    $('#programa').trigger('change');
     // console.log(facultad);}
    //val le asigna valor al selector...
    var rol= $('#rol').data('rol');
    
     $('#rol').val(rol);
     
     $('#rol').trigger('change');
    
     //Asignación del Evento
 $('#editar').on('click', function(){
     //valido los campos
     if($('#usu').valid()){
     //Creo una variable temporal para que guarde el dato que en el selector de programas
     var id_programa =$('#programa').val();
     //console.log(idfacultad);
     var id_rol =$('#rol').val();
    //Guardar los datos
     var usuario= $('#usuario').val();  
      //console.log(programa);
      //Guardar los Datos
      var id= $('#id_programa').val();
      var ide= $('#id_rol').val();
    //Metodo Para enviar los datos al controlador
    //  var ajax= $.post('/usuarios/actualizarusuario', {usuario:usuario, programa:id_programa, rol:id_rol,  id:id, ide:ide});
  //Actualizar el programa
      ajax.done(function(){
      window.location='/usuarios/listarusuario';   
     });    
    }
 }); 
  
 
  } 
/**  programas.eliminarprogramas = function(){
//Asignación de eventos por delegados
$(document).on('click', '.eliminar_programa', function(e){
  //No se comporte por defecto viene, de mandarme a otra pagina  
  e.preventDefault();  
 //console.log('HOla'); 
//Elemnto cliqueado
  var elementocliqueado= this;
 //función del boton eliminar
  //Elemnto cliqueado
  bootbox.dialog({
  message: "Esta Seguro de Borrar La Programa",
  title: "Confirmar Programa",
  buttons: {
   default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
       // Example.show("Se realizo con Exito");
        var programa_id=$(elementocliqueado).data('programa');
       //console.log(programa_id);
       var ajax= $.post('/programas/eliminarprograma', {programa_id:programa_id});
     ajax.error(function(){
     alert('Error, No puede Borrar, Por que hay una llave foranea dfacultad a programa');
 });
   //Codigo para actualizar el listar programa cuando se borra un programa...
    ajax.done(function(){
        location.reload();
    });
      }
    },
    danger: {
      label: "Cancelar",
      className: "btn-danger",
      callback: function() {
        Example.show("oh, Error!");
      }
    }
  }
});

 
});
    
    
}  */ 
  
   