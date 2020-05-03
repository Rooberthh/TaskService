<?php


    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Board extends Model
    {
        protected $fillable = [
            'name',
            'archived',
        ];

        protected $casts = [
            'archived' => 'boolean'
        ];

        protected static function boot()
        {
            parent::boot();

            Board::deleted(function($board){
                $board->statuses->each->delete();
            });
        }

        public function statuses() {
            return $this->hasMany(Status::class);
        }

        public function path()
        {
            return "api/boards/$this->id";
        }
    }
