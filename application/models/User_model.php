<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/25/16
 * Time: 5:34 PM
 */

class User_Model extends CI_Model
{
    private static $TABLE_NAME = 'user';

    public function authenticate($email, $password)
    {
        $this->db->from(self::$TABLE_NAME);
        $this->db->where('email', $email);
        $this->db->where('password', MD5($password));
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        }
        return false;
    }

    public function findById($id)
    {
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function findAll()
    {
        $this->db->from(self::$TABLE_NAME);
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        }
        return false;
    }

    public function insert($value)
    {
        $this->db->insert(self::$TABLE_NAME, $value);
    }

    public function update($value, $id)
    {
        $this->db->where('id', $id);
        $this->db->update(self::$TABLE_NAME, $value);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete(self::$TABLE_NAME);
    }
}
