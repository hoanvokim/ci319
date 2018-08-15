<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 9/4/17
 * Time: 10:34 PM
 */
class Setting_Model extends CI_Model
{
    public function getSettingData()
    {
        try{

            $sql = "select * from setting where setting.key != 'defaultbanner'";
            return $this->db->query($sql)->result_array();

        }catch(Exception $e){
            return false;
        }
    }

    public function getSlogan()
    {
        try {
            $sql = "select * from setting where setting.key='slogan'";
            $list = $this->db->query($sql)->result_array();
            if (count($list > 0)) {
                foreach ($list as $item) {
                    return $item;
                }
            }
            return -1;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function getValueFromKey($key)
    {
        try {
            $sql = "select * from setting where setting.key='$key'";
            $list = $this->db->query($sql)->result_array();
            if (count($list > 0)) {
                foreach ($list as $item) {
                    return $item;
                }
            }
            return -1;
        }
        catch (Exception $e) {
            return false;
        }
    }
    public function update($key, $value)
    {
        $data = array(
            'value' => $value
        );
        $this->db->where('key', $key);
        $this->db->update('setting', $data);
    }
}