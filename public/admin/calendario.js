
var calendar={};
calendar.init = function(){
 // console.log('Hola Kami'); 
 calendar.agregarcalendar();
 calendar.editarcalendar();
 calendar.eliminarcalendar();
 calendar.agregarannio();
}
$(calendar.init);

//Creo un Metodo de Agregar Facultad...
calendar.agregarcalendar = function(){
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
  var ajax= $.post('/calendar/guardarcalendar', {annio:annio, per:per, ini:ini, fin:fin});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
    ajax.error(function(){
      alert('Error, las Fechas Ingresadas Son Incorrectas');  
    });
    ajax.done(function(){
    window.location='/calendar/listarcalendar';
    //pintar una nueva opción
    
   });
    }
    
    });
    
}
//metodo para pintar el select
//Creo un Metodo de Agregar Facultad...
calendar.agregarannio = function(){
   
    //on hace la asignación de un evento..
    $('#agrega').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    
    var annio= $('#annio').val();  
    console.log(annio);
   // console.log(facultad);
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/calendar/guardarcalendar', {annio:annio});
   ajax.done(function(data){
   // window.location='/calendar/listarcalendar';
    //pintar una nueva opción
      var html= "";
      html= '<option value='+ data.id +'>'+ data.annio +'</option>';
      console.log(html);
      console.log(data);
      $('#annio').append(html);
      //Para que se pueda seleccionar el selector
      $('#annio').find('option[value='+ data.id +']').attr('selected', true);
      $('#annio').triggerHandler('change');
   });
   
    
    });
    
}

calendar.editarcalendar = function(){
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
    $('#editar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    //Valido los campos
    if($('#cale').valid()){
   var annio= $('#annio').val(); 
   var per= $('#per').val();
   var ini= $('#ini').val(); 
   console.log(ini);
   var fin= $('#fin').val();
   console.log(fin);
   var ide= $('#id').val();
    //console.log(fin);
    
            
   // console.log(facultad);
    //Metodo Para enviar los datos al controlador
 var ajax=  $.post('/calendar/actualizarcalendar', {annio:annio, per:per, ini:ini, fin:fin, ide:ide});
      //Mensaje de error cuando las fechas son incorrectas
      ajax.error(function(){
      alert('Error, las Fechas Ingresadas Son Incorrectas');  
       });
      //Actualizar Calendario
        ajax.done(function(){
      window.location='/calendar/listarcalendar';
  });    
    }
    });
    
}
calendar.eliminarcalendar = function(){
   // console.log('eliminar');
//Asignación de eventos por delegados
$(document).on('click', '.eliminar_calendario', function(e){
  //No se comporte por defecto viene, de mandarme a otra pagina  
  e.preventDefault(); 
   //Elemnto cliqueado
 var elementocliqueado= this;
 //console.log('HOla'); 
    bootbox.dialog({
  message: "Esta Seguro de Borrar El Calendario",
  title: "Confirmar Calendario Académico",
  buttons: {
    default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
       // Example.show("Se realizo con Exito");
        var calendario_id=$(elementocliqueado).data('calendario');
        console.log(calendario_id);

 var ajax= $.post('/calendar/eliminarcalendar', {calendario_id:calendario_id});
  ajax.error(function(){
     alert('Error, No puede Borrar.');
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





