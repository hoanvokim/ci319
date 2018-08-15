<?php $this->load->view('layout/webapp/header'); ?>

    <!-- main container start -->
    <div class="inner-container">
        <div class="container">

            <div class="row" style="margin: 90px;">
                <div class="col-sm-12 col-md-8">
                    <ul class="project-category" style="text-align: left; margin-left:20px;">
                        <li><a href="#" data-filter="" id="option1" class="active"><?php echo $keyword; ?></a></li>
                    </ul>
                    <p style="margin-left:20px; color:#2e4c95;"><?php echo $this->lang->line('SEARCH_RESULT'); ?><span
                                style="font-weight: bold;font-size: 18px;"><?php echo $search_item_count; ?></span></p>
                    <br>

                    <?php if ($search_item_count > 0) { ?>
                        <!-- inner container start -->
                        <div class="inner-container">
                            <div class="container">
                                <div id="masonry" class="row">

                                    <?php foreach ($anews as $news) { ?>
                                        <!-- blog item start -->

                                        <div class="col-md-12 grid-item">
                                            <div class="blog-item">
                                                <div class="entry-media">
                                                    <a href="<?php echo base_url(); ?>news/<?php echo $news['slug']; ?>">
                                                        <img
                                                                src="<?php echo base_url(); ?><?php echo $news['img_src']; ?>"
                                                                alt=""/>
                                                    </a>
                                                </div>
                                                <div class="entry-content">
                                                    <span class="entry-date"><a
                                                                href="#"><?php echo date_format(new DateTime($news['created_date']), "d.m.Y"); ?></a></span>
                                                    <h4 style="padding-top: 55px;">
                                                        <a href="<?php echo base_url(); ?>news/<?php echo $news['slug']; ?>"><?php echo $news['title']; ?></a>
                                                    </h4>
                                                    <p><?php echo $news['summary']; ?></p>

                                                    <a href="<?php echo base_url(); ?>news/<?php echo $news['slug']; ?>"
                                                       class="btn btn-primary btn-xs"><?php echo $this->lang->line('READ_DETAIL'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- blog item end -->
                                    <?php } ?>


                                </div>

                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <ul class="pagination">

                                            <?php if ($total_page > 5 && $cur_page > 1) { ?>
                                                <li>
                                                    <a href="<?php echo base_url() . 'search/' . $keyword . '/' . ($cur_page - 1); ?>"><i
                                                                class="ion ion-android-arrow-back"></i></a></li>
                                            <?php } ?>

                                            <?php if ($total_page <= 12) {
                                                for ($i = 1; $i <= $total_page; $i++) { ?>

                                                    <li <?php if ($cur_page == $i) {
                                                        echo "class='active'";
                                                    } ?>>
                                                        <a href="<?php echo base_url() . "search/" . $keyword . '/' . $i; ?>"><?php echo $i; ?></a>
                                                    </li>

                                                <?php }
                                            }
                                            else { ?>

                                                <?php if (($cur_page - 1) >= 1) { ?>
                                                    <li <?php if ($cur_page == 1) {
                                                        echo "class='active'";
                                                    } ?>>
                                                        <a href="<?php echo base_url() . "search/" . $keyword . '/1'; ?>">1</a>
                                                    </li>
                                                <?php } ?>

                                                <?php if (($cur_page - 2) > 1) { ?>
                                                    <li><a href="#">..</a></li>
                                                <?php } ?>

                                                <?php if (($cur_page - 1) > 1) { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . "search/" . $keyword . '/' . ($cur_page - 1); ?>"><?php echo($cur_page - 1); ?></a>
                                                    </li>
                                                <?php } ?>

                                                <li class="active"><a
                                                            href="<?php echo base_url() . "search/" . $keyword . '/' . ($cur_page); ?>"><?php echo $cur_page; ?></a>
                                                </li>

                                                <?php if (($cur_page + 1) < $total_page) { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() . "search/" . $keyword . '/' . ($cur_page + 1); ?>"><?php echo($cur_page + 1); ?></a>
                                                    </li>
                                                <?php } ?>

                                                <?php if (($cur_page + 2) < $total_page) { ?>
                                                    <li><a href="#">..</a></li>
                                                <?php } ?>

                                                <?php if (($cur_page + 1) <= $total_page) { ?>
                                                    <li <?php if ($cur_page == $total_page) {
                                                        echo "class='active'";
                                                    } ?>>
                                                        <a href="<?php echo base_url() . "search/" . $keyword . '/' . $total_page; ?>"><?php echo $total_page; ?></a>
                                                    </li>
                                                <?php } ?>

                                            <?php } ?>

                                            <?php if ($total_page > 5 && $cur_page < $total_page) { ?>
                                                <li>
                                                    <a href="<?php echo base_url() . 'search/' . $keyword . '/' . ($cur_page + 1); ?>"><i
                                                                class="ion ion-android-arrow-forward"></i></a></li>
                                            <?php } ?>

                                        </ul>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- inner container end -->
                    <?php } ?>
                </div>
                <div class="col-sm-12 col-md-4 asidebar">
                    <!--register form-->
                    <div class="inner-container">
                        <div class="container">
                            <h4><?php echo $this->lang->line('REGISTER'); ?></h4>

                            <p class="message <?php echo $status; ?>"><?php if ($status == 'error') {
                                    echo $this->lang->line('MESSAGE_ERROR');
                                }
                                elseif ($status == 'success') {
                                    echo $this->lang->line('CONTACT_SUCCESS');
                                }
                                else {
                                    echo '';
                                } ?></p>

                            <div class="row">
                                <form class="contact-form" id="ContactForm" method="post"
                                      action="<?php echo base_url(); ?>">
                                    <!--contact form-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="text" name="consult_name" class="form-control"
                                                           placeholder="<?php echo $this->lang->line('NAME'); ?> *"
                                                           required="required">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="email" name="consult_email" class="form-control"
                                                           placeholder="<?php echo $this->lang->line('EMAIL'); ?> *"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" name="consult_phone" class="form-control"
                                                           placeholder="<?php echo $this->lang->line('PHONE'); ?> *">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                        <textarea class="form-control" name="consult_content" rows="10"
                                                  placeholder="<?php echo $this->lang->line('CONTENT'); ?> *"
                                                  required="required"></textarea>
                                                </div>
                                                <input type="submit" value="<?php echo $this->lang->line('SEND'); ?>"
                                                       name="btn_consult_send" class="btn btn-primary"/>
                                            </div>
                                        </div>
                                </form>
                                <!--end contact form-->
                            </div>
                        </div>
                    </div> <!-- register consult -->
                    <!-- end regiter consult -->
                </div>
            </div>
        </div>
    </div>
    <!-- main container end -->

<?php $this->load->view('layout/webapp/footer'); ?>