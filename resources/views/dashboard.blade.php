@extends("template")

@section("title", "Dashboard")

@section("content")
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="pills-article-tab" data-toggle="pill" data-target="#pills-article" type="button" role="tab" aria-controls="pills-article" aria-selected="true">Article</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-video-tab" data-toggle="pill" data-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">Video</button>
        </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-article" role="tabpanel" aria-labelledby="pills-article-tab">
            @foreach($article as $data)
                <a href="{{ url('/article/'.$data->id) }}">
                    <h4>{{ $data->title }}</h4>
                </a>
                <p>
                    {{ substr($data->content, 0, 200) }} 
                    ... 
                    <a href="{{ url('/article/'.$data->id) }}">[Read More]</a> 
                </p>
                <hr>
            @endforeach
        </div>
        <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
            <div class="row">
                @foreach($video as $data)
                    <div class="col-4">
                        <h4>{{ $data->title }}</h4>
                        <iframe
                            src="{{ $data->link }}">
                        </iframe> 
                    </div>
                @endforeach
            </div>
        </div>
    </div>  
@endsection