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

                    <?php echo form_open_multipart('create-feature-submit'); ?>
                    <div class="form-group">
                        <div class="form-group">
                            <div id="demo-lft-tab-4" class="tab-pane fade active in">
                                <div class="form-group">
                                    <label for="upload_file">File upload</label>
                                    <input type='file' name='userfile' size='20'/>
                                    <br/>
                                    <i>Lưu ý: Hình ảnh size chuẩn: 200px * 200px</i>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="demo-vs-definput" class="control-label">Tiêu đề điểm nổi bật</label>
                                <textarea name="viDes" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-xs" name="save"><i class="fa fa-save"></i> Lưu</button>
                    <button type="submit" class="btn btn-default btn-xs" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');"><i class="fa fa-close"></i> Huỷ</button>
                    </form>


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
