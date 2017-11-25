<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Article;
use Sastrawi\Stemmer\StemmerFactory;
use Sastrawi\Tokenizer\TokenizerFactory;

class SearchController extends Controller {

    private $article;

    public function __construct() {
        $this->article = new Article();
    }

    public function index() {
        return view('search');
    }

    public function result($page = 1) {

        $q = \Request::get('q');

        $tokenizerFactory = new TokenizerFactory();
        $tokenizer = $tokenizerFactory->createDefaultTokenizer();

        $stemmerFactory = new StemmerFactory();
        $stemmer = $stemmerFactory->createStemmer();

        $qq = $stemmer->stem($q);
        $tokens = $tokenizer->tokenize($qq);

        $PER_PAGE = 10;
        $startFrom = ($page - 1) * $PER_PAGE;
        $time1 = microtime(true);
        $res = $this->article->getResultSearch($tokens, $startFrom, $PER_PAGE);
        $time2 = microtime(true);
        $totalPages = ceil($res['count_all'] / $PER_PAGE);
//        var_dump($totalPages);
//        die();  
//        dd($qq);

        return view('search_result')->with([
                    'q' => $q,
                    'page' => $page,
                    'total_pages' => $totalPages,
                    'results' => $res['result'],
                    'time' => ($time2 - $time1),
        ]);
    }

}
