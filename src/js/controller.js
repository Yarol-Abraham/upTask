import * as model from './model.js';
import taskView from './view/taskView.js';

import 'core-js/stable';
import 'regenerator-runtime/runtime';

const createTask = async function(newTask)
{ 
    try {
        //loading
        taskView.renderSpinner();
        
        //create task
        model.state.tasks = await model.createTask(newTask);
        const { tasks } = model.state; 

        // capture error
        if(!tasks.status) throw new Error(tasks.msg);
        
        // render form
        renderForm();
        
        // success
        taskView.renderSuccess( "success", tasks.msg );

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
    renderForm();
    taskView._toggleModal();    
}