import { message } from '../dom/alerts.js';
import View from './view.js';

class TaskView extends View {
    _parentElement = document.querySelector('.project__main__list');
    _component = document.querySelector('.page__form');

    _generateMarkup()
    {
     //   return this._data.map(this._generateMarkupImages).join('');
    }

    addHandleForm(handle)
    {
        this._component.addEventListener('submit', function(e){
            e.preventDefault();
            const input = document.querySelector(".page__form__input");
            if(input.value.trim() == "") return message("error", "Hace falta un nombre para crear la tarea 🤔", this);
            console.log("pasa la prueba");
        })
    }

}

export default new TaskView();