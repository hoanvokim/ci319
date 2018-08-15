<?php $attributes = array('enctype' => 'multipart/form-data');
echo form_open('university-manager-update-university-submit', $attributes); ?>

<input type="hidden" id="hide" name="uniId" value="<?php echo $id; ?>">
<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Url</label>
    <input type="text" name="url" class="form-control" value="<?php echo $url; ?>">
</div>
<?php if ($hasImg == 0) { ?>
    <div class="form-group">
        <label for="upload_file">File upload</label>
        <input type='file' name='userfile' size='20'/>
        <br/>
        <i>Lưu ý: Hình ảnh size chuẩn: 200px * 200px</i>
    </div>
<?php } else { ?>
    <div class="form-group">
        <label for="demo-vs-definput" class="control-label">Hình ảnh</label>
        <br/>
        <img src="<?php echo base_url() . $img; ?>" style="height: 100px;"/>
        <input type="hidden" id="hide" name="img" value="<?php echo $img; ?>"/>
        <button type="submit" class="btn btn-danger btn-xs" name="delete-img" style="margin-left: 15px;"><i
                    class="fa fa-close"></i> Xoá
            ảnh
        </button>
    </div>
<?php } ?>
<button type="submit" class="btn btn-success" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</button>
<button type="submit" class="btn btn-danger pull-right" name="delete" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</button>
</form>