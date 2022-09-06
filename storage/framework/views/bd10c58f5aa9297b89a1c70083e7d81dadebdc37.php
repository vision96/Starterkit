<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu"><?php echo app('translator')->get('translation.menu'); ?></li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards"><?php echo app('translator')->get('translation.dashboards'); ?></span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-bank"></i>
                        <span key="t-banks"><?php echo app('translator')->get('translation.Banks'); ?></span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="<?php echo e(route('show-bank')); ?>" key="t-show-banks"><?php echo app('translator')->get('translation.Show_Banks'); ?></a></li>
                    </ul>
                </li>







                <li>
                    <a href="#" class="waves-effect">
                        <i class="bx bx-money"></i>
                        <span key="t-cheques"><?php echo app('translator')->get('translation.Cheques'); ?></span>
                    </a>
                </li>








            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH C:\wamp64\www\Starterkit\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>