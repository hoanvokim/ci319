<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title ?></title>
    <?php $this->load->view('layout/dm/header'); ?>
</head>

<body>
<div id="container" class="effect mainnav-lg navbar-fixed mainnav-fixed">
    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <section id="content-container">
            <?php $this->load->view('layout/dm/breadcrumb'); ?>

            <!--Page content-->
            <!--===================================================-->
            <div id="page-content">
                <div claass="row">
                    <div class="invoice-inner">
                        <div class="row">
                            <div class="col-xs-6">
                                <h3>Du học Hàn Quốc & Đào tạo hàn ngữ</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="panel">
                            <div class="panel-body">
                                <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th width="15%">Tiêu đề</th>
                                        <th width="15%">Ảnh</th>
                                        <th width="15%">Tác vụ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><h3>Banner mặc định</h3></td>
                                        <td><img src="<?php echo base_url() . $defaultbanner['value']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('defaultbanner'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <!-- Category -->
                                    <tr>
                                        <td><h3>Du học Hàn quốc</h3></td>
                                        <td><img src="<?php echo base_url() . $duhochanquoc['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('duhochanquoc'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <!-- Category -->
                                    <tr>
                                        <td><h5>Du học tiếng</h5></td>
                                        <td><img src="<?php echo base_url() . $duhoctieng['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('duhoctieng'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Du học ngành</h5></td>
                                        <td><img src="<?php echo base_url() . $duhocnganh['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('duhocnganh'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Du học nghề</h5></td>
                                        <td><img src="<?php echo base_url() . $duhocnghe['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('duhocnghe'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h3>Đào tạo hàn ngữ</h3></td>
                                        <td><img src="<?php echo base_url() . $daotaohanngu['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('daotaohanngu'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Tiếng hàn sơ cấp</h5></td>
                                        <td><img src="<?php echo base_url() . $tienghansocap['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('tienghansocap'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <!-- Category -->
                                    <tr>
                                        <td><h5>Tiếng hàn trung cấp</h5></td>
                                        <td><img src="<?php echo base_url() . $tienghantrungcap['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('tienghantrungcap'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Luyện thi TOPIK</h5></td>
                                        <td><img src="<?php echo base_url() . $luyenthitopik['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('luyenthitopik'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Luyện thi KLAT</h5></td>
                                        <td><img src="<?php echo base_url() . $luyenthiklat['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('luyenthiklat'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Luyện thi EPS</h5></td>
                                        <td><img src="<?php echo base_url() . $luyenthieps['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('luyenthieps'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Đào tạo doanh nghiệp</h5></td>
                                        <td><img src="<?php echo base_url() . $daotaodoanhnghiep['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('daotaodoanhnghiep'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><h5>Lịch khai giảng</h5></td>
                                        <td><img src="<?php echo base_url() . $lichkhaigiang['img']; ?>" width="150px"/></td>
                                        <td>
                                            <a href="<?php echo base_url() . "gallery-manager/update-gallery/" . $this->config->item('lichkhaigiang'); ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--===================================================-->
                <!--End page content-->

        </section>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->

        <?php $this->load->view('layout/dm/navigation'); ?>

    </div>

    <?php $this->load->view('layout/dm/footer_bar'); ?>

</div>
<!--===================================================-->
<!-- END OF CONTAINER -->

<?php $this->load->view('layout/dm/footer'); ?>
</body>
</html>
