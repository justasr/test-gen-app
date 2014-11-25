
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo base_url()."pages/index"; ?>"><i class="fa fa-dashboard fa-fw"></i>  <?php echo lang('nav_index'); ?> </a>
            </li>

            <li>
                <a href="<?php echo base_url()."deposits/make"; ?>"><i class="fa fa-dashboard fa-fw"></i>  <?php echo lang('nav_user_make_deposit'); ?> </a>
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo lang('nav_user_profile'); ?> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url()."user/statistics"; ?>"> <?php echo lang('nav_user_statistics'); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()."user/show_deposits"; ?>"> <?php echo lang('nav_user_deposits'); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()."user/show_withdrawals"; ?>"> <?php echo lang('nav_user_withdrawals'); ?> </a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo lang('nav_info'); ?> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>pages/statistics"> <?php echo lang('nav_stats'); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>pages/faq"> <?php echo lang('nav_faq'); ?> </a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
