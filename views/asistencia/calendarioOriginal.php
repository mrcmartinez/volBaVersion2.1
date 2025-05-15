<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agenda con Asistencia</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
    }

    #calendar {
        max-width: 1000px;
        margin: 0 auto;
    }
    </style>
</head>

<body>

    <h2>Agenda de Asistencia</h2>
    <div id="calendar"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var eventos = <?php echo $this->asistencia; ?>;

    var eventosCalendar = [];

    eventos.forEach(function(evento) {
        let color = '';
        if (evento.estatus === 'Asistencia') {
            color = 'green';
        } else if (evento.estatus === 'Asistencia-Apoyo') {
            color = 'orange';
        } else if (evento.estatus === 'Falta') {
            color = 'red';
        } else if (evento.estatus === 'Falta-Justificada') {
            color = 'pink';
        } else {
            color = 'gray';
        }

        // Evento visible con contenido personalizado
        eventosCalendar.push({
            title: '', // Se personaliza con eventDidMount
            start: evento.fecha,
            color: color,
            allDay: true,
            extendedProps: {
                estatus: evento.estatus,
                nombre: evento.nombre,
                hora: evento.hora,
                descripcion: evento.descripcion
            }
        });

        // Evento de fondo (pinta todo el día)
        eventosCalendar.push({
            start: evento.fecha,
            display: 'background',
            color: color
        });
    });

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'es',
        events: eventosCalendar,
        dayMaxEvents: true,
        eventDidMount: function(info) {
            const estatus = info.event.extendedProps.estatus || '';
            const nombre = info.event.extendedProps.nombre || '';
            const hora = info.event.extendedProps.hora || '';
            const descripcion = info.event.extendedProps.descripcion || '';

            if (info.el.querySelector('.fc-event-title')) {
                info.el.querySelector('.fc-event-title').innerHTML = `
                    <strong>${estatus}</strong><br>
                    ${nombre}<br>
                    <small>${hora}</small><br>
                    <em>${descripcion}</em>
                `;
            }
        }
    });

    calendar.render();
});
</script>




</body>

</html>