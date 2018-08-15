<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/25/16
 * Time: 5:34 PM
 */
class Tag_Model extends CI_Model
{

    public function saveReferenceNews($tag, $newsId)
    {
        if (count($this->checkIdExisted($tag)) == 0) {
            $tagId = $this->insert($tag);
        }
        else {
            $tagId = $tag;
        }
        $data = array(
            'news_id' => $newsId,
            'tag_id' => $tagId,
        );
        $this->db->insert('tagnews', $data);
    }

    public function getTagByNewsId($news_id)
    {
        $sql = "select tag.id as tag_id, tag.name as tag_name from tag, tagnews where tagnews.news_id = $news_id and tagnews.tag_id = tag.id";
        return $this->db->query($sql)->result_array();
    }

    public function getNameById($tag_id)
    {
        $sql = "select name from tag where id=$tag_id";
        $list = $this->db->query($sql)->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item['name'];
            }
        }
        return -1;
    }

    public function findAll()
    {
        return $this->db->get("tag")->result_array();
    }

    public function findById($tagId)
    {
        $this->db->where('id', $tagId);
        $list = $this->db->get("tag")->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item;
            }
        }
        return -1;
    }

    public function findByNews($newsId)
    {
        $this->db->select('tag_id');
        $this->db->from('tagnews');
        $this->db->where('news_id =', $newsId);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function checkIdExisted($tagId)
    {
        $this->db->where('id', $tagId);
        return $this->db->get("tag")->result_array();
    }

    public function insert($tagName)
    {
        $data = array(
            'name' => $tagName
        );

        $this->db->insert('tag', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($tagId, $tagName)
    {
        $data = array(
            'name' => $tagName
        );
        $this->db->where('id', $tagId);
        $this->db->update('tag', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tag');
    }

    public function deleteByNews($id)
    {
        $sql = "delete tagnews from tagnews where tagnews.`news_id` = $id ";
        $this->db->query($sql);
    }

}