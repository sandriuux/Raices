$(document).ready(function() {
    $('#formChef').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '../form/formChef.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                alert(response);
            },
            error: function(xhr, status, error) {
                alert('Error al registrar al chef: ' + error);
            }
        });
    });
});
