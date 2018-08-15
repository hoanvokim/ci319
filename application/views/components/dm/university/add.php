<?php $attributes = array('enctype' => 'multipart/form-data');
echo form_open('university-manager-create-university-submit', $attributes); ?>

<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Url</label>
    <input type="text" name="url" class="form-control">
</div>
<div class="form-group">
    <label for="upload_file">File upload</label>
    <input type='file' name='userfile' size='20'/>
    <br/>
    <i>Lưu ý: Hình ảnh size chuẩn: 608px * 349px</i>
</div>

<button type="submit" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Lưu</button>
<a href="<?php echo base_url() . "university-manager/create-university-cancel" ?>" type="submit"
   class="btn btn-default btn-xs" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i
        class="fa fa-close"></i> Huỷ</a>
</form>