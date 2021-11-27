import View from './view.js';

class TasksView extends View {
    
    _parentComponent = document.querySelector('.project__list');

    _generateMarkup()
    {
        return this._data.map(task => this._renderPreview(task) ).join('');
    }

    _renderPreview(task)
    {
        return `
            <div class="project__list--item">
                <p>${task.nombre}</p>
                <div class="project__list--buttons">
                    <button id="${task.id}" type="button" class="btn btn-ms-w btn-yellow">Pendiente</button>
                    <button id="${task.id}" type="button" class="btn btn-ms-w btn-red">Eliminar</button>
                </div>
            </div>
        `;
    }

    _renderMessage(){
        return `
            <div class="projects__message">
                <p class="text-center text-uppercase md-mb">En este apartato apareceran tus tareas creados! 😊✔</p>
                <div class="projects__img">
                    <img src="/upTask/src/images/dashboard/lanzamiento.png" alt="lanzamiento">
                </div>
            </div> 
        `;
    }

}

export default new TasksView();