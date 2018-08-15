<?php $this->load->view('layout/webapp/header');

function limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos = array_keys($words);
        $text = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

?>
<!-- main container start -->

<div class="main-container">

    <div class="slogan-disabled">
        <div class="container jumbotron-v2">
            <div class="row">
                <span class="tlt animateText">Chắp cánh cho giấc mơ du học của chính bạn</span>
                <span class="infoText">
                    Hotline: <a href="tel:0898 084 080">0898 084 080</a><br/>
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

    <?php if ($aImpNews && count($aImpNews) > 0) { ?>
        <!-- inner container start -->
        <div class="inner-container" style="margin-top:25px;">
            <div class="container">
                <div class="table-responsive">
                    <table class="table table-cat">
                        <thead>
                        <tr>
                            <?php foreach ($aImpNews as $item) { ?>
                                <th style="width: 33%;">
                                    <a class="col-header"
                                       href="<?php echo base_url() . 'cat/' . $item['cat_slug']; ?>">
                                        <?php if ($item['cat_id'] == $this->config->item('hoc_tieng_han')) {
                                            echo '<img src="' . base_url() . 'webresources/images/hoctienghan.png" style="width: 50px;" />   ';
                                            echo $this->lang->line('HOC_TIENG_HAN');
                                        }
                                        else if ($item['cat_id'] == $this->config->item('hoc_bong')) {
                                            echo '<img src="' . base_url() . 'webresources/images/hocbong.png" style="width: 50px;" />   ';
                                            echo $item['cat_name'];
                                        }
                                        else {
                                            echo '<img src="' . base_url() . 'webresources/images/duhoc.png" style="width: 50px;" />   ';
                                            echo $item['cat_name'];
                                        } ?>
                                    </a>
                                </th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $index = 0;
                        while ($index < 3) {
                            ?>
                            <tr>
                                <?php foreach ($aImpNews as $item) { ?>
                                    <td>
                                        <a href="<?php echo base_url() . 'news/' . $item['related_news'][$index]['slug']; ?>">
                                            <div class="row row-eq-height">
                                                <div class="col-sm-5" style="padding: 0px !important;">
                                                    <img
                                                        src="<?php echo base_url(); ?><?php if (empty($item['related_news'][$index]['img_src'])) {
                                                            echo 'webresources/images/banner0.jpg';
                                                        }
                                                        else {
                                                            echo $item['related_news'][$index]['img_src'];
                                                        } ?>"
                                                        alt=""/>
                                                </div>
                                                <div class="col-sm-7">
                                                <span>
                                                    <span style="font-weight: 500;"><?php echo $item['related_news'][$index]['title'] ?></span>
                                                    <br/>
                                                    <small class="cat-date"><?php echo date_format(new DateTime($item['related_news'][$index]['created_date'], new DateTimeZone('Pacific/Nauru')), "F d, Y"); ?></small>
                                                </span>
                                                </div>
                                            </div>

                                        </a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                            $index++;
                        }
                        ?>
                        <tr>
                            <?php foreach ($aImpNews as $item) { ?>
                                <td>
                                    <?php if ($item['count_news'] > 3) { ?>
                                        <div class="pull-right"><a
                                                href="<?php echo base_url() . 'cat/' . $item['cat_slug']; ?>"
                                                class="btn btn-default btn-xs"><?php echo $this->lang->line('READ_MORE'); ?>
                                                <i
                                                    class="ion ion-ios-arrow-thin-right"></i></a></div>
                                    <?php } ?>
                                </td>
                            <?php } ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- inner container end -->
    <?php } ?>


    <?php if ($last_news && count($last_news) > 0) { ?>
        <div class="news-inner-container">
            <div class="container">
                <a href="<?php echo base_url() . 'cat/tin-tuc-su-kien' ?>"><h3
                        class="col-header-color"><?php echo $this->lang->line('LASTEST_NEWS'); ?></h3></a>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row service-box--main">
                            <div class="col-md-12">
                                <div class="img-responsive">
                                    <a href="<?php echo base_url() . 'news/' . $last_news[0]['slug']; ?>">
                                        <img
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
                                            ?>" width="100%">
                                    </a>
                                </div>
                                <a href="<?php echo base_url() . 'news/' . $last_news[0]['slug']; ?>"><h4>
                                        <strong><?php echo $last_news[0]['title']; ?></strong></h4></a>
                                <h6 class="posted-date"><?php echo $this->lang->line('POST_DATE'); ?>:
                                    <i><?php echo date_format(new DateTime($last_news[0]['created_date']), "d/m/Y"); ?></i>
                                </h6>
                                <div class="simple-summary">
                                    <?php echo $last_news[0]['summary']; ?>
                                    <a href="<?php echo base_url() . 'news/' . $last_news[0]['slug']; ?>"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       data-original-title="Xem chi tiết">
                                        <i class="ion icon ion-forward" style="font-size: 15px; color:#139bd5;"> Thông tin chi tiết</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <?php for ($i = 1; $i < 4; $i++) { ?>
                            <?php if ($i > (count($last_news) - 1)) {
                                break;
                            } ?>
                            <div class="service-box" style="padding: 0px !important;">
                                <div class="col-md-4">
                                    <a href="<?php echo base_url() . 'news/' . $last_news[$i]['slug']; ?>">
                                        <img
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
                                            ?>" width="100%">
                                    </a>
                                </div>
                                <div class="col-md-8" style="margin-bottom: -14px;">
                                    <a href="<?php echo base_url() . 'news/' . $last_news[$i]['slug']; ?>"><h4>
                                            <strong><?php echo $last_news[$i]['title']; ?></strong></h4></a>
                                    <h6 class="posted-date"><?php echo $this->lang->line('POST_DATE'); ?>:
                                        <i><?php echo date_format(new DateTime($last_news[$i]['created_date']), "d/m/Y"); ?></i>
                                    </h6>
                                </div>
                                <div class="col-md-12">
                                    <div><?php echo limit_text($last_news[$i]['summary'], 50); ?>
                                    </div>
                                    <a href="<?php echo base_url() . 'news/' . $last_news[$i]['slug']; ?>"
                                       data-toggle="tooltip"
                                       data-placement="bottom"
                                       data-original-title="Xem chi tiết">
                                        <i class="ion icon ion-forward" style="font-size: 15px; color:#139bd5;">
                                            Thông tin chi tiết</i>
                                    </a>
                                    <hr/>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default btn-xs"
                       href="<?php echo base_url() . 'cat/tin-tuc-su-kien' ?>"><?php echo $this->lang->line('READ_MORE_NEWS'); ?>
                        <i class="ion ion-ios-arrow-thin-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- inner container end -->
    <?php } ?>

    <?php if ($video_image && count($video_image) > 0) { ?>
        <div class="feature-container mar-60">
            <div class="container">
                <h3 class="col-header-color"
                    style="margin-bottom: -1px;"><?php echo $this->lang->line('SHARING_VIDEO'); ?></h3>
                <div class="feature-slider" style="box-shadow: 0px 7px 16px rgba(152, 152, 152, 0.31);">

                    <?php for ($i = 0;
                               $i < count($video_image);
                               $i++) { ?>
                        <div class="feature-box">
                            <div class="white-paper"
                                 style="background: url('<?php echo base_url() . $video_image[$i]['img_src']; ?>'); background-size: 300px;">
                                <?php if (strpos($video_image[$i]['img_src'], 'youtube') == false) { ?>
                                    <div class="slide-caption"><span><?php echo $video_image[$i]['title']; ?></span></div>
                                <?php }
                                else { ?>
                                    <a href="<?php echo $video_image[$i]['img_src']; ?>" target="_blank">
                                        <img src="<?php echo $video_image[$i]['youtube']; ?>" alt=""/>
                                        <img class="youtube-play-btn"
                                             src="<?php echo base_url() . 'webresources/images/play-btn.png'; ?>"
                                             alt=""/>
                                    </a>
                                    <div class="slide-caption"><?php echo $video_image[$i]['title']; ?></div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

    <?php } ?>

    <?php if ($universities && count($universities) > 0) { ?>
        <!-- slider container start -->
        <div class="slider-university-container">
            <div class="container">
                <h3 class="col-header-color"><?php echo $this->lang->line('UNIVERSITY_INFO'); ?></h3>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="recent-projects-slider2">
                            <li>
                                <div>
                                    <a href="http://www.kgrc.ac.kr/"
                                       target="_blank"><img class="img-uni-logo"
                                                            src="<?php echo base_url() . '/assets/upload/images/university/koguryeo-issiloo.png' ?>"/></a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="http://www.pusan.ac.kr/uPNU_homepage/kr/default.asp"
                                       target="_blank"><img class="img-uni-logo"
                                                            src="<?php echo base_url() . '/assets/upload/images/university/pusan.png' ?>"/></a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="http://www.yonsei.ac.kr/en_sc/"
                                       target="_blank"><img class="img-uni-logo"
                                                            src="<?php echo base_url() . '/assets/upload/images/university/yonsei-issiloo.png' ?>"/></a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="http://www.bwc.ac.kr/sch/index.asp"
                                       target="_blank"><img class="img-uni-logo"
                                                            src="<?php echo base_url() . '/assets/upload/images/university/pusan-woman.png' ?>"/></a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="http://www.univerzities.com/south-korea/catholic-university-of-pusan/"
                                       target="_blank"><img class="img-uni-logo"
                                                            src="<?php echo base_url() . '/assets/upload/images/university/pusan-cathe.png' ?>"/></a>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <a href="http://www.cu.ac.kr/"
                                       target="_blank"><img class="img-uni-logo"
                                                            src="<?php echo base_url() . '/assets/upload/images/university/deagu-cathe.png' ?>"/></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider container end -->
    <?php } ?>

</div>
<!-- main container end -->

<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1463519310579697";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<?php $this->load->view('layout/webapp/footer'); ?>
