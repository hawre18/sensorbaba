@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl;">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">برندها</h3>
                <div class="text-left">
                    <a class="btn btn-app" href="{{route('brands.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('brand_success'))
                    <div class="alert alert-success">
                        <div>{{session('brand_success')}}</div>
                    </div>
                    @elseif(Session::has('brand_error'))
                        <div class="alert alert-danger">
                            <div>{{session('brand_error')}}</div>
                        </div>
                @endif
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th class="text-center">شناسه</th>
                            <th class="text-center">عنوان</th>
                            <th class="text-center">توضیحات</th>
                            <th class="text-center">تصویر برند</th>
                            <th class="text-center">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <td class="text-center"><a href="{{ route('brands.show', $brand->id) }}">{{$loop->index + 1 }}</a></td>
                                <td class="text-center"><a href="{{ route('brands.show', $brand->id) }}">{{$brand->title}}</a></td>
                                <td class="text-center"><a href="{{ route('brands.show', $brand->id) }}">{{mb_substr($brand->description, 0, 15).' ...' }}</a></td>
                                <td class="img-circle text-center"><a href="{{ route('brands.show', $brand->id) }}"><img width="17%" src="{{$brand->photo->path}}"></a></td>
                                <td class="text-center">
                                    <a class="btn btn-warning" href="{{route('brands.edit', $brand->id)}}">ویرایش</a>
                                    <a type="submit" class="btn btn-danger" href="{{route('brands.delete', $brand->id)}}">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                    <div class="center-block text-center">{{ $brands->links() }}</div>
            </div>
        </div>
    </section>

@endsection
