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

class FirstController extends Controller {
    //
    use StaticHelper;

    public function index(Request $request) {
    	//dd("fdsafds");

    	// menghitung total centroid
    	// menghitung total articles
    	$countCentroid = Centroid::count();
    	$countArticle = Article::count();
    	$countDimensi = DetailCentroid::where('centroid_id', '=', 9)->count();


    	// ambil 5 berita yang paling baru diambil
    	$articles = Article::select('id' ,'title')
		->whereNotNull('publish_date')
		->orderBy('publish_date', 'DESC')
		->limit(5)
		->get();
    	// dd($articles);

    	// ambil random berita
        $randomArticles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
        ->inRandomOrder()
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
        // ->toArray();
        // dd($popularArticles);


    	// mendapatkan kata yang sering muncul
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
    	//->toArray();
    	// dd($words);

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

    	// get detail centroids
    	$centroids = $this->getCentroid(true, 1, $offset, $perPage);
    	//dd($centroids->toArray());


    	return view('frontend2.home')->with([
                    'title' => "Home",
                    'is_show_slide_show' => true,
                    
    				// header & sidebar
    				'headline_news' => $articles,

    				// main content
    				'centroids' => $centroids,
    				'limit_article' => 1,

    				// sidebar for words
    				'random_news' => $randomArticles,
    				'popular_news' => $popularArticles,
    				'words' => $words,

    				// footer
                    'total_centroid' => $countCentroid,
                    'total_article' => $countArticle,
                    'total_dimensi' => $countDimensi,
        ]);
    }

    public function news(Request $request) {
    	
    	$countCentroid = Centroid::count();
    	$countArticle = Article::count();
    	$countDimensi = DetailCentroid::where('centroid_id', '=', 9)->count();


    	// ambil 5 berita yang paling baru diambil
    	$articles = Article::select('id' ,'title')
		->whereNotNull('publish_date')
		->orderBy('publish_date', 'DESC')
		->limit(5)
		->get();
    	// dd($articles);

    	// ambil random berita
        $randomArticles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
        ->inRandomOrder()
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
        // ->toArray();
        // dd($popularArticles);


    	// mendapatkan kata yang sering muncul
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
    	//->toArray();
    	// dd($words);

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

    	// get detail centroids
    	$centroids = $this->getCentroid(true, 1, $offset, $perPage);
    	//dd($centroids->toArray());


    	return view('frontend2.home')->with([
                    'title' => "Terpopuler",
    				// header & sidebar
    				'headline_news' => $articles,

    				// main content
    				'centroids' => $centroids,
    				'limit_article' => 1,

    				// sidebar for words
    				'random_news' => $randomArticles,
    				'popular_news' => $popularArticles,
    				'words' => $words,

    				// footer
                    'total_centroid' => $countCentroid,
                    'total_article' => $countArticle,
                    'total_dimensi' => $countDimensi,
        ]);
    }

    public function popular(Request $request) {
        $countCentroid = Centroid::count();
        $countArticle = Article::count();
        $countDimensi = DetailCentroid::where('centroid_id', '=', 9)->count();


        // ambil 5 berita yang paling baru diambil
        $articles = Article::select('id' ,'title')
        ->whereNotNull('publish_date')
        ->orderBy('publish_date', 'DESC')
        ->limit(5)
        ->get();
        // dd($articles);

        // ambil random berita
        $randomArticles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
        ->inRandomOrder()
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
        // ->toArray();
        // dd($popularArticles);


        // mendapatkan kata yang sering muncul
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
        //->toArray();
        // dd($words);

        $perPage = 10;
        $offset = 0;
        $nWord = 1;

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

        // get detail centroids
        $centroids = Centroid::select(
            'id', 
            'count_member', 
            'description', 
            DB::raw(
                "SUBSTRING_INDEX(GROUP_CONCAT(
                    ccc.text
                ORDER BY
                ccc.count DESC 
                SEPARATOR ', '
                ), ',', '$nWord') AS words"
            )
        )
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
        ->where('centroid.id' , '!=', '276')
        ->where('centroid.id' , '!=', '150')
        ->where('centroid.id' , '!=', '0')
        ->groupBy('centroid.id')

        //->orderBy('centroid.description', 'ASC')
        ->orderBy('centroid.count_member', 'DESC')
        //->orderBy('centroid.id', 'ASC');
        ->orderBy('centroid.updated_at', 'DESC');

        $centroids = $centroids->with([
        'articles' => function($query) {
            $query->select([
                        'article.id',
                        'article.title',
                        'article.link',
                        'article.publish_date',
                        'article.content',
                        'article.centroid_id',
                        'article.media_content_url',
                        'article.feed_id'
                    ])
                    ->orderBy('article.distance_to_centroid', 'DESC')
                    ->with('feed');
        }]);

        $centroids = $centroids->skip($offset)->take($perPage);
        $centroids = $centroids->get();
        //dd($centroids->toArray());


        return view('frontend2.home')->with([
                    'title' => "Terbaru",

                    // header & sidebar
                    'headline_news' => $articles,

                    // main content
                    'centroids' => $centroids,
                    'limit_article' => 1,

                    // sidebar for words
                    'random_news' => $randomArticles,
                    // 'popular_news' => $popularArticles,
                    'words' => $words,

                    // footer
                    'total_centroid' => $countCentroid,
                    'total_article' => $countArticle,
                    'total_dimensi' => $countDimensi,

        ]);
    }

}
