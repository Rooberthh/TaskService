<?php


    namespace App;

    use Illuminate\Database\Eloquent\Model;

    class Status extends Model
    {
        use Favoritable;
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name',
            'color',
            'board_id',
            'order',
            'favorite'
        ];

        protected $casts = [
            'favorite' => 'boolean'
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
            return $this->hasMany(Task::class)->orderBy('order', 'asc')->orderBy('updated_at', 'desc');
        }

        public function path()
        {
            return "api/boards/{$this->board->id}/statuses/$this->id";
        }
    }
