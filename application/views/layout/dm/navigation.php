<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <ul id="mainnav-menu" class="list-group">
                        <li class="list-header">Tổng quát</li>
                        <li>
                            <a href="<?php echo site_url('admin'); ?>">
                                <i class="fa fa-dashboard"></i>
                                <span class="menu-title">
												<strong>Xem tổng quan</strong>
											</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('slider-manager'); ?>">
                                <i class="fa fa-braille"></i>
                                <span class="menu-title">Slider</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('main-feature-manager'); ?>">
                                <i class="fa fa-file-image-o"></i>
                                <span class="menu-title">Thay hình ảnh</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('feature-manager'); ?>">
                                <i class="fa fa-cubes"></i>
                                <span class="menu-title">Điểm nổi bật</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('manage-intro'); ?>">
                                <i class="fa fa-info-circle"></i>
                                <span class="menu-title">Giới thiệu</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('university-manager'); ?>">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">Trường đại học</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('sharing-manager'); ?>">
                                <i class="fa fa-share-alt"></i>
                                <span class="menu-title">Góc chia sẻ</span>
                            </a>
                        </li>

                        <!-- Group -->
                        <li class="list-divider"></li>
                        <li class="list-header">Du Học Hàn Quốc</li>
                        <li>
                            <a href="<?php echo site_url('manage-study-category'); ?>">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">Phân nhóm</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('study-manager/create-category'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Thêm Category</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('manage-study-news'); ?>">
                                <i class="fa fa-briefcase"></i>
                                <span class="menu-title">Bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('news-manager/add-news'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Viết bài mới</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "news-manager/update-study-news/" . $this->config->item('baiviet_duhoctieng'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Du học tiếng</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "news-manager/update-study-news/" . $this->config->item('baiviet_duhocnganh'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Du học ngành</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "news-manager/update-study-news/" . $this->config->item('baiviet_duhocnghe'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Du học nghề</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="list-header">Trung tâm Hàn Ngữ</li>
                        <li>
                            <a href="<?php echo site_url('program-manager'); ?>">
                                <i class="fa fa-product-hunt"></i>
                                <span class="menu-title">Chương trình đào tạo</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('learning-tips-manager'); ?>">
                                <i class="fa fa-book"></i>
                                <span class="menu-title">Góc học tập</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_tienghansocap'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Tiếng hàn sơ cấp</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_tienghantrungcap'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Tiếng hàn trung cấp</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_luyenthitopik'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Luyện thi TOPIK</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_luyenthiklat'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Luyện thi KLAT</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_luyenthieps'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Luyện thi EPS</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_daotaodoanhnghiep'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Đào tạo doanh nghiệp</span>
                            </a>
                        </li>
                        <li>
                            <a href=" <?php echo base_url() . "program-manager/update-program/" . $this->config->item('baiviet_lichkhaigiang'); ?>">
                                <i class="fa fa-plus-circle"></i>
                                <span class="menu-title">Lịch khai giảng</span>
                            </a>
                        </li>
                        <!-- Group -->
                        <li class="list-divider"></li>
                        <li class="list-header">Tin tức</li>
                        <li>
                            <a href="<?php echo site_url('news-manager'); ?>">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="menu-title">Sự kiện nổi bật</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('studyabroad-manager'); ?>">
                                <i class="fa fa-newspaper-o"></i>
                                <span class="menu-title">Thông tin du học</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('scholarship-manager'); ?>">
                                <i class="fa fa-unlink"></i>
                                <span class="menu-title">Học bổng</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('recruitment-manager'); ?>">
                                <i class="fa fa-binoculars"></i>
                                <span class="menu-title">Tuyển dụng</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('faq-manager'); ?>">
                                <i class="fa fa-question-circle-o"></i>
                                <span class="menu-title">Hỏi đáp</span>
                            </a>
                        </li>

                        <li class="list-divider"></li>
                        <li class="list-header">Mở rộng</li>
                        <li>
                            <a href="<?php echo site_url('gallery-manager'); ?>">
                                <i class="fa fa-image"></i>
                                <span class="menu-title">Thư mục ảnh</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('setting-manager'); ?>">
                                <i class="fa fa-gear"></i>
                                <span class="menu-title">Cấu hình hệ thống</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo site_url('tag-manager'); ?>">
                                <i class="fa fa-search"></i>
                                <span class="menu-title">Từ khoá tìm kiếm</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>edit-profile"> <i class="fa fa-user-md fa-fw"></i> Profile
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>logout"> <i class="fa fa-sign-out fa-fw"></i> Logout </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
<!--===================================================-->
<!--END MAIN NAVIGATION-->
