<?php


    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Board extends Model
    {
        protected $fillable = [
            'name',
            'archived',
            'user_id'
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
            return $this->hasMany(Status::class)->orderBy('order')->orderBy('updated_at', 'desc');
        }

        public function path()
        {
            return "api/boards/$this->id";
        }
    }
