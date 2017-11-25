<?php

namespace beritaku\Http\Controllers\Api;

use beritaku\Http\Controllers\Controller;
use Illuminate\Http\Request;
use beritaku\Http\Requests;
use beritaku\Article;
use beritaku\Traits\StaticHelper;

use beritaku\Centroid;

use DB;

class CentroidController extends Controller {

    use StaticHelper;

//    private $articles;

    public function __construct() {
//        $this->articles = new Article();
    }

    public function index(Request $request) {
        
        try {
            
            $nWord = 2;
            $perPage = 2;
            $offset = 0;

            if ($request->per_page) {
                $perPage = $request->per_page;
            } else {
                $perPage = 2;
            }

            if ($request->page) {
                $offset = ($request->page - 1) * $perPage;
            } else {
                $request->page = 1;
            }


            $centroids = Centroid::select('id', 'count_member', 'description', DB::raw(
                                    "SUBSTRING_INDEX(GROUP_CONCAT(
                                                ccc.text
                                                ORDER BY
                                                        ccc.count DESC 
                                                SEPARATOR ', '
                                        ), ',', '$nWord') AS words"
                    ))
                    ->join(DB::raw("(
                                SELECT
                                        a.centroid_id,
                                        w.word AS text,
                                        COUNT(w.id) AS count
                                FROM
                                        count_word AS cw
                                    LEFT JOIN word AS w ON cw.word_id = w.id
                                    LEFT JOIN article AS a ON cw.article_id = a.id
                                GROUP BY
                                        w.id, a.centroid_id
                                ORDER BY
                                        COUNT(w.id) DESC
                        ) AS ccc"), "ccc.centroid_id", '=', "centroid.id")
                    ->groupBy('centroid.id')
//                ->orderBy('centroid.description', 'ASC')
                    // ->orderBy('centroid.count_member', 'DESC')
                    ->orderBy('centroid.updated_at', 'DESC');
                    // ->orderBy('centroid.id', 'ASC');
//        dd($centroids);

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
//                $centroids = $centroids->limit($perPage);

                    $centroids = $centroids->get();

                    return response()->json(array(
                                'centroids' => $centroids,
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
        