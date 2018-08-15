<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title pull-left">Change password</h3>
    </div>
    <div class="panel-body">
        <p class="message <?php echo $this->session->userdata('status'); ?>"><?php echo $this->session->userdata('message'); ?></p>

        <?php echo form_open_multipart('edit-profile-change-password-submit'); ?>

        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Old Password</label>
            <input type="password" name="old_password" class="form-control">
        </div>

        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">New Password</label>
            <input type="password" name="new_password" class="form-control">
        </div>

        <div class="form-group">
            <label for="demo-vs-definput" class="control-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>

        <button type="submit" class="btn btn-success btn-xs" name="save"><i class="fa fa-save"></i> Lưu</button>
        <button type="submit" class="btn btn-default btn-xs" name="cancel"><i class="fa fa-close"></i> Huỷ</button>
        </form>
    </div>
</div>
