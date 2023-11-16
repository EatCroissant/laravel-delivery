<div class="media mt-4">
    <a class="pr-3" href="#"><img class="rounded-circle" alt="Bootstrap Media Another Preview" src="https://i.imgur.com/xELPaag.jpg" /></a>
    <div class="media-body">

        <div class="row">
            <div class="col-12 d-flex">
                <h5>
                    {{$comment_nested['user']['name']}}</h5>
                <span class="pl-4">
        {{$comment_nested['created_at']}}</span>
            </div>


        </div>
        {{$comment_nested['text']}}
    </div>
</div>
