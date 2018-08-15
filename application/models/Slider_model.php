<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/25/16
 * Time: 5:34 PM
 */
class Slider_Model extends CI_Model
{
    public function getAll()
    {
        try{

            $sql = "select * from slider order by created_date DESC";
            return $this->db->query($sql)->result_array();

        }catch(Exception $e){

            return false;

        }
    }

    public function findById($id)
    {
        $this->db->where('id', $id);
        $sliders = $this->db->get("slider")->result_array();
        if(count($sliders > 0)) {
	        foreach ($sliders as $slider) {
		     return $slider;
		}
	}
        return -1;
    }

    public function insert($img_src, $url, $vi_content)
    {
        $data = array(
            'img_src' => $img_src,
            'vi_content' => $vi_content,
            'url' => $url
        );

        $this->db->insert('slider', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($id, $img_src, $url, $vi_content)
    {
        $data = array(
            'img_src' => $img_src,
            'vi_content' => $vi_content,
            'url' => $url
        );
        $this->db->where('id', $id);
        $this->db->update('slider', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('slider');
    }
}