<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Жалоба</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item active">Жалоба</li>
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
                            <h3 class="card-title">Жалоба</h3>
                            <span class="badge badge-light"><?php echo app('translator')->get('global.amount'); ?> : <?php echo e($complaints->total() ?? 0); ?></span>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button name="filter" type="button" value="1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter-modal"><i class="fas fa-filter"></i> <?php echo app('translator')->get('global.filter'); ?></button>
                                    <form action="" method="get">
                                        <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filters" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo app('translator')->get('global.filter'); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <!-- full_name -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Пользователи</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm">
                                                                    <option value=""> like </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="hidden" name="full_name_operator" value="like">
                                                                <input class="form-control form-control-sm" type="text" name="name" value="<?php echo e(old('name',request()->name??'')); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6><?php echo app('translator')->get('global.phone'); ?></h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" >
                                                                    <option value=""> like </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="hidden" name="phone_operator" value="like">
                                                                <input class="form-control form-control-sm" type="text" name="phone" value="<?php echo e(old('phone',request()->phone??'')); ?>">
                                                            </div>
                                                        </div>
                                                        <!-- status -->























































































                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Дата создания</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="created_at_operator"
                                                                        onchange="
                                                                                if(this.value == 'between'){
                                                                                document.getElementById('created_at_pair').style.display = 'block';
                                                                                } else {
                                                                                document.getElementById('created_at_pair').style.display = 'none';
                                                                                }
                                                                                ">
                                                                    <option value="" <?php echo e(request()->created_at_operator == '=' ? 'selected':''); ?>> = </option>
                                                                    <option value=">" <?php echo e(request()->created_at_operator == '>' ? 'selected':''); ?>> > </option>
                                                                    <option value="<" <?php echo e(request()->created_at_operator == '<' ? 'selected':''); ?>> < </option>
                                                                    <option value="between" <?php echo e(request()->created_at_operator == 'between' ? 'selected':''); ?>> От .. до .. </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="date" name="created_at" value="<?php echo e(old('created_at',request()->created_at??'')); ?>">
                                                            </div>
                                                            <div class="col-3" id="created_at_pair" style="display: <?php echo e(request()->created_at_operator == 'between' ? 'block':'none'); ?>">
                                                                <input class="form-control form-control-sm" type="date" name="created_at_pair" value="<?php echo e(old('created_at_pair',request()->created_at_pair??'')); ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="filter" class="btn btn-primary"><?php echo app('translator')->get('global.filtering'); ?></button>
                                                        <button type="button" class="btn btn-outline-warning float-left pull-left" id="reset_form"><?php echo app('translator')->get('global.clear'); ?></button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo app('translator')->get('global.closed'); ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="<?php echo e(route('complaintIndex')); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-redo-alt"></i> <?php echo app('translator')->get('global.clear'); ?></a>

                                </div>
                            </div>
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
                                    <th>Дата создания</th>
                                    <th>Название</th>
                                    <th>Телефон</th>
                                    <th>Жалоба</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="text-center"><?php echo e(date('H:i:s d-m-Y', strtotime($user->created_at))); ?></td>
                                        <td class="text-center"><?php echo e($user->botuser->name); ?></td>
                                        <td class="text-center"><?php echo e($user->botuser->phone); ?></td>
                                        <td class="text-center"><?php echo e($user->compaint_text); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <?php echo e($complaints->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminjon/web/admin.khan-chapan.uz/public_html/resources/views/pages/complaint/index.blade.php ENDPATH**/ ?>