@extends('Admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ویرایش دسته بندی{{$category->name}}</h3>
                <div class="text-left">
                    <a class="btn btn-app">
                        <i class="fa fa-plus" href="{{route('categories.create')}}"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('Admin.layout.errors')
                        <form method="post" action="\admins\categories\{{$category->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" name="title" class="form-control" value="{{$category->name}}">
                            </div>
                            <div class="form-group">
                                <label for="category_parent">دسته والد</label>
                                <select name="category_parent" class="form-control">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($categories as $category_data)
                                        <option value="{{$category_data->id}}" @if($category->parent_id==$category_data->id) selected @endif>{{$category_data->name}}</option>
                                        @if(count($category_data->childrenRecursive)>0)
                                            @include('Admin.partials.category',['categories'=>$category_data->childrenRecursive, 'level'=>1,'selected_category'=>$category])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">عنوان سئو</label>
                                <input type="text" name="meta_title" class="form-control" value="{{$category->meta_title}}">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">توضیحات سئو</label>
                                <textarea type="text" name="meta_desc" class="form-control">{{$category->meta_desc}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">کلمات کلید سئو</label>
                                <input type="text" name="meta_keywords" class="form-control" value="{{$category->meta_keywords}}">
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
    </section>
@endsection
