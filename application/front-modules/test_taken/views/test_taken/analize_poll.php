<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php echo lang('header_poll_analize'); ?></h1>
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
                <?php echo lang('header_poll_analize'); ?>
            </div>
            <div class="panel-body">
                <input type="hidden" name="sub" value="sub" />
                <?php foreach( $output['taken_test_prepared']['questions_with_answers'] as $question_with_answers ): ?>

                    <!-- START OF QUESTION_TYPE_MULTI_RESPONSE !-->
                    <?php if( Question_model::QUESTION_TYPE_MULTI_RESPONSE == $question_with_answers['question_type'] ): ?>
                        <div id="q_main" class="col-lg-12">
                            <div class="panel panel-primary">
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
                            <div class="panel panel-primary">
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
                            <div class="panel panel-primary">
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
                            <div class="panel panel-primary">
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
    <!-- /.col-lg-6 -->
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?php echo lang('header_poll_analize'); ?>
            </div>
            <div class="panel-body">

                <?php // echo "<pre>"; print_r($output['take_test_analitics']['questions_with_answers']); exit; ?>

                <?php foreach($output['take_test_analitics']['questions_with_answers'] as $question_id => $question ): ?>
                    <?php
                        $pollDATA = array();
                        $pollDATA['xkey'] = $question['question_name'];
                        $pollDATA['data'][100] =  $pollDATA['xkey'];

                    ?>
                    <?php foreach($question['answers'] as $answer_id => $answer ): ?>
                        <?php
                            $pollDATA['data'][] = $answer['usersTotalSelectedProc'];
                            $pollDATA['labels'][] = $answer['answer_name'];
                        ?>
                    <?php endforeach; ?>

                    <?php
                        $pollDATA['ykeys'] = $pollDATA['data'];
                        unset($pollDATA['ykeys'][100]);
                        $pollDATA['ykeys'] = array_keys( $pollDATA['ykeys'] );

                    ?>

                    <div id="poll-statistics-<?php echo $question_id;?>"></div>
                    <script type="text/javascript">
                        var_data_json = $.parseJSON('<?php echo json_encode($pollDATA); ?>');
                        console.log(var_data_json['data']);

                        $( document ).ready(function() {
                            Morris.Bar({
                                element: 'poll-statistics-<?php echo $question_id;?>',
                                data: [ var_data_json['data'] ],
                                xkey: '100',
                                ymax: 100,
                                ykeys: var_data_json['ykeys'],
                                labels:  var_data_json['labels']
                            });
                        });

                    </script>

                <?php endforeach; ?>
<!--                <div id="poll-statistics"></div>-->
            </div>

        </div>
        <!-- /.panel-body -->
    </div>
</div>
<!-- /.row -->


<script type="text/javascript">
    $( document ).ready(function() {

        var analitics_win_text = "<?php echo lang('header_test_exam_questions_right'); ?>";
        var analitics_win_count = <?php echo $output['taken_test_prepared']['statitics']['total_questions']; ?>;

        var analitics_loss_text = "<?php echo lang('header_test_exam_questions_wrong'); ?>";
        var analitics_loss_count = <?php echo $output['taken_test_prepared']['statitics']['questions_wrong']; ?>;

        var_data =  [ { 100: '2006', 1: 100,2: 50,3: 25 } ];
        var_xkey =  '100';
        var_ykeys =  [ '1','2','3' ];
        var_labels = ['Series A', 'Series B'];

        Morris.Bar({
            element: 'poll-statistics',
            data: var_data,
            xkey: var_xkey,
            ykeys: var_ykeys,
            labels: var_labels
        });
    });
</script>
