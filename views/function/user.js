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
}

if (document.querySelector("#frm_user")) {
  let frm_user = document.querySelector("#frm_user");
  frm_user.onsubmit = function (e) {
    e.preventDefault();
    validar_form();
  };
}

async function registrarUsuario() {
  try {
    const datos = new FormData(document.querySelector("#frm_user"));

    let respuesta = await fetch(
      base_url + "control/UsuarioController.php?tipo=registrar",
      {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
      }
    );

    let json = await respuesta.json();

    if (json.status) {
      alert(json.msg);
      document.getElementById("frm_user").reset();
    } else {
      alert(json.msg);
    }
  } catch (e) {
    console.log("Error a registrar Usuario:" + e);
  }
}


async function iniciar_sesion() {
  let usuario = document.getElementById("usuario").value;
  let password = document.getElementById("password").value;

  if (usuario == "" || password == "") {
    alert("ERROR, CAMPOS VACÍOS!");
    return;
  }

  try {
    const datos = new FormData(document.querySelector("#frm_login"));
    let respuesta = await fetch(base_url+'control/UsuarioController.php?tipo=iniciar_sesion',{
         method: "POST",
        mode: "cors",
        cache: "no-cache",
        body: datos,
    });
    // ------------------------------
    let json = await respuesta.json();
    // Validamos que json.status sea=true
    if (json.status) { // true
      location.replace(base_url + 'new-user');
    }else{
      alert(json.msg);
    }
  } catch (error) {
    console.log(error);
  }
}
  
async function views_users() {
  try {
    const resp = await fetch(`${base_url}control/UsuarioController.php?tipo=ver_usuarios`);
    if (!resp.ok) throw new Error(`Error HTTP: ${resp.status}`);

    const usuarios = await resp.json();
    renderUsers(usuarios);
  } catch (error) {
    console.error('Error al cargar usuarios:', error);
    document.getElementById('content_users').innerHTML = `<tr><td colspan="6" class="text-center text-danger">Error al cargar datos</td></tr>`;
  }
}

function renderUsers(lista) {
  const tbody = document.getElementById('content_users');
  if (!tbody) return;

  tbody.innerHTML = ''; // Limpiar contenido anterior

  if (!Array.isArray(lista) || lista.length === 0) {
    tbody.innerHTML = `<tr><td colspan="6" class="text-center">No hay usuarios.</td></tr>`;
    return;
  }

  lista.forEach((u, index) => {
    tbody.innerHTML += `
      <tr>
        <td class="text-center">${index + 1}</td>
        <td class="text-center">${u.nro_identidad}</td>
        <td class="text-center">${u.razon_social}</td>
        <td class="text-center">${u.correo}</td>
        <td class="text-center">${u.rol}</td>
        <td class="text-center">${u.estado}</td>
        <td>
          <a href="'+ base_url+'edit_user/+usuarios.id'+'">Editar</a>
        </td>

      </tr>
    `;
  });
}

if (document.getElementById('content_users')) {
  views_users();
}


