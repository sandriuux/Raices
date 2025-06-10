window.onload = function() {
    const successMessage = document.getElementById('successMessage');
    if (window.location.search.indexOf('success=true') > -1) {
        successMessage.style.display = 'block'; 
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 5000);
    }
};

