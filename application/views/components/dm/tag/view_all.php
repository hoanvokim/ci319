<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Tất cả các Tabs hiện tại</h3>
        <a href="<?php echo base_url() . "tag-manager/create-tag" ?>" class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 tab mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">TabID</th>
                <th width="10%">Tên tag</th>
                <th width="15%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tags as $tag) { ?>
                <tr>
                    <td><?php echo $tag['id']; ?></td>
                    <td><?php echo $tag['name']; ?></td>
                    <td>
                        <a href="<?php echo base_url() . "tag-manager/update-tag/" . $tag['id']; ?>"
                           class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                        <a href="<?php echo base_url() . "tag-manager/delete-tag/" . $tag['id']; ?>"
                           class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "tag-manager/create-tag" ?>" class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 tab
            mới</a>
    </div>
</div>