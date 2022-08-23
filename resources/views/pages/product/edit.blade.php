@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Управление продукты</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('global.home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('productIndex') }}">Управление продукты</a></li>
                        <li class="breadcrumb-item active">@lang('global.edit')</li>
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
                        @if(sizeof($products))
                            <button style="font-size: 14px; font-weight: 500;" type="button" class="btn btn-danger btn-sm float-right" data-toggle="modal" data-target="#modal-lg_jowiproducts">
                                @lang('global.jowiproducts')
                            </button>
                        @endif
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('productUpdate',$product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Название на русском</label>
                                        <input type="text" name="name_ru" class="form-control {{ $errors->has('name_ru') ? "is-invalid":"" }}" value="{{ old('name_ru',$product->name_ru) }}" required>
                                        @if($errors->has('name_ru') || 1)
                                            <span class="error invalid-feedback">{{ $errors->first('name_ru') }}</span>
                                        @endif
                                    </div>
                                    <div class="col">
                                        <label>Название на узбекском</label>
                                        <input type="text" name="name_uz" class="form-control" value="{{ old('name_uz',$product->name_uz) }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Описание на русском</label>
                                        <textarea rows="3" name="description_ru" class="form-control">{{ old('description_ru',$product->description_ru) }}</textarea>
                                    </div>
                                    <div class="col">
                                        <label>Описание на узбекском</label>
                                        <textarea rows="3" name="description_uz" class="form-control">{{ old('description_uz',$product->description_uz) }}</textarea>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group " id="price">
                                <div class="row">
                                    <div class="col-6">
                                        <label >Цена</label>
                                        <input type="number" min="0" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                                    </div>
                                    <div class="col-6">
                                        <label>Категории</label>
                                        <select class="form-control select2" style="width: 100%;" name="category_id" value="{{ old('category_id',$product->category_id) }}" required>
                                            @foreach($categories as $category)
                                                <option @if($product->category_id == $category->id) {{'selected'}} @endif value="{{$category->id}}" >{{" ".$category->name_ru}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Изображение</label>
                                        <input style="border: 0px; padding-left: 0px" type="file" name="photo" class="form-control">
                                    </div>
                                    <div class="col">
                                        <img  style="width: 80px" src="/images/{{$product->photo}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn btn-success float-right">@lang('global.save')</button>
                                <a href="{{ route('productIndex') }}" class="btn btn-default float-left">@lang('global.cancel')</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
