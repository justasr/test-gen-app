<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title></title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()."/assets/css/font-awesome.min.css" ?>" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Tables -->
    <link href="<?php echo base_url(); ?>/assets/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="<?php echo base_url(); ?>/assets/css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/assets/css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>/assets/css/sb-admin.css" rel="stylesheet">
    <!-- Core Scripts - Include with every page -->
    <script src="<?php echo base_url(); ?>/assets/js/jquery-1.10.2.js"></script>

    <!-- Papildoma CSS !-->
    <link href="<?php echo base_url(); ?>/assets/css/additional.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/plugins/morris/morris-0.4.3.min.css">

</head>

<body>


<div id="wrapper">
    <?php  if( isset($template['partials']['nav_head']) ) echo $template['partials']['nav_head']; ?>
    <!-- /.navbar-static-top -->
    <?php  if( isset($template['partials']['nav_left']) ) echo $template['partials']['nav_left']; ?>
    <!-- /.navbar-static-side -->


    <div id="page-wrapper">
        <?php echo $template['body']; ?>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Core Scripts - Include with every page -->
<script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Page-Level Plugin Scripts - Dashboard -->
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.js"></script>

<!-- SB Admin Scripts - Include with every page -->
<script src="<?php echo base_url(); ?>assets/js/sb-admin.js"></script>

<!-- Page-Level Plugin Scripts - Tables -->
<script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- MORRIS !-->
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/raphael-2.1.0.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.js"></script>

</body>

</html>
