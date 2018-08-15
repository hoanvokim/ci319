<?php echo form_open_multipart('gallery-corner-manager-update-gallery-submit'); ?>

<input type="hidden" id="hide" name="id" value="<?php echo $id; ?>" />

<div class="form-group">
    <?php if (!empty($img_src)) { ?>
        <?php if (strpos($img_src, 'youtube') == false) { ?>
            <img src="<?php echo base_url() . $img_src; ?> " height="120px;"/>
        <?php } else { ?>
            <img src="<?php echo $youtube_thumbnail; ?>" alt=""
                 style="height:120px;"/>
        <?php } ?>
        <input type="hidden" id="hide" name="img_src" value="<?php echo $img_src; ?>">
        <br/>
        <br/>
        <button type="submit" class="btn btn-danger btn-xs" name="delete-img"  onclick="return confirm('Bạn có muốn xoá không?');"><i
                class="fa fa-close"></i> Xoá
        </button>
    <?php } else { ?>
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
                        <label for="upload_file">Youtube link</label>
                        <input type="text" name="img_src" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="form-group">
    <label for="demo-vs-definput" class="control-label">Tiêu đề ảnh</label>
    <textarea name="vi_title" class="form-control"><?php echo $vi_title; ?></textarea>
</div>

<button type="submit" class="btn btn-success" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</button>
<button type="submit" class="btn btn-danger pull-right" name="delete" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</button>
</form>
