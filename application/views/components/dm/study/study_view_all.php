<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Tất cả các Phân Nhóm của Du Học</h3>
        <a href="<?php echo base_url() . "study-manager/create-category" ?>"
           class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1
                                                                                                     Phân Nhóm mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th width="20%">Phân Nhóm cha</th>
                <th width="20%">Phân Nhóm hiện tại</th>
                <th width="16%">Ngày thêm</th>
                <th width="16%">Ngày cập nhật</th>
                <th width="23%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?php echo $category['id']; ?></td>
                    <td><i><?php echo $category['parent_id']; ?></i></td>
                    <td> <?php if ($category['isView'] == 1) { ?>
                            <i class="fa fa-eye"></i>
                        <?php } ?>
                        <?php echo $category['vi_name'];?>

                        <?php if (!$category['can_be_write'] && !in_array($category['id'], $this->config->item('cat_duhoc'))) { ?>
                        <a href="<?php echo base_url() . "news-manager/add-news/" . $category['id']; ?>"
                           class="pull-right"><i class="fa fa-pencil-square" data-toggle="tooltip" data-placement="bottom"
                                                 data-original-title="Xem chi tiết"></i></a>
                        <?php } ?>
                    </td>
                    <td><?php echo substr($category['created_date'], 0, 10); ?></td>
                    <td><?php echo substr($category['updated_date'], 0, 10); ?></td>
                    <td>
                        <?php if (!in_array($category['id'], $this->config->item('cat_duhoc'))) { ?>
                            <a href="<?php echo base_url() . "study-manager/add-child/" . $category['id']; ?>"
                               class="btn btn-mint btn-xs"><i class="fa fa-plus-square"></i> Thêm sub </a>
                            <?php if ($category['can_be_edited'] == TRUE) { ?>
                                <a href="<?php echo base_url() . "study-manager/update-category/" . $category['id']; ?>"
                                   class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                            <?php } ?>
                            <?php if (!empty($category['parent_id'])) { ?>
                                <a href="<?php echo base_url() . "study-manager/delete-category/" . $category['id']; ?>"
                                   class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');"><i class="fa fa-close"></i> Xoá</a>
                            <?php }
                        } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "study-manager/create-category" ?>"
           class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1
                                                                                       Phân Nhóm mới</a>
    </div>
</div>