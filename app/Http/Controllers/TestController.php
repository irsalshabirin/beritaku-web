<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;

use beritaku\Http\Requests;

use beritaku\Article;

class TestController extends Controller {
    //
    public function index() {
    	$articles = Article::select('')
    	return view('frontend2.home')->with([
                    // 'count_article' => $this->articles->count(),
                    // 'count_feed' => $this->feeds->count(),
                    // 'count_user' => $this->users->count(),
                    // 'count_word' => $this->words->count(),
                    // 'count_article_by_feed' => $countArticleByFeedId,
        ]);
    }
}
