@extends('layouts.app')

@section('title', 'Alle berichten')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Alle berichten</h1>
            <a href="{{route('posts.create')}}" class="btn btn-success">Maak een nieuw bericht aan</a>
            <br><br>
            <div class="row row-cols-1 row-cols-md-3 g-3">
                @foreach($posts as $post)
                    <div class="col-mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="card-title">
                                    <h4>{{$post->title}}</h4>
                                </div>
                                <div class="card-image">
                                    @php
                                        $fileSize = getimagesize('storage/'. $post->thumbnail);
                                        $width = $fileSize['0'];
                                        $height = $fileSize['1'];
                                    @endphp
                                    @if($width >= $height)
                                        <img style="width: 150px;"
                                             src="{{ asset('storage/'. $post->thumbnail) }}"
                                             alt="Foto met titel: {{$post->title}}">
                                    @else
                                        <img style="height: 150px;"
                                             src="{{ asset('storage/'. $post->thumbnail) }}"
                                             alt="Foto met titel: {{$post->title}}">
                                    @endif
                                </div>
                                <br>
                                <div class="card-text">
                                    <p>{!! \Illuminate\Support\Str::limit($post->description, 50) !!}</p>
                                    <br>
                                    <a href="{{route('posts.show', $post->id)}}" class="btn btn-success btn-sm">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
