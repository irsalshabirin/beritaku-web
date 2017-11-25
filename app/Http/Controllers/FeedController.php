<?php

namespace beritaku\Http\Controllers;

use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Feed;
use beritaku\Article;

class FeedController extends Controller {

    private $feeds;
    private $article;

    public function __construct() {
        $this->feeds = new Feed();
        $this->article = new Article();
    }

    public function index() {
////        $feed = \Feeds::make('http://rss.detik.com/index.php/detikcom_nasional');
//        $feed = \Feeds::make('http://rss.detik.com/index.php/finance');
//        $data = array(
//            'title'    => $feed->get_title(),
//            'description' => $feed->get_description(),
//            'icon_url' => $feed->get_image_url(),
////            'permalink' => $feed->get_permalink(),
//        );
//        var_dump($data);

        return view('backend.feed')->with([
                    'feeds' => $this->feeds->select(['id', 'title', 'feed_url', 'icon_url'])->get()
        ]);
    }

    public function create() {
        return view('feeds');
    }

    public function detailFeed($id) {
        // mendapatkan berita dari setiap feed
//        dd($this->article->where('feed_id', $id)->get());
//        die();
        
        return view('backend.article')->with([
            'feed_id' => $id,
        ]);
    }

    public function store(Request $request) {

        $url = trim($request->input('feed_url'));

        $feed = \Feeds::make($url);

        if (isset($feed)) {
            $title = $feed->get_title();
//            $description = $feed->get_description();
            $icon_url = $feed->get_image_url();
            $feed_url = $url;
            $is_validated = 1;

            if (isset($feed->error)) {

                return redirect('admin/feed')->with(
                                'failed', 'Feeds tidak berhasil ditambahkan.'
                );
            } else {

                try {

                    $this->feeds->add($title, $feed_url, $icon_url, $is_validated);
                } catch (\Exception $e) {

                    return redirect('admin/feed')->with(
                                    'failed', 'Feeds tidak berhasil ditambahkan.'
                    );
                }
            }
        }

        return redirect('admin/feed')->with(
                        'success', 'Feeds berhasil ditambahkan.'
        );
    }

    public function destroy(Request $request) {
        $id = $request->input('id');

        $this->feeds->remove($id);
        return redirect('admin/feed')->with('success', 'Feed berhasil dihapus.');
    }

}
