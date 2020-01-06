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
            return Status::all();
        }

        /**
         * @param Request $request
         * @return Response|ResponseFactory
         * @throws ValidationException
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'name' => 'required',
                'color' => 'required'
            ]);

            $status = Status::create([
                'name' => $request->get('name'),
                'color' => $request->get('color')
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
                'color' => $request->get('color')
            ]);

            return response($status, 200);
        }

    }
