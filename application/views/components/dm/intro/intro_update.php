<?php foreach ($intros as $intro) { ?>
    <?php echo form_open('intro-manager-update-submit'); ?>
    <input type="hidden" id="hide" name="catId" value="<?php echo $intro['catId']; ?>">
    <div class="form-group">
        <label for="demo-vs-definput" class="control-label">Tên tab</label>
        <input type="text" name="viTabName" class="form-control" value="<?php echo $intro['viCatName']; ?>">
    </div>

    <!--Summernote-->
    <!--===================================================-->
    <textarea name="contenteditor"><?php echo $intro['viNewsContent']; ?></textarea>
    <!--===================================================-->
    <!-- End Summernote -->
    <br/>
    <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-save"></i> Cập nhật</button>
    <a href="<?php echo base_url() . "intro-manager/update-cancel" ?>" type="submit"
       class="btn btn-default btn-xs" onclick="return confirm('Bạn muốn thoát ra phải không?');"><i class="fa fa-close"></i> Huỷ</a>
    </form>
<?php } ?>