
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
 /**   if(num > 0 && reco != "" && despla != "" && sal != "" && lug != ""  && dia != "" && lle != "" && docen != "" && auxi != "" && ases != "" &&  obs != ""){
       
       
        valid= true;
           // alert('Los Datos Son Correctos');
    }else{
        valid = false;
        alert('Los Datos Son Incorrectos');
    } */
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
         '<td><a class="editar_prog" href="#"><i class="fa fa-pencil-square-o" style="font-size:18px;color:#337ab7;cursor:pointer;"></i></a>  <a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a></td>'
           
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
       
     
      }); 
      //Validación para que el evento se active inmediatamente cuando los cambios de paso, 
      //pero antes de que el asistente muestra el nuevo paso. 
      //Evento del editar
         $(document).on( 'click', '.editar_prog', function (e) {
             
              //No se comporte por defecto viene, de mandarme a otra pagina  
          e.preventDefault(); 
           //Elemnto cliqueado
       var elementocliqueado= this;
          //   console.log('hola');
         var form= $('#form').clone();
         form.removeClass('hide');
           bootbox.dialog({
    message: form,
    class:'modalancho', 
  title: "Datos de la programación",
  buttons: {
    default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
          var elemento= $(elementocliqueado).parent().parent();
          var desplazamiento= form.find('.despla').val();
          var pernoctado= form.find('.per').is(':checked')?'Si':'No';
          var ruta= form.find('.reco option:selected').html()+'<input type="hidden" value=' + form.find('.reco').val() + '>';
          var docente=form.find('.docen option:selected').html()+'<input type="hidden" value=' + form.find('.docen').val() + '>';
          var auxiliar=form.find('.auxi option:selected').html()+'<input type="hidden" value=' + form.find('.auxi').val() + '>';
          var asesor=form.find('.ases option:selected').html()+'<input type="hidden" value=' + form.find('.ases').val() + '>';
          var observaciones= form.find('.obs').val();
           var d = datatable.row( elemento ).data();
           d[1]=ruta;
           d[2]=desplazamiento;
           d[5]=pernoctado;
           d[8]=docente;
           d[9]=auxiliar;
           d[10]=asesor;
           d[11]=observaciones;
          // console.log(d);
        //  d.counter++;
 
   datatable
        .row(elemento)
        .data( d )
        .draw();
       // Example.show("Se realizo con Exito");
     //   var facultad_id=$(elementocliqueado).data('facultad');

 //Codigo para actualizar automaticamente la pagina..
 
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
      //Evento del recursos especiales
      $(document).on( 'click', '.editar_recur', function (e) {
        //evento del recurso  
          e.preventDefault(); 
           //Elemnto cliqueado
       var elementocliqueado= this;
          //   console.log('hola');
         var recurso= $('#re').clone();
         recurso.removeClass('hide');
          var table=recurso.find('.recurso').DataTable();
       $(document).on('click', '.rec', function(e){
  //No se comporte por defecto viene, de mandarme a otra pagina  
  e.preventDefault(); 
   //Elemnto cliqueado
 var elementocliqueado= this;
 //console.log('HOla'); 
 var idrecurso= recurso.find('.tipo').val();   
     var tipo= recurso.find('.tipo option:selected').html();
      // console.log(tipo);
     var valor= recurso.find('.valor').val(); 
      // console.log(valor);
       
        if(valor > 0){
       //Metodo Para enviar los datos al controlador
  var ajax= $.post('/Progrecurso/guardarprogrecurso', {valor:valor, idrecurso:idrecurso});
      ajax.done(function(data){
         // console.log(data);
       //pintar una nueva opción
        table.row.add([
         data.id_pro,   
         tipo,
         valor,
         '<td><a class="eliminar_practicaa" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a></td>'
           
      ]).draw();

      
     // window.location='/facultades/listarfacultad';
  }); 
  }else{
        valid = false;
        alert('Los Datos Son Incorrectos');
        
    }
   //función para eliminar una fila
      $(document).on( 'click', '.eliminar_practicaa', function (e) {
          // Previene los comportamientos por defectos
           e.preventDefault(); 
    table
        .row( $(this).parents('tr') )
        .remove()
        .draw();
      });
 
 }); 
 
           bootbox.dialog({
    message: recurso,
    class:'modalancho', 
  title: "Datos de la programación",
  buttons: {
    default: {
      label: "Aceptar",
      className: "btn-default",
      callback: function() {
          var elemento= $(elementocliqueado).parent().parent();
          var d = datatable.row( elemento ).data();
          
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
         d[7]=recursosdatos; 
          // console.log(d);
        //  d.counter++;
 
   datatable
        .row(elemento)
        .data( d )
        .draw(); 
       // Example.show("Se realizo con Exito");
     //   var facultad_id=$(elementocliqueado).data('facultad');

 //Codigo para actualizar automaticamente la pagina..
 
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
      
      
      $("#myWizard").on('actionclicked.fu.wizard', function (evt, data){
        
           //Validación De campos Vacios
           var valid= true;
           console.log(data);
           if(data.step==1){
          
         // var calendario= $('#cal').val();    
          var solicitante= $('#nombre').val();
          var facultad= $('#fac').val();
          var departamento= $('#dep').val();
          var programa= $('#pro').val();
          var semestre= $('#sem').val();
          var asignatura= $('#asigna').val();
          var numero_est= $('#num').val();
          var practica= $('#nom').val();
          var tipo= $('#tipo').val();
          var objetivo= $('#obj').val();
          var justificacion= $('#jus').val();
          var des_docente= $('#adoc').val();
          var des_estudiante= $('#est').val();
          
          //Validación
          //  facultad != "" && departamento != "" && programa != "" && semestre != "" && asignatura != "" && numero_est > 0 && practica != "" && tipo != "" && objetivo != "" && justificacion != "" && des_docente != "" && des_estudiante != ""
     /**     if(calendario != ""){
            console.log(calendario); 
            
          }else{
              evt.preventDefault();
               valid = false;
             alert('Por Favor Diligencie el campo'); 
          } */
          if(solicitante != "" && facultad != "" && departamento != "" && programa != "" && semestre != "" && asignatura != "" && numero_est > 0 && practica != "" && tipo != "" && objetivo != "" && justificacion != "" && des_docente != "" && des_estudiante != ""){
          //  console.log(); 
            
          }else{
              evt.preventDefault();
               valid = false;
             alert('Por Favor Diligencie los campos'); 
          }
            
          }
          //obtener el numero de dias, apartir de dos fechas..
         // console.log(data);
          if(data.step==2){
              var fecha_inicial= $('#sal').val();
          // console.log(fecha_inicial);
           var fecha_final= $('#lle').val();
            var dias= practicas.calcularDias(fecha_inicial, fecha_final)+1;   
            
           if(dias > 0){
               console.log(dias);
               
           }else{
               evt.preventDefault();
               valid = false;
             alert('Las fechas son incorrectas'); 
           }   
           
           var lugar= $('#lug').val();
           if(lugar != ""){
               
           }else{
               evt.preventDefault();
               valid= false;
               alert('Por favor ingrese el lugar de encuentro'); 
           }
          // console.log(fecha_final);
           
        var convertir= new Date(fecha_inicial)
            console.log(convertir);
            var fecha= practicas.sumaFecha(1, fecha_inicial);
            console.log(fecha);
            var tmp= fecha_final;
            for(i=0; i< dias; i++){
             if(i==0){
               
             } else{
                lugar= "";  
             } 
             console.log(dias-1);
            
             if(i == (dias-1)){
              fecha_final= tmp;   
                 
             }else{
                 fecha_final= "";
             }
             datatable.row.add ([
              i+1,
              "",
              "",
              practicas.sumaFecha(i, fecha_inicial),
              lugar,
              "",
             fecha_final,
             "",
             "",
             "",
             "",
             "",
          '<td><a class="editar_prog" href="#"><i class="fa fa-pencil-square-o" style="font-size:18px;color:#337ab7;cursor:pointer;"></i></a> <a class="editar_recur" href="#"><i class="fa fa-pencil-square-o"  style="font-size:18px;color:#21b384;cursor:pointer;"></i></a> <a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a></td>'    
             ]).draw();
           
            }
          }
          else{
              if(data.step==3){
                  $('#rep_cal').html($('#cal option:selected').html());
                  $('#rep_docente').html($('#nombre').val());
                  $('#rep_asig').html($('#asigna option:selected').html());
                  $('#rep_numest').html($('#num').val());
                  $('#rep_nompr').html($('#nom').val());
                  $('#rep_obj').html($('#obj').val());
                  $('#rep_just').html($('#jus').val());
                  $('#rep_actdoc').html($('#adoc').val());
                  $('#rep_actest').html($('#est').val());
                  $('#rep_tipopr').html($('#tipo').val());
                  $('#rep_fsal').html($('#sal').val());
                  $('#rep_flleg').html($('#lle').val());
                  $('#rep_lugar').html($('#lug').val());
                  
                  var tmp = $('#example').clone();
                  tmp.prop('id', 'rep_table');
                  tmp.DataTable();
                  $('#rep_tbl').append(tmp);
                  
              }
              if(data.step == 4){
                  if(data.direction == "previous"){
                      if(confirm("Esta operación eliminará la programación ingresada, ¿desea continuar?")){
                          datatable.clear().draw();
                          $('#myWizard').wizard('selectedItem', {
                                step: 3
                            });
                      }
                      
                  }
              }
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
       //validación del paso1 corresponde al formulario de prácticas
       
        //Con esta variable le paso los datos del formulario en un vector
     var datos = $('#pra').serialize();
     //campos para validar
    
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
practicas.isValidDate= function (day,month,year){
		var dteDate;
		month=month-1;
		dteDate=new Date(year,month,day);
		return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
	}
 
	/**
	 * Funcion para validar una fecha
	 * Tiene que recibir:
	 *  La fecha en formato español dd/mm/yyyy
	 * Devuelve:
	 *  true o false
	 */
 practicas.validate_fecha= function (fecha){
		var patron=new RegExp("^([0-9]{1,2})([/])([0-9]{1,2})([/])(19|20)+([0-9]{2})$");
 
		if(fecha.search(patron)==0){
			var values=fecha.split("/");
			if(practicas.isValidDate(values[0],values[1],values[2])){
				return true;
			}
		}
		return false;
	}
 
 practicas.calcularDias= function(fechaInicial, fechaFinal){
		
		var resultado="";
		if(practicas.validate_fecha(fechaInicial) && practicas.validate_fecha(fechaFinal)){
			inicial=fechaInicial.split("/");
			final=fechaFinal.split("/");
			// obtenemos las fechas en milisegundos
			var dateStart=new Date(inicial[2],(inicial[1]-1),inicial[0]);
            var dateEnd=new Date(final[2],(final[1]-1),final[0]);
            if(dateStart<dateEnd)
            {
				// la diferencia entre las dos fechas, la dividimos entre 86400 segundos
				// que tiene un dia, y posteriormente entre 1000 ya que estamos
				// trabajando con milisegundos.
				resultado=(((dateEnd-dateStart)/86400)/1000);
			}else{
				resultado="La fecha inicial es posterior a la fecha final";
			}
		}else{
			if(!practicas.validate_fecha(fechaInicial))
				resultado="La fecha inicial es incorrecta";
			if(!practicas.validate_fecha(fechaFinal))
				resultado="La fecha final es incorrecta";
		}
		return resultado;
    }
  practicas.sumaFecha = function(d, fecha){
 var Fecha = new Date();
 var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
 var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
 var aFecha = sFecha.split(sep);
 var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
 fecha= new Date(fecha);
 fecha.setDate(fecha.getDate()+parseInt(d));
 var anno=fecha.getFullYear();
 var mes= fecha.getMonth()+1;
 var dia= fecha.getDate();
 mes = (mes < 10) ? ("0" + mes) : mes;
 dia = (dia < 10) ? ("0" + dia) : dia;
 var fechaFinal = dia+sep+mes+sep+anno;
 return (fechaFinal);
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





