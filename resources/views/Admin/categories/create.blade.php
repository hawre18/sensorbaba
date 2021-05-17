@extends('Admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ایجاد دسته بندی جدید</h3>
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
                        <form method="post" action="\admins\categories">
                            @csrf
                            <div class="form-group">
                                <label for="name">نام</label>
                                <input type="text" name="title" class="form-control" placeholder="عنوان دسته بندی">
                            </div>
                            <div class="form-group">
                                <label for="category_parent">دسته والد</label>
                                <select name="category_parent" class="form-control">
                                    <option value="">انتخاب کنید</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == old('$category_parent')) selected @endif>{{$category->name}}</option>
                                        @if(count($category->childrenRecursive)>0)
                                            @include('Admin.partials.category',['categories'=>$category->childrenRecursive, 'level'=>1])
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="meta_title">عنوان سئو</label>
                                <input type="text" name="meta_title" value="{{old('meta_title')}}" class="form-control" placeholder="عنوان سئو را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="meta_desc">توضیحات سئو</label>
                                <input type="text" name="meta_desc" value="{{old('meta_desc')}}" class="form-control" placeholder="توضیحات سئو را وارد کنید">
                            </div>
                            <div class="form-group">
                                <label for="meta_keywords">کلمات کلید سئو</label>
                                <input type="text" name="meta_keywords" value="{{old('meta_keywords')}}" class="form-control" placeholder="کلمات کلیدی سئو را وارد کنید">
                            </div>
                            <button type="submit" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
