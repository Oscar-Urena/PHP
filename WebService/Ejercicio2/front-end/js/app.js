"use strict"

const cumpleaniosApp = (() => {

    let btnSave, tbody, elemento, subelemento, msg;
    const init = () => {
        document.addEventListener("DOMContentLoaded", async ()=>{
            establecerObjetos();
            establecerEventos();
            await buscarCiudad();
        })
    };

    const establecerObjetos=()=>{
        btnSave = document.querySelector("#btnBuscar");
        tbody = document.querySelector("tbody");
    }

    const establecerEventos=()=>{
        btnSave.addEventListener("click", buscarCiudad);
    }


    const limpiarTabla=()=>{
        document.querySelectorAll("tbody tr").forEach(e=>e.remove());
    }

    const eliminarUser=async(id)=>{
        try {
            const response = await fetch(`../back-end/controller/user.controller.php?id=${id}`, {
                method: 'DELETE'
            });
            if (!response.ok) {
                throw new Error(`Error en la comunicacion ${response.status}`);
            }
            await cargarAlumnos();
        } catch (error) {
            console.log(error);
        }
    }

    const buscarCiudad=async()=>{
        try {
            limpiarTabla();
            const response = await fetch("../back-end/controller/city.controller.php");
            if (!response.ok) {
                throw new Error(`Error en la comunicacion ${response.status}`);
            }
            const data = await response.json();

            let indice = 0;
            data.forEach(element => {
                elemento = document.createElement("tr");
                elemento.setAttribute("id", ++indice);
                subelemento = document.createElement("td");
                subelemento.textContent = element.name;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("td");
                subelemento.textContent = element.population;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("td");
                subelemento.textContent = element.country;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("button");
                subelemento.textContent = "Delete";
                subelemento.addEventListener("click", async () => {
                    await eliminarCiudad(elemento.id);
                });
                elemento.appendChild(subelemento);
                subelemento = document.createElement("button");
                subelemento.textContent = "Update";
                subelemento.addEventListener("click", async () => {
                    await updateCiudad(element.textContent);
                });
                elemento.appendChild(subelemento);
                
                tbody.appendChild(elemento);
            });
            
        } catch (error) {
            console.log(error);
        }
    }

    const guardarCumple=async()=>{
        try {
            const response = await fetch("./Ejercicio1/back-end/controller/user.controller.php", {
                method: 'POST',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },  
                body: `nombre=${nombre.value}&apellido=${apellido.value}&fecha=${fecha.value}&pais=${pais.value}`
            });
            if (!response.ok) {
                throw new Error(`Error en la comunicacion ${response.status}`);
            }
            const data = await response.text();
            msg.textContent = data;
            await cargarAlumnos();
        } catch (error) {
            console.log(error);
        }
    }

    const updateUser=async(id)=>{
        try {
            const response = await fetch(`../back-end/controller/user.controller.php`, {
                method: 'PUT',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${id}&nombre=${nombre.value}&apellido=${apellido.value}&fecha=${fecha.value}&pais=${pais.value}`
            });
            if (!response.ok) {
                throw new Error(`Error en la comunicacion ${response.status}`);
            }
            await cargarAlumnos();
        } catch (error) {
            console.log(error);
        }
    }

    const limpiarFormulario=()=>{
        nombre.value="";
        apellido.value="";
        fecha.value="";
        pais.value="";
    }


    return { init };
})();

cumpleaniosApp.init();