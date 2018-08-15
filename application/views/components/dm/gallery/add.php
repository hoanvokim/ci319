<?php echo form_open_multipart('gallery-corner-manager-create-gallery-submit'); ?>

<div class="form-group">

    <div class="form-group">
        <div class="tab-base">
            <!--Nav Tabs-->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#demo-lft-tab-4">Ảnh</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#demo-lft-tab-5">Video</a>
                </li>
            </ul>

            <!--Tabs Content-->
            <div class="tab-content">
                <div id="demo-lft-tab-4" class="tab-pane fade active in">
                    <div class="form-group">
                        <label for="upload_file">File upload</label>
                        <input type='file' name='userfile' size='20'/>
                        <br/>
                        <i>Lưu ý: Hình ảnh size chuẩn: 1050px * 788px</i>
                    </div>
                </div>
                <div id="demo-lft-tab-5" class="tab-pane fade">
                    <div class="form-group">
                        <label>Youtube link</label>
                        <input type="text" name="img_src" class="form-control">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tiêu đề ảnh</label>
    <textarea name="vi_title" class="form-control"></textarea>
</div>

<button type="submit" class="btn btn-success btn-xs" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default btn-xs" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');"><i class="fa fa-close"></i> Huỷ</button>
</form>
