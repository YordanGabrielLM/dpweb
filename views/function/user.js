function validar_form() {
  let nro_identidad = document.getElementById("nro_identidad").value;
  let razon_social = document.getElementById("razon_social").value;
  let telefono = document.getElementById("telefono").value;
  let correo = document.getElementById("correo").value;
  let departamento = document.getElementById("departamento").value;
  let provincia = document.getElementById("provincia").value;
  let cod_postal = document.getElementById("cod_postal").value;
  let direccion = document.getElementById("direccion").value;
  let rol = document.getElementById("rol").value;
  if (
    nro_identidad == "" ||
    razon_social == "" ||
    telefono == "" ||
    correo == "" ||
    departamento == "" ||
    provincia == "" ||
    cod_postal == "" ||
    direccion == "" ||
    rol == ""
  ) {
    Swal.fire({
      title: "Error de Validación",
      text: "Existen campos vacíos. Por favor, complete todos los datos.",
      icon: "error",
      confirmButtonText: "Entendido",
    });
    return;
  }
  registrarUsuario();
  //alert("procederemos a Registrar");
  //Swal.fire({
   // title: "Registro Exitoso",
   // text: "El usuario ha sido registrado con éxito",
   // icon: "success",
   // confirmButtonText: "Aceptar",
 // });
}

if (document.querySelector("#frm_user")) {
  //Evita que se envie el formulario
  let frm_user = document.querySelector("#frm_user");
  frm_user.onsubmit = function (e) {
    e.preventDefault();
    validar_form();
  };
}
async function registrarUsuario() {
    try {
       //capturar campos  de formulario (HTML)
      const datos = new FormData(frm_user);  
      //Enviar datos a controlador 
      let respusta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar',{
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
      });            
    } catch (e) {
        console.log("Error a registrar Usuario:"+ e)
    }
}

