import View from './view.js';

class TasksView extends View {
    
    _parentComponent = document.querySelector('.project__list');
    _msg = "En este apartato apareceran tus tareas creados! 😊✔";

    setMsg(msg)
    {
        this._msg = msg;
    }

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
                    <button id="${task.id}" data-update_id="${task.id}" type="button" class="btn btn-ms-w btn-${Number(task.estado) === 0 ? 'yellow' : 'green'}">${Number(task.estado) === 0 ? 'Pendiente' : 'Completo'}</button>
                    <button data-remove_id="${task.id}" type="button" class="btn btn-ms-w btn-red">Eliminar</button>
                </div>
            </div>
        `;
    }

    _renderMessage()
    {
        return `
            <div class="projects__message">
                <p class="text-center text-uppercase md-mb">${this._msg}</p>
                <div class="projects__img">
                    <img src="/upTask/src/images/dashboard/lanzamiento.png" alt="lanzamiento">
                </div>
            </div> 
        `;
    }

    addHandleUpdateTask(handle)
    {
       this._parentComponent.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-yellow') || e.target.closest('.btn-green');
            if(!btn) return;
            const id = btn.dataset.update_id;
            handle(id, "update");
       });
    }

    addHandleDeleteTask(handle)
    {
        this._parentComponent.addEventListener('click', function(e){
            const btn = e.target.closest('.btn-red');
            if(!btn) return;
            const id = btn.dataset.remove_id;
            handle(id, "delete");
       });
    }

}

export default new TasksView();