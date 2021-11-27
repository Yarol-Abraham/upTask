import * as model from './model.js';
import taskView from './view/taskView.js';
import tasksView from './view/tasksView.js';

import 'core-js/stable';
import 'regenerator-runtime/runtime';

const listTask = async function(){

    try {
        //loading
        tasksView.renderSpinner();

        //list tasks
        model.state.tasks = await model.loadTask();
        const { tasks } = model.state; 
    
        // capture error
        if(!tasks.status) throw new Error(tasks.msg);
        
        // renderizar la vista
        tasksView.render(tasks.tasks);
        
    } catch (error) {
        console.log(error.message);
    }
}

const createTask = async function(newTask)
{ 
    try {
        //loading
        taskView.renderSpinner();
        
        //create task
        model.state.task = await model.createTask(newTask);
        const { task } = model.state; 

        // capture error
        if(!task.status) throw new Error(task.msg);
        
        // render form
        renderForm();
        
        // success
        taskView.renderSuccess( "success", task.msg );

    } catch (error) {
        renderForm();
        taskView.renderError( "error", error.message );
    }
}


function renderForm(){
    taskView.renderForm();
    taskView._toggleModalButton();
    taskView.addHandleForm(createTask);
}

export default function init()
{
    if(tasksView._parentComponent) // renderizar las tareas cuando se este en proyectos
    {
        listTask();
        renderForm();
        taskView._toggleModal(); 
    }   
}