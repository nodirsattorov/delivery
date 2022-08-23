<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Рассылки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item active">Рассылки </li>
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
                            <span class="badge badge-light"><?php echo app('translator')->get('global.amount'); ?> : <?php echo e($mailings->total() ?? 0); ?></span>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.add')): ?>
                                <a href="<?php echo e(route('mailingAdd')); ?>" class="btn btn-success btn-sm float-right">
                                    <span class="fas fa-plus-circle"></span>
                                    <?php echo app('translator')->get('global.add'); ?>
                                </a>
                            <?php endif; ?>
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
                                    <th>rasm</th>
                                    <th>text</th>
                                    <th>status</th>
                                    <th style="width: 40px"><?php echo app('translator')->get('global.action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $mailings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mailing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(date('H:i:s d-m-Y', strtotime($mailing->created_at))); ?></td>
                                        <td><a target="_blank" href="https://khanchapan.khan-chapan.uz/public/images/<?php echo e($mailing->photo); ?>"><?php echo e($mailing->photo); ?></a> </td>

                                        <td><?php echo $mailing->text; ?></td>

                                        <td class="text-center">
                                            <button id="status_<?php echo e($mailing->id); ?>" class="btn btn-<?php echo e($mailing->status == 0 ? 'danger' : 'success'); ?> btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <?php echo e($mailing->status == '0' ? 'Не отправлено' : ($mailing->status == '1' ? 'Отправьте меня' : 'Отправить пользователям')); ?>

                                            </button>
                                            <div class="dropdown-menu">
                                                <button onclick="changeMailingStatus('<?php echo e($mailing->id); ?>', '1')" class="dropdown-item" href="#">Отправьте меня</button>
                                                <button onclick="changeMailingStatus('<?php echo e($mailing->id); ?>', '2')" class="dropdown-item" href="#">Отправить пользователям</button>
                                            </div>
                                        </td>




                                        <td class="text-center">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('permission.delete')): ?>
                                                <form action="<?php echo e(route('mailingDestroy',$mailing->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="btn-group">
                                                        
                                                        <a href="<?php echo e(route('mailingEdit',$mailing->id)); ?>" type="button" class="btn btn-info btn-sm"> <?php echo app('translator')->get('global.edit'); ?></a>
                                                        
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="button" class="submitButton btn btn-danger btn-sm"> <?php echo app('translator')->get('global.delete'); ?></button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <?php echo e($mailings->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script !src="">
        function changeMailingStatus($x, $y) {

            let button = $("#status_"+$x);

            let mailing_id = $x;
            let status = $y;

            $.ajax({
                url:'/mailing/status',
                type: "POST",
                data:{
                    mailing_id: mailing_id,
                    status: status,
                    _token: "<?php echo @csrf_token(); ?>"
                },
                beforeSend:function () {
                    SpinnerGo(button);
                },
                success:function (result) {
                    if(result.status)
                    {
                        /*
                        * 'Не отправлено' : ($mailing->status == '1' ? 'Отправьте меня' : 'Отправить пользователям'
                        * */
                        let classes = ['danger','success','success'];
                        let text = ['Не отправлено','Отправьте меня','Отправить пользователям'];
                        button.attr('class',"btn-sm dropdown-toggle btn btn-"+classes[$y]);
                        console.log(classes[$y]);
                        button.text(text[$y]);
                    }
                    else
                    {

                    }
                    SpinnerStop(button);
                },
                error:function(err){
                    console.log(err);
                    SpinnerStop(button);
                }
            })



        }
        function changePayment($x, $y, $t) {


            let button = $("#payment_"+$x);
            let order_id = $x;
            let status = $y;
            let types = $t;

            $.ajax({
                url:'/order/status',
                type: "POST",
                data:{
                    order_id: order_id,
                    status: status,
                    types: types,
                    _token: "<?php echo @csrf_token(); ?>"
                },
                beforeSend:function () {
                    SpinnerGo(button);
                },
                success:function (result) {
                    if(result.status)
                    {
                        let classes = ['danger','success'];
                        let text = ['В обработке','Подтвержден','Выполняется','Выполнено','Отменен'];
                        button.attr('class',"btn-sm dropdown-toggle btn btn-"+classes[$y]);
                        console.log(classes[$y]);

                        button.text(text[$y]);
                    }
                    else
                    {

                    }
                    SpinnerStop(button);
                },
                error:function(err){
                    console.log(err);
                    SpinnerStop(button);
                }
            })



        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminjon/web/khanchapan.khan-chapan.uz/public_html/resources/views/pages/mailing/index.blade.php ENDPATH**/ ?>