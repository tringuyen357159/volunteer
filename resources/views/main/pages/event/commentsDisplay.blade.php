@foreach($comments as $comment)
<style>
   .d-none{display:none;}
   .d-notnone{display: block;}
</style>
<div class="content-comment" @if($comment->parent_id != null) style="margin-left:20px; margin-top:15px" @endif>
    <img src="{{url('photo/user', $comment->user->photo)}}" alt="">
    <div class="info-comment">
        <div class="header-info">
            <div class="header-info-left">
                <span>{{ $comment->user->name }}</span>
            </div>
            <small>{{ $comment->created_at }}</small>
        </div>
        <div class="body-comment">
            <p>
                {{ $comment->body }}
            </p>
        </div>
        <div class="footer-comment reply">

            <span>
                <a href="javascript:;void(0);" class=""><i class="far fa-comment-dots checkk"> Trả lời</i></a>
            </span>
        </div>
        <div class="ip-comment reply-form d-none">
            <form method="post" action="{{ route('comment.event') }}" style="display: flex">
                @csrf
                <div class="rounded-circle">
                    <img src="{{asset('home/img/donate.jpg')}}" alt="">
                </div>
                <input type=hidden name=event_id value="{{ $event_id }}" />
                <input type=hidden name=parent_id value="{{ $comment->id }}" />
                <input type="text" name="body"  placeholder="Nhập bình luận...">
            </form>
        </div>
        @include('main.pages.event.commentsDisplay', ['comments' => $comment->replies])
    </div>
</div>

@endforeach

@section('jsblock')
<script type="text/javascript">
    $(document).ready(function () {
        $('.reply').click(function () {
          $(this).next().toggleClass('d-notnone')
        })
    })
</script>
@endsection

