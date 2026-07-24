function obtenerIdsSeleccionados() {
    return [...document.querySelectorAll(".chk-orden:checked")]
        .map(c => c.value);
}

function nowMySQL() {
    const d = new Date();

    const pad = n => n.toString().padStart(2, "0");

    return `${d.getFullYear()}-${pad(d.getMonth()+1)}-${pad(d.getDate())} ` +
           `${pad(d.getHours())}:${pad(d.getMinutes())}:${pad(d.getSeconds())}`;
}

function ejecutar(url, payload, successMsg) {
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            location.reload();
        } else {
            alert(res.msg || "Error en operación");
        }
    });
}

/* =========================
   LIBERAR
========================= */
function liberar() {

    let ids = obtenerIdsSeleccionados();

    if (ids.length === 0) {
        alert("Selecciona al menos una orden");
        return;
    }

    ejecutar("acciones_backend.php", {
        accion: "liberar",
        ids
    });
}

/* =========================
   CERRAR
========================= */
function cerrar() {

    let ids = obtenerIdsSeleccionados();

    if (ids.length === 0) {
        alert("Selecciona al menos una orden");
        return;
    }

    ejecutar("acciones_backend.php", {
        accion: "cerrar",
        ids
    });
}

/* =========================
   CANCELAR
========================= */
function cancelar() {

    let ids = obtenerIdsSeleccionados();

    if (ids.length === 0) {
        alert("Selecciona al menos una orden");
        return;
    }

    ejecutar("acciones_backend.php", {
        accion: "cancelar",
        ids
    });
}

/* =========================
   RELIBERAR
========================= */
function reliberar() {

    let ids = [...document.querySelectorAll(".chk-orden:checked")]
        .map(c => c.value);

    if (ids.length === 0) {
        alert("Selecciona al menos una orden");
        return;
    }

    fetch("acciones_backend.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            accion: "reliberar",
            ids
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            location.reload();
        } else {
            alert(res.msg || "Error al reliberar");
        }
    });
}

function modificarOrden() {

    let ids = [...document.querySelectorAll(".chk-orden:checked")]
        .map(c => c.value);

    if (ids.length === 0) {
        alert("Selecciona una orden");
        return;
    }

    if (ids.length > 1) {
        alert("Solo puedes modificar una orden a la vez 😏");
        return;
    }

    let id = ids[0];

    window.location.href = "orden_detalle.php?id=" + id;
}