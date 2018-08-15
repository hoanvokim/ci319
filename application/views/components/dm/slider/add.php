<?php echo form_open_multipart('slider-manager-create-slider-submit'); ?>

<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tên slider</label>
    <input type="text" name="vi_content" class="form-control">
</div>
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Url</label>
    <input type="text" name="url" class="form-control">
</div>
<div class="form-group">
    <label for="upload_file">File upload</label>
    <input type='file' name='userfile' size='20'/>
    <br/>
    <i>Lưu ý: Hình ảnh size chuẩn: 2000px * 748px</i>
</div>

<button type="submit" class="btn btn-success btn-xs" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default btn-xs" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</button>
</form>
