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
                <?php echo form_open('setting-manager-update-submit'); ?>
                <div class="row">
                    <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="30%"> Tên</th>
                            <th width="70%"> Giá trị</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($settings as $setting) { ?>
                            <tr>
                                <td><strong><?php echo $setting['key']; ?></strong></td>
                                <td><input type="text" name="<?php echo $setting['key']; ?>" value="<?php echo $setting['value']; ?>" style="width: 600px;"/></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Lưu</button>
                </div>
                </form>
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
