
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
      //Se muestre por consola el resultado de este metodo    
     // datatable.fnGetData();  
     
      var num= $('#num').val(); 
      console.log(num);
      var reco= $('#reco option:selected').html();
       console.log(reco);
      var despla= $('#despla').val();
      console.log(despla);
      var sal= $('#sal').val(); 
       console.log(sal);
      var lug= $('#lug').val(); 
       console.log(lug);
      var dia= $('#per').val(); 
       console.log(dia);
      var lle= $('#lle').val(); 
       console.log(lle);
       var docen= $('#docen option:selected').html();
       console.log(docen);
        var auxi= $('#auxi option:selected').html();
       console.log(auxi);
        var ases= $('#ases option:selected').html();
       console.log(ases);
      var obs= $('#obs').val(); 
       console.log(obs);
       
       //función para eliminar una fila
      $(document).on( 'click', '.eliminar_practica', function (e) {
          // Previene los comportamientos por defectos
           e.preventDefault(); 
    datatable
        .row( $(this).parents('tr') )
        .remove()
        .draw();
      });
      
         //Validación De campos Vacios
    var valid= true;
     //llamo a la variable table
      var table=$('#examplee').DataTable();
      
      table.rows().data();
      var recursos= table.data().toArray();
      var recursosdatos= "";
      var ides= [];
      var nombresrecursos= [];
      
      for(var i=0; i<recursos.length; i++){
          ides.push(recursos[i][0]);
          nombresrecursos.push(recursos[i][1]);
          
          
      }
        recursosdatos= nombresrecursos.join(',') +'<input type="hidden" value=' + ides.join(',') + '>' ;
    if(num > 0 && reco != "" && despla != "" && sal != "" && lug != ""  && dia != "" && lle != "" && docen != "" && auxi != "" && ases != "" &&  obs != ""){
       
       
        valid= true;
        datatable.row.add([
         num,
         reco,
         despla,
         sal,
         lug,
         dia,
         lle,
         recursosdatos,
         docen +'<input type="hidden" value=' + $('#docen').val() + '>',
         auxi +'<input type="hidden" value=' + $('#auxi').val() + '>',
         ases +'<input type="hidden" value=' + $('#ases').val() + '>',
         obs,
         '<td><a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a></td>'
           
      ]).draw();
      //Para que se limpie el formulario
      var num= $('#num').val("");
      var reco= $('#reco').val("");
      var despla= $('#despla').val("");
      var sal= $('#sal').val(""); 
      var lug= $('#lug').val(""); 
      var dia= $('#per').val("");
      var lle= $('#lle').val(""); 
      var tipo= $('#tipo').val("");
      var valor= $('#valor').val(""); 
      var docen= $('#docen option:selected').val("");
      var auxi= $('#auxi option:selected').val("");
      var ases= $('#ases option:selected').val("");
      var obs= $('#obs').val(""); 
       
       // alert('Los Datos Son Correctos');
    }else{
        valid = false;
        alert('Los Datos Son Incorrectos');
    } 
      }); 
         
    //Validación de que los campos no se vayan vacios
    $( "#myWizard" ).on('finished.fu.wizard', function(){
        
    
    
     
     datatable.rows().data();
    
     // console.log(datatable.data().toArray());
      //declaro una variable para conocer la pocisión del vector a donde estan los id de participantes
      var programacion= datatable.data().toArray();
    
      for(var i=0; i< programacion.length;i++){
          programacion[i][7]= programacion[i][7].substring(programacion[i][7].indexOf('value=')+6).replace('>', "");
          programacion[i][8]= programacion[i][8].substring(programacion[i][8].indexOf('value=')+6).replace('>', "");
          programacion[i][9]= programacion[i][9].substring(programacion[i][9].indexOf('value=')+6).replace('>', "");
          programacion[i][10]= programacion[i][10].substring(programacion[i][10].indexOf('value=')+6).replace('>', "");
          console.log(programacion);
          
      }
       // console.log('Hola Kami');
        //Con esta variable le paso los datos del formulario en un vector
     var datos = $('#pra').serialize();
    // alert(datos); 
    //Mensaje de Confirmación 
    $(document).on('click', '#final', function(e){
  //No se comporte por defecto viene, de mandarme a otra pagina  
  e.preventDefault(); 
   //Elemnto cliqueado
 var elementocliqueado= this;
 //console.log('HOla'); 
    bootbox.dialog({
  message: "La Práctica se envió a la Logística",
  title: "Práctica se guardo con exito",
  buttons: {
    default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
       // Example.show("Se realizo con Exito");
       
// console.log(facultad_id);

 var ajax= $.post('/practicas/guardarpractica', {datos:datos, programacion:programacion});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
    //  alert('la Práctica se Guardo Con Exito');
    // window.location='/practicas/listarpractica';
  });
 
 //Codigo para actualizar automaticamente la pagina.
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
    
   });
    
}
 practicas.editarpractica = function(){
    //Creo una variable que me guarde el dato de la facultad para este caso el id..   
   var calendario= $('#cal').data('calendario');   
 
      $('#cal').val(calendario);
    //Se actualice el valor del selector cuando elija un programa que este asociado a su facultad.
    $('#cal').trigger('change');
   var datos = $('#pra').serialize();
    // alert(datos); 
    //Mensaje de Confirmación 
     $('#final').on('click', function(){
     
     var id=$('#cod_practica').val();
// console.log(facultad_id);

 var ajax= $.post('/practicas/actualizarpractica', {datos:datos, programacion:programacion, id:id});
  // Codigo para actualizar la facultad cuando se agrega una nueva facultad..
  ajax.done(function(){
    //  alert('la Práctica se Guardo Con Exito');
    // window.location='/practicas/listarpractica';
  });
 
   
    });
 
 //console.log('HOla'); 
  
       // Example.show("Se realizo con Exito");
      
 //Codigo para actualizar automaticamente la pagina.
      
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





