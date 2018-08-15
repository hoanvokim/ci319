<?php $this->load->view('layout/webapp/header'); ?>
<link href="<?php echo base_url(); ?>webresources/css/issiloo_reset.css"
      rel="stylesheet" type="text/css">
<?php $this->load->view('components/webapp/banner_start'); ?>

<!-- inner container start -->
<div class="inner-container" style="margin-top: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- blog item start -->

                <div class="single-post">
                    <?php if ($detail != -1) { ?>
                        <div class="entry-content">
                            <!--<h4><a href="single-post.html"><?php echo $detail['title']; ?></a></h4>-->
                            <link href="<?php echo base_url(); ?>webresources/css/issiloo_reset.css" rel="stylesheet"
                                  type="text/css">
                            <div id="detail_content">
                                <div class="fr-view">
                                    <?php echo $detail['content']; ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="post-nav">
                    <?php if ($cur_post > 0) { ?>
                        <h4 class="prev-post"><a
                                    href="<?php echo base_url() . 'news/' . $lst_post[$cur_post - 1]['slug']; ?>"
                                    class="btn btn-primary btn-block"><i
                                        class="ion ion-ios-undo"></i> <?php echo $this->lang->line('PREVIOUS_POST'); ?>
                            </a>
                        </h4>
                    <?php } ?>

                    <?php if ($cur_post < $max_post) { ?>
                        <h4 class="next-post"><a
                                    href="<?php echo base_url() . 'news/' . $lst_post[$cur_post + 1]['slug']; ?>"
                                    class="btn btn-primary btn-block"><?php echo $this->lang->line('NEXT_POST'); ?> <i
                                        class="ion ion-ios-redo"></i></a></h4>
                    <?php } ?>

                </div>
                <!-- post nav end -->


                <!-- widget start -->
                <div class="widget-box">
                    <?php if ($tagnews && count($tagnews) > 0) { ?>
                        <h4>Tags </h4>
                        <div class="tag-box">
                            <?php foreach ($tagnews as $item) { ?>
                                <a href="<?php echo base_url(); ?>tag/<?php echo $item['tag_id']; ?>"><?php echo $item['tag_name']; ?></a>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
                <!-- widget end -->

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

            <div class="col-md-12" style="margin-bottom: 30px;">
                <?php if ($relatednews && count($relatednews) > 0) { ?>
                    <h3 class="col-header-color">Có thể bạn quan tâm</h3></a>
                    <hr class="divider"/>
                <?php } ?>
                <?php $displayRow = 0; ?>
                <?php for ($i = 0;
                $i < count($relatednews);
                $i++) { ?>
                <?php if ($displayRow < 2) { ?>
                <div class="row"> <?php } ?>
                    <div class="col-md-6" <?php if ($i > 1) { ?> style="margin-top: 10px;" <?php } ?>>
                        <a href="<?php echo base_url(); ?>news/<?php echo $relatednews[$i]['slug']; ?>">
                            <div class="col-md-6">
                                <img
                                        src="
                                            <?php
                                        if (empty($relatednews[$i]['img_src'])) {
                                            echo base_url() . 'webresources/images/banner0.jpg';
                                        }
                                        else {
                                            echo base_url() . $relatednews[$i]['img_src'];
                                        }
                                        ?>
                                            "
                                        alt=""/>
                            </div>
                            <div class="col-md-6">
                                <?php echo $relatednews[$i]['title']; ?>
                                <br/>
                                <small><?php echo date_format(new DateTime($relatednews[$i]['created_date']), "F d, Y"); ?></small>
                            </div>
                        </a>
                    </div>
                    <?php if ($displayRow < 2) {
                        $displayRow++;
                    }
                    else if ($displayRow == 1) {
                        $displayRow = 0;
                        echo '</div';
                    } ?>
                    <?php } ?>
                </div>
            </div>

        </div>
    </div>
    <!-- inner container end -->


    <?php $this->load->view('layout/webapp/footer'); ?>
