
<nav class="mt-2">

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any([
        'permission.mainadmin'
    ])): ?>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link <?php echo e((Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'active':''); ?>">
                <i class="fas fa-users-cog"></i>
                <p>
                    <?php echo app('translator')->get('cruds.userManagement.title'); ?>
                </p>
            </a>
            <ul class="nav nav-treeview pl-3" style="display: <?php echo e((Request::is('permission*') || Request::is('role*') || Request::is('user*')) ? 'block':'none'); ?>;">


















                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.show')): ?>
                <li class="nav-item  <?php echo e(Request::is('user*') ? "active":''); ?>">
                    <a href="<?php echo e(route('userIndex')); ?>" class="nav-link">
                        <i class="fas fa-user-friends"></i>
                        <p> <?php echo app('translator')->get('cruds.user.title'); ?></p>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
    </ul>
    <?php endif; ?>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/category" class="nav-link <?php echo e((Request::is('category*') || Request::is('category*') || Request::is('category*')) ? 'active':''); ?>">
                <i class="fas fa-border-all" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">
                    Категории
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/product" class="nav-link <?php echo e(Request::is('product*') ? "active":''); ?>">
                <i class="fas fa-th" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">Продукты</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/order" class="nav-link <?php echo e(Request::is('order*') ? "active":''); ?>">
                <i class="fas fa-shopping-cart"  style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">Заказы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/botusers" class="nav-link <?php echo e(Request::is('botusers*') ? "active":''); ?>">
                <i class="fas fa-users" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;">Пользователи</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/complaint" class="nav-link <?php echo e(Request::is('complaint*') ? "active":''); ?>">
                <i class="fas fa-file-alt" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;"> Жалоба</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/mailing" class="nav-link <?php echo e(Request::is('mailing*') ? "active":''); ?>">
                <i class="fas fa-envelope" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;"> Рассылки </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/settings" class="nav-link <?php echo e(Request::is('settings*') ? "active":''); ?>">
                <i class="fas fa-cog" style="font-size: 1.4rem"></i>
                <p style="font-size: 22px; font-weight: 300;"> Настройки </p>
            </a>
        </li>
    </ul>




</nav>
<?php /**PATH D:\Web\OpenServer\domains\test.nodirsattorov.loc\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>