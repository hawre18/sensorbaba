@extends('admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ویرایش گروه ویژگی{{$attribute->title}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @include('Admin.layout.errors')
                        <form method="post" action="\admins\attributes\{{$attribute->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">عنوان</label>
                                <input type="text" name="title" class="form-control" value="{{$attribute->title}}">
                            </div>
                            <div class="form-group">
                                <label for="type">نوع</label>
                                <select name="type" class="form-control">
                                    <option value="">انتخاب کنید</option>
                                        <option value="select" @if($attribute->type=="select") selected @endif >لیست تکی</option>
                                        <option value="multiple" @if($attribute->type=="multiple") selected @endif >لیست چندتایی</option>
                                </select>
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
