<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/25/16
 * Time: 5:34 PM
 */
class News_Model extends CI_Model
{
    public $title = "vi_title";
    public $content = "vi_content";
    public $summary = "vi_summary";

    public function __construct()
    {
        $this->title = $_SESSION["activeLanguage"] == "vi" ? "vi_title" : "en_title";
        $this->content = $_SESSION["activeLanguage"] == "vi" ? "vi_content" : "en_content";
        $this->summary = $_SESSION["activeLanguage"] == "vi" ? "vi_summary" : "en_summary";
        $this->load->model("Category_model");
    }

    public function getIdFromSlug($slug)
    {
        $sql = "select id from news where slug='$slug' limit 0,1";
        $list = $this->db->query($sql)->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item['id'];
            }
        }
        return -1;
    }

    public function getNewsById($id)
    {
        $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, $this->summary as summary from news where id = $id";
        $list = $this->db->query($sql)->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item;
            }
        }
        return -1;
    }

    public function getNewsByIds($ids)
    {
        $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, $this->summary as summary from news where id in (";
        $cnt = count($ids);
        for ($i = 0; $i < $cnt - 1; $i++) {
            $sql = $sql . $ids[$i] . ",";
        }
        $sql = $sql . $ids[$cnt - 1] . ")";
        return $this->db->query($sql)->result_array();
    }

    public function getNewsByCatId($catId)
    {
        $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, $this->summary as summary, created_date, updated_date from news where category_id = $catId order by created_date DESC";
        return $this->db->query($sql)->result_array();
    }

    public function getLastNews()
    {
        //HARDCODE
        try{
            $news_and_event = $this->config->item('news_and_event') != 0 ? $this->config->item('news_and_event') : 0;
            $recruitment = $this->config->item('tuyen_dung') != 0 ? $this->config->item('tuyen_dung') : 0;
            $sharing_corner = $this->config->item('gocchiase') != 0 ? $this->config->item('gocchiase') : 0;
            $scholarship = $this->config->item('hoc_bong') != 0 ? $this->config->item('hoc_bong') : 0;
            $sql = "select id, category_id, img_src, slug, $this->title as title, $this->summary as summary, created_date from news where category_id in ($news_and_event, $sharing_corner, $recruitment, $scholarship) order by created_date desc limit 0,4";
            $aData = $this->db->query($sql)->result_array();
            $aResult = array();
            $cnt = 0;
            if(count($aData)>0){

                foreach ($aData as $item) {
                    $aResult[$cnt]['id'] = $item['id'];
                    $aResult[$cnt]['category_id'] = $item['category_id'];
                    $aResult[$cnt]['title'] = $item['title'];
                    $aResult[$cnt]['slug'] = $item['slug'];
                    $aResult[$cnt]['img_src'] = $item['img_src'];
                    $aResult[$cnt]['created_date'] = $item['created_date'];
                    $aResult[$cnt]['summary'] = $item['summary'];
                    $cnt++;
                }
            }
            return $aResult;

        }catch(Exception $e){
            return false;
        }
    }

    public function getLastNewsByCatId($catId)
    {
        //HARDCODE
        try{
            $sql = "select id, category_id, img_src, slug, $this->title as title, $this->summary as summary, created_date from news where category_id in ($catId) order by created_date desc limit 0,5";
            $aData = $this->db->query($sql)->result_array();
            $aResult = array();
            $cnt = 0;
            if(count($aData)>0){

                foreach ($aData as $item) {
                    $aResult[$cnt]['id'] = $item['id'];
                    $aResult[$cnt]['category_id'] = $item['category_id'];
                    $aResult[$cnt]['title'] = $item['title'];
                    $aResult[$cnt]['slug'] = $item['slug'];
                    $aResult[$cnt]['img_src'] = $item['img_src'];
                    $aResult[$cnt]['created_date'] = $item['created_date'];
                    $aResult[$cnt]['summary'] = $item['summary'];
                    $cnt++;
                }
            }
            return $aResult;

        }catch(Exception $e){
            return false;
        }
    }
    public function getLastNewsByCatIds($catId, $catId2)
    {
        //HARDCODE
        try{
            $sql = "select id, category_id, img_src, slug, $this->title as title, $this->summary as summary, created_date from news where category_id in ($catId, $catId2) order by created_date desc limit 0,4";
            $aData = $this->db->query($sql)->result_array();
            $aResult = array();
            $cnt = 0;
            if(count($aData)>0){

                foreach ($aData as $item) {
                    $aResult[$cnt]['id'] = $item['id'];
                    $aResult[$cnt]['category_id'] = $item['category_id'];
                    $aResult[$cnt]['title'] = $item['title'];
                    $aResult[$cnt]['slug'] = $item['slug'];
                    $aResult[$cnt]['img_src'] = $item['img_src'];
                    $aResult[$cnt]['created_date'] = $item['created_date'];
                    $aResult[$cnt]['summary'] = $item['summary'];
                    $cnt++;
                }
            }
            return $aResult;

        }catch(Exception $e){
            return false;
        }
    }

    public function getNewsByArrCat($aCat)
    {
        $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, $this->summary as summary, updated_date from news where category_id in (";
        $cnt = count($aCat);
        for ($i = 0; $i < $cnt - 1; $i++) {
            $sql = $sql . $aCat[$i] . ",";
        }
        $sql = $sql . $aCat[$cnt - 1] . ") order by created_date DESC";
        return $this->db->query($sql)->result_array();
    }

    public function getNewsByCatCollection($aCat, $cur_page, $limit)
    {
        $start = ($cur_page - 1) * $limit;
        if($aCat && count($aCat) > 0){
            $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, $this->summary as summary from news where category_id in (";
            $cnt = count($aCat);
            for ($i = 0; $i < $cnt - 1; $i++) {
                $sql = $sql . $aCat[$i] . ",";
            }
            $sql = $sql . $aCat[$cnt - 1] . ") order by created_date DESC limit $start,$limit";
            return $this->db->query($sql)->result_array();
        }
        return array();
    }

    public function getNewsByCatCollectionWithoutLimit($aCat)
    {
        $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, updated_date, $this->summary as summary from news where category_id in (";
        foreach ($aCat as $value) {
            $sql = $sql . $value . ",";
        }
        $sql = substr($sql, 0, -1);
        $sql = $sql . ") order by created_date desc";
        return $this->db->query($sql)->result_array();
    }

    public function getToTalRowByCatCollection($aCat)
    {
        $sql = "select count(*) as total_row from news where category_id in(";
        $cnt = count($aCat);
        for ($i = 0; $i < $cnt - 1; $i++) {
            $sql = $sql . $aCat[$i] . ",";
        }
        $sql = $sql . $aCat[$cnt - 1] . ")";
        $list = $this->db->query($sql)->result_array();
        if (count($list) > 0) {
            foreach ($list as $item) {
                return $item['total_row'];
            }
        }
        return -1;
    }

    public function getRelatedNewsByCatId($category_id)
    {
        $arr = array();
        $cnt = 0;
        $aSubMenu = array();
        $this->Category_model->getDirectSubMenu($category_id, $aSubMenu);
        foreach ($aSubMenu as $item) {
            if ($cnt > 2) {
                break;
            }
            if (count($this->getNewsByCatId($item)) == 0) {
                continue;
            }
            $arr[$cnt]['cat_name'] = $this->Category_model->getName($item);
            $aNews = $this->getNewsByCatId($item);
            $max_news = count($aNews) > 4 ? 4 : count($aNews);
            $arr[$cnt]['related_news'] = $this->resizeNewsArray($aNews, $max_news);
            $cnt++;
        }
        return $arr;
    }

    public function resizeNewsArray($aNews, $new_cnt)
    {
        $arr = array();
        for ($j = 0; $j < $new_cnt; $j++) {
            $arr[$j]['id'] = $aNews[$j]['id'];
            $arr[$j]['category_id'] = $aNews[$j]['category_id'];
            $arr[$j]['img_src'] = $aNews[$j]['img_src'];
            $arr[$j]['slug'] = $aNews[$j]['slug'];
            $arr[$j]['title_header'] = $aNews[$j]['title_header'];
            $arr[$j]['description_header'] = $aNews[$j]['description_header'];
            $arr[$j]['keyword_header'] = $aNews[$j]['keyword_header'];
            $arr[$j]['title'] = $aNews[$j]['title'];
            $arr[$j]['content'] = $aNews[$j]['content'];
            $arr[$j]['summary'] = $aNews[$j]['summary'];
            $arr[$j]['created_date'] = $aNews[$j]['created_date'];
            $arr[$j]['updated_date'] = $aNews[$j]['updated_date'];
        }
        return $arr;
    }

    public function getNewsByCategoryConfig($type, $is_enable_op = true)
    {
        $sql = "select category_id,max_news from category_config where type='$type'";
        if ($is_enable_op) {
            $sql = $sql . " and is_enable=1";
        }
        $sql = $sql . " order by sort_index";
        $aCatConfig = $this->db->query($sql)->result_array();

        $arr = array();
        $cnt = 0;
        foreach ($aCatConfig as $item) {
            if ($cnt > 2) {
                //max category is 3
                break;
            }
            $aNews = $this->getNewsByCatId($item['category_id']);
            if (count($aNews) == 0) {
                continue;
            }
            $arr[$cnt]['cat_name'] = $this->Category_model->getName($item['category_id']);
            $max_news = $item['max_news'] < count($aNews) ? $item['max_news'] : count($aNews);
            $arr[$cnt]['related_news'] = $this->resizeNewsArray($aNews, $max_news);
            $cnt++;
        }
        return $arr;
    }

    public function getRelatedNewsById($news_id)
    {
        $sql = "select category_id from news where id=$news_id";
        $result = $this->db->query($sql)->result_array();
        $category_id = 0;
        foreach($result as $item){
            $category_id = $item['category_id'];
            break;
        }

        $sql = "select id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, $this->summary as summary ";
        $sql = $sql . "from news where category_id = $category_id and id <> $news_id order by id desc limit 0,6";

        return $this->db->query($sql)->result_array();
    }

    public function getTotalRowByTagId($tag_id)
    {
        $sql = "select count(*) as total_row from news, tagnews where tag_id = $tag_id and news_id = news.id";
        $list = $this->db->query($sql)->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item['total_row'];
            }
        }
        return -1;
    }

    public function getNewsByTagId($tag_id, $cur_page, $limit)
    {
        $start = ($cur_page - 1) * $limit;
        $sql = "select news.id, category_id, img_src, slug, title_header, description_header, keyword_header, $this->title as title, $this->content as content, created_date, $this->summary as summary from news, tagnews where tagnews.tag_id = $tag_id and tagnews.news_id = news.id limit $start,$limit";
        return $this->db->query($sql)->result_array();

    }

    public function getTotalRowBySearchTag($keyword)
    {
        $select = "select distinct news_id ";
        $from = "from tag, tagnews, news ";
        $where = "where lower(tag.name) = lower('$keyword') and tag.id=tagnews.tag_id and tagnews.news_id = news.id";
        $sql = $select . $from . $where;
        return count($this->db->query($sql)->result_array());
    }

    public function getNewsBySearchTag($keyword, $cur_page, $limit)
    {
        $start = ($cur_page - 1) * $limit;
        $select = "select distinct news_id , category_id, img_src, slug, $this->title as title, $this->content as content, created_date, $this->summary as summary ";
        $from = "from tag, tagnews, news ";
        $where = "where lower(tag.name) = lower('$keyword') and tag.id=tagnews.tag_id and tagnews.news_id = news.id limit $start,$limit";
        $sql = $select . $from . $where;
        return $this->db->query($sql)->result_array();
    }

    public function getIntroduces($catId)
    {
        $sql = " select category.id as catId, 
                 news.id as newsId,
                 category.en_name as enCatName,
                 category.vi_name as viCatName, 
                 news.en_content as enNewsContent, 
                 news.vi_content as viNewsContent, 
                 category.created_date as catCreatedDate, 
                 category.updated_date as catUpdatedDate 
                 from news INNER JOIN category ON news.category_id=category.id 
                 where news.category_id in (select id from category where category.parent_id = $catId) 
                 order by category.id asc;";
        return $this->db->query($sql)->result_array();
    }

    public function getCurrentIntroduce($catId)
    {
        $sql = " select category.id as catId, 
                 news.id as newsId,
                 category.en_name as enCatName,
                 category.vi_name as viCatName, 
                 news.en_content as enNewsContent, 
                 news.vi_content as viNewsContent, 
                 category.created_date as catCreatedDate, 
                 category.updated_date as catUpdatedDate 
                 from news INNER JOIN category ON news.category_id=category.id 
                 where news.category_id = $catId 
                 order by category.id desc;";
        return $this->db->query($sql)->result_array();
    }

    public function insert($catId, $vi_content)
    {
        $data = array(
            'category_id' => $catId,
            'vi_content' => $vi_content
        );

        $this->db->insert('news', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insert_full($catId, $img_src, $slug, $title_header, $description_header, $keyword_header, $vi_title, $vi_content, $vi_summary)
    {
        $data = array(
            'category_id' => $catId,
            'img_src' => $img_src,
            'slug' => $slug,
            'title_header' => $title_header,
            'description_header' => $description_header,
            'keyword_header' => $keyword_header,
            'vi_title' => $vi_title,
            'vi_content' => $vi_content,
            'vi_summary' => $vi_summary
        );

        $this->db->insert('news', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($catId, $vi_content)
    {
        $data = array(
            'vi_content' => $vi_content
        );
        $this->db->where('category_id', $catId);
        $this->db->update('news', $data);
    }

    public function update_full($newsId, $catId, $img_src, $slug, $title_header, $description_header, $keyword_header, $vi_title, $vi_content, $vi_summary)
    {
        $data = array(
            'category_id' => $catId,
            'img_src' => $img_src,
            'slug' => $slug,
            'title_header' => $title_header,
            'description_header' => $description_header,
            'keyword_header' => $keyword_header,
            'vi_title' => $vi_title,
            'vi_content' => $vi_content,
            'vi_summary' => $vi_summary
        );
        $this->db->where('id', $newsId);
        $this->db->update('news', $data);
    }

    //$type_content = en_content | vi_content
    public function update_content($newsId, $type_content, $content){
        $data = array(
            $type_content => $content
        );
        $this->db->where('id',$newsId);
        $this->db->update('news',$data);
    }

    public function updateImage($newsId)
    {
        $data = array(
            'img_src' => ''
        );
        $this->db->where('id', $newsId);
        $this->db->update('news', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('news');
    }
}