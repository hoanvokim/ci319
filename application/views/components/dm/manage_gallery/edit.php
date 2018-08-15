<?php echo form_open_multipart('gallery-manager-update-gallery-submit'); ?>
<?php if ($hasImg == 0) { ?>
    <div class="form-group">
        <label for="upload_file">File upload</label>
        <input type='file' name='userfileDefaultbanner' size='30'/>
        <br/>
        <i>Lưu ý: Hình ảnh size chuẩn: 200px * 200px</i>
    </div>
<?php } else { ?>
    <div class="form-group">
        <label for="demo-vs-definput" class="control-label">Hình ảnh</label>
        <br/>
        <img src="<?php echo base_url() . $defaultbanner['value']; ?>" style="height: 100px;"/>
        <input type="hidden" id="hide" name="defaultbannerimg" value="<?php echo $defaultbanner['key']; ?>"/>
        <button type="submit" class="btn btn-danger btn-xs" name="delete-img-defaultbanner" style="margin-left: 15px;"><i
                class="fa fa-close"></i> Xoá ảnh
        </button>
    </div>
<?php } ?>
<input type="hidden" id="hide" name="param" value="<?php echo $defaultbanner['key']; ?>"/>
<button type="submit" class="btn btn-success" name="save-defaultbanner"><i class="fa fa-save"></i> Lưu</button>
</form>