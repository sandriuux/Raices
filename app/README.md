<!-- delimitador estado reserva finalizada -->
<!-- habilitar el evento -->
SET GLOBAL event_scheduler = ON;

<!-- crear evento -->
DELIMITER //

CREATE EVENT IF NOT EXISTS actualizarEstadoReserva
ON SCHEDULE EVERY 1 MINUTE
DO
  BEGIN
    UPDATE reservas
    SET EstadoReserva = 'Finalizada'
    WHERE FechaReserva < CURRENT_DATE() OR
          (FechaReserva = CURRENT_DATE() AND HoraReserva < CURRENT_TIME());
  END; //

DELIMITER ;


<!-- verificacion -->
SHOW EVENTS;
