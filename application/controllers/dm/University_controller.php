<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 4/29/16
 * Time: 9:44 PM
 */
class University_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('University_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['universities'] = $this->University_model->getAll();
        $data['title'] = 'Xem tất cả trường đại học';
        $this->load->view('pages/dm/university/view_all', $data);
    }

    public function create_university()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Thêm trường đại học';
        $this->load->view('pages/dm/university/add', $data);
    }

    public function create_university_submit()
    {
        $this->load->library('upload', $this->get_config());
        if ($this->upload->do_upload('userfile')) {
            $upload_files = $this->upload->data();
            $file_path = 'assets/upload/images/university/' . $upload_files['file_name'];

            $this->University_model->insert(
                $file_path,
                $this->input->post('url')
            );
        }
        redirect('university-manager', 'refresh');
    }

    public function create_university_cancel()
    {
        redirect('university-manager', 'refresh');
    }

    public function update_university()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $university = $this->University_model->getById($this->uri->segment(3));
        $data['img'] = $university['img_src'];
        if (strlen($data['img']) > 0) {
            $data['hasImg'] = 1;
        } else {
            $data['hasImg'] = 0;
        }
        $data['id'] = $university['id'];
        $data['img'] = $university['img_src'];
        $data['url'] = $university['url'];
        $data['title'] = 'Cập nhật trường đại học';
        $this->load->view('pages/dm/university/edit', $data);
    }

    public function update_university_submit()
    {
        if (isset($_POST["save"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/university/' . $upload_files['file_name'];

                $this->University_model->update(
                    $this->input->post('uniId'),
                    $file_path,
                    $this->input->post('url')
                );
            } else {
                $this->University_model->update(
                    $this->input->post('uniId'),
                    $this->input->post('img'),
                    $this->input->post('url')
                );
            }
            redirect('university-manager', 'refresh');

        }
        if (isset($_POST["delete"])) {
            $news = $this->University_model->getById($this->input->post('id'));
            if (strlen($news['img_src']) > 0) {
                unlink('./' . $news['img_src']);
            }
            $this->University_model->delete($this->input->post('id'));
            redirect('university-manager', 'refresh');
        }
        if (isset($_POST["cancel"])) {
            redirect('university-manager', 'refresh');
        }

        if (isset($_POST["delete-img"])) {
            $news = $this->University_model->getById($this->input->post('id'));
            if(!is_null($news['img_src'])) {
                unlink('./' . $news['img_src']);
            }
            $this->University_model->update(
                $this->input->post('uniId'),
                '',
                $this->input->post('url')
            );

            $data['hasImg'] = 0;
            $data['id'] = $this->input->post('id');
            $data['img_src'] = $this->input->post('img');
            $data['url'] = $this->input->post('url');
            $data['title'] = 'Cập nhật trường đại học';
            $this->load->view('pages/dm/university/edit', $data);
        }
    }

    public function delete_university()
    {
        $news = $this->University_model->getById($this->uri->segment(3));
        if (strlen($news['img_src']) > 0) {
            unlink('./' . $news['img_src']);
        }
        $this->University_model->delete($this->input->post('id'));
        redirect('university-manager', 'refresh');
    }


    private function get_config()
    {
        return array(
            'upload_path' => "./assets/upload/images/university",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
    }


}
