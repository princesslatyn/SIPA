
var liquidarconductor={};
liquidarconductor.init = function(){
 // console.log('Hola Kami'); 
 liquidarconductor.agregarliquidarconductor();
 liquidarconductor.editarliquidarconductor();
 liquidarconductor.eliminarliquidarconductor();
}
$(liquidarconductor.init);

//Creo un Metodo de Agregar Conductor...
liquidarconductor.agregarliquidarconductor = function(){
  //Validación de que los campos no se vayan vacios
    $( "#liqui" ).validate({
  rules: {
    combu: {
      required: true
       },
       pea: {
      required: true
       },
       via: {
      required: true
       },
       impre: {
      required: true
       },
       paga: {
      required: true
       },
       lega: {
        required: true   
       },
       pa: {
        required: true   
       },
       le: {
        required: true   
       },
        ru: {
        required: true   
       },
       condu: {
        required: true   
       },
       co: {
        required: true   
       },
       veh: {
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
    if($('#liqui').valid()){
    var combustible= $('#combu').val(); 
    console.log(combustible);
    var peaje= $('#pea').val();
    console.log(peaje);
    var viatico= $('#via').val();
    console.log(viatico);
    var imprevisto= $('#impre').val();
    console.log(imprevisto);
    var pagado= $('#paga').val();
    console.log(pagado);
     var legalizado= $('#lega').val();
    console.log(legalizado);
    var fechapa= $('#pa').val();
    console.log(fechapa);
     var fechale= $('#le').val();
    console.log(fechale);
    var codigo_prog= $('#ru').val();
    console.log(codigo_prog);
    var conductor= $('#condu').val();
    console.log(conductor);
    var cod_practica= $('#co').val();
    console.log(cod_practica);
    var vehiculo= $('#veh').val();
    console.log(vehiculo);
    //Metodo Para enviar los datos al controlador
  var ajax= $.post('/liquiconductor/guardarliquiconductor', {combustible:combustible, peaje:peaje, viatico:viatico, imprevisto:imprevisto, pagado:pagado, legalizado:legalizado, fechapa:fechapa, fechale:fechale, codigo_prog:codigo_prog, conductor:conductor, cod_practica:cod_practica, vehiculo:vehiculo});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
  // window.location='/conductor/listarconductor';
  });
    }
    
    });
    
}
liquidarconductor.editarliquidarconductor = function(){
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
    $('#editar').on('click', function(){
       // console.log('Hola')
    //val me devuelve el elemento que esta en el id de la función  (extrae el valor del input)
    // #facultad valor del input
    // facultad variable donde se guarda los datos
    //Valido los campos
    if($('#con').valid()){
    var nombre= $('#nom').val(); 
    //console.log(nom);
    var apellido= $('#ape').val();
   // console.log(ape);
    var identificacion= $('#ide').val();
   // console.log(ide);
    var telefono= $('#tele').val();
    //console.log(tele);
    var direccion= $('#dir').val();
    //console.log(dir);
    //Guardar el id de facultades
    var id=$('#id_conductor').val();
    
            
   // console.log(facultad);
    //Metodo Para enviar los datos al controlador
 var ajax=  $.post('/conductor/actualizarconductor', {nombre:nombre, apellido:apellido, identificacion:identificacion, telefono:telefono, direccion:direccion, id:id});
       //Actualizar Facultad
        ajax.done(function(){
        window.location='/conductor/listarconductor';
  });    
    }
    });
    
}
//Edición Adicional

liquidarconductor.eliminarliquidarconductor = function(){
//Asignación de eventos por delegados
$(document).on('click', '.eliminar_conductor', function(e){
  //No se comporte por defecto viene, de mandarme a otra pagina  
  e.preventDefault(); 
   //Elemnto cliqueado
 var elementocliqueado= this;
 //console.log('HOla'); 
    bootbox.dialog({
  message: "Esta Seguro de Borrar el conductor",
  title: "Confirmar Facultad",
  buttons: {
    default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
       // Example.show("Se realizo con Exito");
        var conductor_id=$(elementocliqueado).data('conductor');
// console.log(facultad_id);

 var ajax= $.post('/conductor/eliminarconductor', {conductor_id:conductor_id});
 
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








