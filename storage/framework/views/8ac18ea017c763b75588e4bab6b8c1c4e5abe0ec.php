<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Управление категория</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('categoryIndex')); ?>">Управление категория</a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('global.add'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo app('translator')->get('global.edit'); ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="<?php echo e(route('categoryUpdate',$category->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Название на русском</label>
                                <input type="text" name="name_ru" class="form-control <?php echo e($errors->has('name_ru') ? "is-invalid":""); ?>" value="<?php echo e(old('name_ru',$category->name_ru)); ?>" required>
                                <?php if($errors->has('name_ru') || 1): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('name_ru')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label>Название на узбекском</label>
                                <input type="text" name="name_uz" class="form-control" value="<?php echo e(old('name_uz',$category->name_uz)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Родительская категория</label>
                                <select class="form-control select2" style="width: 100%;" name="parent_id" value="<?php echo e(old('parent_id',$category->parent_id)); ?>" require>
                                    <option value="0"> - </option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($categoryItem->id != $category->id): ?>
                                            <option value="<?php echo e($categoryItem->id); ?>" <?php echo e($categoryItem->id == $category->parent_id ? 'selected' : ''); ?> ><?php echo e($categoryItem->name_ru); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <input type="hidden" name="old_parent_id" class="form-control" value="<?php echo e(old('old_parent_id', $category->parent_id)); ?>" required>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('global.save'); ?></button>
                                <a href="<?php echo e(route('categoryIndex')); ?>" class="btn btn-default float-left"><?php echo app('translator')->get('global.cancel'); ?></a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/t92074/public_html/izumrudniybot.skybox.uz/resources/views/pages/category/edit.blade.php ENDPATH**/ ?>