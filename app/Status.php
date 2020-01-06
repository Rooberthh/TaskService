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
            'color'
        ];

        protected static function boot()
        {
            parent::boot();

            Status::deleting(function($status){
                $status->tasks->each->delete();
            });
        }

        public function tasks()
        {
            return $this->hasMany(Task::class);
        }

        public function path()
        {
            return "api/statuses/$this->id";
        }
    }
