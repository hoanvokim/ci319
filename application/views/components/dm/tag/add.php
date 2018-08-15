<?php echo form_open('tag-manager-create-tag-submit'); ?>
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tên tag</label>
    <input type="text" name="tagName" class="form-control">
</div>
<button type="submit" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Lưu</button>
<a href="<?php echo base_url() . "tag-manager/create-tag-cancel" ?>" type="submit" class="btn btn-default btn-xs" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</a>
</form>