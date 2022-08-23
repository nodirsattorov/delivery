

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo app('translator')->get('cruds.user.title'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('userIndex')); ?>"><?php echo app('translator')->get('cruds.user.title'); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo app('translator')->get('global.edit'); ?></li>
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

                        <form action="<?php echo e(route('userUpdate',$user->id)); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.user.fields.name'); ?></label>
                                <input type="text" name="name" class="form-control <?php echo e($errors->has('name') ? "is-invalid":""); ?>" value="<?php echo e(old('name',$user->name)); ?>" required>
                                <?php if($errors->has('name')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('name')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.user.fields.email'); ?></label>
                                <input type="email" name="email" class="form-control <?php echo e($errors->has('email') ? "is-invalid":""); ?>" value="<?php echo e(old('email',$user->email)); ?>" required>
                                <?php if($errors->has('email')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('email')); ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['roles.edit','user.edit'])): ?>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('cruds.role.fields.roles'); ?></label>
                                <select class="select2" multiple="multiple" name="roles[]" data-placeholder="<?php echo app('translator')->get('pleaseSelect'); ?>" style="width: 100%;">
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->name); ?>" <?php echo e(($user->hasRole($role->name) ? "selected":'')); ?>><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <label><?php echo app('translator')->get('cruds.user.fields.password'); ?></label>
                            <div class="form-group">
                                <input type="password" name="password" id="password-field" class="form-control <?php echo e($errors->has('password') ? "is-invalid":""); ?>">
                                <span toggle="#password-field" class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                <?php if($errors->has('password')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('password')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <label><?php echo app('translator')->get('global.login_password_confirmation'); ?></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                <span toggle="#password-confirm" class="fa fa-fw fa-eye toggle-password field-icon"></span>
                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="error invalid-feedback"><?php echo e($errors->first('password_confirmation')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('global.save'); ?></button>
                                <a href="<?php echo e(route('userIndex')); ?>" class="btn btn-default float-left"><?php echo app('translator')->get('global.cancel'); ?></a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/n86342/public_html/test.nodirsattorov.uz/resources/views/pages/user/edit.blade.php ENDPATH**/ ?>