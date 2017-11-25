<?php

namespace beritaku;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model {

    protected $table = 'feed';

    public function add($title, $feed_url, $icon_url, $is_validated) {
//        try {
        $this->title = $title;
        $this->feed_url = $feed_url;
        $this->icon_url = $icon_url;
        $this->is_validated = $is_validated;

        $this->save();

        return $this->id;
//        } catch (\Exceptions $e) {
//            return "failed";
//        }
    }

    public function remove($id) {
        $this->destroy($id);
    }

    public function getAll() {
        return $this->all();
    }

    public function articles() {
        return $this->hasMany('beritaku\Article', 'feed_id', 'id');
    }

}
