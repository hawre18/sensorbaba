@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">گروه های ویژگیا</h3>
                <div class="text-left">
                    <a class="btn btn-app"  href="{{route('attributes.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('attribute_success'))
                    <div class="alert alert-success">
                        <div>{{Session('attribute_success')}}</div>
                    </div>
                @elseif(Session::has('attribute_error'))
                    <div class="alert alert-error">
                        <div>{{Session('attribute_error')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">نوع</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attributes as $attribute)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td class="text-center">{{$attribute->title}}</td>
                                    <td class="text-center">{{$attribute->type}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{route('attributes.edit',$attribute->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('attributes.delete',$attribute->id)}}">حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.table-responsive -->
                    <div class="center-block text-center">{{ $attributes->links() }}</div>
            </div>
        </div>
            <!-- /.box-body -->
    </section>
@endsection
