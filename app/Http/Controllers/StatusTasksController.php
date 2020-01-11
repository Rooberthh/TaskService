<?php


    namespace App\Http\Controllers;


    use App\Status;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Validation\ValidationException;
    use Laravel\Lumen\Http\ResponseFactory;

    class StatusTasksController extends Controller
    {
        public function index($id)
        {
            $status = Status::find($id);

            return $status->tasks;
        }


    }
