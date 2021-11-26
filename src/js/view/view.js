import { message } from '../dom/alerts.js';

class View {
     
    _data;
  
    render(data)
    {
      console.log(data);
    /*  if(!data || Array.isArray(data) && data.length === 0 ) return this.renderError();
        this._data = data;
        const markup = this._generateMarkup();
        this._clear();
        this._parentElement.insertAdjacentHTML('afterbegin', markup);*/
    }
    _clear()
    { 
      this._modalComponet.innerHTML = "";
    }

    renderSpinner() // spinner mientras realiza la peticion
    {
      const markup = `
        <div class="lds-ring"><div></div><div></div><div></div><div>
      `;
      this._clear();
      this._modalComponet.insertAdjacentHTML('afterbegin', markup);
    }

    renderError(type, msg) // si existe un error
    {
      message(type, msg, this._modalComponet);   
    }

    renderSuccess(type, msg) // si se crea la tarea sin problemas
    {
      message(type, msg, this._modalComponet);   
    }

}

export default View;