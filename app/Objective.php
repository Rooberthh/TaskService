<?php


    namespace App;


    use Illuminate\Database\Eloquent\Model;

    class Objective extends Model
    {
        protected $fillable = [
            'body', 'completed'
        ];

        protected $casts = [
            'completed' => 'boolean'
        ];

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
    }
