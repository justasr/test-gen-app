
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo lang('register_user_heading');?></h3>
            </div>
            <div class="panel-body">

                <?php echo $template['partials']['alerts']; ?>

                <?php echo form_open( base_url()."user/auth/register");?>
                <fieldset>
                    <div class="form-group">
                        <?php echo lang('register_user_username_label', 'username');?> <br />
                        <?php echo form_input($output['username']);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('register_user_fname_label', 'first_name');?> <br />
                        <?php echo form_input($output['first_name']);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('register_user_lname_label', 'last_name');?> <br />
                        <?php echo form_input($output['last_name']);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('register_user_email_label', 'email');?> <br />
                        <?php echo form_input($output['email']);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('register_user_password_label', 'password');?> <br />
                        <?php echo form_input($output['password']);?>
                    </div>
                    <div class="form-group">
                        <?php echo lang('register_user_password_confirm_label', 'password_confirm');?> <br />
                        <?php echo form_input($output['password_confirm']);?>
                    </div>
                    <!-- Change this to a button or input when using this as a form -->
                    <?php echo form_input( $output['submit'] );?>
                </fieldset>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

