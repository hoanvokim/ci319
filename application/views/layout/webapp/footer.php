<footer>
    <!--footer-upper start-->
    <div class="footer-upper">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12">
                    <h5><a href="#"><img src="<?php echo base_url(); ?>webresources/images/logo-line-white-2.png"
                                         alt="ISSILOO"
                                         class="footer-logo"/></a></h5>
                    <div style="width: 100%">
                        <ul class="social-links">
                            <li><a href="https://www.facebook.com/issiloo.edu.vn/" target="_blank" title="Facebook">
                                    <img src="<?php echo base_url() . 'webresources/images/fb.png' ?>"
                                         style="width: 45px;"/></a></li>
                            <li><a href="https://www.youtube.com/channel/UCxSwrePN-rYK7AUtoKi2gfg?view_as=subscriber" target="_blank"
                                   title="Youtube">
                                    <img src="<?php echo base_url() . 'webresources/images/youtube.png' ?>"
                                         style="width: 45px;"/></a></li>
                            <li><a href="http://zaloapp.com/qr/p/fwc7rp42pe1x" target="_blank" title="Zalo">
                                    <img src="<?php echo base_url() . 'webresources/images/zalo.png' ?>"
                                         style="width: 45px;"/></a></li>
                        </ul>
                    </div>
                    <br/><br/>
                    <div class="fb-page" data-href="https://www.facebook.com/issiloo.edu.vn" data-tabs="timeline"
                         data-width="400" data-height="160" data-small-header="true" data-adapt-container-width="true"
                         data-hide-cover="false" data-show-facepile="true" style="margin-top: 20px;">
                        <div class="fb-xfbml-parse-ignore">
                            <blockquote cite="https://www.facebook.com/issiloo.edu.vn"><a
                                        href="https://www.facebook.com/issiloo.edu.vn">Hàn ngữ ISSILOO</a></blockquote>
                        </div>
                    </div>
                    <br/>
                </div>
                <div class="col-md-3 col-sm-12" style="padding-left: 25px;">
                    <h4><?php echo $this->lang->line('MENU_CONTACT'); ?></h4>
                    <address>
                        <p>
                            <i class="ion ion-ios-location-outline"></i> <?php echo $this->lang->line('ISSI_ADDRESS_STREET'); ?>
                        </p>
                        <p>
                            <i class="ion ion-ios-at-outline" style="font-size: 25px;"></i> <a
                                    href="mailto:kr-info@issiloo.edu.vn">kr-info@issiloo.edu.vn</a><br/>
                            <i class="ion ion-ios-telephone-outline"></i> Phone: <a
                                    href="tel:(08) 3517 1099"><?php echo $this->lang->line('ISSI_PHONE'); ?></a><br/>
                            <i class="ion ion-ios-telephone-outline"></i> Hotline: <a href="tel:0901 879 877">0901 879 877</a>
                            <br/>
                            <br/>
                        <h4><?php echo $this->lang->line('WORKING_TIME'); ?></h4>
                        <i
                                class="ion ion-ios-alarm-outline"></i> <?php echo $this->lang->line('MONDAY_FRIDAY'); ?>
                        [ <?php echo $this->lang->line('MORNING_EVENING'); ?> ]<br/>
                        <i
                                class="ion ion-ios-alarm-outline"></i> <?php echo $this->lang->line('SATURDAY'); ?>
                        [ <?php echo $this->lang->line('MORNING_NOON'); ?> ]
                        </p>
                    </address>
                </div>
                <div class="col-md-5 col-sm-12">
                    <h4 style="padding-left: 55px;"><?php echo $this->lang->line('REGISTER'); ?></h4>

                    <p class="message <?php echo $status; ?>"><?php if ($status == 'error') {
                            echo $this->lang->line('MESSAGE_ERROR');
                        } elseif ($status == 'success') {
                            echo $this->lang->line('CONTACT_SUCCESS');
                        } else {
                            echo '';
                        } ?></p>

                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
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
                </div>
            </div>
        </div>
    </div>
    <!--footer-upper end-->
</footer><!--footer end-->

</div> <!-- end of animsition -->

<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/animsition.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/slick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/jquery.countTo.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/scroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/imagesloaded.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/masonry-3.1.4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/masonry.filter.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/jquery.vide.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/jquery.fittext.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/jquery.lettering.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/jquery.textillate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>webresources/js/theme-core.js"></script>

<script>
    $(function () {
        $('.tlt').textillate({
            in: {
                effect: 'fadeInRight',
            },
            out: {
                effect: 'fadeOut'
            },
            loop: true,
            minDisplayTime: 3000
        });
    });
</script>
<div id="fb-root"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1463519310579697";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<script type='text/javascript' data-cfasync='false'>window.purechatApi = {
        l: [], t: [], on: function () {
            this.l.push(arguments);
        }
    };
    (function () {
        var done = false;
        var script = document.createElement('script');
        script.async = true;
        script.type = 'text/javascript';
        script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript';
        document.getElementsByTagName('HEAD').item(0).appendChild(script);
        script.onreadystatechange = script.onload = function (e) {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                var w = new PCWidget({c: '5fafbfea-65b9-4347-8f02-d4b6215668ae', f: true});
                done = true;
            }
        };
    })();</script>
</body>
</html>