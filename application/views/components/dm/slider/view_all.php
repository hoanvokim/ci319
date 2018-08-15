<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Quản lý các Slider</h3>
        <a href="<?php echo base_url() . "slider-manager/create-slider" ?>" class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 Slider mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="10%">Ảnh</th>
                <th width="10%">Tên</th>
                <th width="10%">url</th>
                <th width="15%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sliders as $slider) { ?>
                <tr>
                    <td><?php echo $slider['id']; ?></td>
                    <td><img src="<?php echo  base_url() . $slider['img_src']; ?>" style="height: 50px;"/></td>
                    <td><?php echo $slider['vi_content']; ?></td>
                    <td><?php echo $slider['url']; ?></td>
                    <td>
                        <a href="<?php echo base_url() . "slider-manager/update-slider/" . $slider['id']; ?>"
                           class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                        <a href="<?php echo base_url() . "slider-manager/delete-slider/" . $slider['id']; ?>"
                           class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "slider-manager/create-slider" ?>" class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 Slider mới
            </a>
    </div>
</div>