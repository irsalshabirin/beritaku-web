<?php

namespace beritaku\Http\Controllers\FrontEnd;

use beritaku\Http\Controllers\Controller;
use Illuminate\Http\Request;

use beritaku\Http\Requests;

use DB;

use beritaku\Article;
use beritaku\Centroid;
use beritaku\CountWord;
use beritaku\DetailCentroid;

use beritaku\Traits\StaticHelper;

class AdditionalController extends Controller {
    //
    use StaticHelper;

    public function about() {
    	$countCentroid = Centroid::count();
    	$countArticle = Article::count();
    	$countDimensi = DetailCentroid::where('centroid_id', '=', 9)->count();
    	//dd($countDimensi);

    	return view('frontend2.about')->with([
                    // header
    				// 'headline_news' => $articles,

                    // footer
                    'total_centroid' => $countCentroid,
                    'total_article' => $countArticle,
                    'total_dimensi' => $countDimensi,

                    // main_content
                    // 'article' => $article,
                    // 'keywords' => $keywords,


                    // sidebar
                    // 'random_news' => $randomArticles,
                    // 'words' => $words,
        ]);
    	
    }
}
