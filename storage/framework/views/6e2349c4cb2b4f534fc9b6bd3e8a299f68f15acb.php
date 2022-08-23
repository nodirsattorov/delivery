<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Управление продукты</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('productIndex')); ?>">Управление продукты</a></li>
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
                        <?php if(sizeof($products)): ?>
                            <button style="font-size: 14px; font-weight: 500;" type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modal-lg_jowiproducts">
                                <?php echo app('translator')->get('global.jowiproducts'); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="<?php echo e(route('productUpdate',$product->id)); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Название на русском</label>
                                        <input type="text" name="name_ru" class="form-control <?php echo e($errors->has('name_ru') ? "is-invalid":""); ?>" value="<?php echo e(old('name_ru',$product->name_ru)); ?>" required>
                                        <?php if($errors->has('name_ru') || 1): ?>
                                            <span class="error invalid-feedback"><?php echo e($errors->first('name_ru')); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col">
                                        <label>Название на узбекском</label>
                                        <input type="text" name="name_uz" class="form-control" value="<?php echo e(old('name_uz',$product->name_uz)); ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Описание на русском</label>
                                        <textarea rows="3" name="description_ru" class="form-control"><?php echo e(old('description_ru',$product->description_ru)); ?></textarea>
                                    </div>
                                    <div class="col">
                                        <label>Описание на узбекском</label>
                                        <textarea rows="3" name="description_uz" class="form-control"><?php echo e(old('description_uz',$product->description_uz)); ?></textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group " id="price">
                                <div class="row">
                                    <div class="col-6">
                                        <label >Цена</label>
                                        <input type="number" min="0" name="price" class="form-control" value="<?php echo e(old('price', $product->price)); ?>" required>
                                    </div>
                                    <div class="col-6">
                                        <label>Категории</label>
                                        <select class="form-control select2" style="width: 100%;" name="category_id" value="<?php echo e(old('category_id',$product->category_id)); ?>" required>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if($product->category_id == $category->id): ?> <?php echo e('selected'); ?> <?php endif; ?> value="<?php echo e($category->id); ?>" ><?php echo e(" ".$category->name_ru); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Изображение</label>
                                        <input style="border: 0px; padding-left: 0px" type="file" name="photo" class="form-control">
                                    </div>
                                    <div class="col">
                                        <img  style="width: 80px" src="/images/<?php echo e($product->photo); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-success float-right"><?php echo app('translator')->get('global.save'); ?></button>
                                <a href="<?php echo e(route('productIndex')); ?>" class="btn btn-default float-left"><?php echo app('translator')->get('global.cancel'); ?></a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/t92074/public_html/izumrudniybot.skybox.uz/resources/views/pages/product/edit.blade.php ENDPATH**/ ?>