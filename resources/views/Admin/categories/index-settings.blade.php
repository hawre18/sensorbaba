@extends('Admin.layout.master')

@section('content')
    <section class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">تعیین ویژگی های دسته بندی {{$category->name}}</h3>
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
                        <form method="post" action="\admins\categories.saveSetting\{{$category->id}}">
                            @csrf
                            <div class="form-group">
                                <label for="attributeGroups">تعیین ویژگی های دسته بندی {{$category->name}}</label>
                                <select name="attributeGroups[]" class="form-control" multiple>
                                    @foreach($attributeGroups as $attributeGroup)
                                        <option value="{{$attributeGroup->id}}" @if(in_array($attributeGroup->id,$category->attributeGroups->pluck('id')->toArray())) selected @endif>{{$attributeGroup->title}}</option>
                                    @endforeach
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
