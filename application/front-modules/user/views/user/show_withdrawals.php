<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <?php echo lang('heading_show_withdrawals'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

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
                    <a href="<?php echo base_url()."withdrawals/make" ?>" > <button type="button" class="btn btn-primary"> <?php echo lang('submit_make_withdrawal'); ?> </button> </a>
                </p>

            </div>
            <!-- /.panel-body -->
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_show_withdrawals'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer" id="withdrawals-table" aria-describedby="dataTables-example_info">
                                <thead>
                                <tr role="row">
                                    <?php foreach( $output['columns'] as $column ):  ?>
                                        <th> <?php echo $column ?>  </th>
                                    <?php  endforeach; ?>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                <div class="row">

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
        $('#withdrawals-table').dataTable( {
            "bFilter": false,
            "bProcessing": true,
            "bServerSide": true,
            "bStateSave": true,
            "fnServerParams": function ( aoData ) {
                aoData.push( { "name": "ajax_call", "value": "1" } );
            },
            "fnRowCallback": function( nRow, aData, iDisplayIndex ) {

                if( aData[0] == '<?php echo $this->config->item('PAYMENT_STATUS_PENDING_ID'); ?>'  )
                    nRow.className = 'info';
                else if( aData[0] == '<?php echo $this->config->item('PAYMENT_STATUS_CANCELED_ID'); ?>'  )
                    nRow.className = 'danger';
                else if( aData[0] == '<?php echo $this->config->item('PAYMENT_STATUS_FINISHED_ID'); ?>'  )
                    nRow.className = 'success';

                return nRow;
            },
            "sAjaxSource": "<?php echo base_url(); ?>/user/show_withdrawals_ajax",

            "aoColumnDefs":[{
                "aTargets": [ status ]
                , "mRender": function ( data )  {
                    if( data == <?php echo $this->config->item('PAYMENT_STATUS_PENDING_ID'); ?> )
                        return  '<?php echo lang("PAYMENT_STATUS_PENDING"); ?>';
                    else if( data == <?php echo $this->config->item('PAYMENT_STATUS_CANCELED_ID'); ?> )
                        return  '<?php echo lang("PAYMENT_STATUS_CANCELED"); ?>';
                    else if( data == <?php echo $this->config->item('PAYMENT_STATUS_FINISHED_ID'); ?> )
                        return  '<?php echo lang("PAYMENT_STATUS_FINISHED"); ?>';
                }
            },{
                "aTargets": [ asked_date ],
                "mRender": function ( data )  {
                    if( data )
                        return data;
                    else
                        return '<?php echo lang('date_null'); ?>';
                }
            },{
                "aTargets": [ confirm_date ],
                "mRender": function ( data )  {
                    if( data )
                        return data;
                    else
                        return '<?php echo lang('date_null'); ?>';
                }
            },{
                "aTargets": [ cancel_date ],
                "mRender": function ( data )  {
                    if( data )
                        return data;
                    else
                        return '<?php echo lang('date_null'); ?>';
                }
            }]

        } );
    } );
</script>