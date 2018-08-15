<?php echo form_open('faq-manager-update-faq-submit'); ?>
<input type="hidden" id="hide" name="faqId" value="<?php if (!empty($faqId)) {
    echo $faqId;
} ?>">
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tên tag</label>
    <input type="text" name="faqQuestion" class="form-control" value="<?php echo $faqQuestion ?>" />
</div>
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tóm tắt</label>
    <textarea name="contenteditor"><?php echo $faqAnswer; ?></textarea>
</div>
<br/>
<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Lưu</button>
<a href="<?php echo base_url() . "faq-manager/create-faq-cancel" ?>" type="submit" class="btn btn-default"  onclick="return confirm('Bạn muốn thoát ra phải không?');"><i class="fa fa-close"></i> Huỷ</a>
<a href="<?php echo base_url() . "faq-manager/delete-faq/" . $faqId; ?>"
   class="btn btn-danger pull-right" onclick="return confirm('Bạn có muốn xoá không?');"><i class="fa fa-close"></i> Xoá</a>
</form>