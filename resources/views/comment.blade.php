<div class="media mt-4">
    <img class="mr-3 rounded-circle" alt="Bootstrap Media Preview" src="https://i.imgur.com/stD0Q19.jpg" />
    <div class="media-body">
        <div class="row">
            <div class="col-8 d-flex">
                <h5>{{$comment['user']['name']}}</h5>
                <span class="pl-4">  {{$comment['created_at']}}</span>
            </div>

            <div class="col-4">

                <div class="pull-right reply">

                    <a href="#" class="submit-id" dataid="{{$comment['id']}}"><span><i class="fa fa-reply" ></i> reply</span></a>

                </div>

            </div>
        </div>
            {{$comment['text']}}
        @foreach($comment['comments'] as $comment_nested)
            @include("comment-nested")
        @endforeach
    </div>
</div>
