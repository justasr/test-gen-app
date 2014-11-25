<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">  <?php echo lang('header_test_create_manual'); ?> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php echo $template['partials']['alerts']; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('heading_test_create_manual'); ?>
            </div>
            <div class="panel-body">
                <?php echo validation_errors(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo form_open( "test/create_manual",array( 'role'=>'form' ) ); ?>

                        <div class="form-group input-group">
                            <label> <?php echo lang("l_test_name"); ?>:</label>
                            <input  placeholder="<?php echo lang('l_test_name'); ?>" type="text"  value="" name="test_name"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label> <?php echo lang("l_test_types"); ?>:</label>
                            <?php foreach( $output['test_types'] as $test_type ): ?>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="test_type" <?php echo set_radio('test_type', $test_type['idtest_type'] ); ?>  id="test_type<?php echo $test_type['idtest_type'];  ?>" value="<?php echo $test_type['idtest_type']; ?>" ><?php echo lang( 'l_'.$test_type['test_type_name'] ); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <button type="submit" class="btn btn-default"> <?php echo lang('l_submit_test_create_manual'); ?> </button>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>

