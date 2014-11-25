<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('header_exam_analize'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="row">

    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Optional Actions
            </div>
            <div class="panel-body">
                <a href="<?php echo base_url()."/user/show_tests_taken_all"; ?>">
                    <button type="button" class="btn btn-primary">Back</button>
                </a>
            </div>
            <div class="panel-footer">
                Optional Actions
            </div>
        </div>
    </div>
    <!-- /.col-lg-4 -->

</div>

<!-- /.row -->
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_exam_analize'); ?>
            </div>
            <div class="panel-body">
                    <input type="hidden" name="sub" value="sub" />
                    <?php foreach( $output['taken_test_prepared']['questions_with_answers'] as $question_with_answers ): ?>

                        <!-- START OF QUESTION_TYPE_MULTI_RESPONSE !-->
                        <?php if( Question_model::QUESTION_TYPE_MULTI_RESPONSE == $question_with_answers['question_type'] ): ?>
                            <div id="q_main" class="col-lg-12">
                                <div class="panel <?php if($question_with_answers['won']): ?> panel-success <?php else: ?> panel-danger <?php endif; ?>">
                                    <div class="panel-heading">
                                        <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_RESPONSE; ?>_con">
                                            <?php foreach($question_with_answers['answers'] as $key => $answer ): ?>
                                                <tr>
                                                    <td> <input disabled <?php if( in_array($answer['idanswer'],$question_with_answers['user_selection']) ): ?> checked <?php endif; ?> class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="checkbox" value="<?php echo $answer['idanswer']; ?>" /> </td>
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
                                <div class="panel <?php if($question_with_answers['won']): ?> panel-success <?php else: ?> panel-danger <?php endif; ?>">
                                    <div class="panel-heading">
                                        <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_con">
                                            <?php foreach($question_with_answers['answers'] as $key => $answer ): ?>
                                                <tr>
                                                    <td> <input disabled <?php if( in_array($answer['idanswer'],$question_with_answers['user_selection']) ): ?> checked <?php endif; ?> class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="radio" value="<?php echo $answer['idanswer']; ?>" /> </td>
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
                                <div class="panel <?php if($question_with_answers['won']): ?> panel-success <?php else: ?> panel-danger <?php endif; ?>">
                                    <div class="panel-heading">
                                        <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_BLANK; ?>_con">
                                            <tr>
                                                <td> <input disabled name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="text" value="<?php echo $question_with_answers['user_selection']; ?>" /> </td>
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
                                <div class="panel <?php if($question_with_answers['won']): ?> panel-success <?php else: ?> panel-danger <?php endif; ?>">
                                    <div class="panel-heading">
                                        <h4><?php echo lang('l_question'); ?>: <?php echo $question_with_answers['question_name'] ?></h4>
                                    </div>
                                    <div class="panel-body">
                                        <table class="question qa_<?php echo Question_model::QUESTION_TYPE_MULTI_CHOISE; ?>_con">
                                            <tr>
                                                <td> <input disabled <?php if( in_array($question_with_answers['answers'][0]['idanswer'],$question_with_answers['user_selection']) ): ?> checked <?php endif; ?> class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="radio" value="<?php $question_with_answers['answers'][0]['idanswer'] ?>" > </td>
                                                <td> <p> <?php echo $question_with_answers['answers'][0]['answer_name'] ?> </p> </td>
                                            </tr>
                                            <tr>
                                                <td> <input disabled <?php if( in_array($question_with_answers['answers'][1]['idanswer'],$question_with_answers['user_selection']) ): ?> checked <?php endif; ?> class="test_check_box" name="choise[<?php echo $question_with_answers['idquestion']; ?>][]" type="radio" value="<?php $question_with_answers['answers'][1]['idanswer'] ?>" > </td>
                                                <td> <p> <?php echo $question_with_answers['answers'][1]['answer_name'] ?> </p> </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- END OF QUESTION_TYPE_MULTI_TRUE_FALSE !-->
                        <?php endforeach; ?>
                    </div>

            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    <!-- /.col-lg-12 -->
<!--    <div class="col-lg-6">-->
<!--        <div class="panel panel-default">-->
<!--            <div class="panel-heading">-->
<!--                --><?php //echo lang('header_test_statistics'); ?>
<!--            </div>-->
<!--            <div class="panel-body">-->
<!--                <div class="col-lg-12">-->
<!--                    <div>-->
<!--                        --><?php //if( $output['taken_test_prepared']['statitics']['passed'] ): ?>
<!--                            <h1 style="color:#217F4E" > Passed! </h2>-->
<!--                        --><?php //else: ?>
<!--                            <h1 style="color:#FF0000" > Failed! </h2>-->
<!--                        --><?php //endif; ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-12">-->
<!--                    <div>-->
<!--                        <p>-->
<!--                            <strong>Wrong </strong>-->
<!--                            <span class="pull-right text-muted">--><?php //echo $output['taken_test_prepared']['statitics']['questions_wrong_precent'];?><!--% of answers </span>-->
<!--                        </p>-->
<!--                        <div class="progress progress-striped active">-->
<!--                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="--><?php //echo $output['taken_test_prepared']['statitics']['questions_wrong_precent'];?><!--" aria-valuemin="0" aria-valuemax="100" style="width: --><?php //echo $output['taken_test_prepared']['statitics']['questions_wrong_precent'];?><!--%">-->
<!--                                <span class="sr-only">--><?php //echo $output['taken_test_prepared']['statitics']['questions_wrong_precent'];?><!--%</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-lg-12">-->
<!--                    <div>-->
<!--                        <p>-->
<!--                            <strong>Good </strong>-->
<!--                            <span class="pull-right text-muted">--><?php //echo $output['taken_test_prepared']['statitics']['questions_right_precent'];?><!--% of answers </span>-->
<!--                        </p>-->
<!--                        <div class="progress progress-striped active">-->
<!--                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="--><?php //echo $output['taken_test_prepared']['statitics']['questions_right_precent'];?><!--" aria-valuemin="0" aria-valuemax="100" style="width: --><?php //echo $output['taken_test_prepared']['statitics']['questions_right_precent'];?><!--%">-->
<!--                                <span class="sr-only">--><?php //echo $output['taken_test_prepared']['statitics']['questions_right_precent'];?><!--%</span>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--            <div class="panel-footer">-->
<!--                --><?php //echo lang('header_test_statistics'); ?>
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_test_statistics'); ?>
            </div>
            <div class="panel-body">
                <div class="col-lg-12">
                    <div>
                        <?php if( $output['taken_test_prepared']['statitics']['passed'] ): ?>
                        <h1 style="color:#217F4E" > Passed! </h2>
                            <?php else: ?>
                            <h1 style="color:#FF0000" > Failed! </h2>
                                <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div id="testOverAll" ></div>
                </div>
            </div>
            <div class="panel-footer">
                <?php echo lang('header_test_statistics'); ?>
            </div>
        </div>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<script type="text/javascript">
    $( document ).ready(function() {

       var analitics_win_text = "<?php echo lang('header_test_exam_questions_right'); ?>";
       var analitics_win_count = <?php echo $output['taken_test_prepared']['statitics']['questions_right']; ?>;

       var analitics_loss_text = "<?php echo lang('header_test_exam_questions_wrong'); ?>";
       var analitics_loss_count = <?php echo $output['taken_test_prepared']['statitics']['questions_wrong']; ?>;

        Morris.Donut({
            element: 'testOverAll',
            data: [
                {label: analitics_win_text, value: analitics_win_count},
                {label: analitics_loss_text, value: analitics_loss_count}
            ],
            colors: [
                '#217F4E',
                '#FF0000'
            ]
        });
    });

</script>