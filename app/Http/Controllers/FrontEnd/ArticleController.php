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

class ArticleController extends Controller {
    //
    use StaticHelper;

    public function detail($id, Request $request) {

    	// menghitung total centroid
    	// menghitung total articles
    	$countCentroid = Centroid::count();
    	$countArticle = Article::count();
        $countDimensi = DetailCentroid::where('centroid_id', '=', 9)->count();

    	// ambil 5 berita yang paling baru diambil
    	$articles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
		->whereNotNull('publish_date')
		->orderBy('publish_date', 'DESC')
		->limit(5)
		->get();
    	//dd($articles);

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
        

        // ambil random berita
        $randomArticles = Article::select('id' ,'title', 'media_content_url', 'publish_date')
        ->inRandomOrder()
        ->limit(5)
        ->get();

        $article = Article::select(
                        'title', 'content', 'feed_id', 'link', 'media_content_url', 'publish_date'
                )
                ->with('feed')
                ->where('id', $id)
                ->first();

        $article->content = $this->cleanHtml($article->content);
    
        $keywords = CountWord::select(
                        //'count_word.id',
                        'word.id',
                        'word.word',
                        'count_word.count'
                    )
        ->join('word', 'count_word.word_id', '=', 'word.id')
        ->where("count_word.article_id", $id)
        ->orderBy("count", "DESC")
        ->get();
        //->toArray();

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

    	return view('frontend2.detail_article')->with([
                    'title' => $article->title,

                    // header
    				'headline_news' => $articles,

                    // footer
                    'total_centroid' => $countCentroid,
                    'total_article' => $countArticle,
                    'total_dimensi' => $countDimensi,

                    // main_content
                    'article' => $article,
                    'keywords' => $keywords,


                    // sidebar
                    'random_news' => $randomArticles,
                    'popular_news' => $popularArticles,
                    'words' => $words,

        ]);
    }
}
