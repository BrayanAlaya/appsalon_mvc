let paso = 1;

const paginacionInicial = 1;
const paginacionFinal = 3;

const cita = {
    id: "",
    nombre: "",
    fecha: "",
    hora: "",
    servicios: []
}

document.addEventListener("DOMContentLoaded", function () {
    iniciarapp();
})

function iniciarapp() {
    mostrarSeccion();
    tabs();
    botonPaginador();
    botonAnterior();
    botonSiguiente();
    consultarApi();
    setNombre();
    setFecha();
    setId();
    setHora();
    mostrarResumen();
};

function mostrarResumen() {
    const resumen = document.querySelector(".contenido-resumen");

    while (resumen.firstChild) {
        resumen.firstChild.remove();
    }

    if (Object.values(cita).includes("") || cita.servicios === 0) {
        mostrarAlerta("Datos insuficientes", "error", ".contenido-resumen", false);
        return;
    }

    const headingServicios = document.createElement("h3");
    headingServicios.textContent = "Resumen Servicios";
    resumen.appendChild(headingServicios);

    const { nombre, fecha, hora, servicios } = cita;

    servicios.forEach(servicio => {
        const { nombre, precio } = servicio;

        const servicioCita = document.createElement("DIV");
        servicioCita.classList.add("servicioCita-resumen");

        const nombreServicio = document.createElement("P");
        nombreServicio.innerHTML = `<span>Servicio:</span> ${nombre}`;

        const precioServicio = document.createElement("P");
        precioServicio.innerHTML = `<span>Precio:</span> $${precio}`;

        servicioCita.appendChild(nombreServicio);
        servicioCita.appendChild(precioServicio);

        resumen.appendChild(servicioCita);

    });

    const headingCita = document.createElement("h3");
    headingCita.textContent = "Resumen Cita";
    resumen.appendChild(headingCita);

    const dateObj = new Date(fecha);
    const day = dateObj.getDate() + 2;
    const mes = dateObj.getMonth();
    const year = dateObj.getFullYear();

    const fechaUtc = new Date(Date.UTC(year, mes, day));

    const opciones = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
    const fechaFormateada = fechaUtc.toLocaleDateString("es-MX", opciones);

    const nombreCita = document.createElement("P");
    nombreCita.innerHTML = `<span>Nombre:</span> ${nombre}`;
    const fechaCita = document.createElement("P");
    fechaCita.innerHTML = `<span>Fecha:</span> ${fechaFormateada}`;
    const horaCita = document.createElement("P");
    horaCita.innerHTML = `<span>Hora:</span> ${hora}:00`;

    resumen.appendChild(nombreCita);
    resumen.appendChild(fechaCita);
    resumen.appendChild(horaCita);

    const botonEnviar = document.createElement("buttom");
    botonEnviar.classList.add("boton");
    botonEnviar.textContent = "Reservar Cita";
    botonEnviar.onclick = enviarCita;
    resumen.appendChild(botonEnviar);
}

async function enviarCita() {
    const { id, fecha, hora, servicios } = cita;
    const serviciosid = servicios.map(servicio => servicio.id);

    const datos = new FormData();
    datos.append("fecha", fecha);
    datos.append("usuarioid",id);
    datos.append("hora", hora);
    datos.append("serviciosid", serviciosid);

    try {
        const url = "/api/citas";

        const enviar = await fetch(url, {
            method: "POST",
            body: datos
        });

        const resultado = await enviar.json();

        if (resultado.resultado) {
            Swal.fire({
                icon:"success",
                title: "Cita Creada",
                text: "Cita reservada correctamente",
            }).then(()=>{
                setTimeout(()=>{
                    window.location.reload();
                },1500)
            })
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Error",
            text: "Cita no creada"
          });
    }



}

function setHora() {
    const horaForm = document.querySelector("#time");
    horaForm.addEventListener("input", (e) => {

        const horaActual = (e.target.value).split(":")[0];
        if (horaActual < 8 || horaActual > 18) {
            e.target.value = "";
            mostrarAlerta("Horario no permitido", "error", ".formulario");
        } else {
            cita.hora = e.target.value;
        }
    });
}

function setId() {
    cita.id = document.querySelector("#id").value;
}
function setNombre() {
    cita.nombre = document.querySelector("#name").value;
}
function setFecha() {
    const date = document.querySelector("#date");
    date.addEventListener("input", (e) => {
        const currentDay = new Date(e.target.value).getUTCDay();

        if ([0, 6].includes(currentDay)) {
            e.target.value = "";
            mostrarAlerta("Fines de mensaje no permitidos", "error", ".formulario");
        } else {
            cita.fecha = e.target.value;
        }
    });
}

function mostrarAlerta(mensaje, tipo, lugar, desaparecer = true) {
    const verificarAlertas = document.querySelector(".alerta");
    if (verificarAlertas) {
        verificarAlertas.remove();
    };

    const alerta = document.createElement("DIV");
    alerta.textContent = mensaje;
    alerta.classList.add("alerta");
    alerta.classList.add(tipo);

    const agregarAlerta = document.querySelector(lugar);
    agregarAlerta.appendChild(alerta);

    if (desaparecer) {

        setTimeout(() => {
            alerta.remove();
        }, 3000)

    }
}

async function consultarApi() {
    try {
        const url = "/api/servicio";
        const resultado = await fetch(url);
        const servicio = await resultado.json();
        mostrarServicios(servicio);
    } catch (error) {

    }
}

function mostrarServicios(servicios) {
    servicios.forEach(servicio => {
        const { id, nombre, precio } = servicio;

        const mostrarNombre = document.createElement("P");
        mostrarNombre.classList.add("nombre-servicio");
        mostrarNombre.textContent = nombre;

        const mostrarPrecio = document.createElement("P");
        mostrarPrecio.classList.add("precio-servicio");
        mostrarPrecio.textContent = `$${precio}`;

        const mostrarDivServicio = document.createElement("DIV");
        mostrarDivServicio.classList.add("mostrar-servicios");
        mostrarDivServicio.dataset.idServicio = id;
        mostrarDivServicio.onclick = () => {
            setServicio(servicio);
        };

        mostrarDivServicio.appendChild(mostrarNombre);
        mostrarDivServicio.appendChild(mostrarPrecio);

        document.querySelector("#servicios").appendChild(mostrarDivServicio);

    })
}

function setServicio(servicio) {
    const { id } = servicio;
    const { servicios } = cita;
    const divServicio = document.querySelector(`[data-id-servicio='${id}']`);

    if (servicios.some(agredado => agredado.id === id)) {
        cita.servicios = servicios.filter(agregado => agregado.id !== id);
        divServicio.classList.remove("seleccionado");
    } else {
        divServicio.classList.add("seleccionado");
        cita.servicios = [...servicios, servicio];
    }
}

function botonAnterior() {
    const anterior = document.querySelector("#anterior");
    anterior.addEventListener("click", () => {

        if (paso <= paginacionInicial) {

            return;
        }
        paso--;
        botonPaginador();
        mostrarSeccion();
    });
}
function botonSiguiente() {
    const siguiente = document.querySelector("#siguiente");
    siguiente.addEventListener("click", () => {

        if (paso >= paginacionFinal) {
            return;
        }
        paso++;
        botonPaginador();
        mostrarSeccion();
    });
}

function mostrarSeccion() {

    const seccionAnterior = document.querySelector(".mostrar");
    if (seccionAnterior) {
        seccionAnterior.classList.remove("mostrar");
    }
    const tabAnterior = document.querySelector(".actual");
    if (tabAnterior) {
        tabAnterior.classList.remove("actual");
    }

    const seccion = document.querySelector(`#paso-${paso}`);
    seccion.classList.add("mostrar");

    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add("actual");
}

function tabs() {
    const botones = document.querySelectorAll(".tab button");

    botones.forEach(boton => {
        boton.addEventListener("click", (e) => {
            paso = parseInt(e.target.dataset.paso);
            botonPaginador();
            mostrarSeccion();
        })
    });

}

function botonPaginador() {
    const paginaSiquiente = document.querySelector("#siguiente");
    const paginaAnterior = document.querySelector("#anterior");

    if (paso === 1) {
        paginaAnterior.classList.add("ocultar");
        paginaSiquiente.classList.remove("ocultar");
    } else if (paso === 3) {
        paginaSiquiente.classList.add("ocultar");
        paginaAnterior.classList.remove("ocultar");
        mostrarResumen();
    } else if (paso === 2) {
        paginaAnterior.classList.remove("ocultar");
        paginaSiquiente.classList.remove("ocultar");
    }

}


