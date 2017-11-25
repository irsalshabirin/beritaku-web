<?php

namespace beritaku\Traits;

use beritaku\Centroid;
use DB;

trait StaticHelper {
//trait ConstFunc {
    
    
    public function cleanHtml($string) {
        // remove character unprintable
        $string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $string);

        // remove tag <!-- --> comment
        $string = preg_replace('/<!--(.*)-->/Uis', '', $string);

        // remove tag section
        $string = preg_replace("/<section\s(.+?)>(.+?)<\/section>/is", "", $string);

        // remove tag div
        $string = preg_replace("/<div\s(.+?)>(.+?)<\/div>/is", "<p>$2</p>", $string);

        // remove tag a href
        $string = preg_replace("/<a\s(.+?)>(.+?)<\/a>/is", "$2", $string);
        
        return $string;
    }

    public function getCentroid($isWithArticle = true, $nWord = 1, $offset = 0, $perPage = 15) {

        $centroids = Centroid::select(
            'id', 
            'count_member', 
            'description', 
            DB::raw(
                "SUBSTRING_INDEX(GROUP_CONCAT(
                    ccc.text
                ORDER BY
                ccc.count DESC 
                SEPARATOR ', '
                ), ',', '$nWord') AS words"
            )
        )
        ->join(DB::raw("(
                    SELECT
                            a.centroid_id,"

                            //. "CONCAT(w.word, ' (', COUNT(w.id), ')') AS text,"
                            . "w.word AS text, "

                            . "COUNT(w.id) AS count
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
        //->orderBy('centroid.description', 'ASC')
        //->orderBy('centroid.count_member', 'DESC')
        //->orderBy('centroid.id', 'ASC');
        ->orderBy('centroid.updated_at', 'DESC');

        if($isWithArticle) {
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
        }

        $centroids = $centroids->skip($offset)->take($perPage);
        $centroids = $centroids->get();

        return $centroids;
    }


    public function getDetailCentroid($isWithArticle = true, $nWord = 1, $id) {

        $centroids = Centroid::select(
            'id', 
            'count_member', 
            'description', 
            DB::raw(
                "SUBSTRING_INDEX(GROUP_CONCAT(
                    ccc.text
                ORDER BY
                ccc.count DESC 
                SEPARATOR ', '
                ), ',', '$nWord') AS words"
            )
        )
        ->join(DB::raw("(
                    SELECT
                            a.centroid_id,"

                            //. "CONCAT(w.word, ' (', COUNT(w.id), ')') AS text,"
                            . "w.word AS text, "

                            . "COUNT(w.id) AS count
                    FROM
                            count_word AS cw
                        LEFT JOIN word AS w ON cw.word_id = w.id
                        LEFT JOIN article AS a ON cw.article_id = a.id
                    GROUP BY
                            w.id, a.centroid_id
                    ORDER BY
                            COUNT(w.id) DESC
            ) AS ccc"), "ccc.centroid_id", '=', "centroid.id")

        // centroid_id
        ->where('centroid.id', '=', $id)

        ->groupBy('centroid.id')
        //->orderBy('centroid.description', 'ASC')
        //->orderBy('centroid.count_member', 'DESC')
        //->orderBy('centroid.id', 'ASC');
        ->orderBy('centroid.updated_at', 'DESC');

        if($isWithArticle) {
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
        }

        $centroids = $centroids->get();
        return $centroids;
    }


}