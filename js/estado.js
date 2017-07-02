$(document).ready(function(){
    $('#cambiarEstado').click(function() {
        $.ajax({
            type: "POST",
            url: "cambiarestado.php"
        }).done(function() {
        location.reload();
      });    
    });
});