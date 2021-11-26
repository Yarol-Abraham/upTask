import { message } from '../dom/alerts.js';
import View from './view.js';

class TaskView extends View {
   
    _modalComponet = document.querySelector('.modal__body');
    _modal = document.querySelector('.modal');
    _overlay = document.querySelector('.overlay');

    renderForm()
    {
       const markup = `
            <form method="POST" class="page__form">
                <fieldset class="page__form__fieldset">
                    <legend class="page__form__legend">Agregar una nueva tarea</legend>
                    <input class="page__form__input" type="text" placeholder="Escribir..." name="nombre" />
                    
                    <div class="page__form__box">
                        <button class="btn-md-w btn btn-blue btn--animated ms-m" type="submit">Agregar</button>
                        <button id="btn--close" class="btn--close btn-md-w btn btn-red btn--animated ms-m" type="button">Cancelar</button>
                    </div>
                </fieldset>
            </form>
       `; 
       this._modalComponet.innerHTML = "";
       this._modalComponet.insertAdjacentHTML('afterbegin', markup);
    }

    addHandleForm(handle = null)
    {
        const _component = document.querySelector('.page__form');
        _component.addEventListener('submit', function(e){
            e.preventDefault();
            const input = document.querySelector(".page__form__input").value;
            if(input.trim() == "") return message("error", "Hace falta un nombre para crear la tarea 🤔", this);
            handle(input);
        })
    }

    toggleModal() // abrir o cerrar el modal
    {
        this._modal.classList.toggle("modal--hidden");
        this._overlay.classList.toggle("modal--hidden");
    }

    _toggleModal()
    {
        const btnCloseModal = document.querySelector('.btn--close-modal');
        const btnOpenModal = document.querySelector('.btn--show');
       
        btnOpenModal.addEventListener('click', this.toggleModal.bind(this) ); // abrir modal
        btnCloseModal.addEventListener('click', this.toggleModal.bind(this) ); // cerrar modal
        this._overlay.addEventListener('click', this.toggleModal.bind(this) ); // cerrar modal
    }

    _toggleModalButton()
    {
        const btnCloseModal = document.querySelector("#btn--close");
        btnCloseModal.addEventListener('click', this.toggleModal.bind(this) );
    }

}

export default new TaskView();