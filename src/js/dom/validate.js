import { message } from './alerts.js';
export function validateTask()
{
    const form = document.querySelector(".page__form");
    const input = document.querySelector(".page__form__input");

    form.addEventListener('submit', function(e){
        e.preventDefault();
        if(input.value.trim() == "") return message("error", "Hace falta un nombre para crear la tarea 🤔", form);
    });

}