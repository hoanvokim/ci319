<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 9/4/17
 * Time: 10:34 PM
 */
class Feature_model extends CI_Model
{
    public function getAll()
    {
        try {
            $sql = "select * from feature";
            return $this->db->query($sql)->result_array();

        }
        catch (Exception $e) {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('feature');
    }

    public function insert($img, $vi_des)
    {
        $data = array(
            'img' => $img,
            'vi_des' => $vi_des
        );

        $this->db->insert('feature', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($id, $img, $vi_des)
    {
        $data = array(
            'img' => $img,
            'vi_des' => $vi_des
        );
        $this->db->where('id', $id);
        $this->db->update('feature', $data);
    }


    public function findById($id)
    {
        $this->db->where('id', $id);
        $features = $this->db->get("feature")->result_array();
        if(count($features > 0)) {
            foreach ($features as $feature) {
                return $feature;
            }
        }
        return -1;
    }

}