import * as model from './model.js';
import taskView from './view/taskView.js';
import tasksView from './view/tasksView.js';

import 'core-js/stable';
import 'regenerator-runtime/runtime';

const listTask = async function()
{
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
        
    } catch (error)
    {
        tasksView.renderFail( "error", error.message );
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
        
        // update tasks
        const { tasks } = model.state.tasks;

        // render tasks
        tasksView.render(tasks);

        // success
        taskView.renderSuccess( "success", task.msg );

    } catch (error) {
        renderForm();
        taskView.renderError( "error", error.message );
    }
}

const updateTask = async function(id, method = "")
{
    try {
        
        // update state
        if(method === "update") await model.updateTask(id);
        
        // delete task
        else if(method === "delete") await model.deleteTask(id);
        
        // tasks
        const { tasks } = model.state.tasks;
       
        // render tasks
        tasksView.render(tasks);
        
    } catch (error) {  tasksView.renderFail( "error", error.message ); }

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
        tasksView.addHandleUpdateTask(updateTask);
        tasksView.addHandleDeleteTask(updateTask);
        renderForm();
        taskView._toggleModal(); 
    }   
}