@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl;">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">جزئیات برند {{$brand->title}}</h3>
                <div class="text-left">
                    <a class="btn btn-app" href="{{route('brands.index')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                            <lable>عنوان: {{$brand->title}}</lable></br>
                            <lable for="description">توصیحات: </lable></br>
                            <textarea id="description">{{$brand->description}}</textarea></br>
                            <lable for="image">تصویر برند: </lable></br>
                            <img width="20%" src="{{$brand->photo->path}}">
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
    </section>

@endsection
