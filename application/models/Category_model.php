<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/25/16
 * Time: 5:34 PM
 */
class Category_Model extends CI_Model
{
    public $name_field = "vi_name";

//    Fundamental functions

    public function __construct()
    {
        $this->name_field = $_SESSION["activeLanguage"] == "vi" ? "vi_name" : "en_name";
    }

    public function findAll()
    {
        return $this->db->get("category")->result_array();
    }

    public function findByParent($parent)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('parent_id =', $parent);
        return $this->db->get()->result_array();
    }

    public function findCategoryNameFromId($catId)
    {
        $sql = "select vi_name from category where id='$catId'";
        $list = $this->db->query($sql)->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item['vi_name'];
            }
        }
        return 'no item found';
    }

    public function findById($catId)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id =', $catId);
        return $this->db->get()->result_array();
    }

    public function findByIds($arr)
    {
        $sql = "select * from category where id in (";
        $cnt = count($arr);
        for ($i = 0; $i < $cnt - 1; $i++) {
            $sql = $sql . $arr[$i] . ",";
        }
        $sql = $sql . $arr[$cnt - 1] . ")";
        return $this->db->query($sql)->result_array();
    }

    public function insert($vi_name)
    {
        $children = $this->findByParent($this->config->item('introduce'));
        $sortIndex = sizeof($children);
        $data = array(
            'vi_name' => $vi_name,
            'parent_id' => $this->config->item('introduce'),
            'sort_index' => $sortIndex
        );

        $this->db->insert('category', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insertSubCategory($vi_name, $slug)
    {
        $data = array(
            'vi_name' => $vi_name,
            'slug' => $slug,
            'sort_index' => 0,
            'is_menu' => 0
        );

        $this->db->insert('category', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function insertWithParent($vi_name, $slug, $parentId)
    {
        $children = $this->findByParent($parentId);
        $sortIndex = sizeof($children);
        $data = array(
            'vi_name' => $vi_name,
            'slug' => $slug,
            'parent_id' => $parentId,
            'sort_index' => $sortIndex,
            'is_menu' => 1
        );

        $this->db->insert('category', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function update($catId, $slug, $vi_name)
    {
        $data = array(
            'vi_name' => $vi_name,
            'slug' => $slug
        );
        $this->db->where('id', $catId);
        $this->db->update('category', $data);
    }

    public function updateImage($catId, $img)
    {
        $data = array(
            'img' => $img
        );
        $this->db->where('id', $catId);
        $this->db->update('category', $data);
    }

    public function updateWithParent($catId,$slug, $vi_name)
    {
        $data = array(
            'vi_name' => $vi_name,
            'slug' => $slug
        );
        $this->db->where('id', $catId);
        $this->db->update('category', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('category');
    }

//    Utilities

    public function findStudyAbroadRoot()
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id = 10');
        return $this->db->get()->result_array();
    }

    public function findAllSubCategory()
    {
        $sql = "select * from category where parent_id is null and is_menu = 0";
        return $this->db->query($sql)->result_array();
    }

    public function getMainMenu($parent_id = null, &$strMenu)
    {
        $temp_name = $this->name_field;
        $sql = "select id,parent_id,slug,$temp_name from category where is_menu=1 and ";
        if ($parent_id == null) {
            $sql = $sql . "parent_id is null ";
        } else {
            $sql = $sql . "parent_id = $parent_id ";
        }
        $sql = $sql . "order by parent_id, sort_index";
        $arr_result = $this->db->query($sql)->result_array();
        if (count($arr_result) > 0) {

            foreach ($arr_result as $item) {
                //NOTED
                $url = null;
                switch ($item['slug']) {
                    case "du-hoc-tieng":
                    case "du-hoc-nganh":
                    case "du-hoc-nghe":
                        $url = base_url() . "du-hoc-han-quoc/" . $item['slug'];
                        break;
                    case "chuong-trinh-dao-tao":
                        $url = base_url() . "dao-tao-han-ngu";
                        break;
                    case "lich-khai-giang":
                        $url = base_url() . "chuong-trinh-dao-tao/lich-khai-giang";
                        break;
                    default:
                        $url = base_url() . "cat/" . $item['slug'];
                }
                $strMenu = $strMenu . "<li><a href=";//"''>" . $item[$temp_name];
                if ($this->hasSubMenu($item['id'])) {
                    $strMenu = $strMenu . "'#'>";
                } else {
                    $strMenu = $strMenu . "'$url'>";
                }
                $strMenu = $strMenu . $item[$temp_name];
                if ($this->hasSubMenu($item['id'])) {
                    $strMenu = $strMenu . '<span class="ion ion-ios-arrow-down"></span>';
                }
                $strMenu = $strMenu . "</a>";
                if ($item['id'] == null) {
                    ;
                } elseif ($this->isDropMenu($item['id'])) {
                    $strMenu = $strMenu . '<ul class="dropmenu">';
                } else {
                    $strMenu = $strMenu . '<ul class="submenu">';
                }
                $this->getMainMenu($item['id'], $strMenu);

                if (!($item['id'] == null)) {
                    $strMenu = $strMenu . "</li></ul>";
                } else {
                    $strMenu = $strMenu . "</li>";
                }
            }
        }
    }

    public function getAllSubMenu($parent_id, &$aMenu)
    {
        $sql = "select id from category where is_menu=1 and parent_id = $parent_id";
        $arr_result = $this->db->query($sql)->result_array();
        if (count($arr_result) > 0) {
            foreach ($arr_result as $item) {
                $aMenu[] = $item['id'];
                $this->getAllSubMenu($item['id'], $aMenu);
            }
        }
    }

    public function getDirectSubMenu($parent_id, &$aMenu)
    {
        $sql = "select id from category where is_menu=1 and parent_id = $parent_id";
        $arr_result = $this->db->query($sql)->result_array();
        if (count($arr_result) > 0) {
            foreach ($arr_result as $item) {
                $aMenu[] = $item['id'];
            }
        }
    }


    public function getParentId($id)
    {
        $sql = "select parent_id from category where is_menu = 1 and id = $id";
        $result = $this->db->query($sql)->result_array();
        if (count($result) > 0) {
            foreach ($result as $item) {
                return $item['parent_id'];
            }
        }
        return false;
    }

    private function isDropMenu($id)
    {
        $parent_id = $this->getParentId($id);
        if ($parent_id == null) {
            return true;
        }
        return false;
    }

    private function hasSubMenu($id)
    {
        $sql = "select * from category where is_menu = 1 and parent_id = $id";
        $result = $this->db->query($sql)->result_array();
        if (count($result) > 0) {
            return true;
        }
        return false;
    }

    public function hasChild($id)
    {
        $sql = "select * from category where parent_id = $id";
        $result = $this->db->query($sql)->result_array();
        if (count($result) > 0) {
            return true;
        }
        return false;
    }

    public function getName($id)
    {
        $temp = $this->name_field;
        $sql = "select $temp from category where id=$id";
        $result = $this->db->query($sql)->result_array();
        if($result && count($result) > 0){
            foreach($result as $item){
                return $item[$temp];
            }
        }
        return '';
    }

    public function getIdFromSlug($slug)
    {
        $slug = urldecode($slug);
        $sql = "select id from category where is_menu=1 and slug='$slug' limit 0,1";
        $list = $this->db->query($sql)->result_array();
        if (count($list > 0)) {
            foreach ($list as $item) {
                return $item['id'];
            }
        }
        return -1;
    }

    public function getInfoFromId($category_id)
    {
        $sql = "select * from category where id = $category_id";
        $list = $this->db->query($sql)->result_array();
        if (count($list) > 0) {
            foreach ($list as $item) {
                return $item;
            }
        }
        return -1;
    }

}