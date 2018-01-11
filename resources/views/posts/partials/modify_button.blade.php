@if(auth()->check())
    @if(auth()->user()->id == $post->user_id)
        <a href="{{ route('post.edit',$post->id) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> 修改</a>
        <a href="{{ route('post.destroy',$post->id) }}" class="btn btn-danger btn-xs text-right" id="post{{ $post->id }}" onclick="bbconfirm2('post{{ $post->id }}','你確定要刪除這則公告？')"><i class="fa fa-trash"></i> 刪除</a>
    @endif
@endif