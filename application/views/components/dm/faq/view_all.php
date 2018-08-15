<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Hỏi và Đáp</h3>
        <a href="<?php echo base_url() . "faq-manager/create-faq" ?>" class="btn btn-success pull-right btn-top-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 câu hỏi đáp mới</a>
    </div>
    <div class="panel-body">
        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th width="5%">Id</th>
                <th width="10%">Câu hỏi</th>
                <th width="10%">Ngày tạo</th>
                <th width="10%">Ngày cập nhật</th>
                <th width="15%">Tác vụ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($faqs as $faq) { ?>
                <tr>
                    <td><?php echo $faq['id']; ?></td>
                    <td><?php echo $faq['vi_question']; ?></td>
                    <td><?php echo substr($faq['created_date'],0,10); ?></td>
                    <td><?php echo substr($faq['updated_date'],0,10); ?></td>
                    <td>
                        <a href="<?php echo base_url() . "faq-manager/update-faq/" . $faq['id']; ?>"
                           class="btn btn-default btn-xs"><i class="fa fa-pencil-square"></i> Sửa</a>
                        <a href="<?php echo base_url() . "faq-manager/delete-faq/" . $faq['id']; ?>"
                           class="btn btn-danger btn-xs pull-right" onclick="return confirm('Bạn có muốn xoá không?');"><i class="fa fa-close"></i> Xoá</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url() . "faq-manager/create-faq" ?>" class="btn btn-success pull-right btn-xs"><i class="fa fa-plus-square"></i> Thêm 1 câu hỏi đáp mới</a>
    </div>
</div>