<?php

    namespace App\Http\Controllers;

    use App\Task;

    class TasksController extends Controller
    {
        public function index()
        {
            return Task::all();
        }

    }
