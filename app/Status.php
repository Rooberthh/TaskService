<?php


    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Status extends Model
    {
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'color',
            'board_id'
        ];

        protected $with = [
            'tasks'
        ];

        protected static function boot()
        {
            parent::boot();

            Status::deleting(function($status){
                $status->tasks->each->delete();
            });
        }

        public function board()
        {
            return $this->belongsTo(Board::class);
        }

        public function tasks()
        {
            return $this->hasMany(Task::class);
        }

        public function path()
        {
            return "api/boards/{$this->board->id}/statuses/$this->id";
        }
    }
