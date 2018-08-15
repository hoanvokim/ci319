<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Tất cả các bài viết của Góc chia sẽ</h3>
        <a href="<?php echo base_url() . "learning-tips-manager/create-learning-tips" ?>"
           class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 bài mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th width="20%">Tiêu đề</th>
                <th width="20%">Tóm tắt</th>
                <th width="10%">Ngày tạo</th>
                <th width="10%">Ngày cập nhật</th>
                <th width="15%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($programs as $program) { ?>
                <tr>
                    <td><?php echo $program['id']; ?></td>
                    <td><?php echo $program['title']; ?></td>
                    <td><?php echo $program['summary']; ?></td>
                    <td><?php echo substr($program['created_date'],0,10); ?></td>
                    <td><?php echo substr($program['updated_date'],0,10); ?></td>
                    <td>
                        <a href="<?php echo base_url() . "learning-tips-manager/update-learning-tips/" . $program['id']; ?>"
                           class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                        <a href="<?php echo base_url() . "learning-tips-manager/delete-learning-tips/" . $program['id']; ?>"
                           class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "learning-tips-manager/create-learning-tips" ?>"
           class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 bài mới</a>
    </div>
</div>