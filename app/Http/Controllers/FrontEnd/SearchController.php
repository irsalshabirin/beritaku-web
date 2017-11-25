<?php

namespace beritaku\Http\Controllers\FrontEnd;

use beritaku\Http\Controllers\Controller;

use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Article;
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\Tokenizer\TokenizerFactory;

use beritaku\Centroid;
use beritaku\DetailCentroid;

use beritaku\CountWord;
use DB;

class SearchController extends Controller {

    private $article;

    public function __construct() {
        $this->article = new Article();
    }

    public function index() {
        //return view('search');
        return "index";
    }

    public function result($page = 1) {

        $q = \Request::get('search');

        $tokenizerFactory = new TokenizerFactory();
        $tokenizer = $tokenizerFactory->createDefaultTokenizer();

        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        $qq = $stemmer->stem($q);
        $tokens = $tokenizer->tokenize($qq);

        $PER_PAGE = 20;
        $startFrom = ($page - 1) * $PER_PAGE;
        $time1 = microtime(true);
        $res = $this->article->getResultSearch($tokens, $startFrom, $PER_PAGE);
        $time2 = microtime(true);
        $totalPages = ceil($res['count_all'] / $PER_PAGE);
//        var_dump($totalPages);
//        die();  
//        dd($qq);

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

        return view('frontend2.search_result')->with([
        			'title' => "Hasil Pencarian : " .  $q,
                    'q' => $q,

                    // main content
                    'page' => $page,
                    'total_pages' => $totalPages,
                    'results' => $res['result'],
                    'time' => ($time2 - $time1),

                    // header & sidebar
    				'headline_news' => $articles,

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

}

?>