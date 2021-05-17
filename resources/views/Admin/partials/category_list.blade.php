@foreach($categories as $sub_category)
    <tr>
        <td class="text-center">{{$sub_category->id}}</td>
        <td class=>{{str_repeat('-----',$level)}}{{$sub_category->name}}</td>
        <td class="text-center">
            <a class="btn btn-warning" href="{{route('categories.edit',$sub_category->id)}}">ویرایش</a>
            <a class="btn btn-danger" href="{{route('categories.delete',$sub_category->id)}}">حذف</a>
            <a class="btn btn-primary" href="{{route('categories.indexSetting',$sub_category->id)}}">ایجاد ویژگی</a>
        </td>
    </tr>
    @if(count($sub_category->childrenRecursive)>0)
        @include('admin.partials.category_list',['categories'=>$sub_category->childrenRecursive, 'level'=>$level+1])
    @endif
@endforeach
