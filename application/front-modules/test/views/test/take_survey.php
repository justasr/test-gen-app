<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('header_survey_test_take'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_survey_test_take'); ?>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php echo form_open( "test/take_survey?id=".$output['take_test_info']['test_info']['idtest'], array( 'role'=>'form' ) ); ?>
                        <input type="hidden" name="sub" value="sub" />
                        <?php foreach( $output['take_test_info']['questions_with_answers'] as $question_with_answers ): ?>

                            <!-- START OF QUESTION_TYPE_MULTI_RESPONSE !-->
                            <?php if( Question_model::QUESTION_TYPE_MULTI_RESPONSE == $question_with_answers['question_type'] ): ?>
                                <div id="q_main" class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_con">
                                                <?php foreach($question_with_answers['answers'] as $key => $answer ): ?>
                                                    <tr>
                                                        <td> <input  <?php if( $key == 0 ): ?> checked <?php endif; ?> class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="checkbox" value="<?php echo $answer['idanswer']; ?>" /> </td>
                                                        <td> <p> <?php echo $answer['answer_name']; ?> </p> </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- END OF QUESTION_TYPE_MULTI_RESPONSE !-->

                            <!-- START OF QUESTION_TYPE_MULTI_CHOISE !-->
                            <?php if( Question_model::QUESTION_TYPE_MULTI_CHOISE == $question_with_answers['question_type'] ): ?>
                                <div id="q_main" class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_con">
                                                <?php foreach($question_with_answers['answers'] as $key => $answer ): ?>
                                                    <tr>
                                                        <td> <input <?php if( $key == 0 ): ?> checked <?php endif; ?> class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="radio" value="<?php echo $answer['idanswer']; ?>" /> </td>
                                                        <td>  <?php echo $answer['answer_name']; ?> </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- END OF QUESTION_TYPE_MULTI_CHOISE !-->

                            <!-- START OF QUESTION_TYPE_BLANK !-->
                            <?php if( Question_model::QUESTION_TYPE_BLANK == $question_with_answers['question_type'] ): ?>
                                <div id="q_main" class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="question qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_con">
                                                <tr>
                                                    <td> <input name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="text" value="" /> </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- END OF QUESTION_TYPE_BLANK !-->

                            <!-- START OF QUESTION_TYPE_MULTI_TRUE_FALSE !-->
                            <?php if( Question_model::QUESTION_TYPE_MULTI_TRUE_FALSE == $question_with_answers['question_type'] ): ?>
                                <div id="q_main" class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                        </div>
                                        <div class="panel-body">
                                            <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_con">
                                                <tr>
                                                    <td> <input checked class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="radio" value="<?php echo $question_with_answers['answers'][0]['idanswer'] ?>" > </td>
                                                    <td> <p> <?php echo $question_with_answers['answers'][0]['answer_name'] ?> </p> </td>
                                                </tr>
                                                <tr>
                                                    <td> <input class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="radio" value="<?php echo $question_with_answers['answers'][1]['idanswer'] ?>" > </td>
                                                    <td> <p> <?php echo $question_with_answers['answers'][1]['answer_name'] ?> </p> </td>
                                                </tr>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- END OF QUESTION_TYPE_MULTI_TRUE_FALSE !-->


                        <?php endforeach; ?>

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


