<div class="navbar navbar-expand-md navbar-dark bg-teal navbar-static">
    <div class="navbar-brand">
        <a href="index.html" class="d-inline-block">
            <img src="global_assets/images/Imagen1.png" alt="">
        </a>
    </div>
    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button"><i class="icon-paragraph-justify3"></i></button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>
        <span class="navbar-text ml-md-3"><span class="badge badge-mark border-orange-300 mr-2"></span>
            <?php echo ucwords(mb_strtolower ($_SESSION['full_name'],'UTF-8')); ?>
        </span>
    </div>
</div>