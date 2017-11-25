<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Article;
use beritaku\Feed;
use beritaku\User;
use beritaku\Word;
use beritaku\Centroid;
use DB;

class AdminController extends Controller {

    private $articles;
    private $feeds;
    private $users;
    private $words;

    public function __construct() {
        $this->articles = new Article();
        $this->feeds = new Feed();
        $this->users = new User();
        $this->words = new Word();
    }

    public function index() {

        $countArticleByFeedId = DB::table('article')
                ->join('feed', 'feed.id', '=', 'article.feed_id')
                ->select(DB::raw('count(article.id) as count_article, feed_id, feed.title'))
                ->groupBy('feed_id')
                ->orderBy("count_article", 'desc')
                ->take(4)
                ->get();
        

        return view('backend.home')->with([
                    'count_article' => $this->articles->count(),
                    'count_centroid' => Centroid::count(),

                    'count_feed' => $this->feeds->count(),
                    'count_user' => $this->users->count(),
                    'count_word' => $this->words->count(),
                    'count_article_by_feed' => $countArticleByFeedId,
        ]);
    }

}
