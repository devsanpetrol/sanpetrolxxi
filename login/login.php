<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php include '../bar_nav/title.php'; ?></title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
    <link href="../global_assets/css/icons/material/styles.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/layout.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.min.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.min.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
</head>
<body>
    <!-- Main navbar -->
    <?php include '../bar_nav/main_navbar_alter.php'; ?>
    <!-- Page content -->
    <div class="page-content">
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="content d-flex justify-content-center align-items-center">
                <!-- Login form -->
                <form class="login-form" action="engine_session.php" method="post" id="form_login" autocomplete="off">
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                                <h5 class="mb-0">Acceso a su cuenta</h5>
                                <span class="d-block text-muted">Ingrese sus credenciales</span>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="text" class="form-control" placeholder="Usuario" id="user" name="user" autocomplete="off">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" autocomplete="off">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2 text-muted"></i>
                                </div>
                            </div>
                            <div class="alert alert-danger border-0 alert-dismissible"  style="display: none;padding-right: 20px;" id="msj_alert">
                               <span class="font-weight-semibold">Error!</span> Usuario o contraseña no valido
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn bg-teal btn-block" onclick="get_login_acces()">Entrar <i class="icon-circle-right2 ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /login form -->
            </div>
            <!-- /content area -->
            <!-- Footer -->
            <?php include '../bar_nav/footer_navbar.php'; ?>
            <!-- /footer -->
        </div>
    </div>
    <!-- Core JS files -->
    <script src="../global_assets/js/main/jquery.min.js"></script>
    <script src="../global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="../global_assets/js/plugins/loaders/blockui.min.js"></script>
    <script src="../global_assets/js/plugins/ui/ripple.min.js"></script>
    <!-- /core JS files -->
    <script src="../assets/js/app.js"></script>
    <script src="js/engineJS.js"></script>
    <!-- /theme JS files -->
</body>
</html>
