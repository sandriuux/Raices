document.addEventListener('DOMContentLoaded', (event) => {
    const fechaInput = document.getElementById('fecha');
    const horaInput = document.getElementById('hora');

    const establecerFechaMinima = () => {
        const hoy = new Date();
        const dd = String(hoy.getDate()).padStart(2, '0');
        const mm = String(hoy.getMonth() + 1).padStart(2, '0'); //Enero es 0
        const yyyy = hoy.getFullYear();
        fechaInput.min = `${yyyy}-${mm}-${dd}`;
    };

    const validarHorario = () => {
        const horaSeleccionada = horaInput.value;
        const [hora, minutos] = horaSeleccionada.split(':').map(num => parseInt(num, 10));
        
        if(hora < 12 || hora > 23 || (hora === 23 && minutos > 30)) {
            alert('Por favor, seleccione una hora de reserva entre las 12:00 y las 23:30.');
            horaInput.value = '';
        }
    };

    establecerFechaMinima();
    fechaInput.addEventListener('change', establecerFechaMinima);
    horaInput.addEventListener('change', validarHorario);
});
