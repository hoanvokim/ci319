<?php $this->load->view('layout/webapp/header'); ?>

<?php $this->load->view('components/webapp/banner_start'); ?>

    <!-- main container start -->
    <div class="inner-container">
        <div class="container">
            <div class="row">
                <!-- inner container start -->
                <div class="inner-container">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <h4><?php echo $this->lang->line('CONTACT_WITH_US'); ?></h4>

                                <p class="message <?php echo $status; ?>"><?php if ($status == 'error') {
                                        echo $this->lang->line('MESSAGE_ERROR');
                                    } elseif ($status == 'success') {
                                        echo $this->lang->line('CONTACT_SUCCESS');
                                    } else {
                                        echo '';
                                    } ?></p>

                                <form method="post" action="<?php echo base_url() . 'contact'; ?>">
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('NAME'); ?>*</label>
                                        <input type="text" value="" name="sender_name" class="form-control"
                                               required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('EMAIL'); ?>*</label>
                                        <input type="email" value="" name="sender_email" class="form-control"
                                               required="required"/>

                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('PHONE'); ?>*</label>
                                        <input type="text" value="" name="sender_phone" class="form-control"
                                               required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('TITLE'); ?></label>
                                        <input type="text" value="" name="sender_subject" class="form-control"
                                               required="required"/>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $this->lang->line('CONTENT'); ?>*</label>
                                        <textarea class="form-control" name="sender_content"
                                                  required="required"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="<?php echo $this->lang->line('SEND'); ?>"
                                               name="btn_send" class="btn btn-primary"/>
                                    </div>
                                </form>

                            </div>

                            <div class="col-md-4 col-md-offset-1 col-sm-6 col-sm-offset-0">
                                <div class="contact-details">
                                    <h4></h4>
                                    <p><?php echo $this->lang->line('ISSI_INTRO'); ?></p>

                                    <h5>
                                        <i class="ion ion-ios-location-outline"></i> <?php echo $this->lang->line('ADDRESS'); ?>
                                    </h5>
                                    <p><?php echo $this->lang->line('ISSI_ADDRESS_STREET'); ?>
                                        <br/><?php echo $this->lang->line('ISSI_ADDRESS_CITY'); ?></p>

                                    <h5>
                                        <i class="ion ion-ios-email-outline"></i> <?php echo $this->lang->line('EMAIL'); ?>
                                    </h5>
                                    <p>
                                        <a href="mailto:email@yourdomain.com"><?php echo $this->lang->line('ISSI_EMAIL'); ?></a>
                                    </p>

                                    <h5>
                                        <i class="ion ion-ios-telephone-outline"></i> <?php echo $this->lang->line('PHONE'); ?>
                                    </h5>
                                    <p><?php echo $this->lang->line('ISSI_PHONE'); ?></p>

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- inner container end -->
            </div>
        </div>
    </div>
    <!-- main container end -->

    <!-- map container start -->
    <!--<div class="map-container">
        <div id="map-canvas"></div>
    </div>-->
    <!--<div>
        <div id="demo-marker-map" style="height:300px"></div>
    </div>
    <!-- map container end -->

    <div id="issiloo-map" style="text-align: center">
        <h3>SƠ ĐỒ ĐƯỜNG ĐI</h3>
        <div class="overlay" onclick="style.pointerEvents='none'"></div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.8712223826365!2d106.76981495080219!3d10.821165761286451!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x582a5580cd585a9f!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEvhu7kgbmdo4buHIElJ!5e0!3m2!1sen!2s!4v1500431820435" width="75%" height="450px" frameborder="0" style="border:none" allowfullscreen=""></iframe>
    </div>



<?php $this->load->view('layout/webapp/footer'); ?>