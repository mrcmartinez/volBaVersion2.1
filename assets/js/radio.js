// Accedemos al botón
var emailInput = document.getElementById('emailInput');

// evento para el input radio del "si"
document.getElementById('interesadoPositivo').addEventListener('click', function(e) {
  console.log('Vamos a habilitar el input text');
  emailInput.disabled = false;
});

// evento para el input radio del "no"
document.getElementById('interesadoNegativo').addEventListener('click', function(e) {
  console.log('Vamos a deshabilitar el input text');
  emailInput.disabled = true;
});