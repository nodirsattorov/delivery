@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Управление сайтом</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Управление сайтом</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Управление сайтом</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Сумма доставки</label>
                            <div class="input-group input-group">
                                <input type="text" class="form-control" disabled value="{{ number_format($data->d_price , 0,' ',' ')." cум" }}">
                                <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#exampleModal"> Редактировать</button>
                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Минимальная сумма для скидки</label>
                            <div class="input-group input-group">
                                <input type="text" class="form-control" disabled value="{{ number_format($data->min_price , 0,' ',' ')." cум" }}">
                                <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#exampleModal"> Редактировать</button>
                            </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Скидка на доставку</label>
                            <div class="input-group input-group">
                                <input type="text" class="form-control" disabled value="{{ number_format($data->bonus_price , 0,' ',' ')." cум" }}">
                                <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat" data-toggle="modal" data-target="#exampleModal"> Редактировать</button>
                            </span>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
    <form action="" method="get">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Изменить сумму доставки </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInputEmail1">Сумма доставки</label>
                        <div class="input-group input-group">
                            <input type="number" class="form-control" name="price" value="{{ $data->d_price }}">
                        </div>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInputEmail1">Минимальная сумма для скидки</label>
                        <div class="input-group input-group">
                            <input type="number" class="form-control" name="min_price" value="{{ $data->min_price }}">
                        </div>
                    </div>
                    <div class="modal-body">
                        <label for="exampleInputEmail1">Скидка на доставку</label>
                        <div class="input-group input-group">
                            <input type="number" class="form-control" name="bonus_price" value="{{ $data->bonus_price }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыт</button>
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
