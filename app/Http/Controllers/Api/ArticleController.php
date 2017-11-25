<?php

namespace beritaku\Http\Controllers\Api;

use beritaku\Http\Controllers\Controller;
use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Article;
use beritaku\Traits\StaticHelper;

class ArticleController extends Controller {

    use StaticHelper;

//    private $articles;

    public function __construct() {
//        $this->articles = new Article();
    }

    public function get($id) {
        try {
            $result = Article::select(
                            'id', 'title', 'link', 'content', 'media_content_url', 'publish_date', 'feed_id')
                    ->where('id', $id)
                    ->with(['feed' => function($query) {
                            $query->select('feed.id', 'feed.title', 'feed.feed_url', 'feed.icon_url');
                        }])
                    ->first();
                        
//            dd($result);

            $result->content = $this->cleanHtml($result->content);

            return response()->json(array(
                        'article' => $result,
                        'message' => "Success",
                        'error' => false
            ));
        } catch (\Exception $e) {

            return response()->json(array(
                        'message' => "Failed : " . $e->getMessage(),
                        'error' => true
                            ), 500);
        }
    }

}
