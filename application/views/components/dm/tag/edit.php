<?php echo form_open('tag-manager-update-tag-submit'); ?>
<input type="hidden" id="hide" name="tagId" value="<?php if (!empty($tagId)) {
    echo $tagId;
} ?>">
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tên tag</label>
    <input type="text" name="tagName" class="form-control" value="<?php echo $tagName; ?>">
</div>
<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Lưu</button>
<a href="<?php echo base_url() . "tag-manager/create-tag-cancel" ?>" type="submit" class="btn btn-default" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</a>
<a href="<?php echo base_url() . "tag-manager/delete-tag/" . $tagId; ?>"
   class="btn btn-danger pull-right" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</a>
</form>