<?php $this->load->view('layout/webapp/header');  ?>

<?php $this->load->view('components/webapp/banner_start'); ?>

<!-- main container start -->
<div class="inner-container" style="margin-top: 30px;">
    <div class="container">
        <div class="row">
            <!-- inner container start -->
            <div class="inner-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 accordion-container">

                            <?php foreach($faqs as $item){ ?>
                                <div class="panel accordion-panel">
                                    <div class="panel-heading"><h5 class="panel-title"><?php echo $item['question']; ?></h5></div>
                                    <div class="panel-body"><?php echo $item['answer']; ?></div>
                                </div>
                            <?php } ?>

                        </div>


                    </div>
                </div>
            </div>
            <!-- inner container end -->
        </div>
    </div>
</div>
<!-- main container end -->

<?php $this->load->view('layout/webapp/footer'); ?>
