<?php

namespace beritaku;

use Illuminate\Database\Eloquent\Model;

class DetailCentroid extends Model {

    // use SoftDeletes;

    protected $table = 'detail_centroid';
    public $fillable = ['name', 'address', 'phone'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
