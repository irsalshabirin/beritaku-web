<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Centroid;
use beritaku\Article;
use DB;

use beritaku\Traits\StaticHelper;

class HomeController extends Controller {

    use StaticHelper;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {

        $nWord = 10;
        $limitArticle = 1;
        $perPage = 10;
        $offset = 0;

        if ($request->per_page) {
            $perPage = $request->per_page;
        } else {
            $perPage = 10;
        }

        if ($request->page) {
            $offset = ($request->page - 1) * $perPage;
        } else {
            $request->page = 1;
        }

        $centroids = $this->getCentroid(true, $nWord, $offset, $perPage);

        if (count($centroids) == 0) {
            return redirect()->route('home');
        } else {

            return view('frontend.home', [
                'title' => 'Home',
                'centroids' => $centroids,
                'limit_article' => $limitArticle,
                'page' => $request->page,
                    ]
            );
        }
    }

}
        