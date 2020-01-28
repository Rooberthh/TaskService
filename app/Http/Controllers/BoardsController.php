<?php

    namespace App\Http\Controllers;

    use App\Board;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Validation\Rule;

    class BoardsController extends Controller
    {
        public function index()
        {
            return Board::all();
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
            ]);

            $board = Board::create([
                'name' => $request->get('name'),
            ]);

            return response($board, 200);
        }

        public function update($id, Request $request)
        {
            $this->validate($request, [
                'name' => 'sometimes',
            ]);

            $board = Board::find($id);

            $board->update([
                'name' => $request->get('name'),
            ]);

            return response($board, 200);
        }

        /**
         * @param $id
         * @return Response|\Laravel\Lumen\Http\ResponseFactory
         */
        public function destroy($id)
        {
            $board = Board::find($id);
            $board->delete();

            return response('Task have been deleted', 200);
        }

    }
