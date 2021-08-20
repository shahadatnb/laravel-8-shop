<div class="float-right">
    <a class="btn btn-primary btn-xs" href="{{ route('menuItem.edit',$item->id)}}">Edit</a>                                
    <a onclick="return confirm('Are You Sure To Delete This Item?')" href="{{route('menuItem.delete',$item->id)}}" class="btn btn-xs btn-danger">Delete</a>
</div>

