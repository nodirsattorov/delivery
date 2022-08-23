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
                        <li class="breadcrumb-item"><a href="{{ route('categoryIndex') }}">Управление категория</a></li>
                        <li class="breadcrumb-item active">@lang('global.add')</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->

    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">@lang('global.add')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{ route('categoryCreate') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label>Название на русском</label>
                                <input type="text" name="name_ru" class="form-control {{ $errors->has('name_ru') ? "is-invalid":"" }}" value="{{ old('name_ru') }}" required>
                                @if($errors->has('name_ru') || 1)
                                    <span class="error invalid-feedback">{{ $errors->first('name_ru') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Название на узбекском</label>
                                <input type="text" name="name_uz" class="form-control" value="{{ old('name_uz') }}" required>
                            </div>
                            <div class="form-group">
                                <label>Родительская категория</label>
                                <select class="form-control select2" style="width: 100%;" name="parent_id" value="{{ old('parent_id') }}" require>
                                    <option value="0" selected> - </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" >{{$category->name_ru}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('categoryIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
