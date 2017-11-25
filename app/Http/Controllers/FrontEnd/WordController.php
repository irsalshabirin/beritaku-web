<?php

namespace beritaku\Http\Controllers\FrontEnd;

use beritaku\Http\Controllers\Controller;
use Illuminate\Http\Request;

use beritaku\Http\Requests;

use beritaku\Article;
use beritaku\Centroid;
use beritaku\DetailCentroid;

use DB;
use beritaku\CountWord;

class WordController extends Controller {
    //

    public function index($id, Request $request) {
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

    	// mendapatkan random kata
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

		// mendapatkan berita berdasarkan kata yang dipilih melalui url
        $contents = Article::select(
            'article.id',
            'article.title',
            DB::raw('SUM(count_word.count)'),
            'article.content',
            'word.word'
        )
        ->join('count_word', 'count_word.article_id', '=', 'article.id')
        ->join('word', 'count_word.word_id', '=', 'word.id')
        ->where('count_word.word_id', '=', $id)
        ->groupBy('count_word.article_id')
        ->orderBy('count_word.count', 'DESC')
        ->limit(20)
        ->get();

        if(count($contents->toArray()) == 0) {
            return redirect()->route('home');
        }

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
        
        // dd($contents->toArray());

        // dd($contents->toArray()[0]);
    	return view('frontend2.articles_by_word')->with([
                    // title
                    'title' => $contents->toArray()[0]['word'],
                    // header and sidebar
    				'headline_news' => $articles,

                    // sidebar
                    'random_news' => $randomArticles,

                    'contents' => $contents,
                    // tags
                    'words' => $words,

                    // footer
                    'total_centroid' => $countCentroid,
                    'total_article' => $countArticle,
                    'total_dimensi' => $countDimensi,
        ]);
    }
}
