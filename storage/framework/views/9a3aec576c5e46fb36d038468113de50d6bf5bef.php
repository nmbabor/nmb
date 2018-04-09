<? $info=DB::table('about_company')->first(); ?>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="<?php echo e(URL::to('dashboard')); ?>" class="logo">
        <!-- <img src="<?php echo e(asset('public/img/binarylogic.png')); ?>" alt=""> -->
        <h4><?php echo e($info->company_name); ?></h4>
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu"></ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!-- <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> -->
        <!-- user login dropdown start-->
            <? $user_id=Auth::user()->id;
            ?>
        <li class="dropdown">

            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <i class="fa fa-user"></i>
                <span class="username"><?php echo e(Auth::user()['name']); ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href='<?php echo e(URL::to("profile")); ?>'><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li>
                    <a href="<?php echo e(route('logout')); ?>" class="fa fa-key"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo e(csrf_field()); ?>

                    </form>
                </li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->