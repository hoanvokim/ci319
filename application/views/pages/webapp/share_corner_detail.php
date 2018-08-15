<?php $this->load->view('layout/webapp/header');  ?>

<?php $this->load->view('components/webapp/banner_start'); ?>


<!-- main container start -->
<div class="inner-container" style="margin-top: 30px;">
    <div class="container">
        <div class="row">
            <?php if($detail != -1){ ?>
                <!-- inner container start -->
                <div class="inner-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <h3><?php echo $detail['title']; ?></h3>
                                <!-- -->
                                <div class="sharing_slider">
                                    <?php if ($is_video == false) { ?>
                                        <div class="project-screens screen-slider">
                                            <?php foreach ($img_galleries as $item) { ?>
                                                <img src="<?php echo base_url() . $item['img_src']; ?>" alt=""/>
                                            <?php } ?>
                                        </div>


                                    <?php } else { ?>

                                        <iframe width="100%" height="450"
                                                src="<?php echo $link_embed; ?>">
                                        </iframe>

                                    <?php } ?>

                                    <div class="project-nav">
                                        <?php if ($cur_post > 0) { ?>
                                            <a href="<?php echo base_url() . 'news/' . $lst_post[$cur_post - 1]['slug']; ?>" class="prev-project btn btn-primary">
                                                <i class="ion ion-ios-undo"></i> <?php echo $this->lang->line('PREVIOUS_POST'); ?></a>
                                        <?php } ?>

                                        <?php if ($cur_post < $max_post) { ?>
                                            <a href="<?php echo base_url() . 'news/' . $lst_post[$cur_post + 1]['slug']; ?>" class="next-project btn btn-primary"><?php echo $this->lang->line('NEXT_POST'); ?>
                                                <i class="ion ion-ios-redo"></i></a>
                                        <?php } ?>

                                    </div>

                                </div>
                                <!-- -->
                                <div class="project-sidebar-widget">
                                    <p><?php echo $detail['content']; ?></p>
                                </div>
                                <!-- FACEBOOK -->
                                <div id="fb-root"></div>
                                <script>(function (d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) {
                                        return;
                                    }
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = '//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1463519310579697';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>

                                <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-mobile="auto-detect"
                                     data-numposts="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- inner container end -->
            <?php } ?>
        </div>
    </div>
</div>
<!-- main container end -->


<?php $this->load->view('layout/webapp/footer'); ?>
