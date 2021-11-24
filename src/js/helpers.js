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
/* Metodo ajax */
export const ajax = async function(url, uploadData = undefined)
{
    try {
      const fetchPro = uploadData
      ? fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(uploadData),
        })
      : fetch(url);
      const res = new Promise.race([fetchPro, timeout(TIME_SEC)]);
      const data = await res.json();
      if(!res.ok) throw new Error("Lo sentimos! no se encontraron resultados 😢");
      return data;
    } catch (error) { throw error; }
}