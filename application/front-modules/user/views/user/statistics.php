<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> <?php echo lang('header_statistics'); ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php echo $template['partials']['alerts']; ?>
            <div class="row">

                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo lang( 'header_bankroll_statistics' ); ?>
                        </div>
                        <div class="panel-body">
                            <p>
                                <dl>
                                    <dt><?php echo lang( 'l_bankroll_sum' ); ?></dt>
                                    <dd><?php echo $output['bankroll']['sum'] ?></dd>
<!--                                    <dt>--><?php //echo lang( 'l_bankroll_profit' ); ?><!--</dt>-->
<!--                                    <dd>--><?php //echo $output['bankroll']['profit']; ?><!--</dd>-->
<!--                                    <dt>--><?php //echo lang( 'l_bankroll_loss' ); ?><!--</dt>-->
<!--                                    <dd>--><?php //echo $output['bankroll']['loss']; ?><!--</dd>-->
<!--                                    <dt>--><?php //echo lang( 'l_bankroll_balance' ); ?><!--</dt>-->
<!--                                    <dd>--><?php //echo $output['bankroll']['balance']; ?><!--</dd>-->
                                </dl>
                                </p>
                        </div>
                        <div class="panel-footer">
                            <?php echo lang( 'header_bankroll_statistics' ); ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo lang( 'deposits_statistics' ); ?>
                        </div>
                        <div class="panel-body">
                            <p>
                                <dl>
                                    <dt><?php echo lang( 'l_deposits_finished_count' ); ?></dt>
                                    <dd><?php echo $output['deposits']['finished']['count']; ?></dd>
                                    <dt><?php echo lang( 'l_deposits_finished_sum' ); ?></dt>
                                    <dd><?php echo $output['deposits']['finished']['sum']; ?></dd>

                                    <dt><?php echo lang( 'l_deposits_pending_count' ); ?></dt>
                                    <dd><?php echo $output['deposits']['pending']['count']; ?></dd>
                                    <dt><?php echo lang( 'l_deposits_pending_sum' ); ?></dt>
                                    <dd><?php echo $output['deposits']['pending']['sum']; ?></dd>

                                    <dt><?php echo lang( 'l_deposits_canceled_count' ); ?></dt>
                                    <dd><?php echo $output['deposits']['canceled']['count']; ?></dd>
                                    <dt><?php echo lang( 'l_deposits_canceled_sum' ); ?></dt>
                                    <dd><?php echo $output['deposits']['canceled']['sum']; ?></dd>

                                </dl>
                            </p>
                        </div>
                        <div class="panel-footer">
                            <?php echo lang( 'deposits_statistics' ); ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php echo lang( 'withdrawal_statistics' ); ?>
                        </div>
                        <div class="panel-body">
                            <p>
                            <dl>
                                <dt><?php echo lang( 'l_withdrawals_finished_count' ); ?></dt>
                                <dd><?php echo $output['withdrawals']['finished']['count']; ?></dd>
                                <dt><?php echo lang( 'l_withdrawals_finished_sum' ); ?></dt>
                                <dd><?php echo $output['withdrawals']['finished']['sum']; ?></dd>

                                <dt><?php echo lang( 'l_withdrawals_pending_count' ); ?></dt>
                                <dd><?php echo $output['withdrawals']['pending']['count']; ?></dd>
                                <dt><?php echo lang( 'l_withdrawals_pending_sum' ); ?></dt>
                                <dd><?php echo $output['withdrawals']['pending']['sum']; ?></dd>

                                <dt><?php echo lang( 'l_withdrawals_canceled_count' ); ?></dt>
                                <dd><?php echo $output['withdrawals']['canceled']['count']; ?></dd>
                                <dt><?php echo lang( 'l_withdrawals_canceled_sum' ); ?></dt>
                                <dd><?php echo $output['withdrawals']['canceled']['sum']; ?></dd>

                            </dl>
                            </p>
                        </div>
                        <div class="panel-footer">
                            <?php echo lang( 'withdrawal_statistics' ); ?>
                        </div>
                    </div>
                </div>
</div>
<!-- /.row -->