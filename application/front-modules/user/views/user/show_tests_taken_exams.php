<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <?php echo lang('heading_show_tests_taken_exams'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php echo $template['partials']['alerts']; ?>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('heading_show_tests_taken_exams'); ?>
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
    $(document).ready(function() {
        $('#dataTables-show-tests').dataTable( {
            "bFilter": false,
            "bProcessing": true,
            "bServerSide": true,
            "bStateSave": true,
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "ajax_call", "value": "1" } );
            },

            "sAjaxSource": "<?php echo base_url(); ?>user/show_tests_taken_exams_ajax"
        } );
    } );
</script>