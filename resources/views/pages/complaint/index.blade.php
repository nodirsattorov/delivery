@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Жалоба</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
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
                            <span class="badge badge-light">@lang('global.amount') : {{ $complaints->total() ?? 0 }}</span>
                            <div class="card-tools">
                                <div class="btn-group">
                                    <button name="filter" type="button" value="1" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#filter-modal"><i class="fas fa-filter"></i> @lang('global.filter')</button>
                                    <form action="" method="get">
                                        <div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="filters" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">@lang('global.filter')</h5>
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
                                                                <input class="form-control form-control-sm" type="text" name="name" value="{{ old('name',request()->name??'') }}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row align-items-center">
                                                            <div class="col-3">
                                                                <h6>@lang('global.phone')</h6>
                                                            </div>
                                                            <div class="col-2">
                                                                <select class="form-control form-control-sm" >
                                                                    <option value=""> like </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="hidden" name="phone_operator" value="like">
                                                                <input class="form-control form-control-sm" type="text" name="phone" value="{{ old('phone',request()->phone??'') }}">
                                                            </div>
                                                        </div>
                                                        <!-- status -->
{{--                                                        <div class="form-group row align-items-center">--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <h6>Статус</h6>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-2">--}}
{{--                                                                <select class="form-control form-control-sm">--}}
{{--                                                                    <option value=""> = </option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <select class="form-control form-control-sm" name="status">--}}
{{--                                                                    <option value=""></option>--}}
{{--                                                                    <option value="0" {{ (request()->status == '0') ? 'selected':'' }}>В обработке</option>--}}
{{--                                                                    <option value="1" {{ request()->status == 1 ? 'selected':'' }}>Подтвержден</option>--}}
{{--                                                                    <option value="2" {{ request()->status == 2 ? 'selected':'' }}>Выполняется</option>--}}
{{--                                                                    <option value="3" {{ request()->status == 3 ? 'selected':'' }}>Выполнено</option>--}}
{{--                                                                    <option value="4" {{ request()->status == 4 ? 'selected':'' }}>Отменен</option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <!-- payment_status -->--}}
{{--                                                        <div class="form-group row align-items-center">--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <h6>Статус оплаты</h6>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-2">--}}
{{--                                                                <select class="form-control form-control-sm">--}}
{{--                                                                    <option value=""> = </option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <select class="form-control form-control-sm" name="payment">--}}
{{--                                                                    <option value=""></option>--}}
{{--                                                                    <option value="0" {{ (request()->payment == '0') ? 'selected':'' }}>Не Оплачен</option>--}}
{{--                                                                    <option value="1" {{ request()->payment == 1 ? 'selected':'' }}>Оплачен</option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <!-- summa  -->--}}
{{--                                                        <div class="form-group row align-items-center">--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <h6>Сумма</h6>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-2">--}}
{{--                                                                <select class="form-control form-control-sm" name="summa_operator"--}}
{{--                                                                        onchange="--}}
{{--                                                                                if(this.value == 'between'){--}}
{{--                                                                                document.getElementById('summa_pair').style.display = 'block';--}}
{{--                                                                                } else {--}}
{{--                                                                                document.getElementById('summa_pair').style.display = 'none';--}}
{{--                                                                                }--}}
{{--                                                                                ">--}}
{{--                                                                    <option value="" {{ request()->summa_operator == '=' ? 'selected':'' }}> = </option>--}}
{{--                                                                    <option value=">" {{ request()->summa_operator == '>' ? 'selected':'' }}> > </option>--}}
{{--                                                                    <option value="<" {{ request()->summa_operator == '<' ? 'selected':'' }}> < </option>--}}
{{--                                                                    <option value="between" {{ request()->summa_operator == 'between' ? 'selected':'' }}> Between </option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <input class="form-control form-control-sm" type="text" name="summa" value="{{ old('summa',request()->summa??'') }}">--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3" id="summa_pair" style="display: {{ request()->summa_operator == 'between' ? 'block':'none'}}">--}}
{{--                                                                <input class="form-control form-control-sm" type="text" name="summa_pair" value="{{ old('summa_pair',request()->summa_pair ??'') }}">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

{{--                                                        <!-- payment_method -->--}}
{{--                                                        <div class="form-group row align-items-center">--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <h6>Тип оплаты</h6>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-2">--}}
{{--                                                                <select class="form-control form-control-sm">--}}
{{--                                                                    <option value=""> = </option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <select class="form-control form-control-sm" name="payment_method">--}}
{{--                                                                    <option value=""></option>--}}
{{--                                                                    <option value="naqd" {{ (request()->payment_method == 'naqd') ? 'selected':'' }}>💵 Наличные</option>--}}
{{--                                                                    <option value="plastik" {{ request()->payment_method == 'plastik' ? 'selected':'' }}>💳 Пластик</option>--}}
{{--                                                                </select>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}

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
                                                                    <option value="" {{ request()->created_at_operator == '=' ? 'selected':'' }}> = </option>
                                                                    <option value=">" {{ request()->created_at_operator == '>' ? 'selected':'' }}> > </option>
                                                                    <option value="<" {{ request()->created_at_operator == '<' ? 'selected':'' }}> < </option>
                                                                    <option value="between" {{ request()->created_at_operator == 'between' ? 'selected':'' }}> От .. до .. </option>
                                                                </select>
                                                            </div>
                                                            <div class="col-3">
                                                                <input class="form-control form-control-sm" type="date" name="created_at" value="{{ old('created_at',request()->created_at??'') }}">
                                                            </div>
                                                            <div class="col-3" id="created_at_pair" style="display: {{ request()->created_at_operator == 'between' ? 'block':'none'}}">
                                                                <input class="form-control form-control-sm" type="date" name="created_at_pair" value="{{ old('created_at_pair',request()->created_at_pair??'') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="filter" class="btn btn-primary">@lang('global.filtering')</button>
                                                        <button type="button" class="btn btn-outline-warning float-left pull-left" id="reset_form">@lang('global.clear')</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('global.closed')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="{{ route('complaintIndex') }}" class="btn btn-secondary btn-sm"><i class="fa fa-redo-alt"></i> @lang('global.clear')</a>

                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(session()->has('empty_ids') || session()->has('duplicates'))
                                <div class="alert alert-default-danger">
                                    <ul>
                                        @if(session()->has('empty_ids') && count(session()->get('empty_ids')))
                                            @foreach(session()->get('empty_ids') as $item)
                                                <li>Пасспорт ID Пустой: {{ array_string($item) }}</li>
                                            @endforeach
                                        @endif
                                        @foreach(session()->get('duplicates') as $item)
                                            <li>Дублируется: {{ array_string($item) }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
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
                                @foreach($complaints as $user)
                                    <tr>
                                        <td class="text-center">{{ date('H:i:s d-m-Y', strtotime($user->created_at)) }}</td>
                                        <td class="text-center">{{ $user->botuser->name }}</td>
                                        <td class="text-center">{{ $user->botuser->phone }}</td>
                                        <td class="text-center">{{ $user->compaint_text }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $complaints->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
