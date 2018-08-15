<?php $this->load->view('layout/webapp/header'); ?>

<?php $this->load->view('components/webapp/banner_start'); ?>

<!-- main container start -->
<div class="inner-container" style="margin-top:25px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 blog_news">
                <!-- blog content start -->
                <div class="col-md-12 blog_content">
                    <?php foreach ($categories as $category) { ?>
                        <!-- single news area start -->
                        <div class="col-md-4">
                            <div class="banner-block">
                                <a href="<?php echo base_url() . $parent['slug'] .'/'. $category['slug']; ?>"> <img
                                            src="<?php echo base_url() . $category['img']; ?>"
                                            alt="<?php echo $category['vi_name']; ?>"> </a>
                                <div class="text-des-container">
                                    <div class="text-des">
                                        <h3><?php echo $category['vi_name'] ?></h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- single news area end -->
                    <?php } ?>
                </div>
                <!-- blog content end -->
            </div>
        </div>
    </div>
</div>
<!-- main container end -->

<?php $this->load->view('layout/webapp/footer'); ?>
