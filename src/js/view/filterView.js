import View from './view.js';

class FilterView extends View {
    
    _parentComponent = document.querySelector('.project__filter');

    _generateMarkup()
    {
       // return this._data.map(task => this._renderPreview(task) ).join('');
    }

    /*
         1: todas
         2: pendientes
         3: completadas
    */
    addHandleFilter(handle)
    {
        const btns = document.querySelectorAll("input[type='radio']");
        btns.forEach(btn => btn.addEventListener('click', function() {
            handle(Number(btn.value));
        }) );
    }


}

export default new FilterView();