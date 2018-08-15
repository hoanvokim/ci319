<!--NAVBAR-->
<!--===================================================-->
<header id="navbar">
    <div id="navbar-container" class="boxed">

        <!--Brand logo & name-->
        <!--================================-->
        <div class="navbar-header">
            <a href="<?php echo base_url(); ?>admin" class="navbar-brand"> <i class="fa fa-cube brand-icon"></i>
                <div class="brand-title"><span class="brand-text">Admin</span></div>
            </a>
        </div>
        <!--================================-->
        <!--End brand logo & name-->

        <!--Navbar Dropdown-->
        <!--================================-->
        <div class="navbar-content clearfix">
            <ul class="nav navbar-top-links pull-left">
                <!--Navigation toogle button-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#"> <i class="fa fa-navicon fa-lg"></i> </a>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End Navigation toogle button-->
            </ul>
            <ul class="nav navbar-top-links pull-right">
                <!--Language selector-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li class="dropdown">
                    <a id="demo-lang-switch" class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">
                            <span class="lang-selected"> <img class="lang-flag" src="<?php echo base_url(); ?>webresources/dm/img/flags/united-kingdom.png"
                                                              alt="English"> <span class="lang-id">EN</span> <span
                                    class="lang-name">English</span> </span>
                    </a>

                    <!--Language selector menu-->
                    <ul class="head-list dropdown-menu with-arrow">
                        <li>
                            <!--English-->
                            <a href="#" class="active"> <img class="lang-flag" src="<?php echo base_url(); ?>webresources/images/flags/uk.png"
                                                             alt="English"> <span class="lang-id">EN</span> <span
                                    class="lang-name">English</span> </a>
                        </li>
                        <li>
                            <!--Spain-->
                            <a href="#"> <img class="lang-flag" src="<?php echo base_url(); ?>webresources/images/flags/vn.png" alt="Viet nam"> <span
                                    class="lang-id">VN</span> <span class="lang-name">Việt Nam</span> </a>
                        </li>
                        <li>
                            <!--Spain-->
                            <a href="#"> <img class="lang-flag" src="<?php echo base_url(); ?>webresources/images/flags/kr.png" alt="Korea"> <span
                                    class="lang-id">KR</span> <span class="lang-name">Korea</span> </a>
                        </li>
                    </ul>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End language selector-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right"> <span class="pull-right"> <img class="img-circle img-user media-object" src="<?php echo base_url(); ?>webresources/dm/img/av1.png" alt="Profile Picture"> </span>
                        <div class="username hidden-xs">John Doe</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right with-arrow">

                        <!-- User dropdown menu -->
                        <ul class="head-list">
                            <li>
                                <a href="#"> <i class="fa fa-user fa-fw fa-lg"></i> Profile </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>logout"> <i class="fa fa-sign-out fa-fw"></i> Logout </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>
<!--===================================================-->
<!--END NAVBAR-->