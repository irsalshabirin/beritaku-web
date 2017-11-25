<?php

namespace beritaku;

use DB;
use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    protected $table = 'article';

    public function add($name, $description, $parentId, $imgPath) {
        $this->name = $name;
        $this->description = $description;
        $this->parent_id = $parentId;
        $this->img_path = $imgPath;

        $this->save();

        return $this->id;
    }

    public function remove($id) {
        $this->destroy($id);
    }

    public function getAll() {
        return $this->all();
    }

    public function feed() {
//        return $this->hasMany('beritaku\Feed', 'id', 'feed_id');
        return $this->hasOne('beritaku\Feed', 'id', 'feed_id');
//        return $this->belongsTo('beritaku\Feed', 'id', 'feed_id');
    }

    public function centroids() {
        return $this->belongsTo('beritaku\Centroid', 'id', 'centroid_id');
    }

    public function getResultSearch($query, $startFrom, $perPage) {

//        dd($startFrom, $perPage);
//        die();
//        dd($this->createInClause($query));
//        die();

        $result['result'] = DB::select("SELECT 
                a.id, 
                a.title, 
                a.content, 
                a.link, 
                a.media_content_url,
                a.publish_date,
                f.title AS feed_title,
                GROUP_CONCAT(w.word SEPARATOR ', ') as word,
                SUM(cw.count) val
            FROM 
                article AS a 
                    RIGHT JOIN count_word AS cw ON cw.article_id = a.id
                    RIGHT JOIN word AS w ON w.id = cw.word_id
                    RIGHT JOIN feed AS f ON f.id = a.feed_id
            WHERE 
                cw.word_id 
                    IN (SELECT id 
                        FROM word 
                        WHERE word IN( " . $this->createInClause($query) . "))
            GROUP BY 
                cw.article_id
            ORDER BY 
                val DESC
            LIMIT ? OFFSET ?", [
                    $perPage,
                    $startFrom
        ]);

        $result['count_all'] = count(DB::select("SELECT 
                a.id, 
                a.title, 
                a.content, 
                a.link, 
                a.publish_date,
                f.title AS feed_title,
                GROUP_CONCAT(w.word SEPARATOR ', ') AS word,
                SUM(cw.count) AS val
            FROM 
                article AS a 
                    RIGHT JOIN count_word AS cw ON cw.article_id = a.id
                    RIGHT JOIN word AS w ON w.id = cw.word_id
                    RIGHT JOIN feed AS f ON f.id = a.feed_id
            WHERE 
                cw.word_id 
                    IN (SELECT id 
                        FROM word 
                        WHERE word IN( " . $this->createInClause($query) . "))
            GROUP BY 
                cw.article_id
            ORDER BY 
                val DESC"));

        return $result;
    }

    public function createInClause($arr) {
        return '\'' . implode('\', \'', $arr) . '\'';
    }

}
