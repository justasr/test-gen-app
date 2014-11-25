<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Start Bootstrap - SB Admin Version 2.0 Demo</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()."/assets/css/font-awesome.min.css" ?>" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url(); ?>/assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>/assets/css/sb-admin.css" rel="stylesheet">

    <!-- Data Tables Style -->
    <link href="<?php echo base_url(); ?>assets/css/data_tables/table_style.css" rel="stylesheet">

    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo base_url(); ?>/assets/js/jquery-1.10.2.js"></script>

</head>

<body>



<div id="wrapper">
    <?php  if( isset($template['partials']['nav_head']) ) echo $template['partials']['nav_head']; ?>
    <?php  // ( "/parts/".$template['output']['auth_dir']."/nav_head.php" ) ?>
    <!-- /.navbar-static-top -->
    <?php  if( isset($template['partials']['nav_left']) ) echo $template['partials']['nav_left']; ?>
    <?php // include_once( "/parts/".$template['output']['auth_dir']."/nav_left.php" ) ?>
    <!-- /.navbar-static-side -->

    <div id="page-wrapper">
        <?php echo $template['body']; ?>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="<?php echo base_url(); ?>/assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Page-Level Plugin Scripts - Dashboard -->


<!-- SB Admin Scripts - Include with every page -->
<script src="<?php echo base_url(); ?>/assets/js/sb-admin.js"></script>


<!-- Page data_table script -->
<script src="<?php echo base_url(); ?>assets/js/data_tables/jquery.dataTables.min.js"></script>

</body>

</html>
