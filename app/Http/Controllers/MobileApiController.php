<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;

class MobileApiController extends Controller {

    //
    public function index() {
        return view('backend.master');
    }

}
