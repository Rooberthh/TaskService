<?php


    namespace App;


    use Illuminate\Database\Eloquent\Model;

    class Objective extends Model
    {
        protected $fillable = [
            'body',
            'completed'
        ];

        protected $casts = [
            'completed' => 'boolean'
        ];

        protected static function boot()
        {
            parent::boot();

            // auto-sets values on creation
            static::creating(function ($query) {
                $query->completed = $query->completed ?? false;
            });
        }

        public function task()
        {
            return $this->belongsTo(Task::class);
        }

        public function complete()
        {
            return $this->update(['completed' => true]);
        }

        public function incomplete()
        {
            return $this->update(['completed' => false]);
        }

        public function path()
        {
            return  "api/tasks/{$this->task->id}/objectives/$this->id";
        }
    }
