<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('heading_edit'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="panel panel-info">
    <div class="panel-heading">
        Page Actions            </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <ul class="nav nav-horizontal">
            <li>
                <a href="<?php echo base_url()."test/take/?id=".$output['test_info']['idtest']; ?>">  <button type="button" class="btn btn-primary"> <?php echo lang("l_take"); ?> </button> </a>
            </li>
            <li>
                <a href="<?php echo base_url()."export/xml/?id=".$output['test_info']['idtest']; ?>">  <button type="button" class="btn btn-primary"> <?php echo lang("l_export_xml"); ?> </button> </a>
            </li>
            <li>
                <a href="<?php echo base_url()."export/json/?id=".$output['test_info']['idtest']; ?>">  <button type="button" class="btn btn-primary"> <?php echo lang("l_export_json"); ?> </button> </a>
            </li>
        </ul>
    </div>
    <!-- /.panel-body -->
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('heading_edit'); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo form_open( base_url()."test/edit_survey/?id=".$output['test_info']['idtest'],array( 'role'=>'form' ) ); ?>

                        <div class="form-group input-group">
                            <label> <?php echo lang("l_test_name"); ?>:</label>
                            <input  placeholder="<?php echo lang('l_test_name'); ?>" value="<?php echo $output['test_info']['test_name']; ?>" type="text"  value="" name="test_name"  class="form-control">
                        </div>

                        <div class="form-group">
                            <label> <?php echo lang("l_test_types"); ?>:</label>
                            <?php foreach( $output['test_types'] as $test_type ): ?>
                                <div class="radio">
                                    <label>
                                        <input disabled type="radio" name="test_type" <?php if(  $output['test_info']['test_type'] == $test_type['idtest_type'] ): ?> checked <?php endif; ?>  id="test_type<?php echo $test_type['idtest_type'];  ?>" value="<?php echo $test_type['idtest_type']; ?>" ><?php echo lang( 'l_'.$test_type['test_type_name'] ); ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="form-group">
                            <label> <?php echo lang("l_test_status"); ?>:</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="test_status" <?php if(  $output['test_info']['test_status'] == Test_model::TEST_STATUS_PRIVATE ): ?> checked <?php endif; ?>  value="<?php echo Test_model::TEST_STATUS_PRIVATE; ?>" /><?php echo lang( 'l_status_private' ); ?>
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="test_status" <?php if(  $output['test_info']['test_status'] == Test_model::TEST_STATUS_PUBLIC ): ?> checked <?php endif; ?>  value="<?php echo Test_model::TEST_STATUS_PUBLIC ; ?>" /><?php echo lang( 'l_status_public' ); ?>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-default"> <?php echo lang('l_update'); ?> </button>
                        </form>
                    </div>
                    <!-- /.col-lg-6 (nested) -->
                    <div class="col-lg-6">

                    </div>
                    <!-- /.col-lg-6 (nested) -->



                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->

    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Optional Actions
            </div>
            <div class="panel-body">
                <?php if( $output['test_info']['test_status'] == Test_model::TEST_STATUS_PRIVATE ): ?>
                    <a href="<?php echo base_url()."question/create/?test_id=".$output['test_info']['idtest'] ?>"><button type="button" class="btn btn-primary">Add Question</button></a>
                <?php else: ?>
                    <p> Test is now public. Can't add a new question </p>
                <?php endif; ?>
            </div>
            <div class="panel-footer">
                Optional Actions
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_show_questions'); ?>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example" aria-describedby="dataTables-example_info">
                        <thead>
                        <tr role="row">
                            <?php foreach( $output['question_info']['headers'] as $header ):  ?>
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
    <!-- /.col-lg-6 -->
</div>
<!-- /.row -->

<script type="text/javascript" charset="utf-8">
    var testID = <?php echo $output['test_info']['idtest'] ?>;

    var idquestion = 0;
    var test_id = 1;
    var question_name = 2;
    var question_type = 3;
    var action = 4;

    $(document).ready(function() {
        $('#dataTables-example').dataTable( {
            "bProcessing": true,
            "bServerSide": true,
            "bStateSave": true,
            "fnServerParams": function ( aoData ) {
                aoData.push(
                    { "name": "ajax_call", "value": "1" },
                    { "name": "id", "value": testID }
                );
            },
            "sAjaxSource": "<?php echo base_url(); ?>test/show_test_questions_ajax/",

            "aoColumnDefs":[
                { "bSortable": false, "aTargets": [ action ] }
            ]

        } );
    } );
</script>