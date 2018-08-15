<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Quản lý gallery</h3>
        <a href="<?php echo base_url() . "gallery-corner-manager/create-gallery" ?>" class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 ảnh mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">Ảnh</th>
                <th width="15%">Tiêu đề</th>
                <th width="15%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($galleries as $gallery) { ?>
                <tr>
                    <td><?php echo $gallery['id']; ?></td>
                    <td> <?php if (strpos($gallery['img_src'], 'youtube') == false) { ?>
                            <img src="<?php echo base_url() . $gallery['img_src']; ?> " height="120px;"/>
                        <?php } else { ?>
                            <img src="<?php echo $gallery['youtube']; ?>" alt=""
                                 style="height:120px;"/>
                        <?php } ?></td>
                    <td><?php echo $gallery['vi_title']; ?></td>
                    <td>
                        <a href="<?php echo base_url() . "gallery-corner-manager/update-gallery/" . $gallery['id']; ?>"
                           class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                        <a href="<?php echo base_url() . "gallery-corner-manager/delete-gallery/" . $gallery['id']; ?>"
                           class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');"><i class="fa fa-close"></i> Xoá</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "gallery-corner-manager/create-gallery" ?>" class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 ảnh mới
        </a>
    </div>
</div>