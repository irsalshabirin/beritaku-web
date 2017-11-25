<?php

namespace beritaku;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $table = 'category';

    public function add($name, $description, $parentId, $imgPath) {
        $this->name = $name;
        $this->description = $description;
        $this->parent_id = $parentId;
        $this->img_path = $imgPath;

        $this->save();

        return $this->id;
    }

    public function remove($id) {
        $this->destroy($id);
    }

    public function getAll() {
        return $this->all();
    }

}
