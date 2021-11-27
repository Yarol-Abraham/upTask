import { URL_API } from './config.js';
import { AJAX } from './helpers.js';

export const state = {
    task: {},
    tasks: []
}

const getParam = function() // obtener la url del proyecto actual
{
    let urlProject = new URLSearchParams(window.location.search);
    urlProject = Object.fromEntries(urlProject);
    return urlProject.url;
}

export const loadTask = async function() // cargar las tareas por proyecto
{
    try{
        const url = getParam();
        const data = await AJAX(`${URL_API}api/tasks?url=${url}`);
        return data;
    }catch(err){ throw err; }
}

export const createTask = async function(newTask) // crear tarea
{
    try{
        const url = getParam();
        const data = await AJAX(`${URL_API}api/task`, {
            "nombre" : newTask,
            "url": url
        });
        return data;
    }catch(err){ throw err; }
}

export const updateTask = function() // actualizar tarea
{

}

export const deleteTask = function() // eliminar tarea
{

}