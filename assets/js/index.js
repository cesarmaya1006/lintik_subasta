$(document).ready(function () {
    $( "#Correo" ).keyup(function(event) {
        $('#Usuario').val($(this).val());
    });
  document.getElementById("btn_iniciar").addEventListener("click", iniciarSesion);
  document.getElementById("btn_registrarse").addEventListener("click", register);


  function iniciarSesion() {
    $('.t_register').removeClass('d-none');
    $('.t_login').addClass('d-none');
    $('.formulario_login').removeClass('d-none');
    $('.formulario_register').addClass('d-none');
  }

  function register() {
    $('.t_login').removeClass('d-none');
    $('.t_register').addClass('d-none');
    $('.formulario_register').removeClass('d-none');
    $('.formulario_login').addClass('d-none');    
  }
});
