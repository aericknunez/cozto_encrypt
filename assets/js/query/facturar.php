<?php 
/// el sistema es local no se hace mas que imprimir mandando el a llamar la funcion 120 de routes
/// pero si el sistema es web manda a que se ejecute a la ip del equipo donde esta instalada la impresora

if($_SESSION["root_plataforma"] == 0){
 ?>
<script>
$('#btn-facturar').click(function(e){ /// agregar un producto 
e.preventDefault();
$.ajax({
        url: "application/src/routes.php?op=85",
        method: "POST",
        data: $("#form-facturar").serialize(),
        beforeSend: function () {
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data){
            $("#formularios").hide();
            $("#btn-te").hide(); // esconde boton tarjeta y efectivo
            $("#form-facturar").trigger("reset");
            $("#resultado").html(data);     
            $("#botones-imprimir").load('application/src/routes.php?op=120'); // caraga los botones / imprimir          
        }
    })
});
</script>


<?php } else {
/// si es version web
?>

<script>
$('#btn-facturar').click(function(e){ /// agregar un producto 
e.preventDefault();
$.ajax({
        url: "application/src/routes.php?op=85",
        method: "POST",
        data: $("#form-facturar").serialize(),
        beforeSend: function () {
           $("#botones-imprimir").html('<div class="row justify-content-center" >Imprimiendo</div>');
           $("#resultado").html('<div class="row justify-content-center" ><img src="assets/img/loa.gif" alt=""></div>');
        },
        success: function(data){
            $("#form-facturar").trigger("reset");
            $("#formularios").hide();
            $("#btn-te").hide(); // esconde boton tarjeta y efectivo
            $("#resultado").html(data);        
        }
    })

LoadImprimir();
});



function LoadImprimir(){
    var key = $(this).attr('key');
    var op = $(this).attr('op');
    var dataString = {"parametro1" : "valor1", "parametro2" : "valor2"};
    $.ajax({
        type: "POST",
        url: "http://192.168.1.47/impresion/prueba.php",
        data: dataString,
        datatype: 'json',
        beforeSend: function () {
           $("#botones-imprimir").html('<div class="row justify-content-center" >Espere...</div>');
        },
        success: function(data) {            
            $("#botones-imprimir").html(data); // lo que regresa de la busquea         
        }
    });
   
}




</script>



<?
} ?>