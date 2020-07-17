<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    trait Favoritable
    {
        public function favorite()
        {
            return $this->update(['favorite' => true]);
        }

        public function unfavorite()
        {
            return $this->update(['favorite' => false]);
        }

        public function isFavorited()
        {
            return !! $this->favorite;
        }
    }
