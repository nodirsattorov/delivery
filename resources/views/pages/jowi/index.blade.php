@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Новые продукты</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
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
                                    <th>№</th>
                                    <th>Название</th>
                                    <th>Category</th>
                                    <th>Сумма</th>
                                    <th>Jowi id</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $count++ }}</td>
                                        <td class="text-center">{{ $product['title'] }}</td>
                                        <td class="text-center">{{ $product['category'] }}</td>
                                        <td class="text-center">{{ number_format($product['price'], 0,' ',' ') }} сум</td>
                                        <td class="text-center">{{ $product['id'] }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
