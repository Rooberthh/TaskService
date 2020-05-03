<?php

    namespace App\Http\Controllers;

    use App\Objective;
    use App\Task;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;

    class TaskObjectivesController extends Controller
    {

        public function index($id)
        {
            $task = Task::find($id);

            return $task->objectives;
        }

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

        public function update($task, $id, Request $request)
        {
            $this->validate($request, [
                'body' => 'required'
            ]);

            $objective = Objective::find($id);

            $objective->update([
                'body' => $request->get('body')
            ]);

            $request->get('completed') ? $objective->complete() : $objective->incomplete();

            return response($objective, 201);
        }

        /**
         * @param $task
         * @param $objective
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         */
        public function destroy($task, $objective)
        {
            $objective = Objective::find($objective);

            $objective->delete();

            return response('Objective have been deleted', 200);
        }

    }
