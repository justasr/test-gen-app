<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('header_question_create'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_question_create'); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <?php echo form_open( "question/create/?test_id=".$output['test_info']['idtest'], array( 'role'=>'form' ) ); ?>

                            <div class="form-group">
                                <label><?php echo lang('l_question_name'); ?>:</label>
                                <input type="text" class="form-control" name="question_name" value="" placeholder="How Is Your Day?" />
                            </div>

                            <div class="form-group">
                                <label><?php echo lang('l_question_type'); ?>:</label>
                                <select id="question_type" name="question_type" class="form-control">
                                   <option selected value='-1'></option>
                                  <?php foreach($output['question_types'] as $ID => $question_type ): ?>
                                    <option value="<?php echo $ID ?>" > <?php echo lang('l_'.$question_type['question_type_name'] ); ?> </option>
                                  <?php endforeach; ?>
                                </select>
                            </div>

                            <div id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_main" class="answer-con col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo lang('l_multiple_response'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_con">
                                                <tr>
                                                    <td> <input checked class="test_check_box" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_corrent[]" type="checkbox" value="0" > </td>
                                                    <td> <input type="text" class="form-control" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>[]" value="" class="form-control"> </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p>
                                            <button id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_add" type="button" class="btn btn-warning">Add</button>
                                            <button id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_delete" type="button" class="btn btn-danger">Delete</button>
                                        </p>
                                    </div>
                                    <div class="panel-footer">
                                        <?php echo lang('l_multiple_response'); ?>
                                    </div>
                                </div>
                            </div>

                            <div id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_main" class="answer-con col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo lang('l_multiple_choise'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_con">
                                            <tr>
                                                <td> <input checked class="test_check_box" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_corrent[]" type="radio" value="0" > </td>
                                                <td> <input type="text" class="form-control" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>[]" value="" class="form-control"> </td>
                                            </tr>
                                        </table>
                                        <p>
                                            <button id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_add" type="button" class="btn btn-warning">Add</button>
                                            <button id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_delete" type="button" class="btn btn-danger">Delete</button>
                                        </p>
                                    </div>

                                    <div class="panel-footer">
                                        <?php echo lang('l_multiple_choise'); ?>
                                    </div>
                                </div>
                            </div>

                            <div id="qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_main" class="answer-con col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo lang('l_blank'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_con">
                                            <tr>
                                                <td> <input checked style="display:none" checked class="test_check_box" name="qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_corrent[]" type="checkbox" value="0"> </td>
                                                <td> <input type="text" class="form-control" name="qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>[]" value="" class="form-control"> </td>

                                            </tr>
                                        </table>
                                        <p>
                                            <button id="qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_add" type="button" class="btn btn-warning">Add</button>
                                            <button id="qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_delete" type="button" class="btn btn-danger">Delete</button>
                                        </p>
                                    </div>

                                    <div class="panel-footer">
                                        <?php echo lang('l_blank'); ?>
                                    </div>
                                </div>
                            </div>

                            <div id="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE; ?>_main" class="answer-con col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?php echo lang('l_true_false'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE; ?>_con">
                                            <tr>
                                                <td> <input checked class="test_check_box" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE; ?>_corrent[]" type="radio" value="0" > </td>
                                                <td> <input  value="yes" type="text" class="form-control" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE; ?>[]" value="<?php echo lang('l_yes'); ?>" class="form-control"> </td>
                                            </tr>
                                            <tr>
                                                <td> <input class="test_check_box" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE; ?>_corrent[]" type="radio" value="1" > </td>
                                                <td> <input value="no" type="text" class="form-control" name="qa_<?php echo Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE; ?>[]" value="<?php echo lang('l_no'); ?>" class="form-control"> </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="panel-footer">
                                        <?php echo lang('l_true_false'); ?>
                                    </div>
                                </div>
                            </div>
                             <?php echo form_submit('submit', lang('l_submit'),"class='btn btn-default'");?>
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
<!-- /.row -->

<script type="text/javascript" src="<?php echo base_url(); ?>/assets/js/question.js" />