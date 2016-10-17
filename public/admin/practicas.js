
var practicas={};
practicas.init = function(){
 // console.log('Hola Kami'); 
 practicas.agregarpractica ();
 practicas.editarpractica();
 practicas.eliminarpractica();
}
$(practicas.init);

//Creo un Metodo de Agregar Facultad...
 practicas.agregarpractica = function(){
  
     //Evento en el Boton
   var datatable= $('#example').DataTable();
      // Para las multiples tablas
     // $('table.display').dataTable();
      $('#prog').on('click', function(){ 
     // console.log('Hola');
      var num= $('#num').val(); 
      console.log(num);
      var reco= $('#reco').val();
       console.log(reco);
      var sal= $('#sal').val(); 
       console.log(sal);
      var lug= $('#lug').val(); 
       console.log(lug);
      var dia= $('input[name="optionsRadios"]:checked').val(); 
       console.log(dia);
      var lle= $('#lle').val(); 
       console.log(lle);
      var tipo= $('#tipo').val();
       console.log(tipo);
      var valor= $('#valor').val(); 
       console.log(valor);
       var doce= $('#doce').val();
       console.log(doce);
        var aux= $('#aux').val();
       console.log(aux);
        var ase= $('#ase').val();
       console.log(ase);
      var obs= $('#obs').val(); 
       console.log(obs);
       
         //Validación De campos Vacios
    var valid= true;
    if(num > 0 && reco != "" && sal != "" && lug != ""  && dia != "" && lle != "" && tipo != "" && valor > 0 && doce != "" && aux != "" && ase != "" &&  obs != ""){
       
        valid= true;
        datatable.row.add([
         num,
         reco,
         sal,
         lug,
         dia,
         lle,
         tipo,
         valor,
         doce,
         aux,
         ase,
         obs,
         '<td><a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a></td>'
           
      ]).draw();
       // alert('Los Datos Son Correctos');
    }else{
        valid = false;
        alert('Los Datos Son Incorrectos');
    } 
      }); 
         
    //Validación de que los campos no se vayan vacios
    $( "#myWizard" ).on('finished.fu.wizard', function(){
        console.log('Hola Kami');
        //Con esta variable le paso los datos del formulario en un vector
     var datos = $('#pra').serialize();
     alert(datos);  
     
       var ajax= $.post('/practicas/guardarpractica', {datos:datos});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
    //  window.location='/facultades/listarfacultad';
  });
   
   });
 
  
    
    
   
    
}
 practicas.editarpractica = function(){
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
practicas.eliminarpractica = function(){
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





