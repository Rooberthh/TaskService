<?php


    namespace App\Http\Controllers;


    use App\Status;

    class FavoriteStatusesController extends Controller
    {
        public function index()
        {
            return Status::where('favorite', true)->get();
        }

        public function store($status)
        {
            $status = Status::find($status);

            $status->favorite();

            return $status;
        }

        public function destroy($status)
        {
            $status = Status::find($status);

            $status->unfavorite();

            return $status;
        }

    }