import { URL_API } from './config.js';
import { AJAX } from './helpers.js';

export const state = {
    task: {},
    tasks: {
        "status" : false,
        "type"   : "",
        "tasks"  : [] 
    }
}

const getParam = function() // obtener la url del proyecto actual
{
    let urlProject = new URLSearchParams(window.location.search);
    urlProject = Object.fromEntries(urlProject);
    return urlProject.url;
}

const addNewTask = function(task)
{ 
    const { tasks } = state.tasks; 
    tasks.push(task); 
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
        
        if(data.task) addNewTask(data.task); // agregar la nueva tarea al arreglo
        
        return data;

    }catch(err){ throw err; }
}

export const updateTask = async function(id) // actualizar la tarea por id
{
    try {
        
        const data = await AJAX(`${URL_API}api/task/update`, {
            "id" : id
        });
        
        const { tasks } = state.tasks;

        tasks.map(task => {
            if(task.id === id) task.estado = data.task.estado;
         });
        
    } catch (error) { throw error; }
}

export const deleteTask = async function(id) // eliminar tarea por id
{
      try {
        
        const data = await AJAX(`${URL_API}api/task/delete`, {
            "id" : id
        });
        
        const { tasks } = state.tasks;

        const index = tasks.findIndex(task => task.id === id);
        tasks.splice(index, 1);
        
    } catch (error) { throw error; }
}

export const filterTasks = function(filter) // filtrar las tareas
{
    let { tasks } = state.tasks;
    let filterTask;
    
    if(filter === 1 || filter === 0) 
        filterTask = tasks.filter(task => Number(task.estado) === filter);
    if(filter === 2) 
        filterTask = tasks;
    
    return filterTask;
}