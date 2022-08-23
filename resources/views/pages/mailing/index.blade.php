@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Рассылки</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
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
                            <span class="badge badge-light">@lang('global.amount') : {{ $mailings->total() ?? 0 }}</span>
                            @can('permission.add')
                                <a href="{{ route('mailingAdd') }}" class="btn btn-success btn-sm float-right">
                                    <span class="fas fa-plus-circle"></span>
                                    @lang('global.add')
                                </a>
                            @endcan
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
                                    <th>Изображение</th>
                                    <th>Text</th>
                                    <th>Статус</th>
                                    <th>Status</th>
                                    <th style="width: 40px">@lang('global.action')</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mailings as $mailing)
                                    <tr>
                                        <td>{{ date('H:i:s d-m-Y', strtotime($mailing->created_at)) }}</td>
                                        <td><a target="_blank" href="{{ config('constants.bot.photo_url').$mailing->photo }}">{{ $mailing->photo }}</a> </td>

                                        <td>{!! $mailing->text  !!}</td>

                                        <td class="text-center">
                                            <button id="status_{{$mailing->id}}" class="btn btn-{{$mailing->status == 0 ? 'danger' : 'success'}} btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$mailing->status == '0' ? 'Не отправлено' : ($mailing->status == '1' ? 'Отправьте меня' : 'Отправить пользователям')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <button onclick="changeMailingStatus('{{$mailing->id}}', '1')" class="dropdown-item" href="#">Отправьте меня</button>
                                                <button onclick="changeMailingStatus('{{$mailing->id}}', '2')" class="dropdown-item" href="#">Отправить пользователям</button>
                                            </div>
                                        </td>
                                        {{--                                        <td class="text-center">--}}
                                        {{--                                            {{ $mailing->status }}--}}

                                        {{--                                        </td>--}}
                                        <td>
                                            @if($mailing->total > 0)
                                                <div class="progress progress-sm active">
                                                    <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                                         aria-valuenow="{{ $mailing->current }}" aria-valuemin="0" aria-valuemax="{{ $mailing->total }}" style="width: {{ $mailing->current * 100 / $mailing->total }}%">
                                                    </div>
                                                </div>
                                                <div>
                                                    <span style="font-size: 14px">{{ floor($mailing->current * 100 / $mailing->total) }}%</span>
                                                </div>
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @can('permission.delete')
                                                <form action="{{ route('mailingDestroy',$mailing->id) }}" method="post">
                                                    @csrf
                                                    <div class="btn-group">
                                                        {{--                                                    @can('permission.edit')--}}
                                                        <a href="{{ route('mailingEdit',$mailing->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
                                                        {{--                                                    @endcan--}}
                                                        <input name="_method" type="hidden" value="DELETE">
                                                        <button type="button" class="submitButton btn btn-danger btn-sm"> @lang('global.delete')</button>
                                                    </div>
                                                </form>
                                            @endcan
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $mailings->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
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
                    _token: "{!! @csrf_token() !!}"
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
                        let classes = ['danger','success','success','success'];
                        let text = ['Не отправлено','Отправьте меня','Отправить пользователям','Отправить пользователям'];
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
                    _token: "{!! @csrf_token() !!}"
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
@endsection()
