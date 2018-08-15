<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 9/4/17
 * Time: 10:27 PM
 */
class Feature_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }

        $this->load->model('Feature_model');
        $this->load->model('Setting_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Cập nhật các điểm nổi bật trong website';
        $data['features'] = $this->Feature_model->getAll();
        $data['maxFeature'] = $this->Setting_model->getValueFromKey('maxFeature');
        $this->load->view('pages/dm/feature', $data);
    }

    public function create()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Tạo điểm nổi bật';
        $this->load->view('pages/dm/featureCreate', $data);
    }

    public function createSubmit()
    {
        if (isset($_POST["save"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/feature/' . $upload_files['file_name'];

                $this->Feature_model->insert(
                    $file_path,
                    $this->input->post('viDes')
                );
            }
        }
        if (isset($_POST["cancel"])) {
        }
        redirect('feature-manager', 'refresh');
    }

    public function update()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $current = $this->Feature_model->findById($this->uri->segment(3));
        $data['id'] = $current['id'];
        $data['img'] = $current['img'];
        if (strlen($data['img']) > 0) {
            $data['hasImg'] = 1;
        } else {
            $data['hasImg'] = 0;
        }
        $data['vi_des'] = $current['vi_des'];

        $data['title'] = 'Cập nhật điểm nổi bât';
        $this->load->view('pages/dm/featureUpdate', $data);
    }

    public function updateSubmit()
    {
        if (isset($_POST["save"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfile')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/feature/' . $upload_files['file_name'];

                $this->Feature_model->update(
                    $this->input->post('id'),
                    $file_path,
                    $this->input->post('vi_des')
                );
            } else {
                $this->Feature_model->update(
                    $this->input->post('id'),
                    $this->input->post('img'),
                    $this->input->post('vi_des')
                );
            }
            redirect('feature-manager', 'refresh');

        }
        if (isset($_POST["delete"])) {
            $news = $this->Feature_model->findById($this->input->post('id'));
            if (strlen($news['img']) > 0) {
                unlink('./' . $news['img']);
            }
            $this->Feature_model->delete($this->input->post('id'));
            redirect('feature-manager', 'refresh');
        }
        if (isset($_POST["cancel"])) {
            redirect('feature-manager', 'refresh');
        }

        if (isset($_POST["delete-img"])) {
            $news = $this->Feature_model->findById($this->input->post('id'));
            if(!is_null($news['img'])) {
                unlink('./' . $news['img']);
            }
            $this->Feature_model->update(
                $this->input->post('id'),
                '',
                $this->input->post('vi_des')
            );

            $data['hasImg'] = 0;
            $data['id'] = $this->input->post('id');
            $data['img'] = $this->input->post('img');
            $data['vi_des'] = $this->input->post('vi_des');
            $data['title'] = 'Cập nhật điểm nổi bât';
            $this->load->view('pages/dm/featureUpdate', $data);
        }
    }

    public function delete()
    {
        $feature = $this->Feature_model->findById($this->uri->segment(3));
        if (strlen($feature['img']) > 0) {
            unlink('./' . $feature['img']);
        }
        $this->Feature_model->delete($this->uri->segment(3));
        redirect('feature-manager', 'refresh');
    }

    private function get_config()
    {
        return array(
            'upload_path' => "./assets/upload/images/feature",
            'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'max_size' => "20480000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        );
    }

}