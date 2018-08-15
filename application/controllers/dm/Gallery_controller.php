<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 5/13/16
 * Time: 6:25 AM
 */
class Gallery_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('Gallery_model');
        $this->load->model('Category_model');
        $this->load->model('Setting_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['galleries'] = $this->Gallery_model->getGalleryByType('folder', 0, 1000);
        $galleries = array();
        foreach ($data['galleries'] as $item) {
            array_push($galleries, array(
                'id' => $item['id'],
                'vi_title' => $item['vi_title'],
                'img_src' => $item['img_src']
            ));
        }
        $data['galleries'] = $galleries;
        $data['title'] = 'Thư mục ảnh';
        $this->load->view('pages/dm/manage_gallery/view_all', $data);
    }

    public function create_gallery()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Thêm 1 ảnh mới';
        $this->load->view('pages/dm/manage_gallery/add', $data);
    }

    public function create_gallery_submit()
    {
        if (isset($_POST["save"])) {
            $this->load->helper(array('form', 'url'));
            $this->load->library('upload');
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);
            if (strlen($_FILES['userfile']['name'][0]) > 0) {
                for ($i = 0; $i < $cpt; $i++) {
                    $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                    $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                    $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
                    $this->upload->initialize($this->set_upload_options());
                    $this->upload->do_upload();
                    $fileName = $_FILES['userfile']['name'];
                    $src = 'assets/upload/images/gallery/' . $fileName;
                    $this->Gallery_model->insert($src, 'folder', $fileName);
                }
            }
        }
        if (isset($_POST["cancel"])) {
        }
        redirect('gallery-manager', 'refresh');
    }

    public function delete_gallery()
    {
        $gallery = $this->Gallery_model->getGalleryById($this->uri->segment(3));
        if (strlen($gallery['img_src']) > 0) {
            unlink('./' . $gallery['img_src']);
        }
        $this->Gallery_model->delete($this->uri->segment(3));
        redirect('gallery-manager', 'refresh');
    }

    public function update_gallery($param = null)
    {
        $data['title'] = 'Cập nhật hình ảnh';
        $data['hasImg'] = 0;
        if ($param == $this->config->item('defaultbanner')) {
            $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');
            if (strlen($data['defaultbanner']['value']) > 0) {
                $data['hasImg'] = 1;
            }
        }
        else {
            $categories = $this->Category_model->findById($param);
            foreach ($categories as $cat) {
                $cat['value'] = $cat['img'];
                $cat['key'] = $cat['id'];
                $data['defaultbanner'] = $cat;
                if (strlen($data['defaultbanner']['img']) > 0) {
                    $data['hasImg'] = 1;
                }
            }
        }
        $this->load->view('pages/dm/manage_gallery/edit', $data);
    }

    public function update_gallery_submit()
    {
        $data['title'] = 'Cập nhật hình ảnh';
        $data['hasImg'] = 0;
        if ($this->input->post('param') == $this->config->item('defaultbanner')) {
            if (isset($_POST["save-defaultbanner"])) {
                $this->load->library('upload', $this->set_upload_options());
                if ($this->upload->do_upload('userfileDefaultbanner')) {
                    $upload_files = $this->upload->data();
                    $file_path = 'assets/upload/images/gallery/' . $upload_files['file_name'];

                    $this->Setting_model->update(
                        'defaultbanner',
                        $file_path
                    );
                }
                else {
                    $this->Setting_model->update(
                        'defaultbanner',
                        $this->input->post('defaultbannerimg')
                    );
                }
            }
            if (isset($_POST["delete-img-defaultbanner"])) {
                $defaultbanner = $this->Setting_model->getValueFromKey('defaultbanner');
                if (!is_null($defaultbanner['value'])) {
                    unlink('./' . $defaultbanner['value']);
                }
                $this->Setting_model->update(
                    'defaultbanner',
                    ''
                );
                $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');
                if (strlen($data['defaultbanner']['value']) > 0) {
                    $data['defaultbannerHasImg'] = 1;
                }
                else {
                    $data['defaultbannerHasImg'] = 0;
                }
                $this->load->view('pages/dm/mainfeature', $data);
            }
        }
        else {
            if (isset($_POST["save-defaultbanner"])) {
                $this->load->library('upload', $this->set_upload_options());
                if ($this->upload->do_upload('userfileDefaultbanner')) {
                    $upload_files = $this->upload->data();
                    $file_path = 'assets/upload/images/gallery/' . $upload_files['file_name'];
                    $this->Category_model->updateImage(
                        $this->input->post('param'),
                        $file_path
                    );
                }
                else {
                    $this->Category_model->updateImage(
                        $this->input->post('param'),
                        $this->input->post('defaultbannerimg')
                    );
                }
            }
            if (isset($_POST["delete-img-defaultbanner"])) {
                $duhochanquoc = $this->Category_model->findById($this->input->post('param'));
                foreach ($duhochanquoc as $duhoc) {
                    if (!is_null($duhoc['img'])) {
                        unlink('./' . $duhoc['img']);
                    }
                    $this->Category_model->updateImage(
                        $this->input->post('param'),
                        ''
                    );
                }
            }
        }
        redirect('main-feature-manager', 'refresh');
    }

    private function set_upload_options()
    {
        //upload an image options
        $config = array();
        $config['upload_path'] = "./assets/upload/images/gallery";
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size'] = '20480000';
        $config['overwrite'] = TRUE;

        return $config;
    }
}
