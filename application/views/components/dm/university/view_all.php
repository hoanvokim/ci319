<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Tất cả các Trường đại học</h3>
        <a href="<?php echo base_url() . "university-manager/create-university" ?>"
           class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 Trường mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th width="20%">Url</th>
                <th width="23%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($universities as $university) { ?>
                <tr>
                    <td><?php echo $university['id']; ?></td>
                    <td><?php echo $university['url']; ?></td>
                    <td>
                        <a href="<?php echo base_url() . "university-manager/update-university/" . $university['id']; ?>"
                           class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                        <a href="<?php echo base_url() . "university-manager/delete-university/" . $university['id']; ?>"
                           class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "university-manager/create-university" ?>"
           class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 Trường mới</a>
    </div>
</div>