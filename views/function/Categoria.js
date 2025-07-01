function validar_form_categoria() {
    let nombre = document.getElementById("nombre").value.trim();
    let detalle = document.getElementById("detalle").value.trim();

    if (nombre === "" || detalle === "") {
        alert("Error: Existen campos vacíos");
        return false;
    }

    registrarCategoria();
}

if (document.querySelector('#frm_categoria')) {
    document.querySelector('#frm_categoria').onsubmit = function (e) {
        e.preventDefault();
        validar_form_categoria();
    };
}

async function registrarCategoria() {
    try {
        const datos = new FormData(document.getElementById('frm_categoria'));

        let respuesta = await fetch(bd_url + 'control/categoriaController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (json.status) {
            alert(json.msg);
            document.getElementById('frm_categoria').reset();
        } else {
            alert(json.msg);
        }
    } catch (e) {
        console.log("Error al registrar categoría: " + e);
    }
}
