<?php


    namespace App\Http\Controllers;


    use App\Board;
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
                'order' => ($request->get('order')) ? $request->get('order') : 1000,
                'favorite' => ($request->get('favorite')) ? $request->get('favorite') : false
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
                'favorite' => ($request->get('favorite')) ? $request->get('favorite') : $status->favorite
            ]);

            $status->touch();

            return response($status, 200);
        }

        public function updateOrderAll($board, Request $request)
        {
            $statuses = Board::find($board)->statuses;

            // Refactor
            foreach ($statuses as $status) {
                $id = $status->id;
                foreach ($request->get('statuses') as $statusFrontEnd) {
                    if ($statusFrontEnd['id'] == $id) {
                        $status->update(['order' => $statusFrontEnd['order']]);
                    }
                }
            }

            return response('Updated order of statuses', 200);
        }

        public function destroy($board, $id)
        {
            $status = Status::find($id);

            $status->delete();

            return response('Status deleted', 200);
        }

    }
