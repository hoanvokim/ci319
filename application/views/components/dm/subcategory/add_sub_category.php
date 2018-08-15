<?php echo form_open('sub-category-manager-create-sub-category-submit'); ?>
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tên phân nhóm (Viết dính liền)</label>
    <input type="text" name="slug" class="form-control">
</div>
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tên phân nhóm</label>
    <input type="text" name="viCatName" class="form-control">
</div>

<button type="submit" class="btn btn-success btn-xs" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default btn-xs" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</button>
</form>