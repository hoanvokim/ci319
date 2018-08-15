<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Thêm con của phân khúc: <b><?php foreach ($currentCategory as $currentCat) {
                    echo $currentCat['vi_name'];
                } ?> </b></h3>
    </div>
    <div class="panel-body">
        <?php echo form_open('study-manager-add-child-category-submit'); ?>

        <input type="hidden" id="hide" name="catId" value="<?php echo $catId; ?>">
        <div class="form-group">
            <label class="control-label"> Phân nhóm cha </label>
            <div>
                <select class="form-control selectpicker"
                        name="parentCatId" disabled>
                    <?php foreach ($currentCategory as $category) { ?>
                        <option
                            value="<?php echo $category['id'] ?>" <?php foreach ($parentCategory as $parentCat) {
                            if (strcmp($parentCat['vi_name'], $category['vi_name']) == 0) {
                                echo 'selected';
                            }
                        } ?>
                        ><?php echo $category['vi_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Tên trên thanh tiêu đề</label>
            <input type="text" name="slug" class="form-control">
        </div>
        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Tên phân nhóm</label>
            <input type="text" name="viCatName" class="form-control">
        </div>
        <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Cập nhật</button>
        <a href="<?php echo base_url() . "study-manager/update-category-cancel" ?>" type="submit"
           class="btn btn-default btn-xs" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i
                class="fa fa-close"></i> Huỷ</a>
        </form>
    </div>
</div>