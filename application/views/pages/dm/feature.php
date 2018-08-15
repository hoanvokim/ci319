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
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Quản lý điểm nổi bật</h3>

                            <a href="<?php echo base_url() . "feature-manager/create-feature" ?>" class="btn btn-success pull-right btn-top-right btn-xs"
                                <?php
                                if (count($features) >= $maxFeature['value']) {
                                    echo 'disabled="true"';
                                }
                                ?>
                            ><i class="fa fa-plus-square"></i> Thêm 1 điểm nổi bật mới</a>
                        </div>
                        <div class="panel-body">
                            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th width="5%">Icon</th>
                                    <th width="85%">Tiêu đề</th>
                                    <th width="10%">Tác vụ</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($features as $feature) { ?>
                                    <tr>
                                        <td><img src="<?php echo $feature['img']; ?>" style="width: 100px;"/></td>
                                        <td><?php echo $feature['vi_des']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . "feature-manager/update-feature/" . $feature['id']; ?>"
                                               class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                                            <a href="<?php echo base_url() . "feature-manager/delete-feature/" . $feature['id']; ?>"
                                               class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');"><i class="fa fa-close"></i> Xoá</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <a href="<?php echo base_url() . "feature-manager/create-feature" ?>" class="btn btn-success pull-right btn-xs"
                                <?php
                                if (count($features) >= $maxFeature['value']) {
                                    echo 'disabled="true"';
                                }
                                ?>
                            ><i class="fa fa-plus-square"></i> Thêm 1 điểm nổi bật mới
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <strong class="pull-left"> Lưu ý: Chỉ được tối đa <?php echo $maxFeature['value'] ?> điểm nổi bật.</strong>
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
