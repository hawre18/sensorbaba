@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">محصولات</h3>
                <div class="text-left">
                    <a class="btn btn-app"  href="{{route('products.create')}}">
                        <i class="fa fa-plus"></i> جدید
                    </a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if(Session::has('product_success'))
                    <div class="alert alert-success">
                        <div>{{Session('products_success')}}</div>
                    </div>
                @elseif(Session::has('product_error'))
                    <div class="alert alert-danger">
                        <div>{{Session('products_error')}}</div>
                    </div>
                @endif
                <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th class="text-center">شناسه</th>
                                <th class="text-center">کد محصول</th>
                                <th class="text-center">نام محصول</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center"><a href="{{ route('products.show', $product->id)}}">{{ $loop->index + 1 }}</a></td>
                                    <td class="text-center"><a href="{{ route('products.show', $product->id)}}">{{$product->sku}}</a></td>
                                    <td class="text-center"><a href="{{ route('products.show', $product->id)}}">{{$product->title}}</a></td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="{{route('products.edit',$product->id)}}">ویرایش</a>
                                        <a class="btn btn-danger" href="{{route('products.delete',$product->id)}}">حذف</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <!-- /.table-responsive -->
                    <div class="center-block text-center">{{ $products->links() }}</div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection
