<?php


    namespace App\Http\Controllers;


    use App\Status;
    use Illuminate\Http\Request;

    class StatusesController extends Controller
    {
        public function index()
        {
            return Status::all();
        }

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

    }
