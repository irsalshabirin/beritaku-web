<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;

use beritaku\Article;
use beritaku\CountWord;

use Yajra\Datatables\Datatables;
use DB;

use beritaku\Traits\StaticHelper;

class ArticleController extends Controller {

    use StaticHelper;
    
    private $articles;

    public function __construct() {
        $this->articles = new Article();
    }

    public function index() {
//        dd($this->article->find(369426)->feed->title);
//        die();
//        return view('backend.article')->with([
//                    'articles' => $this->articles->getAll(),
//        ]);

        return view('backend.article');
    }

    public function detail($id, Request $request) {

        $article = Article::select(
                        'title', 'content', 'feed_id', 'link', 'media_content_url', 'publish_date'
                )
                ->with('feed')
                ->where('id', $id)
                ->first();

        $article->content = $this->cleanHtml($article->content);
        
//        $article = $article->toArray();
//        dd($article);

        $keywords = CountWord::select(
                        //'count_word.id',
                        'word.word',
                        'count_word.count'
                    )
        ->join('word', 'count_word.word_id', '=', 'word.id')
        ->where("count_word.article_id", $id)
        ->orderBy("count", "DESC")
        ->get();
        //->toArray();

        //dd($keywords);

        return view('frontend.detail_article', [
            'title' => $article->title,
            'article' => $article,
            'keywords' => $keywords,
        ]);
    }

    public function getAllData($feedId = 0) {

        $articles = DB::table("article")
                ->join('feed', 'feed.id', '=', 'article.feed_id')
                ->select(DB::raw("article.id, article.title, article.feed_id, feed.title AS feed_title, feed.feed_url"));

        if ($feedId == 0) {
            $articles->get();
        } else {
            $articles->where('feed_id', '=', $feedId)->get();
        }

        return Datatables::of($articles)
                        ->addColumn('action', function ($article) {
                            return '<div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Action
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-toggle="modal" data-id="' . $article->id . '" data-target="#edit-modal" class="edit-modal" >Edit</a></li>
                                    <li><a href="#" data-toggle="modal" data-id="' . $article->id . '" data-target="#delete-modal" class="delete-modal">Delete</a></li>
                                </ul>
                            </div>';
                        })
                        ->addColumn('id', function ($article) {
                            return $article->id;
                        })
                        ->addColumn('feed_title', function($article) {
                            if (isset($article->feed_url)) {
                                return '<a href="' . $article->feed_url . '" target="_blank"> ' . $article->feed_title . ' <i class="fa fa-rss"></i></a>';
                            } else {
                                return '-';
                            }
                        })
                        ->make(true);
    }

    public function getCountArticleByDate($start, $end) {
//        $start = $request->input('start');
//        $end = $request->input('end');

        $countArticleByDate = DB::table('article')
                ->select(DB::raw('count(id) as count_article, UNIX_TIMESTAMP(publish_date) * 1000 AS publish_date'))
                ->whereBetween(DB::raw('DATE(publish_date)'), array($start, $end))
                ->groupBy(DB::raw('DATE(publish_date)'))
                ->orderBy("publish_date", 'ASC')
                ->get();

        $countArticleByDate = collect($countArticleByDate);

        $count = $countArticleByDate->pluck('count_article');
        $publishDate = $countArticleByDate->pluck('publish_date');
        $tt = $publishDate->zip($count);
//        dd($tt->toJson());
//        die();
        return response()->json($tt->toJson());
    }

}
