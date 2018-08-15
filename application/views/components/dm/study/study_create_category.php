<?php echo form_open('study-manager-create-category-submit'); ?>

<div class="form-group">
    <label class="control-label"> Phân nhóm cha </label>
    <div>
        <select class="form-control selectpicker" name="parentCatId">
            <?php foreach ($categories as $category) { ?>
                <option value="<?php echo $category['id'] ?>"><?php echo $category['vi_name'] ?></option>
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

<button type="submit" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Lưu</button>
<a href="<?php echo base_url() . "study-manager/create-category-cancel" ?>" type="submit"
   class="btn btn-default btn-xs" onclick="return confirm('Bạn muốn thoát ra phải không?');" ><i
        class="fa fa-close"></i> Huỷ</a>
</form>