<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Новые продукты</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item active">Новые продукты</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Продукты</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if(session()->has('empty_ids') || session()->has('duplicates')): ?>
                                <div class="alert alert-default-danger">
                                    <ul>
                                        <?php if(session()->has('empty_ids') && count(session()->get('empty_ids'))): ?>
                                            <?php $__currentLoopData = session()->get('empty_ids'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>Пасспорт ID Пустой: <?php echo e(array_string($item)); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = session()->get('duplicates'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>Дублируется: <?php echo e(array_string($item)); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <table class="table table-bordered table-striped table-responsive-lg">
                                <thead>
                                <tr class="text-center">
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Category</th>
                                    <th>Сумма</th>
                                    <th>Jowi id</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($count++); ?></td>
                                        <td class="text-center"><?php echo e($product['title']); ?></td>
                                        <td class="text-center"><?php echo e($product['category']); ?></td>
                                        <td class="text-center"><?php echo e(number_format($product['price'], 0,' ',' ')); ?> сум</td>
                                        <td class="text-center"><?php echo e($product['id']); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminjon/web/admin.khan-chapan.uz/public_html/resources/views/pages/jowi/index.blade.php ENDPATH**/ ?>