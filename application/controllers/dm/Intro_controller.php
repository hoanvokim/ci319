<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class Intro_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }

        $this->load->model('News_model');
        $this->load->model('Category_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Giới thiệu';
        $data['intros'] = $this->News_model->getIntroduces($this->config->item('introduce'));
        $this->load->view('pages/dm/intro/intro', $data);
    }


    public function create()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Tạo tab mới';
        $this->load->view('pages/dm/intro/intro_create', $data);
    }

    public function create_add()
    {
        print_r($this->input->post('contenteditor'));
        $category_inserted = $this->Category_model->insert($this->input->post('viTabName'));
        $this->News_model->insert($category_inserted, $this->input->post('contenteditor'));
        redirect('manage-intro', 'refresh');
    }

    public function create_cancel()
    {
        redirect('manage-intro', 'refresh');
    }

    public function update()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Cập nhật giới thiệu';
        $data['intros'] = $this->News_model->getCurrentIntroduce($this->uri->segment(3));
        $this->load->view('pages/dm/intro/intro_update', $data);

    }

    public function update_add()
    {
        $this->Category_model->update($this->input->post('catId'),'', $this->input->post('viTabName'));
        $this->News_model->update($this->input->post('catId'), $this->input->post('contenteditor'));
        redirect('manage-intro', 'refresh');

    }

    public function update_cancel()
    {
        redirect('manage-intro', 'refresh');
    }

    public function delete()
    {
        $this->Category_model->delete($this->uri->segment(3));
        redirect('manage-intro', 'refresh');
    }

}
