<?php $__env->startSection('content'); ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Заказы</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo app('translator')->get('global.home'); ?></a></li>
                        <li class="breadcrumb-item active">Заказы</li>
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
                            <h3 class="card-title">Заказы</h3>
                            <span class="badge badge-light"><?php echo app('translator')->get('global.amount'); ?> : <?php echo e($orders->total() ?? 0); ?></span>
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

                                                        <!-- status -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Статус</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm">
                                                                    <option value=""> = </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <select class="form-control form-control-sm" name="status">
                                                                    <option value=""></option>
                                                                    <option value="0" <?php echo e((request()->status == '0') ? 'selected':''); ?>>В обработке</option>
                                                                    <option value="1" <?php echo e(request()->status == 1 ? 'selected':''); ?>>Подтвержден</option>
                                                                    <option value="2" <?php echo e(request()->status == 2 ? 'selected':''); ?>>Выполняется</option>
                                                                    <option value="3" <?php echo e(request()->status == 3 ? 'selected':''); ?>>Выполнено</option>
                                                                    <option value="4" <?php echo e(request()->status == 4 ? 'selected':''); ?>>Отменен</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- payment_status -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Статус оплаты</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm">
                                                                    <option value=""> = </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <select class="form-control form-control-sm" name="payment">
                                                                    <option value=""></option>
                                                                    <option value="0" <?php echo e((request()->payment == '0') ? 'selected':''); ?>>Не Оплачен</option>
                                                                    <option value="1" <?php echo e(request()->payment == 1 ? 'selected':''); ?>>Оплачен</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                       <!-- summa  -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Сумма</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" name="summa_operator"
                                                                        onchange="
                                                                                if(this.value == 'between'){
                                                                                document.getElementById('summa_pair').style.display = 'block';
                                                                                } else {
                                                                                document.getElementById('summa_pair').style.display = 'none';
                                                                                }
                                                                                ">
                                                                    <option value="" <?php echo e(request()->summa_operator == '=' ? 'selected':''); ?>> = </option>
                                                                    <option value=">" <?php echo e(request()->summa_operator == '>' ? 'selected':''); ?>> > </option>
                                                                    <option value="<" <?php echo e(request()->summa_operator == '<' ? 'selected':''); ?>> < </option>
                                                                    <option value="between" <?php echo e(request()->summa_operator == 'between' ? 'selected':''); ?>> Between </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="text" name="summa" value="<?php echo e(old('summa',request()->summa??'')); ?>">
                                                            </div>
                                                            <div class="col-3" id="summa_pair" style="display: <?php echo e(request()->summa_operator == 'between' ? 'block':'none'); ?>">
                                                                <input class="form-control form-control-sm" type="text" name="summa_pair" value="<?php echo e(old('summa_pair',request()->summa_pair ??'')); ?>">
                                                            </div>
                                                        </div>

                                                        <!-- payment_method -->
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>Тип оплаты</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm">
                                                                    <option value=""> = </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <select class="form-control form-control-sm" name="payment_method">
                                                                    <option value=""></option>
                                                                    <option value="naqd" <?php echo e((request()->payment_method == 'naqd') ? 'selected':''); ?>>💵 Наличные</option>
                                                                    <option value="plastik" <?php echo e(request()->payment_method == 'plastik' ? 'selected':''); ?>>💳 Пластик</option>
                                                                </select>
                                                            </div>
                                                        </div>

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
                                    <a href="<?php echo e(route('orderIndex')); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-redo-alt"></i> <?php echo app('translator')->get('global.clear'); ?></a>

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
                                    <th>Пользователи</th>
                                    <th>Статус</th>
                                    <th>Сумма</th>
                                    <th>Статус оплаты</th>
                                    <th>Тип оплаты</th>
                                    <th style="width: 40px"><?php echo app('translator')->get('global.action'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(date('H:i:s d-m-Y', strtotime($order->created_at))); ?></td>
                                        <td><?php echo e($order->botuser->name); ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <?php
                                                    if($order->status_admin == 0 || $order->status_admin == 10)
                                                    {
                                                        $color = 'warning';
                                                        $text = "Новый заказ";
                                                    }
                                                    elseif($order->status_admin == 1)
                                                    {
                                                        $color = 'primary';
                                                        $text = "Заказ принят в работу";
                                                    }
                                                    elseif($order->status_admin == 2)
                                                    {
                                                        $color = 'primary';
                                                        $text = "Заказ отменен";
                                                    }
                                                    elseif($order->status_admin == 3)
                                                    {
                                                        $color = 'success';
                                                        $text = "Заказ отправлен клиенту";
                                                    }
                                                    elseif($order->status_admin == 4)
                                                    {
                                                        $color = 'danger';
                                                        $text = "Заказ доставлен";
                                                    }
                                                    elseif($order->status_admin == 5)
                                                    {
                                                        $color = 'primary';
                                                        $text = "Отправить в Telegram";
                                                    }
                                                ?>
                                                <button id="status_<?php echo e($order->id); ?>" class=" btn btn-<?php echo e($color); ?> btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?php echo e($text); ?>

                                                </button>
                                                <div class="dropdown-menu">
                                                    <button onclick="changeStatus('<?php echo e($order->id); ?>', '0','st')" class="dropdown-item" href="">Новый заказ</button>
                                                    <button onclick="changeStatus('<?php echo e($order->id); ?>', '1','st')" class="dropdown-item" href="">Заказ принят в работу</button>
                                                    <button onclick="changeStatus('<?php echo e($order->id); ?>', '2','st')" class="dropdown-item" href="">Заказ отменен</button>
                                                    <button onclick="changeStatus('<?php echo e($order->id); ?>', '3','st')" class="dropdown-item" href="">Заказ отправлен клиенту</button>
                                                    <button onclick="changeStatus('<?php echo e($order->id); ?>', '4','st')" class="dropdown-item" href="">Заказ доставлен</button>
                                                    <button onclick="changeStatus('<?php echo e($order->id); ?>', '5','st')" class="dropdown-item" href="">Отправить в Telegram</button>

                                                </div>
                                            </div>

                                        </td>

                                        <td><?php echo e(number_format($order->summa, 0,' ',' ')." сум"); ?></td>

                                        <td class="text-center">

                                            <button id="payment_<?php echo e($order->id); ?>" class="btn btn-<?php echo e($order->payment == 0 ? 'danger' : 'success'); ?> btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Пластик
                                            </button>
                                            <div class="dropdown-menu">
                                                <button onclick="changePayment('<?php echo e($order->id); ?>', '0','pay')" class="dropdown-item" href="#">Не Оплачен</button>
                                                <button onclick="changePayment('<?php echo e($order->id); ?>', '1','pay')" class="dropdown-item" href="#">Оплачен</button>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <?php echo e($order->payment_method == 'naqd' ? '💵 Наличные' : '💳 Пластик'); ?>


                                        </td>
                                        <td class="text-center" style="vertical-align: middle">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modal-lg_<?php echo e($order->id); ?>">
                                                    <?php echo app('translator')->get('global.details'); ?>
                                                </button>

                                            </div>
                                            <!-- /.modal -->

                                            <div class="modal fade" id="modal-lg_<?php echo e($order->id); ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Заказы №<?php echo e($order->id); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">

                                                            <table class="table table-striped">
                                                                <tbody>
                                                                <tr>
                                                                    <td style="width: 40%">Имя:</td>
                                                                    <td>
                                                                        <b><?php echo e($order->botuser->name); ?></b>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Телефон:</td>
                                                                    <td>
                                                                        <?php echo e($order->botuser->phone); ?>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Тип оплаты:</td>
                                                                    <td>
                                                                        <?php echo e($order->payment_method == 'naqd' ? '💵 Наличные' : '💳 Пластик'); ?>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Адрес:</td>
                                                                    <td>
                                                                        <?php echo e($order->address == "0" ? "Геолокация в телеграмме" : $order->address); ?>

                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Комментарий к заказу:</td>
                                                                    <td>
                                                                        <?php echo e($order->comment); ?>

                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                            <br>
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>Продукты</th>
                                                                    <th>Цена</th>
                                                                    <th>Количество</th>
                                                                    <th>Итого</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $totalSumma = 0; $count = 0; ?>
                                                                <?php $__currentLoopData = $order->orderitem; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderitem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($orderitem->product->name_ru); ?></td>
                                                                        <td><?php echo e(number_format($orderitem->price, 0,' ',' ')." сум"); ?></td>
                                                                        <td>
                                                                            <?php echo e($orderitem->quantity); ?>

                                                                        </td>
                                                                        <td>
                                                                            <?php echo e(number_format($orderitem->quantity * $orderitem->price, 0,' ',' ')." сум"); ?>

                                                                        </td>
                                                                        <?php $count += 1; $totalSumma += $orderitem->quantity * $orderitem->price; ?>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td colspan="2">
                                                                        <b>Общий продукт:  <?php echo e($count); ?></b>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        <b>Итого сумма:  <?php echo e(number_format($totalSumma, 0,' ',' ')." сум"); ?></b>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>

                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <?php echo e($orders->withQueryString()->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script !src="">
    function changeStatus($x, $y, $t) {

        let button = $("#status_"+$x);

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
                    let classes = ['warning','primary','primary','success','danger','primary'];
                    let text = ['Новый заказ','Заказ принят в работу','Заказ отменен','Заказ отправлен клиенту','Заказ доставлен','Отправить в Telegram'];
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/adminjon/web/admin.khan-chapan.uz/public_html/resources/views/pages/order/index.blade.php ENDPATH**/ ?>