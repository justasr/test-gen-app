
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo lang('nav_clients'); ?> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>user/auth/login"> <?php echo lang('nav_login'); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>user/auth/register"> <?php echo lang('nav_register'); ?> </a>
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
