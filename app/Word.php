<?php

namespace beritaku;

use Illuminate\Database\Eloquent\Model;

class Word extends Model {

    protected $table = 'word';

    public function add($word, $type) {

        $this->word = $word;
        $this->type = $type;
        $this->save();
        return $this->id;
    }

    public function edit($id, $word, $type) {
        $wordUpdate = $this->find($id);
        $wordUpdate->word = $word;
        $wordUpdate->type = $type;

        $wordUpdate->save();
    }

    public function remove($id) {
        $this->destroy($id);
    }

    public function getAll() {
        return $this->all();
    }

}
