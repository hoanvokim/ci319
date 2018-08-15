<?php $this->load->view('layout/webapp/header'); ?>
<!-- main container start -->

<div class="main-container">
    <div class="slogan-disabled">
        <div class="container jumbotron-v2">
            <div class="row">
                <span class="tlt animateText"><?php echo $slogan['value'] ?></span>
                <span class="infoText">
                    Hotline: <a href="tel:0901 879 877"> 0901 879 877</a><br/>
                </span>
                <span class="flags">
                    <img src="<?php echo base_url() . 'webresources/images/vn.png' ?>"/>
                    <img src="<?php echo base_url() . 'webresources/images/korea.png' ?>"/>
                </span>
            </div>
        </div>
    </div>
    <!-- slider container start -->
    <div class="slider-study-abroad-container" style="<?php if (!$sliders || count($sliders) == 0) {
        echo 'padding-top:0px';
    } ?>">
        <?php if ($sliders && count($sliders) > 0) { ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="slider">
                            <?php foreach ($sliders as $slider) { ?>
                                <li>
                                    <a href="<?php echo $slider['url']; ?>"><img
                                                src="<?php echo base_url() . $slider['img_src']; ?>"
                                                alt="<?php echo $slider['vi_content']; ?>"></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- slider container end -->
    <div class="inner-container" style="margin-top:25px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 blog_news">
                    <!-- blog content start -->
                    <div class="col-md-12 blog_content">
                        <!-- single news area start -->
                        <div class="news col-md-6">
                            <div class="banner-block">
                                <a href="<?php echo base_url() . $duhochanquoc['slug']; ?>"> <img
                                            src="<?php echo base_url() . $duhochanquoc['img'] ?>"
                                            alt="<?php echo $duhochanquoc['vi_name'] ?>"> </a>
                            </div>
                        </div>
                        <!-- single news area end -->
                        <!-- single news area start -->
                        <div class="news col-md-6">
                            <div class="banner-block">
                                <a href="<?php echo base_url() . $daotaohanngu['slug']; ?>"> <img
                                            src="<?php echo base_url() . $daotaohanngu['img'] ?>"
                                            alt="<?php echo $daotaohanngu['vi_name'] ?>"> </a>
                            </div>
                        </div>
                        <!-- single news area end -->
                    </div>
                    <!-- blog content end -->
                </div>
            </div>
        </div>
    </div>

    <?php if ($features && count($features) > 0) { ?>
        <!-- feature container start -->
        <div class="inner-container" style="margin-top:25px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="margin_bottom">
                            <h3><strong><?php echo $featureslogan['value'] ?></strong></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php foreach ($features as $feature) { ?>
                        <div class="col-md-<?php echo $featureCount; ?> col-sm-<?php echo $featureCount; ?> col-xs-12 text-center">
                            <div class="feature_detail">
                                <div>
                                    <img src="<?php echo $feature['img']; ?>" style="margin-top: 20px; width: 90px;"/>
                                </div>
                                <h5 style="margin-top: 20px;"><?php echo $feature['vi_des']; ?></h5>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- feature container end -->
    <?php } ?>

    <?php if ($last_news && count($last_news) > 0) { ?>
        <div class="news-inner-container">
            <div class="container">
                <a href="<?php echo base_url() . 'cat/tin-tuc-su-kien' ?>"><h3
                            class="col-header-color"><strong><?php echo $this->lang->line('LASTEST_NEWS'); ?></strong></h3></a>
                <hr class="divider"/>
                <div class="row mar-20">
                    <div class="col-md-12 blog_news">
                        <!-- blog content start -->
                        <div class="col-md-12 blog_content">
                            <!-- single news area start -->
                            <div class="news col-md-6" style="padding: 5px !important;">
                                <div class="banner-block">
                                    <a href="<?php echo base_url() . 'news/' . $last_news[0]['slug']; ?>"> <img
                                                src="<?php if (strripos($last_news[0]['img_src'], 'embed/') !== false || strripos($last_news[0]['img_src'], 'watch?v=') !== false) {
                                                    echo getThumbnailFromYoutubeLink($last_news[0]['img_src']);
                                                }
                                                else {
                                                    if (empty($last_news[0]['img_src'])) {
                                                        echo base_url() . 'webresources/images/banner0.jpg';
                                                    }
                                                    else {
                                                        echo base_url() . $last_news[0]['img_src'];
                                                    }
                                                }
                                                ?>"></a>
                                    <div class="text-des-container-news">
                                        <h6><?php echo $last_news[0]['title']; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <!-- single news area end -->
                            <!-- single news area start -->
                            <div class="news col-md-3" style="padding: 5px !important;">
                                <?php for ($i = 1; $i < 3; $i++) { ?>
                                    <?php if ($i > (count($last_news) - 1)) {
                                        break;
                                    } ?>
                                    <div class="banner-block">
                                        <a href="<?php echo base_url() . 'news/' . $last_news[$i]['slug']; ?>"> <img
                                                    src="<?php if (strripos($last_news[$i]['img_src'], 'embed/') !== false || strripos($last_news[$i]['img_src'], 'watch?v=') !== false) {
                                                        echo getThumbnailFromYoutubeLink($last_news[$i]['img_src']);
                                                    }
                                                    else {
                                                        if (empty($last_news[$i]['img_src'])) {
                                                            echo base_url() . 'webresources/images/banner0.jpg';
                                                        }
                                                        else {
                                                            echo base_url() . $last_news[$i]['img_src'];
                                                        }
                                                    }
                                                    ?>"></a>
                                        <div class="text-des-container-news">
                                            <h6><?php echo $last_news[$i]['title']; ?></h6>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- single news area end -->
                            <!-- single news area start -->
                            <div class="news col-md-3" style="padding: 5px !important;">
                                <?php for ($i = 3; $i < 5; $i++) { ?>
                                    <?php if ($i > (count($last_news) - 1)) {
                                        break;
                                    } ?>
                                    <div class="banner-block">
                                        <a href="<?php echo base_url() . 'news/' . $last_news[$i]['slug']; ?>"> <img
                                                    src="<?php if (strripos($last_news[$i]['img_src'], 'embed/') !== false || strripos($last_news[$i]['img_src'], 'watch?v=') !== false) {
                                                        echo getThumbnailFromYoutubeLink($last_news[$i]['img_src']);
                                                    }
                                                    else {
                                                        if (empty($last_news[$i]['img_src'])) {
                                                            echo base_url() . 'webresources/images/banner0.jpg';
                                                        }
                                                        else {
                                                            echo base_url() . $last_news[$i]['img_src'];
                                                        }
                                                    }
                                                    ?>"></a>
                                        <div class="text-des-container-news">
                                            <h6><?php echo $last_news[$i]['title']; ?></h6>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- single news area end -->
                        </div>
                        <!-- blog content end -->
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs"
                       href="<?php echo base_url() . 'cat/tin-tuc-su-kien' ?>"><strong><?php echo $this->lang->line('READ_MORE_NEWS'); ?></strong>
                        <i class="ion ion-ios-arrow-thin-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- inner container end -->
    <?php } ?>

    <?php if ($studyabroad_news && count($studyabroad_news) > 0) { ?>
        <div class="news-inner-container">
            <div class="container">
                <a href="<?php echo base_url() . 'cat/thong-tin-du-hoc' ?>"><h3
                            class="col-header-color"><strong><?php echo $this->lang->line('STUDYABROAD'); ?></strong></h3></a>
                <hr class="divider"/>
                <div class="row mar-20">
                    <div class="col-md-12 blog_news">
                        <!-- blog content start -->
                        <div class="col-md-12 blog_content">
                            <!-- single news area start -->
                            <div class="news col-md-6">
                                <div class="banner-block">
                                    <a href="<?php echo base_url() . 'news/' . $studyabroad_news[0]['slug']; ?>"> <img
                                                src="<?php if (strripos($studyabroad_news[0]['img_src'], 'embed/') !== false || strripos($studyabroad_news[0]['img_src'], 'watch?v=') !== false) {
                                                    echo getThumbnailFromYoutubeLink($studyabroad_news[0]['img_src']);
                                                }
                                                else {
                                                    if (empty($studyabroad_news[0]['img_src'])) {
                                                        echo base_url() . 'webresources/images/banner0.jpg';
                                                    }
                                                    else {
                                                        echo base_url() . $studyabroad_news[0]['img_src'];
                                                    }
                                                }
                                                ?>"></a>
                                    <div class="text-des-container-news">
                                        <h6><?php echo $studyabroad_news[0]['title']; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <!-- single news area end -->
                            <!-- single news area start -->

                            <?php for ($i = 1; $i < 3; $i++) { ?>
                                <?php if ($i > (count($studyabroad_news) - 1)) {
                                    break;
                                } ?>
                                <div class="news col-md-3">
                                    <div class="banner-block">
                                        <a href="<?php echo base_url() . 'news/' . $studyabroad_news[$i]['slug']; ?>"> <img
                                                    src="<?php if (strripos($studyabroad_news[$i]['img_src'], 'embed/') !== false || strripos($studyabroad_news[$i]['img_src'], 'watch?v=') !== false) {
                                                        echo getThumbnailFromYoutubeLink($studyabroad_news[$i]['img_src']);
                                                    }
                                                    else {
                                                        if (empty($studyabroad_news[$i]['img_src'])) {
                                                            echo base_url() . 'webresources/images/banner0.jpg';
                                                        }
                                                        else {
                                                            echo base_url() . $studyabroad_news[$i]['img_src'];
                                                        }
                                                    }
                                                    ?>"></a>
                                        <div class="text-des-container-news-no-stack">
                                            <h6><?php echo substr($studyabroad_news[$i]['title'], 0, 100); ?></h6>
                                            <p>
                                                <?php echo substr($studyabroad_news[$i]['summary'], 0, 194) . ' ...'; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- single news area end -->
                        </div>
                        <!-- blog content end -->
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs"
                       href="<?php echo base_url() . 'cat/thong-tin-du-hoc' ?>"><strong><?php echo $this->lang->line('READ_MORE_NEWS'); ?></strong>
                        <i class="ion ion-ios-arrow-thin-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- inner container end -->
    <?php } ?>

    <?php if ($uni_news && count($uni_news) > 0) { ?>
        <div class="news-inner-container">
            <div class="container">
                <a href="<?php echo base_url() . 'cat/cac-truong-dai-hoc' ?>"><h3
                            class="col-header-color"><strong><?php echo $this->lang->line('UNIVERSITY'); ?></strong></h3></a>
                <hr class="divider"/>
                <div class="row mar-20">
                    <div class="col-md-12 blog_news">
                        <!-- blog content start -->
                        <div class="col-md-12 blog_content">
                            <!-- single news area start -->
                            <div class="news col-md-6">
                                <div class="banner-block">
                                    <a href="<?php echo base_url() . 'news/' . $uni_news[0]['slug']; ?>"> <img
                                                src="<?php if (strripos($uni_news[0]['img_src'], 'embed/') !== false || strripos($uni_news[0]['img_src'], 'watch?v=') !== false) {
                                                    echo getThumbnailFromYoutubeLink($uni_news[0]['img_src']);
                                                }
                                                else {
                                                    if (empty($uni_news[0]['img_src'])) {
                                                        echo base_url() . 'webresources/images/banner0.jpg';
                                                    }
                                                    else {
                                                        echo base_url() . $uni_news[0]['img_src'];
                                                    }
                                                }
                                                ?>"></a>
                                    <div class="text-des-container-news">
                                        <h6><?php echo $uni_news[0]['title']; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <!-- single news area end -->
                            <!-- single news area start -->

                            <?php for ($i = 1; $i < 3; $i++) { ?>
                                <?php if ($i > (count($uni_news) - 1)) {
                                    break;
                                } ?>
                                <div class="news col-md-3">
                                    <div class="banner-block">
                                        <a href="<?php echo base_url() . 'news/' . $uni_news[$i]['slug']; ?>"> <img
                                                    src="<?php if (strripos($uni_news[$i]['img_src'], 'embed/') !== false || strripos($uni_news[$i]['img_src'], 'watch?v=') !== false) {
                                                        echo getThumbnailFromYoutubeLink($uni_news[$i]['img_src']);
                                                    }
                                                    else {
                                                        if (empty($uni_news[$i]['img_src'])) {
                                                            echo base_url() . 'webresources/images/banner0.jpg';
                                                        }
                                                        else {
                                                            echo base_url() . $uni_news[$i]['img_src'];
                                                        }
                                                    }
                                                    ?>"></a>
                                        <div class="text-des-container-news-no-stack">
                                            <h6><?php echo substr($uni_news[$i]['title'], 0, 100); ?></h6>
                                            <p>
                                                <?php echo substr($uni_news[$i]['summary'], 0, 194) . ' ...'; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- single news area end -->
                        </div>
                        <!-- blog content end -->
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs"
                       href="<?php echo base_url() . 'cat/cac-truong-dai-hoc' ?>"><strong><?php echo $this->lang->line('READ_MORE_NEWS'); ?></strong>
                        <i class="ion ion-ios-arrow-thin-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- inner container end -->
    <?php } ?>

    <?php if ($learning_corner_news && count($learning_corner_news) > 0) { ?>
        <div class="news-inner-container">
            <div class="container">
                <a href="<?php echo base_url() . 'cat/goc-hoc-tap' ?>"><h3
                            class="col-header-color"><strong><?php echo $this->lang->line('STUDY'); ?></strong></h3></a>
                <hr class="divider"/>
                <div class="row mar-20">
                    <div class="col-md-12 blog_news">
                        <!-- blog content start -->
                        <div class="col-md-12 blog_content">
                            <!-- single news area start -->
                            <div class="news col-md-6">
                                <div class="banner-block">
                                    <a href="<?php echo base_url() . 'news/' . $learning_corner_news[0]['slug']; ?>"> <img
                                                src="<?php if (strripos($learning_corner_news[0]['img_src'], 'embed/') !== false || strripos($learning_corner_news[0]['img_src'], 'watch?v=') !== false) {
                                                    echo getThumbnailFromYoutubeLink($learning_corner_news[0]['img_src']);
                                                }
                                                else {
                                                    if (empty($learning_corner_news[0]['img_src'])) {
                                                        echo base_url() . 'webresources/images/banner0.jpg';
                                                    }
                                                    else {
                                                        echo base_url() . $learning_corner_news[0]['img_src'];
                                                    }
                                                }
                                                ?>"></a>
                                    <div class="text-des-container-news">
                                        <h6><?php echo $learning_corner_news[0]['title']; ?></h6>
                                    </div>
                                </div>
                            </div>
                            <!-- single news area end -->
                            <!-- single news area start -->

                            <?php for ($i = 1; $i < 3; $i++) { ?>
                                <?php if ($i > (count($learning_corner_news) - 1)) {
                                    break;
                                } ?>
                                <div class="news col-md-3">
                                    <div class="banner-block">
                                        <a href="<?php echo base_url() . 'news/' . $learning_corner_news[$i]['slug']; ?>"> <img
                                                    src="<?php if (strripos($learning_corner_news[$i]['img_src'], 'embed/') !== false || strripos($learning_corner_news[$i]['img_src'], 'watch?v=') !== false) {
                                                        echo getThumbnailFromYoutubeLink($learning_corner_news[$i]['img_src']);
                                                    }
                                                    else {
                                                        if (empty($learning_corner_news[$i]['img_src'])) {
                                                            echo base_url() . 'webresources/images/banner0.jpg';
                                                        }
                                                        else {
                                                            echo base_url() . $learning_corner_news[$i]['img_src'];
                                                        }
                                                    }
                                                    ?>"></a>
                                        <div class="text-des-container-news-no-stack">
                                            <h6><?php echo substr($learning_corner_news[$i]['title'], 0, 100); ?></h6>
                                            <p>
                                                <?php echo substr($learning_corner_news[$i]['summary'], 0, 194) . ' ...'; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                            <!-- single news area end -->
                        </div>
                        <!-- blog content end -->
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs"
                       href="<?php echo base_url() . 'cat/goc-hoc-tap' ?>"><strong><?php echo $this->lang->line('READ_MORE_NEWS'); ?></strong>
                        <i class="ion ion-ios-arrow-thin-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- inner container end -->
    <?php } ?>

</div>
<!-- main container end -->
<?php $this->load->view('layout/webapp/footer'); ?>
