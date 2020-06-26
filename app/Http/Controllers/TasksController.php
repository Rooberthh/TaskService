<?php

    namespace App\Http\Controllers;

    use App\Task;
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
                'order' => ($request->get('order')) ? $request->get('order') : 0
            ]);

            return response($task, 200);
        }

        public function update($id, Request $request)
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
                'order' => ($request->get('order')) ? $request->get('order') : $task->order
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
