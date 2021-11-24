
class View {
    message = "Ha ocurrido un error inesperado, por favor vuelve a intentar! 😢";
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
      this._parentElement.innerHTML = ""; 
      this._component.innerHTML = "";
    }
      
    renderSpinner() // spinner mientras realiza la peticion
    {
      const markup = `
      <div class="lds-ring"><div></div><div></div><div></div><div>
      `;
      this._clear();
      this._component.insertAdjacentHTML('afterbegin', markup);
    }

    renderError() // si existe un error en el servidor
    {
      const markup = `<p>Ha ocurrido un error</p>`;
      this._clear();
      this._component.insertAdjacentHTML('afterbegin', markup);    
    }

}

export default View;