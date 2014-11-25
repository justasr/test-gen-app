<div class="row">
    <div class="col-lg-12" >
        <?php if( $this->session->flashdata('message_success') != "" ): ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('message_success'); ?>
            </div>
        <?php endif; ?>

        <?php if( $this->session->flashdata('message_info') != "" ): ?>
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('message_info'); ?>
            </div>
        <?php endif; ?>

        <?php if( $this->session->flashdata('message_warning') != "" ): ?>
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('message_warning'); ?>
            </div>
        <?php endif; ?>

        <?php if( $this->session->flashdata('message_failure') != "" ): ?>

            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('message_failure'); ?>
            </div>
        <?php endif; ?>
    </div>
    <!-- /.col-lg-12 -->
</div>

