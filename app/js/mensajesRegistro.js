window.onload = function() {
    setTimeout(function() {
        var alerts = document.querySelectorAll('.alert');
        for (var i = 0; i < alerts.length; i++) {
            var alert = alerts[i];
            alert.style.opacity = '0';
            setTimeout(function(alert) {
                if (alert) alert.parentNode.removeChild(alert);
            }, 500, alert);
        }
    }, 3000);
}