<?php

    namespace App\Http\Controllers;

    use App\Task;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class TaskObjectivesController extends Controller
    {
        /**
         * @param $task
         * @param Request $request
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store($task, Request $request)
        {
            $this->validate($request, [
                'body' => 'required'
            ]);

            $task = Task::find($task);

            return $task->addObjective($request->get('body'));
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
