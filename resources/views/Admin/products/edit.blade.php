@extends('admin.layout.master')
@section('styles')
    <link rel="stylesheet" href="{{asset('/admin/dist/css/dropzone.css')}}">
@endsection
@section('content')
    <section id="app" class="content" style="direction: rtl">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title pull-right">ویرایش محصول</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @include('Admin.layout.errors')
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form method="post" action="\admins\products\{{$product->id}}">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <div class="form-group">
                                <label for="title">نام محصول</label>
                                <input type="text" name="title" value="{{$product->title}}" class="form-control" placeholder="نام محصول">
                            </div>
                            <div class="form-group">
                                <label for="slug">نام مستعار محصول</label>
                                <input type="text" name="slug" value="{{$product->slug}}" class="form-control" placeholder="نام مستعار محصول">
                            </div>
                            <attribute-component :brands="{{$brands}}" :product="{{$product}}"></attribute-component>
                            <div>
                                <label >وضعیت نشر</label>
                                <div>
                                    <input type="radio" name="status" value="0" @if($product->status==0) checked @endif ><span>منتشر نشده</span>
                                    <input type="radio" name="status" value="1" @if($product->status==1) checked @endif><span>منتشر شده</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label >قیمت</label>
                                <input type="number" name="price" value="{{$product->price}}" class="form-control" placeholder="قیمت محصول">
                            </div>
                            <div class="form-group">
                                <label >قیمت ویژه</label>
                                <input type="number" name="discount_price" value="{{$product->discount_price}}" class="form-control" placeholder="قیمت ویژه محصول">
                            </div>
                            <div class="form-group">
                                <label >توضیحات کوتاه</label>
                                <textarea id="ShortDescription" name="short_description" class="form-control" >{{$product->short_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label >توضیحات اصلی</label>
                                <textarea  id="longDescription" name="long_description" class="form-control" >{{$product->long_description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">گالری تصاویر</label>
                                <input type="hidden" name="photo_id[]" id="product-photo">
                                <div class="form-control dropzone" id="photo"></div>
                                @foreach($product->photos as $photo)
                                    <div class="col-sm-3" id="updated_photo_{{$photo->id}}">
                                        <img class="img-responsive" src="{{$photo->path}}">
                                        <button type="button" class="btn btn-danger" onclick="removeImages({{$photo->id}})">حذف</button>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="mete_title">عنوان سئو</label>
                                <input type="text" name="slug" value="{{$product->meta_title}}" class="form-control" placeholder="عنوان سئو">
                            </div>
                            <div class="form-group">
                                <label for="mete_desc">توضیحات سئو</label>
                                <input type="text" name="slug" value="{{$product->mete_desc}}" class="form-control" placeholder="توضیحات سئو">
                            </div>
                            <div class="form-group">
                                <label for="mete_keywords">کلمات کلیدی سئو</label>
                                <input type="text" name="slug" value="{{$product->mete_keywords}}" class="form-control" placeholder="کلمات کلیدی سئو">
                            </div>
                            <button type="submit" onclick="productGallery()" class="btn btn-success pull-left">ذخیره</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
@endsection
@section('script-vuejs')
    <script src="{{asset('/admin/js/app.js')}}"></script>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('/admin/dist/js/dropzone.js')}}"></script>
    <script type="text/javascript" src="{{asset('/admin/plugins/ckeditor/ckeditor.js')}}"></script>
    <script>
        Dropzone.autoDiscover=false;
        var photosGallery=[]
        var photo=[].concat({{$product->photos->pluck('id')}})
        var drop=new Dropzone('#photo',{
            addRemoveLinks:true,
            url:"{{route('photos.upload')}}",
            sending:function (file,xhr,formData) {
                formData.append("_token","{{csrf_token()}}")
            },
            success: function (file,response) {
                photosGallery.push(response.photo_id)
            }
        });
        productGallery=function () {
                document.getElementById('product-photo').value=photosGallery.concat(photo)
        }
        CKEDITOR.replace('ShortDescription',{
            customConfig:'config.js',
            toolbar:'simple',
            language:'fa',
            removePlugins:'cloudservices, easyimage'
        });
        CKEDITOR.replace('longDescription',{
            customConfig:'config.js',
            toolbar:'simple',
            language:'fa',
            removePlugins:'cloudservices, easyimage'
        })
        removeImages=function (id) {
            var index=photo.indexOf(id)
            photo.splice(index,1);
            document.getElementById('updated_photo_'+id).remove();
        }
    </script>
@endsection
