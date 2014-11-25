<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">  <?php echo lang('header_import_xml'); ?> </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php echo $template['partials']['alerts']; ?>


<?php if( isset($output['upload_errors']) && $output['upload_errors'] != "" ): ?>
    <div class="alert alert-info alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $output['upload_errors']; ?>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_import_xml'); ?>
            </div>
            <div class="panel-body">
                <?php echo validation_errors(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo form_open_multipart( "import/xml",array( 'role'=>'form' ) );?>
                            <div class="form-group input-group">
                                <input type="hidden" name="fSubmit" value="1" />
                                <input class="btn btn-default" type="file" name="xmlFile" />
                            </div>
                            <button type="submit" class="btn btn-default"> <?php echo lang('l_submit_import_xml'); ?> </button>
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

