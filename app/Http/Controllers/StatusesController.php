<?php


    namespace App\Http\Controllers;


    use App\Status;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Validation\ValidationException;
    use Laravel\Lumen\Http\ResponseFactory;

    class StatusesController extends Controller
    {
        public function index()
        {
            return Status::orderBy('order')->get();
        }

        /**
         * @param $board
         * @param Request $request
         * @return Response|ResponseFactory
         * @throws ValidationException
         */
        public function store($board, Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'color' => 'required'
            ]);

            $status = Status::create([
                'name' => $request->get('name'),
                'color' => $request->get('color'),
                'board_id' => $board,
                'order' => ($request->get('order')) ? $request->get('order') : 1000
            ]);

            return response($status, 200);
        }

        /**
         * @param $id
         * @param Request $request
         * @return Response|ResponseFactory
         * @throws ValidationException
         */
        public function update($id, Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'color' => 'required'
            ]);

            $status = Status::find($id);

            $status->update([
                'name' => $request->get('name'),
                'color' => $request->get('color'),
                'order' => ($request->get('order')) ? $request->get('order') : $status->order,
            ]);

            $status->touch();

            return response($status, 200);
        }

        public function destroy($board, $id)
        {
            $status = Status::find($id);

            $status->delete();

            return response('Status deleted', 200);
        }

    }
