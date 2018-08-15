<?php echo form_open_multipart('sharing-manager-update-sharing-submit'); ?>
<input type="hidden" id="hide" name="newsId" value="<?php if (!empty($newsId)) {
    echo $newsId;
} ?>">
<!--Default Tabs (Left Aligned)-->
<!--===================================================-->
<div class="tab-base">
    <!--Nav Tabs-->
    <ul class="nav nav-tabs">
        <li class="active">
            <a data-toggle="tab" href="#demo-lft-tab-1"> Tổng quan </a>
        </li>
        <li>
            <a data-toggle="tab" href="#demo-lft-tab-2"> Tóm tắt bài viết</a>
        </li>
        <li>
            <a data-toggle="tab" href="#demo-lft-tab-3"> Nội dung bài viết</a>
        </li>
    </ul>
    <!--Tabs Content-->
    <div class="tab-content">
        <div id="demo-lft-tab-1" class="tab-pane fade active in">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Tổng quan</h3>
                </div>
                <div class="panel-body">
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
                            <button type="submit" class="btn btn-danger btn-xs" name="remove-current"><i
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
                                            <input type='file' name='albumFile' size='20'>
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
                </div>
            </div>

            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">SEO</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Đường dẫn trên thanh địa chỉ <span style="font-style: italic; font-size: 10px; padding-left: 10px;">(Xin vui lòng <span style="font-style: italic; font-size: 10px; color: red;"> không để trống</span> và nhập tiếng việt không dấu, và viết cách nhau bằng dấu "-" (ví dụ: chuong-trinh-du-hoc-issiloo))</span></label>
                        <input type="text" name="slug" class="form-control" value="<?php echo $slug; ?>">
                    </div>
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Tiêu đề [SEO]</label>
                        <input type="text" name="title_header" class="form-control"
                               value="<?php echo $title_header; ?>">
                    </div>
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Đặc tả [SEO]</label>
                        <input type="text" name="description_header" class="form-control"
                               value="<?php echo $description_header; ?>">
                    </div>
                    <div class="form-group">
                        <label for="demo-vs-definput" class="control-label">Từ khoá [SEO]</label>
                        <input type="text" name="keyword_header" class="form-control"
                               value="<?php echo $keyword_header; ?>">
                    </div>
                </div>
            </div>

            <!--Handle Image-->
            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Hình ảnh</label>
                <div class="tab-base">

                    <!--Nav Tabs-->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#demo-lft-tab-6"> Duyệt ảnh </a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#demo-lft-tab-7">Thêm ảnh</a>
                        </li>
                    </ul>

                    <!--Tabs Content-->
                    <div class="tab-content">
                        <div id="demo-lft-tab-6" class="tab-pane fade active in">
                            <?php foreach ($images as $img) { ?>
                                <div class="checkbox">
                                    <label class="form-checkbox form-icon">
                                        <input type="checkbox" name="deleteimg[]" value="<?php echo $img['id'] ?>"> <img
                                            src="<?php echo base_url() . $img['img_src'] ?>"
                                            style="height: 50px;"> <?php echo $img['vi_title'] ?></label>
                                </div>
                            <?php } ?>
                            <button type="submit" class="btn btn-danger btn-xs" name="delete-img"><i
                                    class="fa fa-close"></i> Xoá
                                ảnh
                            </button>
                        </div>
                        <div id="demo-lft-tab-7" class="tab-pane fade">

                            <div class="form-group">
                                <label for="upload_file">File upload</label>
                                <input type="file" multiple name="userfile[]"/>
                                <br/>
                                <button type="submit" class="btn btn-success btn-xs" name="add-img"><i
                                        class="fa fa-save"></i> Thêm
                                    ảnh
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($tags != null): ?>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="packing">Tags</label>
                        <select class="form-control select2 populate" multiple="multiple" id="tags_dropdown"
                                name="tags[]">
                            <?php foreach ($tags as $tag): ?>
                                <option value="<?php echo $tag['id'] ?>"
                                    <?php
                                    foreach ($selectedTags as $selected) {
                                        if($tag['id']==$selected['tag_id']) {
                                            echo ' selected ';
                                        }
                                    }
                                    ?>
                                ><?php echo $tag['name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
            <?php endif ?>
        </div>
        <div id="demo-lft-tab-2" class="tab-pane fade">
            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Tóm tắt</label>
                <textarea name="summaryeditor" class="form-control" style="min-height: 300px;"><?php echo $visummary; ?></textarea>
            </div>

        </div>

        <div id="demo-lft-tab-3" class="tab-pane fade">
            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Tên bài viết</label>
                <input type="text" name="vititle" class="form-control" value="<?php echo $vititle; ?>">
            </div>

            <div class="form-group">
                <label for="demo-vs-definput" class="control-label">Nội dung bài viết</label>
                <textarea name="contenteditor"><?php echo $vicontent; ?></textarea>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--End Default Tabs (Left Aligned)-->
<button type="submit" class="btn btn-success" name="save"><i class="fa fa-save"></i> Lưu</button>
<button type="submit" class="btn btn-default" name="cancel" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i class="fa fa-close"></i> Huỷ</button>
<button type="submit" class="btn btn-danger pull-right" name="delete" onclick="return confirm('Bạn có muốn xoá không?');" ><i class="fa fa-close"></i> Xoá</button>
</form>