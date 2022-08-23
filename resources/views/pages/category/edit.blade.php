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
                        <h3 class="card-title">@lang('global.edit')</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('categoryUpdate',$category->id) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Название на русском</label>
                                <input type="text" name="name_ru" class="form-control {{ $errors->has('name_ru') ? "is-invalid":"" }}" value="{{ old('name_ru',$category->name_ru) }}" required>
                                @if($errors->has('name_ru') || 1)
                                    <span class="error invalid-feedback">{{ $errors->first('name_ru') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Название на узбекском</label>
                                <input type="text" name="name_uz" class="form-control" value="{{ old('name_uz',$category->name_uz) }}" required>
                            </div>
                            <div class="form-group">
                                <label>Родительская категория</label>
                                <select class="form-control select2" style="width: 100%;" name="parent_id" value="{{ old('parent_id',$category->parent_id) }}" require>
                                    <option value="0"> - </option>
                                    @foreach($categories as $categoryItem)
                                        @if($categoryItem->id != $category->id)
                                            <option value="{{$categoryItem->id}}" {{ $categoryItem->id == $category->parent_id ? 'selected' : '' }} >{{$categoryItem->name_ru}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="old_parent_id" class="form-control" value="{{ old('old_parent_id', $category->parent_id) }}" required>
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
