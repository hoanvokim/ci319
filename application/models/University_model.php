<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/25/16
 * Time: 5:34 PM
 */
class University_Model extends CI_Model
{

    public function __construct()
    {
    }

    public function getAll()
    {
        $sql = "select * from university";
        return $this->db->query($sql)->result_array();
    }

    public function getById($id)
    {
        $this->db->where('id', $id);
        $features = $this->db->get("university")->result_array();
        if(count($features > 0)) {
            foreach ($features as $feature) {
                return $feature;
            }
        }
        return -1;
    }

    public function insert($img, $url)
    {
        $data = array(
            'img_src' => $img,
            'url' => $url
        );

        $this->db->insert('university', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($uniId, $img, $url)
    {
        $data = array(
            'img_src' => $img,
            'url' => $url
        );
        $this->db->where('id', $uniId);
        $this->db->update('university', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('university');
    }

}