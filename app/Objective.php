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

        function task()
        {
            return $this->belongsTo(Task::class);
        }

    }
