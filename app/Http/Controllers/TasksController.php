<?php

    namespace App\Http\Controllers;

    use App\Task;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class TasksController extends Controller
    {
        public function index()
        {
            return Task::all();
        }

        /**
         * @param Request $request
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'title' => 'required'
            ]);

            $task = Task::create([
                'title' => $request->get('title'),
                'description' => $request->get('description')
            ]);

            return response($task, 200);
        }

        /**
         * @param $id
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         */
        public function destroy($id)
        {
            $task = Task::find($id);
            $task->delete();

            return response('Task have been deleted', 200);
        }

    }
