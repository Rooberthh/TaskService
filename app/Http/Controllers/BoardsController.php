<?php

    namespace App\Http\Controllers;

    use App\Board;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Validation\Rule;

    class BoardsController extends Controller
    {
        public function index(Request $request)
        {
            $id = (int)$request->get('user_id');

            return Board::where('user_id', $id)->with('statuses')->get();
        }

        public function show($id, Request $request)
        {
            $board = Board::with('statuses.tasks.objectives')->findOrFail($id);

            return response($board, 200);
        }

        /**
         * @param Request $request
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         * @throws \Illuminate\Validation\ValidationException
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'name' => ['required', Rule::unique('boards')],
                'user_id' => ['required'],
            ]);

            $board = Board::create([
                'name' => $request->get('name'),
                'user_id' => $request->get('user_id')
            ]);

            return response($board, 200);
        }

        public function update($id, Request $request)
        {
            $this->validate($request, [
                'name' => 'sometimes',
            ]);

            $board = Board::find($id);

            //Refactor
            if((int)$board->user_id !== $request->get('user_id')){
                return response('You do not have access to update board', 403);
            }

            $board->update([
                'name' => $request->get('name'),
            ]);

            return response($board, 200);
        }

        /**
         * @param $id
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         */
        public function destroy($id, Request $request)
        {
            $board = Board::find($id);

            if((int)$board->user_id !== $request->get('user_id')){
                return response('You do not have access to delete board', 403);
            }

            $board->delete();

            return response('Task have been deleted', 200);
        }

    }
