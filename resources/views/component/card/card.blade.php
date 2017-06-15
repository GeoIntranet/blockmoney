<div class="card">
    <h3 class="card-header">{{$header or '$header' }}</h3>
    <div class="card-block">
        <h4 class="card-title">{{$title or '$title'}}</h4>
        <p class="card-text">{{$body or '$body'}}</p>
        {{--<a href="#" class="btn btn-primary">Go somewhere</a>--}}
    </div>
    <div class="card-footer text-muted">
        {{$footer or '$footer'}}
    </div>
</div>