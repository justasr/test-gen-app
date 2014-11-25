
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo lang('nav_user_tests'); ?> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url()."user/user_tests"; ?>"> <?php echo lang('nav_user_user_tests'); ?> </a>
                    </li>
                    <li class="">
                        <a href="#"> <?php echo lang('nav_user_tests_taken'); ?> <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level collapse" style="height: 0px;">
                            <li>
                                <a href="<?php echo base_url()."user/show_tests_taken_all"; ?>"><?php echo lang('nav_user_tests_taken_all'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()."user/show_tests_taken_polls"; ?>"><?php echo lang('nav_user_tests_taken_polls'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()."user/show_tests_taken_exams"; ?>#"><?php echo lang('nav_user_tests_taken_exams'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url()."user/show_tests_taken_surveys"; ?>"><?php echo lang('nav_user_tests_taken_surveys'); ?></a>
                            </li>

                        </ul>
                        <!-- /.nav-third-level -->
                    </li>

                    <li>
                        <a href="<?php echo base_url()."user/show_tests"; ?>">  Public Tests     <?php // echo lang('nav_user_all_tests'); ?> </a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> <?php echo lang('nav_user_create_test'); ?> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>test/create_manual"> <?php echo lang('nav_user_create_manual'); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>import/xml"> <?php echo lang('nav_user_create_xml'); ?> </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>import/json"> <?php echo lang('nav_user_create_json'); ?> </a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Logout <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="<?php echo base_url(); ?>user/auth/logout"> Logout </a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        <!-- /#side-menu -->

    </div>
    <!-- /.sidebar-collapse -->
</nav>
