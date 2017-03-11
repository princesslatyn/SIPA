
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
     
//Evento para escoger la facultad
 $('#dep').on('change', function(){
    var departamento = $('#dep').val();
   // console.log(facultad);
 //var programas =('#pro').val();
    
    var ajax= $.get('/Practicas/obtenerprogramas', {departamento:departamento});
    ajax.done(function(data){
      //  console.log(data);
        //limpiar el contenido del selector
        $('#pro').html('');
      //  $('#dep').html('');
        //declaro una variable
        
          for(var i=0; i<data.length; i++){
        // console.log(data);
        //agregar contenido al selector
        $('#pro').append('<option value="'+data[i]['ID_Programa']+'" selected="selected">'+data[i]['Programa']+'</option>'); 
       // $('#dep').append('<option value="'+data[i]['ID_Departamento']+'" selected="selected">'+data[i]['Departamento']+'</option>');
        }  
         $('#pro').trigger('change');
    });
 }); 
 //evento para escoger el departamento
  $('#fac').on('change', function(){
    var facultad = $('#fac').val();
   // console.log('Hola');
 //var programas =('#pro').val();
 
    
    var ajax= $.get('/Practicas/obtenerdepartamento', {facultad:facultad});
    ajax.done(function(data){
      //  console.log(data);
        //limpiar el contenido del selector
         $('#dep').html('');
        //declaro una variable
        
          for(var i=0; i<data.length; i++){
         //console.log(data);
        //agregar contenido al selector
        $('#dep').append('<option value="'+data[i]['ID']+'" selected="selected">'+data[i]['Departa']+'</option>');
        }  
       //EVENTO PARA SIMILAR ENTREDA DEL USUARIO
       $('#dep').trigger('change');
      
    });
 }); 
 //Obtener el programas
 //evento para escoger el departamento
  $('#pro').on('change', function(){
    var programas = $('#pro').val();
   // console.log(departamento);
 //var programas =('#pro').val();
 
    
    var ajax= $.get('/Practicas/obtenersemestre', {programas:programas});
    ajax.done(function(data){
      //  console.log(data);
        //limpiar el contenido del selector
         $('#sem').html('');
        //declaro una variable
        
          for(var i=0; i<data.length; i++){
        // console.log(data);
        //agregar contenido al selector
        $('#sem').append('<option value="'+data[i]['sem']+'" selected="selected">'+data[i]['sem']+'</option>');
        }  
       //EVENTO PARA SIMILAR ENTREDA DEL USUARIO
       $('#sem').trigger('change');
    });
 });
 //Obtener las asignaturas
  $('#sem').on('change', function(){
    var programa= $('#pro').val();  
    var semestre = $('#sem').val();
   // console.log(departamento);
 //var programas =('#pro').val();
 
    
    var ajax= $.get('/Practicas/obtenerasignatura', {semestre:semestre, programa:programa});
    ajax.done(function(data){
      //  console.log(data);
        //limpiar el contenido del selector
        
       $('#asigna').html('');
       // $('#sem').html('');
        
        //declaro una variable
        
          for(var i=0; i<data.length; i++){
        // console.log(data);
        //agregar contenido al selector
        $('#asigna').append('<option value="'+data[i]['id_asigna']+'" selected="selected">'+data[i]['asigna']+'</option>');
        }  
       //EVENTO PARA SIMULAR ENTREDA DEL USUARIO
         $('#asigna').trigger('change');
      // $('#pro').trigger('change');
    });
 });
 //Evento para obtener los grupos de las asignatura escogida
  $('#asigna').on('change', function(){
    var asignatura= $('#asigna').val();  
   
   // console.log(asignatura);
    
    var ajax= $.get('/Practicas/obtenergrupos', {asignatura:asignatura});
    ajax.done(function(data){
      // console.log(data);
        //limpiar el contenido del selector
         $('#gru').html('');
        //declaro una variable
        
          for(var i=0; i<data.length; i++){
       // console.log(data);
        //agregar contenido al selector
        $('#gru').append('<option value="'+data[i]['gru']+'" selected="selected">'+data[i]['gru']+'</option>');
        }  
       //EVENTO PARA SIMULAR ENTREDA DEL USUARIO
       $('#gru').trigger('change');
     
    });
 }); 
 //Evento para obtener los matriculados
  $('#gru').on('change', function(){
    var grupo= $('#gru').val();  
   
   // console.log(grupo);
    
    var ajax= $.get('/Practicas/obtenermatriculados', {grupo:grupo});
    ajax.done(function(data){
      // console.log(data);
        //limpiar el contenido del selector
         $('#num').html('');
        //declaro una variable
        
          for(var i=0; i<data.length; i++){
       // console.log(data);
        //agregar contenido al selector
        $('#num').append('<option value="'+data[i]['mat']+'" selected="selected">'+data[i]['mat']+'</option>');
        }  
       //EVENTO PARA SIMULAR ENTREDA DEL USUARIO
       $('#num').trigger('change');
    });
 }); 

 
 
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
         sal,
         lug,
         dia,
         lle,
         '<td><div class="hide"><div class="desplazamiento"><input name="desplazamiento" type="hidden" value='+despla+'></div><div class="docentes">'+docen+'<input name="id_docentes" type="hidden" value='+ $('#docen').val()+'></div><div class="auxiliares">'+auxi+'<input name="id_auxiliares" type="hidden" value=' + $('#auxi').val()+'></div><div class="asesores">'+ases+'<input name="id_asesores" type="hidden" value=' + $('#ases').val()+'></div><div class="observaciones"><input name="observaciones" type="hidden" value=' +obs+'></div><div class="recursos"><input name="recursos" type="hidden" value=' +recursosdatos+'></div></div> <a class="editar_prog" href="#"><i class="fa fa-pencil-square-o" style="font-size:18px;color:#563d7c;cursor:pointer;"></i></a> <a class href="#"><i class="fa fa-user-plus" style="font-size:18px;color:#337ab7;cursor:pointer;"></i></a> <a class="editar_recur" href="#"><i class="fa fa-pencil-square-o"  style="font-size:18px;color:#21b384;cursor:pointer;"></i></a> <a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a> <a class="" href="#"><i class="fa fa-file-text-o" style="font-size:18px;color:#704010;cursor:pointer;"></i></a> </td>'
          
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
             //Cargar valores por defecto
             var elemento= $(this).parent().parent();
             var d = datatable.row( elemento ).data();
             //se toma el dato de la ultima columna de la tabla
             var data_default = d[6];
             var data_obj = $.parseHTML(data_default);
             //desplazamiento
             var desplazamiento_def = $(data_obj).find('.desplazamiento').html();
             //pernoctado se toma de la columna 4 de la tabla tiene valor si y no pero se necesita true o false
           //  console.log(d[4]);
             var pernoctado_def = (d[4] == "Si" ? 1 : 0);
            // console.log(pernoctado_def);
             //ruta no esta en los datos ocultos de la columna acciones se toma de la columna 1 de la tabla
             var ruta_def= d[1];
             //docente
             var docente_def = $(data_obj).find('.docentes').html();
             //auxiliar
             var auxiliar_def = $(data_obj).find('.auxiliares').html();
             //asesor
             var asesor_def = $(data_obj).find('.asesores').html();
             //observaciones
             var observaciones_def= $(data_obj).find('.observaciones').html();
             
             
              //No se comporte por defecto viene, de mandarme a otra pagina  
          e.preventDefault(); 
           //Elemnto cliqueado
         var elementocliqueado= this;
          //   console.log('hola');
         var form= $('#form').clone();
         
         //se aplican los datos al formulario de editar
         
         //recorrido
         // busca en el selector reco la opcion que tenga el mismo valor que la variable ruta_def
        var id_ruta = (ruta_def != null ? ruta_def.slice(ruta_def.indexOf("value=")+6, ruta_def.lastIndexOf('>')) : -1);
        console.log('recorrido');
        console.log(ruta_def);
        console.log(id_ruta);
        if(id_ruta > 0)
        form.find('.reco').val(id_ruta);
         
         //desplazamiento         
         form.find('.despla').val(desplazamiento_def);
         console.log(desplazamiento_def);
         
        //pernoctado     
        pernoctado_def > 0 ? form.find('.per').prop('checked', true) : form.find('.per').prop('checked', false);
        
        //docente
        /*
         * Me llegara un dato similar a este
         * <div class="docentes">Jhanier Garcia Pitalua<input type="hidden" value="3">&gt;</div>
         * pero solo debo sacar el id por lo tanto hay que procesar la cadena para obtener el id solamente
         * en este caso el id es 3
         */
        var id_docente = (docente_def != null ? docente_def.slice(docente_def.indexOf("value=")+7, docente_def.lastIndexOf('"')) : -1);
        console.log(id_docente);
        if(id_docente > 0)
        form.find('.docen').val(id_docente);
        
        //auxiliar
        /*
         * Similar al anterior
         * <div class="auxiliares">Kamilo Cervantes<input type="hidden" value="4"></div>
         */
        var id_auxiliar = (auxiliar_def != null ? auxiliar_def.slice(auxiliar_def.indexOf("value=")+7, auxiliar_def.lastIndexOf('"')): -1);
        console.log(id_auxiliar);
        if(id_auxiliar > 0)
        form.find('.auxi').val(id_auxiliar);
        
        //asesor
        /*
         * Similar al anterior
         * <div class="asesores">Luchi Sarriego<input type="hidden" value="5"></div>
         */
        var id_asesor = (asesor_def != null ? asesor_def.slice(asesor_def.indexOf("value=")+7, asesor_def.lastIndexOf('"')): -1);
        console.log(id_asesor);
         if(id_asesor > 0)
        form.find('.ases').val(id_asesor);
        
        //observaciones
        form.find('.obs').val(observaciones_def);
        
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
//          console.log(docente);
          var auxiliar=form.find('.auxi option:selected').html()+'<input type="hidden" value=' + form.find('.auxi').val() + '>';
          var asesor=form.find('.ases option:selected').html()+'<input type="hidden" value=' + form.find('.ases').val() + '>';
          var observaciones= form.find('.obs').val();
           var d = datatable.row( elemento ).data();
           //se captura el valor guardado de campos escondidos de la tabla
           var tmp = d[6];
//           console.log("preprocesado");
//           console.log(tmp);
           //se convierte la informacion que esta en html a objeto jquery
           tmp = $.parseHTML(tmp);
//           console.log("nodo jquery");
           console.log(tmp);
           //de dicha informacion se saca la parte de recurso que no se recopila en el modal de editar
           var recursos = $('.recursos', tmp).html();
           console.log(recursos);
           d[1]=ruta;
         //  d[2]=desplazamiento;
           d[4]=pernoctado;
           d[6]= '<td><div class="hide"><div class="desplazamiento">'+desplazamiento+'</div><div class="docentes">'+docente+'></div><div class="auxiliares">'+auxiliar+'</div><div class="asesores">'+asesor+'</div><div class="observaciones">' +observaciones+'</div><div class="recursos">'+recursos+'</div></div><a class="editar_prog" href="#"><i class="fa fa-pencil-square-o" style="font-size:18px;color:#563d7c;cursor:pointer;"></i></a> <a class href="#"><i class="fa fa-user-plus" style="font-size:18px;color:#337ab7;cursor:pointer;"></i></a> <a class="editar_recur" href="#"><i class="fa fa-pencil-square-o"  style="font-size:18px;color:#21b384;cursor:pointer;"></i></a> <a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a> <a class="" href="#"><i class="fa fa-file-text-o" style="font-size:18px;color:#704010;cursor:pointer;"></i></a> </td>';

          // d[8]=docente;
         //  d[9]=auxiliar;
         //  d[10]=asesor;
          // d[11]=observaciones;
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
      //metodo para visualizar los recursos y el valor
//      $(document).on('')
      //Evento del recursos especiales
      $(document).on( 'click', '.editar_recur', function (e) {
       
          
        //evento del recurso 
          e.preventDefault(); 
           //Elemnto cliqueado
       var elementocliqueado= this;
       var elemento= $(elementocliqueado).parent().parent();
       // console.log(elemento);
        var d = datatable.row( elemento ).data();
      //  console.log(d);
        var recurso= $('#re').clone();    
        //se toma el dato de la ultima columna de la tabla
        var data_default = d[6];
        
        var data_obj = $.parseHTML(data_default);
        //tipo
        var tipo_def= $(data_obj).find('.recursos').html();
        console.log(tipo_def);
        //corto el cadena de string, para que solo me queden los id de los recursos
        var id_recursos= (tipo_def != null ? tipo_def.slice(tipo_def.indexOf("value=")+6, tipo_def.lastIndexOf('>')): -1);
        console.log(id_recursos);
         if(id_recursos > 0)
        recurso.find('.recursos').val(id_recursos);
          //   console.log('hola');
        var ajax=$.post('/Progrecurso/visualizarprogrecurso', {tipo_def:id_recursos});
        
        ajax.done(function(data){
            if(data.length > 0){
               var tabla_recurso = recurso.find('.recurso').dataTable();
            
                tabla_recurso.rows().add(data); 
            }
            
            recurso.removeClass('hide');
            
        });
      //   var recurso= $('#re').clone();
         //se aplican los datos al formulario de editar
         
       
       var table=recurso.find('.recurso').DataTable();
       $(document).on('click', '.rec', function(e){
         
       //No se comporte por defecto viene, de mandarme a otra pagina  
       e.preventDefault(); 
      //Elemnto cliqueado
      var elementocliqueado= this;
      //de esta manera no vas a poder sacar los datos
      //los datos se sacan del datatable no del formulario
      var idrecurso= recurso.find('.tipo').val();   
      var tipo= recurso.find('.tipo option:selected').html();
      // console.log(tipo);
      var valor= recurso.find('.valor').val(); 
       //Cargar valores por defecto
    
       
      if(valor > 0){
       //Metodo Para enviar los datos al controlador
      var ajax= $.post('/Progrecurso/guardarprogrecurso', {valor:valor, idrecurso:idrecurso});
      //envio los datos de los recursos por ajax
     
      ajax.done(function(data){
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
      $(document).on( 'click', '.eliminar_practicaa', function (e){
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
        console.log(recursosdatos);
           var tmp = d[6];
           var tmp2;
           console.log("preprocesado");
           console.log(tmp2);
           //se convierte la informacion que esta en html a objeto jquery
           tmp2 = $.parseHTML(tmp);
           console.log("nodo jquery");
//           console.log(tmp2.html());
           //de dicha informacion se saca la parte de recurso que no se recopila en el modal de editar
           $(tmp2).find(".recursos").html(recursosdatos);
         //  console.log(tmp2);
           d[6] = $(tmp2).html();
        //   console.log(d[6]);
//         d[7]=recursosdatos; 
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
          // console.log(data);
           if(data.step==1){
          
         // var calendario= $('#cal').val();    
          var solicitante= $('#nombre').val();
          var facultad= $('#fac').val();
          var departamento= $('#dep').val();
          var programa= $('#pro').val();
          var semestre= $('#sem').val();
          var asignatura= $('#asigna').val();
          var grupo= $('#gru').val();
          var numero_est= $('#num').val();
          var practica= $('#nom').val();
          var tipo= $('#tipo').val();
          var objetivo= $('#obj').val();
          var justificacion= $('#jus').val();
          var des_docente= $('#adoc').val();
          var des_estudiante= $('#est').val();
          
          //Validación
     
          if(solicitante != "" && facultad != "" && departamento != "" && programa != "" && semestre != "" && asignatura != "" && grupo != "" && numero_est != "" && practica != "" && tipo != "" && objetivo != "" && justificacion != "" && des_docente != "" && des_estudiante != ""){
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
           
              if(dias > 0 || fecha_inicial == fecha_final){
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
          // console.log(convertir);
            var fecha= practicas.sumaFecha(1, fecha_inicial);
          //  console.log(fecha);
            var tmp= fecha_final;
            if(fecha_inicial == fecha_final){
                dias = 1;
            }
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
             if(fecha_inicial == fecha_final){
              datatable.row.add ([
              i+1,
              "",
              fecha_inicial,
              lugar,
              "",
             fecha_final,
            
          '<td><a class="editar_prog" href="#"><i class="fa fa-pencil-square-o" style="font-size:18px;color:#563d7c;cursor:pointer;"></i></a> <a class href="#"><i class="fa fa-user-plus" style="font-size:18px;color:#337ab7;cursor:pointer;"></i></a> <a class="editar_recur" href="#"><i class="fa fa-pencil-square-o"  style="font-size:18px;color:#21b384;cursor:pointer;"></i></a> <a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a> <a class="" href="#"><i class="fa fa-file-text-o" style="font-size:18px;color:#704010;cursor:pointer;"></i></a> </td>'    
             ]).draw();
             }
             else{
                 datatable.row.add ([
              i+1,
              "",
              practicas.sumaFecha(i, fecha_inicial),
              lugar,
              "",
             fecha_final,
          '<td><a class="editar_prog" href="#"><i class="fa fa-pencil-square-o" style="font-size:18px;color:#563d7c;cursor:pointer;"></i></a> <a class href="#"><i class="fa fa-user-plus" style="font-size:18px;color:#337ab7;cursor:pointer;"></i></a> <a class="editar_recur" href="#"><i class="fa fa-pencil-square-o"  style="font-size:18px;color:#21b384;cursor:pointer;"></i></a> <a class="eliminar_practica" data-practica="" href="#"><i class="fa fa-trash" style="font-size:18px;color:#d9534f;cursor:pointer;"></i></a> <a class="" href="#"><i class="fa fa-file-text-o" style="font-size:18px;color:#704010;cursor:pointer;"></i></a> </td>'    
             ]).draw();
             }
             
           
            }
          }
          else{
              if(data.step==3){
                  $('#rep_cal').html($('#cal option:selected').html());
                  $('#rep_docente').html($('#nombre').val());
                  $('#rep_asig').html($('#asigna option:selected').html());
                  $('#rep_gru').html($('#gru option:selected').html());
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
              if(data.step == 3){
                  if(data.direction == "previous"){
                      if(confirm("Esta operación eliminará la programación ingresada, ¿desea continuar?")){
                          datatable.clear().draw();
                          $('#myWizard').wizard('selectedItem', {
                                step: 3
                                
                            });
                      }
                      
                  } 
              }
              
              if(data.step == 4){
              if(data.direction == "previous"){
              if(confirm("Esta operación eliminará la programación ingresada, ¿desea continuar?")){    
              //var rep_tab= $('#rep_table').DataTable();
              $('#rep_table').html('');
              //rep_tab.clear().draw();
              datatable.clear().draw();
              $('#myWizard').wizard('selectedItem', { 
                   step:3
              
                      });
                  }
              }    
                  
              }
          }
      });   
          
   
          
      
         
    //Validación de que los campos no se vayan vacios
    $( "#myWizard" ).on('finished.fu.wizard', function(){
       
   //un ejemplo de como extraer los datos de la tabla datatable
     datatable.rows().data();
    //si lo usas en la tabla de recursos te va a devolver los recursos almacenados
     // console.log(datatable.data().toArray());
      //declaro una variable para conocer la pocisión del vector a donde estan los id de participantes
      var programacion= datatable.data().toArray();
    
      for(var i=0; i< programacion.length;i++){
          programacion[i][7]= programacion[i][7].substring(programacion[i][7].indexOf('value=')+6).replace('>', "");
          programacion[i][8]= programacion[i][8].substring(programacion[i][8].indexOf('value=')+6).replace('>', "");
          programacion[i][9]= programacion[i][9].substring(programacion[i][9].indexOf('value=')+6).replace('>', "");
          programacion[i][10]= programacion[i][10].substring(programacion[i][10].indexOf('value=')+6).replace('>', "");
        //  console.log(programacion);
          
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
            console.log(dateStart - dateEnd);
            console.log(dateStart);
            console.log(dateEnd);
            if(dateStart<dateEnd)
            {
				// la diferencia entre las dos fechas, la dividimos entre 86400 segundos
				// que tiene un dia, y posteriormente entre 1000 ya que estamos
				// trabajando con milisegundos.
				resultado=(((dateEnd-dateStart)/86400)/1000);
			}else{
                            if(dateStart - dateEnd == 0){
                                resultado = 1;
                            }
                            else{
                                resultado="La fecha inicial es posterior a la fecha final";
                            }
				
			}
		}else{
                    if(dateStart - dateEnd == 0){
                                resultado = 1;
                            }
                           
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
       
 var programacion = "";
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





