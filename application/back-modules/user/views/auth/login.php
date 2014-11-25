<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('login_heading');?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<?php echo $template['partials']['alerts']; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('login_subheading');?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo form_open("user/auth/login");?>

                        <div class="form-group">
                            <label><?php echo lang('login_identity_label', 'identity');?></label>

                            <?php echo form_input( array( 'value' => $output['identity'],'name' => 'identity','class'=>'form-control' ) );?>
                        </div>

                        <div class="form-group">
                            <label><?php echo lang('login_password_label', 'password');?></label>
                            <?php echo form_input( $output['password'],array('class' => 'form-control') );?>
<!--                            <input class="form-control">-->
                        </div>

                        <div class="form-group">
                            <label><?php echo lang('login_remember_label', 'remember');?></label>
                            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                            <!--                            <input class="form-control">-->
                        </div>

                        <div class="form-group">
                            <?php echo form_submit('submit', lang('login_submit_btn'),array('class' => 'btn btn-default'));?>
                            <!--                            <input class="form-control">-->
                        </div>

                        <?php echo form_close();?>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<!--<div id="infoMessage">--><?php //echo $output['message'];?><!--</div>-->
<!---->
<?php //echo form_open("user/auth/login");?>
<!---->
<!--  <p>-->
<!--    --><?php //echo lang('login_identity_label', 'identity');?>
<!--    --><?php //echo form_input( $output['identity'] );?>
<!--  </p>-->
<!---->
<!--  <p>-->
<!--    --><?php //echo lang('login_password_label', 'password');?>
<!--    --><?php //echo form_input( $output['password'] );?>
<!--  </p>-->
<!---->
<!--  <p>-->
<!--    --><?php //echo lang('login_remember_label', 'remember');?>
<!--    --><?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
<!--  </p>-->
<!---->
<!---->
<!--  <p>--><?php //echo form_submit('submit', lang('login_submit_btn'));?><!--</p>-->
<!---->
<?php //echo form_close();?>
<!---->
<!--<p><a href="forgot_password">--><?php //echo lang('login_forgot_password');?><!--</a></p>-->