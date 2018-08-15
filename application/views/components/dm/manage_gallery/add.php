<?php echo form_open_multipart('gallery-manager-create-gallery-submit'); ?>
<div class="form-group">
    <label for="upload_file">File upload</label>
    <input type='file' multiple name='userfile[]' size='20'/>
</div>

<!--===================================================-->
<!--End Default Tabs (Left Aligned)-->
<button type="submit" class="btn btn-success btn" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default btn" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</button>
</form>