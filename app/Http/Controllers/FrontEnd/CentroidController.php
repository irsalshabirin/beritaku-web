<?php

namespace beritaku\Http\Controllers\FrontEnd;

use beritaku\Http\Controllers\Controller;
use Illuminate\Http\Request;

use beritaku\Http\Requests;

use beritaku\Article;
use beritaku\Centroid;
use beritaku\CountWord;
use beritaku\DetailCentroid;


use DB;
class CentroidController extends Controller {
    //

    public function index($id, Request $request) {
    	//dd("fdsafds");

    	// menghitung total centroid
    	// menghitung total articles
    	$countCentroid = Centroid::count();
    	$countArticle = Article::count();
    	$countDimensi = DetailCentroid::where('centroid_id', '=', 9)->count();

    	// ambil 4 berita yang paling baru diambil
    	$articles = Article::select('id' ,'title')
    				->whereNotNull('publish_date')
    				->orderBy('publish_date', 'DESC')
    				->limit(5)
    				->get();


    	// ambil article popular depend on count member cluster
        $popularArticles = Article::select(
        	'article.id' ,'article.title', 'article.media_content_url', 'article.publish_date',
        	'centroid.id AS cid',
        	'centroid.count_member'
        	)
        ->join('centroid', 'article.centroid_id', '=', 'centroid.id')
        ->where('centroid.id' , '!=', '276')
        ->where('centroid.id' , '!=', '150')
        ->where('centroid.id' , '!=', '0')
        ->orderBy('centroid.count_member', 'DESC')
        ->orderBy('centroid.updated_at', 'DESC')
        ->groupBy('centroid.id')
        ->limit(5)
        ->get();


    	$nWord = 2;
        $limitArticle = 100;

        // ambil random berita
        $randomArticles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
        ->inRandomOrder()
        ->limit(5)
        ->get();

        $centroids = Centroid::select('id', 'count_member', 'description', DB::raw(
                                "SUBSTRING_INDEX(GROUP_CONCAT(
                                                ccc.text
                                                ORDER BY
                                                        ccc.count DESC SEPARATOR ', '
                                        ), ',', '$nWord') AS words"
                ))
                ->join(DB::raw("(
                                SELECT
                                        a.centroid_id,"
                                        //. "CONCAT(w.word, ' (', COUNT(w.id), ')') AS text,"
                                        . "w.word AS text, "
                                        . "COUNT(w.id) AS count
                                FROM
                                        count_word AS cw
                                LEFT JOIN word AS w ON cw.word_id = w.id
                                LEFT JOIN article AS a ON cw.article_id = a.id
                                GROUP BY
                                        w.id, a.centroid_id
                                ORDER BY
                                        COUNT(w.id) DESC
                        ) AS ccc"), "ccc.centroid_id", '=', "centroid.id")
                ->where('centroid.id', '=', $id)
                ->groupBy('centroid.id')
    //                ->orderBy('centroid.description', 'ASC')
                ->orderBy('centroid.count_member', 'DESC')
                ->orderBy('centroid.id', 'ASC');


        $centroids = $centroids->with([
            'articles' => function($query) {
                $query->select([
                            'article.id',
                            'article.title',
                            'article.link',
                            'article.content',
                            'article.publish_date',
                            'article.centroid_id',
                            'article.media_content_url',
                            'article.feed_id'
                        ])
                        ->orderBy('article.distance_to_centroid', 'DESC')
                        ->with('feed');
            }]);


        $centroids = $centroids->get();

        // sidebar -> words
        $words = CountWord::select(
        	'word.id',
            'word.word',
            DB::raw('SUM(count_word.count) AS cc')
            )
        ->join('word', 'count_word.word_id', '=', 'word.id')
        ->groupBy('count_word.word_id')
        ->limit(20)
        ->inRandomOrder()
        ->get();

        // ambil random berita
        $randomArticles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
        ->inRandomOrder()
        ->limit(5)
        ->get();

        //dd($centroids->toArray()[0]['words']);

        if (count($centroids) == 0) {
            return redirect()->route('home');
        } else {

            return view('frontend2.home', [
                'title' => $centroids->toArray()[0]['words'],

                'centroids' => $centroids,
                'limit_article' => $limitArticle,

            	// header and sidebar
				'headline_news' => $articles,


				// footer
                'total_centroid' => $countCentroid,
                'total_article' => $countArticle,
                'total_dimensi' => $countDimensi,

                // sidebar
                'words' => $words,
                'popular_news' => $popularArticles,
                'random_news' => $randomArticles,
                // ''
            ]);
        }

    }
}
