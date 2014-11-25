<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo lang('login_heading');?></h3>
            </div>
            <div class="panel-body">

                <?php echo $template['partials']['alerts']; ?>

                <?php echo form_open("user/auth/login");?>
                    <fieldset>
                        <div class="form-group">
                            <?php echo form_input( $output['identity'] );?>
                        </div>
                        <div class="form-group">
                            <?php echo form_input( $output['password'] );?>
                        </div>
                        <!-- Change this to a button or input when using this as a form -->
                        <?php echo form_input( $output['submit'] );?>
                    </fieldset>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>