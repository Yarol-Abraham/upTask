import { TIME_SEC } from './config.js';
/* Tiempo de espera por solicitud */
export const timeout = function(s)
{
    return new Promise((_, reject) => {
      setTimeout(()=> {
        reject(new Error('Lo sentimos, la solicitud al servidor tardo demasiado 😢'));
      }, s * 1000);  
    })
}

/* Método ajax - POST / GET */
export const AJAX = async function(url, task = null)
{
    try {
      let fetchPro;

      if(task)
      {
        const form = new FormData();    
        Object.keys(task).forEach(el => form.append(el, task[el]) );

        fetchPro = fetch(url, {
          method: 'POST',
          body: form
        });

      }else{ fetchPro = fetch(url); }

      const res = await Promise.race([fetchPro, timeout(TIME_SEC)]); // tiempo de consulta: 10 segundos
      const data = await res.json();
      
      if(!res.ok) throw new Error("Lo sentimos! no se encontraron resultados 😢");
      
      return data;
    } catch (error) { throw error; }
}