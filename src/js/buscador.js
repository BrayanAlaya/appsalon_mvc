document.addEventListener("DOMContentLoaded",()=>{
    iniciarApp();
});

function iniciarApp(){
    buscarPorFecha();
}

function buscarPorFecha(){
    const fecha = document.querySelector("#fecha");
    fecha.addEventListener("input",(e)=>{
        const fechaInput = e.target.value;
        window.location = `?fecha=${fechaInput}`;
    });
}


