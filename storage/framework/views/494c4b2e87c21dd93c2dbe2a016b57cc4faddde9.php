
<nav class="mt-2">

    <?php
        $jowicategores = \App\Http\Controllers\Blade\CategoryController::getAllfromJowi();
    ?>

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
        <?php if(sizeof($jowicategores)): ?>
            <li class="nav-item">
                <a href="/jowiproducts" class="nav-link <?php echo e(Request::is('jowiproducts*') ? "active":''); ?>">
                    <i class="fas fa-exclamation-triangle" style="font-size: 1.4rem; <?php echo e(Request::is('jowiproducts*') ? "":'color: red'); ?>"></i>
                    <p style="font-size: 22px; font-weight: 600; <?php echo e(Request::is('jowiproducts*') ? "":'color: red'); ?>"> Новые продукты <span style="border-radius: 50%; line-height: 15px; font-size: 15px; position: relative; top: -8px; left: -5px; <?php echo e(Request::is('jowiproducts*') ? "background-color: #007BFF":''); ?>" class="badge badge-danger"><?php echo e(sizeof($jowicategores)); ?></span></p>
                </a>
            </li>
        <?php endif; ?>
    </ul>




</nav>
<?php /**PATH /home/t93347/public_html/admin.khan-chapan.uz/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>