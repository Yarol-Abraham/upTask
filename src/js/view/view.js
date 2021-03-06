import { message, hideMessage } from '../dom/alerts.js';

class View {
     
    _data;
  
    render(data)
    {
      this._data = data;
      const markup = data.length !== 0 ? this._generateMarkup() : this._renderMessage();
      this._clear();
      this._parentComponent.insertAdjacentHTML('afterbegin', markup);
    }
    
    _clear()
    { 
      this._parentComponent.innerHTML = "";
    }

    renderSpinner() // spinner mientras realiza la peticion
    {
      const markup = `
        <div class="lds-ring"><div></div><div></div><div></div><div>
      `;
      this._clear();
      this._parentComponent.insertAdjacentHTML('afterbegin', markup);
    }

    renderError(type, msg) // si existe un error
    {
      message(type, msg, this._parentComponent);   
    }

    renderFail(type, msg) // si existe un error
    {
      const markup = `<p class="alert alert-${type}">${msg}</p>`;
      this._clear();
      this._parentComponent.insertAdjacentHTML('afterbegin', markup);
      window.setTimeout(hideMessage, 3 * 1000);   
    }

    renderSuccess(type, msg) // si se crea la tarea sin problemas
    {
      message(type, msg, this._parentComponent);   
    }

}

export default View;