<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Centroid;
use DB;

use beritaku\Traits\StaticHelper;

class CentroidController extends Controller {

    use StaticHelper;

    //
    // get all article by centroid id
    public function detail($id, Request $request) {

        $nWord = 100;
        $limitArticle = 100;
    //        $perPage = 8;

        $centroids = $this->getDetailCentroid(true, $nWord, $id);

        if (count($centroids) == 0) {
            return redirect()->route('home');
        } else {

            return view('frontend.home', [
                'title' => 'Centroid ke-' . $id,
                'centroids' => $centroids,
                'limit_article' => $limitArticle,
                    ]
            );
        }
    }

}

