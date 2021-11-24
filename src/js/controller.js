import * as model from './model.js';
import taskView from './view/taskView.js';

import 'core-js/stable';
import 'regenerator-runtime/runtime';


const createTask = function(newTask)
{
    //crear tareas
}


export default function init()
{
    taskView.addHandleForm(createTask);
}