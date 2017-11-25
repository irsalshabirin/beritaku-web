<?php

namespace beritaku;

use Illuminate\Database\Eloquent\Model;
//use beritaku\BaseModel;

class Centroid extends Model {

    protected $table = 'centroid';

    /**
     * Get latest 5 comments from hasMany relation.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function nearestArticles() {
//        
//        return $this->articles()->nPerGroup('centroid_id', 2);
//    }

    public function articles() {
        return $this->hasMany('beritaku\Article', 'centroid_id', 'id');
    }

}
