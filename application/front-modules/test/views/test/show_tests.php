<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <?php echo lang('heading_show_deposits'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php echo $template['partials']['alerts']; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <?php echo lang('action_panel'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <p>
                    <a href="<?php echo base_url()."deposits/make" ?>" > <button type="button" class="btn btn-primary"> <?php echo lang('submit_make_deposit'); ?> </button> </a>
                </p>

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_show_deposits'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-show-tests" aria-describedby="dataTables-show-tests">
                        <thead>
                        <tr role="row">
                            <?php foreach( $output['headers'] as $header ):  ?>
                                <th> <?php echo $header ?>  </th>
                            <?php  endforeach; ?>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<script type="text/javascript" charset="utf-8">
    var status = 0;
    var payment_type = 1;
    var asked_date = 2;
    var confirm_date = 3;
    var cancel_date = 4;
    var amount = 5;
    $(document).ready(function() {
        $('#dataTables-show-tests').dataTable( {
            "bFilter": false,
            "bProcessing": true,
            "bServerSide": true,
            "bStateSave": true,
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "ajax_call", "value": "1" } );
            },

            "sAjaxSource": "<?php echo base_url(); ?>user/show_tests_ajax"
        } );
    } );
</script>