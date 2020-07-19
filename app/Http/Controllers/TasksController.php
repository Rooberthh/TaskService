<?php

    namespace App\Http\Controllers;

    use App\Status;
    use App\Task;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Validation\Rule;

    class TasksController extends Controller
    {
        public function index()
        {
            return Task::orderBy('order')->get();
        }

        /**
         * @param $status
         * @param Request $request
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'title' => ['required', Rule::unique('tasks')],
                'status_id' => 'required'
            ]);

            $task = Task::create([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'status_id' => $request->get('status_id'),
                'order' => ($request->get('order')) ? $request->get('order') : 1000
            ]);

            return response($task, 200);
        }

        public function update($status, $id, Request $request)
        {
            $this->validate($request, [
                'title' => 'sometimes',
                'description' => 'sometimes',
                'status_id' => 'sometimes'
            ]);

            $task = Task::find($id);
            $task->update([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'status_id' => $request->get('status_id'),
                'order' => ($request->get('order')) ? $request->get('order') : $task->order,
            ]);

            //Force update of updated_at
            $task->touch();

            return response($task, 200);
        }

        public function updateOrderAll($status, Request $request)
        {
            $tasks = Status::find($status)->tasks;
            foreach ($tasks as $task) {
                $id = $task->id;
                foreach ($request->get('tasks') as $taskFrontEnd) {
                    if ($taskFrontEnd['id'] == $id) {
                        $task->update(['order' => $taskFrontEnd['order']]);
                    }
                }
            }

            return response('Updated order of tasks', 200);
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
