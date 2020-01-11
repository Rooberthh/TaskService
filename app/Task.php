<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /**
     * @method static find($id)
     */
    class Task extends Model
    {
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'title',
            'description',
            'status_id'
        ];

        protected static function boot()
        {
            parent::boot();

            Task::deleting(function($task){
                $task->objectives->each->delete();
            });
        }

        public function status()
        {
            return $this->belongsTo(Status::class);
        }

        public function objectives()
        {
            return $this->hasMany(Objective::class);
        }

        public function addObjective($body)
        {
            return $this->objectives()->create(compact('body'));
        }

        public function path()
        {
            return "/api/tasks/$this->id";
        }
    }
