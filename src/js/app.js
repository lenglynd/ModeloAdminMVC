"use strict";
document.addEventListener('DOMContentLoaded', function () {
    eventListeners();
    darkMode();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme)');
    //preferencia del usuario de esquema de color
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('darl-mode');
    }
    
    prefiereDarkMode.addEventListener('change', function () {
        if (prefiereDarkMode.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('darl-mode');
        }
        
    });
    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode')
    });
};

function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', navegacionResponsive);
    
    // muestra campos comsicionales
    const contacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    contacto.forEach(input => input.addEventListener('click', mostrarMetodos));
    
    
}; 

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');
    
    navegacion.classList.toggle('mostrar');
    
    //las lineas de abajo es lo mismo que arriba
    
    // if (navegacion.classList.contains('mostrar')) {
    //     navegacion.classList.remove('mostrar')
    // } else {
    //     navegacion.classList.add('mostrar'); 
    // }
}
function mostrarMetodos(e) {
    const contactoDiv = document.querySelector('#contacto');
    
    if (e.target.value==='telefono') {
        contactoDiv.innerHTML = `
        <label for="tel"></label>
        <input name="contacto[telefono]" id="tel" type="tel" placeholder="654321123">
        <p>Indique la hora y fecha</p>
        <label for="fecha">Fecha</label>
        <input type="date" name="contacto[fecha]" id="fecha">
        <label for="hora">Hora</label>
        <input type="time" name="contacto[hora]" id="hora" min="09:00" max="20:00">
        `;
        
    } else {
        contactoDiv.innerHTML = `
        <label  for="email"></label>
        <input required name="contacto[email]" id="email" type="email" placeholder="correo@correo.com">
        
        `;
        
    }
}
