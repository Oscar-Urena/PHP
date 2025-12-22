"use strict"

const cumpleaniosApp = (() => {

    let btnSave, btnNew, nombre, apellido, fecha, pais, tbody, elemento, subelemento, msg;
    const init = () => {
        document.addEventListener("DOMContentLoaded", async ()=>{
            establecerObjetos();
            establecerEventos();
            await cargarAlumnos();
        })
    };

    const establecerObjetos=()=>{
        btnSave = document.querySelector("#name");
        btnNew = document.querySelector("#surname");
        nombre = document.querySelector("#birthday");
        apellido = document.querySelector("#pais");
        fecha = document.querySelector("#birthday");
        pais = document.querySelector("#country");
        tbody = document.querySelector("tbody");
        msg = document.querySelector("#msg");
    }

    const establecerEventos=()=>{
        btnSave.addEventListener("click", guardarCumple);
        btnNew.addEventListener("click", limpiarFormulario);
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

    const limpiarFormulario=()=>{
        nombre.value="";
        apellido.value="";
        fecha.value="";
        pais.value="";
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

    const cargarAlumnos=async()=>{
        try {
            limpiarTabla();
            const response = await fetch("../back-end/controller/user.controller.php");
            if (!response.ok) {
                throw new Error(`Error en la comunicacion ${response.status}`);
            }
            const data = await response.json();

            let indice = 0;
            data.forEach(element => {
                elemento = document.createElement("tr");
                elemento.setAttribute("id", indice++);
                subelemento = document.createElement("td");
                subelemento.textContent = element.name;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("td");
                subelemento.textContent = element.surname;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("td");
                subelemento.textContent = element.birthDay;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("td");
                subelemento.textContent = element.country;
                elemento.appendChild(subelemento);
                subelemento = document.createElement("button");
                subelemento.textContent = "Delete";
                subelemento.addEventListener("click", async () => {
                    await eliminarUser(elemento.id);
                });
                elemento.appendChild(subelemento);
                subelemento = document.createElement("button");
                subelemento.textContent = "Update";
                subelemento.addEventListener("click", async () => {
                    await updateUser(element.textContent);
                });
                elemento.appendChild(subelemento);
                
                tbody.appendChild(elemento);
            });
            
        } catch (error) {
            console.log(error);
        }
    }

    return { init };
})();

cumpleaniosApp.init();