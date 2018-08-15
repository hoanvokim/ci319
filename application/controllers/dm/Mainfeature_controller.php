<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by IntelliJ IDEA.
 * User: hoanvo
 * Date: 9/4/17
 * Time: 10:27 PM
 */
class Mainfeature_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($_SESSION["activeLanguage"])) {
            $_SESSION["activeLanguage"] = "vi";
        }
        $this->load->model('Category_model');
        $this->load->model('Setting_model');
    }

    public function index()
    {
        if (!$this->is_login()) {
            $this->load_login_view();
            return;
        }
        $data['title'] = 'Cập nhật Banner';
        $data = $this->loadDuHocHanQuoc($data);
        $data = $this->loadDaoTaoHanNgu($data);
        $duhoctieng = $this->Category_model->findById($this->config->item('duhoctieng'));
        foreach ($duhoctieng as $duhoc) {
            $data['duhoctieng'] = $duhoc;
        }
        $duhocnganh = $this->Category_model->findById($this->config->item('duhocnganh'));
        foreach ($duhocnganh as $duhoc) {
            $data['duhocnganh'] = $duhoc;
        }
        $duhocnghe = $this->Category_model->findById($this->config->item('duhocnghe'));
        foreach ($duhocnghe as $duhoc) {
            $data['duhocnghe'] = $duhoc;
        }

        $duhoctieng = $this->Category_model->findById($this->config->item('tienghansocap'));
        foreach ($duhoctieng as $duhoc) {
            $data['tienghansocap'] = $duhoc;
        }
        $duhocnganh = $this->Category_model->findById($this->config->item('tienghantrungcap'));
        foreach ($duhocnganh as $duhoc) {
            $data['tienghantrungcap'] = $duhoc;
        }
        $duhocnghe = $this->Category_model->findById($this->config->item('luyenthitopik'));
        foreach ($duhocnghe as $duhoc) {
            $data['luyenthitopik'] = $duhoc;
        }
        $duhocnghe = $this->Category_model->findById($this->config->item('luyenthiklat'));
        foreach ($duhocnghe as $duhoc) {
            $data['luyenthiklat'] = $duhoc;
        }
        $duhocnghe = $this->Category_model->findById($this->config->item('luyenthieps'));
        foreach ($duhocnghe as $duhoc) {
            $data['luyenthieps'] = $duhoc;
        }
        $duhocnghe = $this->Category_model->findById($this->config->item('daotaodoanhnghiep'));
        foreach ($duhocnghe as $duhoc) {
            $data['daotaodoanhnghiep'] = $duhoc;
        }
        $duhocnghe = $this->Category_model->findById($this->config->item('lichkhaigiang'));
        foreach ($duhocnghe as $duhoc) {
            $data['lichkhaigiang'] = $duhoc;
        }
        $data = $this->loadDefaultBanner($data);
        $this->load->view('pages/dm/mainfeature', $data);
    }

    public function updateSubmit()
    {
        $data['title'] = 'Cập nhật Banner';
        if (isset($_POST["save-duhoc"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfileDuhoc')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/feature/' . $upload_files['file_name'];

                $this->Category_model->updateImage(
                    $this->config->item('duhochanquoc'),
                    $file_path
                );
            }
            else {
                $this->Category_model->updateImage(
                    $this->config->item('duhochanquoc'),
                    $this->input->post('duhochanquocimg')
                );
            }
            redirect('main-feature-manager', 'refresh');
        }
        if (isset($_POST["delete-img-duhoc"])) {
            $duhochanquoc = $this->Category_model->findById($this->config->item('duhochanquoc'));
            foreach ($duhochanquoc as $duhoc) {
                if (!is_null($duhoc['img'])) {
                    unlink('./' . $duhoc['img']);
                }
                $this->Category_model->updateImage(
                    $this->config->item('duhochanquoc'),
                    ''
                );
                $data['duhochanquocHasImg'] = 0;
                $data['duhochanquoc'] = $duhoc;
            }
            $data = $this->loadDaoTaoHanNgu($data);
            $data = $this->loadDefaultBanner($data);
            $this->load->view('pages/dm/mainfeature', $data);
        }
        if (isset($_POST["save-daotao"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfileDaotao')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/feature/' . $upload_files['file_name'];

                $this->Category_model->updateImage(
                    $this->config->item('daotaohanngu'),
                    $file_path
                );
            }
            else {
                $this->Category_model->updateImage(
                    $this->config->item('daotaohanngu'),
                    $this->input->post('daotaohannguimg')
                );
            }
            redirect('main-feature-manager', 'refresh');

        }
        if (isset($_POST["delete-img-daotao"])) {
            $daotaohanngu = $this->Category_model->findById($this->config->item('daotaohanngu'));
            foreach ($daotaohanngu as $daotao) {
                if (!is_null($daotao['img'])) {
                    unlink('./' . $daotao['img']);
                }
                $this->Category_model->updateImage(
                    $this->config->item('daotaohanngu'),
                    ''
                );
                $data['daotaohannguHasImg'] = 0;
                $data['daotaohanngu'] = $daotao;
            }
            $data = $this->loadDuHocHanQuoc($data);
            $data = $this->loadDefaultBanner($data);
            $this->load->view('pages/dm/mainfeature', $data);
        }
        //
        if (isset($_POST["save-defaultbanner"])) {
            $this->load->library('upload', $this->get_config());
            if ($this->upload->do_upload('userfileDefaultbanner')) {
                $upload_files = $this->upload->data();
                $file_path = 'assets/upload/images/feature/' . $upload_files['file_name'];

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
            redirect('main-feature-manager', 'refresh');

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
            $data = $this->loadDefaultBanner($data);
            $data = $this->loadDuHocHanQuoc($data);
            $data = $this->loadDaoTaoHanNgu($data);
            $this->load->view('pages/dm/mainfeature', $data);
        }
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

    /**
     * @param $data
     * @return mixed
     */
    public function loadDuHocHanQuoc($data)
    {
        $duhochanquoc = $this->Category_model->findById($this->config->item('duhochanquoc'));
        foreach ($duhochanquoc as $duhoc) {
            $data['duhochanquoc'] = $duhoc;
        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function loadDaoTaoHanNgu($data)
    {
        $daotaohanngu = $this->Category_model->findById($this->config->item('daotaohanngu'));
        foreach ($daotaohanngu as $daotao) {
            $data['daotaohanngu'] = $daotao;
        }
        return $data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function loadDefaultBanner($data)
    {
        $data['defaultbanner'] = $this->Setting_model->getValueFromKey('defaultbanner');
        return $data;
    }

}