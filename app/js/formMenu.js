$(document).ready(function() {
    $('#formMenu').on('submit', function(event) {
        event.preventDefault();

        var datosDelFormulario = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: '../form/formMenu.php',
            data: datosDelFormulario,
            success: function(response) {
                alert(response); 
                
            },
            error: function(xhr, status, error) {
                alert('Error al añadir el plato: ' + error);
            }
        });
    });
});
