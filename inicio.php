<?php require_once './ini_ses.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include './bar_nav/title.php'; ?></title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script src="global_assets/js/main/jquery.min.js"></script>
    <script src="global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script src="global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script src="global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="global_assets/js/plugins/pickers/daterangepicker.js"></script>

    <script src="assets/js/app.js"></script>
    <script src="global_assets/js/demo_pages/dashboard.js"></script>
    <!-- /theme JS files -->
</head>
<body>
    <!-- Main navbar -->
    <?php include './bar_nav/main_navbar.php'; ?>
    <!-- Page content -->
    <div class="page-content">
        <!-- Main sidebar -->
        <?php include './bar_nav/main_sidebar.php'; ?>
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light">
                <?php //include './bar_nav/page-header-content.php'; ?>
                <?php //include './bar_nav/breadcrumb-line.php'; ?>
            </div>

            <!-- Content area -->
            <div class="content">
                <div class="row">
                <!-- Dashboard content -->
                    <div class="col-xl-4">

                    </div>
                <!-- /dashboard content -->
                </div>
            </div>
            <!-- /content area -->
            
            <!-- Footer -->
            <?php include './bar_nav/footer_navbar.php'; ?>
            <!-- /footer -->
        </div>
    </div>
</body>
</html>
