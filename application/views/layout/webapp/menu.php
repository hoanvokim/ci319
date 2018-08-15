<header class="navigation navbar-fixed-top" id="nav">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="logo"><a href="<?php echo base_url(); ?>" class="animsition-link"><img
                                src="<?php echo base_url(); ?>webresources/images/logo-line-white.png"
                                alt="ISSILOO"/></a></div>


                <div class="nav-menu-icon"><a href="#"><i></i></a></div>


                <nav class="fixed-collapse-navbar">
                    <ul class="menu nav navbar-nav navbar-right">
                        <li><a class="active"
                               href="<?php echo base_url(); ?>"><?php echo $this->lang->line('MENU_HOME'); ?></a>
                        </li>
                        <?php echo $menustr; ?>
                        <li>
                            <a href="<?php echo base_url() . 'contact'; ?>"><?php echo $this->lang->line('MENU_CONTACT'); ?></a>
                        </li>
                        <li>
                            <!--Header Search-->
                            <div class="search" id="headerSearch">
                                <a href="#" id="headerSearchOpen"><i class="fa fa-search"></i></a>
                                <div class="search-input">
                                    <form id="headerSearchForm" method="get"
                                          action="<?php echo base_url() . 'search' ?>">
                                        <div class="input-group">
                                            <input type="text" class="form-control search" name="searchValue" id="searchValue"
                                                   placeholder="Tìm kiếm...">
                                            <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button"><i
                                                    class="fa fa-search"></i></button>
                                    </span>
                                        </div>
                                    </form>
                                    <span class="v-arrow-wrap"><span class="v-arrow-inner"></span></span>
                                </div>
                            </div>
                            <!--End Header Search-->
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<!--header end-->