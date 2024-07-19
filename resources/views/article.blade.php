@extends("template")

@section("title", "Detail Article")

@section("content")
    <h3>{{ $article["title"] }}</h3>
    <h6 class="text-muted"><i class="bi bi-pencil mr-2"></i>{{ $article["writer"] }}</h6>
    <h6 class="text-muted"><i class="bi bi-clock mr-2"></i>{{ $article["created_at"] }}</h6>

    <p class="mt-3">
        {{ $article["content"] }}
    </p>

    <a  href="{{ url("") }}" class="btn btn-primary">Back</a>
@endsection