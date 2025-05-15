<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>assets/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo constant('URL'); ?>assets/img/logo.ico" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 40px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
    }
    /* Estilo para el evento principal */




    </style>
</head>

<body>
    <?php require 'views/header.php'; ?>

    <div id="main">
        <div class="center-form">
            <h3 class="center"><?php echo $_SESSION['nombreVol'];?></h3>
            <div class="center">
                <!-- <form action="<?php echo constant('URL'); ?>personal/listarPersonal" method="POST">
                    <input type="submit" value="Regresar">
                </form> -->
                <form action="<?php echo constant('URL'); ?>consultaAsistencia/calendario/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn btn-success infCalendar" type="submit" value="calendario">
                </form>
                <form
                    action="<?php echo constant('URL'); ?>consultaAsistencia/verasistenciaidRango/<?php echo $this->id?>"
                    method="POST">
                    <input class="btn btn-secondary infCalendar" type="submit" value="Asistencias">
                </form>
                <form action="<?php echo constant('URL'); ?>documento/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary infCalendar" value="Documentación Digital">
                </form>
                <form action="<?php echo constant('URL'); ?>documentoFisico/verdocumentoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary infCalendar" value="Documentacion Fisica">
                </form>
                <form action="<?php echo constant('URL'); ?>telefono/vertelefonoid/<?php echo $this->id?>"
                    method="POST">
                    <input type="submit" class="btn btn-secondary infCalendar" value="Teléfonos">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input type="submit" class="btn btn-secondary infCalendar" value="Qr">
                </form>
                <form action="<?php echo constant('URL'); ?>qr/consultar/<?php echo $this->id?>" method="POST">
                    <input type="submit" class="btn btn-secondary infCalendar" value="Calendario">
                </form>
            </div>


            <div id="calendar"></div>
        </div>
        <!-- <h1 class="center"><?php //echo $_SESSION['nombreVol'];?></h1> -->

    </div>
    </div>
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
                    descripcion: evento.descripcion,
                    id_personal: evento.id_personal
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
                const id_personal = info.event.extendedProps.id_personal || '';
                const fecha = info.event.startStr; // formato YYYY-MM-DD

                if (info.el.querySelector('.fc-event-title')) {
                    let html =
                        `<strong>${estatus}</strong><br><small>${hora}</small><br><em>${descripcion}</em>`;

                    // if (estatus === 'Falta') {
                    //     html += `<a href="${"<?php echo constant('URL'); ?>"}consultaAsistencia/eliminar/${id_personal}/${fecha}/IDCalendario"
                    //     onclick="return confirmBaja()">
                    //     <img src="${"<?php echo constant('URL'); ?>"}assets/img/eliminar.png" title="Quitar de Lista" />
                    // </a>`;
                    // }

                    info.el.querySelector('.fc-event-title').innerHTML = html;
                }
            }

        });

        calendar.render();
    });
    </script>

    <?php require 'views/footer.php'; ?>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
    <?php
        if (!empty($this->mensaje)) 
        {
            ?>
    <script>
    Swal.fire({
        // position: 'top-end',
        icon: "<?php echo $this->code; ?>",
        title: '<?php echo $this->mensaje; ?>',
        showConfirmButton: false,
        timer: 1500
    })
    </script>
    <?php    
        }
    ?>

    <script src="<?php echo constant('URL'); ?>assets/js/main.js"></script>
    <script src="<?php echo constant('URL'); ?>assets/js/estatus.js"></script>
</body>

</html>