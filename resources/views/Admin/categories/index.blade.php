@extends('Admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">دسته بندی ها</h3>
                <div class="text-left">
                    <a class="btn btn-app"  href="{{route('categories.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('category_success'))
                    <div class="alert alert-success">
                        <div>{{session('category_success')}}</div>
                    </div>
                @elseif(Session::has('category_error'))
                    <div class="alert alert-danger">
                        <div>{{session('category_error')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{$category->name}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{route('categories.edit',$category->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('categories.delete',$category->id)}}">حذف</a>
                                        <a class="btn btn-primary" href="{{route('categories.indexSetting',$category->id)}}">ایجاد ویژگی</a>
                                    </td>
                                </tr>
                                @if(count($category->childrenRecursive)>0)
                                    @include('Admin.partials.category_list',['categories'=>$category->childrenRecursive, 'level'=>1])
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.table-responsive -->
                    <div class="center-block text-center">{{ $categories->links() }}</div>
            </div>
            <!-- /.box-body -->
    </section>
@endsection
