@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Управление категория</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item active">Управление категория</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Категория</h3>
                        @can('permission.add')
                            <a href="{{ route('categoryAdd') }}" class="btn btn-success btn-sm float-right">
                                <span class="fas fa-plus-circle"></span>
                                @lang('global.add')
                            </a>
                        @endcan
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Data table -->
                        <table id="dataTable" class="table table-bordered table-striped dataTable dtr-inline table-responsive-lg" role="grid" aria-describedby="dataTable_info">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название на русском</th>
                                <th>Название на узбекском</th>
                                <th>Родительская категория</th>
                                <th class="w-25">@lang('global.actions')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name_ru }}</td>
                                    <td>{{ $category->name_uz }}</td>
                                    <td>{{ isset($category->parent->name_ru) ? ("ID: ".$category->parent->id." ".$category->parent->name_ru) : '-' }}</td>
                                    <td class="text-center">
                                        @can('permission.delete')
                                            <form action="{{ route('categoryDestroy',$category->id) }}" method="post">
                                                @csrf
                                                <div class="btn-group">
                                                    {{--                                                    @can('permission.edit')--}}
                                                    <a href="{{ route('categoryEdit',$category->id) }}" type="button" class="btn btn-info btn-sm"> @lang('global.edit')</a>
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
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
