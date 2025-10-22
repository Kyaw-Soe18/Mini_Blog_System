
@extends('layouts.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                @if ($data->image == null)
                <img src="{{ asset('defaultImage/default-image.png') }}" alt="" class="img-thumbnail w-100">
                @else
                <img src="{{ asset('uploads/'.$data->image) }}" alt="" class="img-thumbnail">
                @endif
            </div>
            <div class="col-6">
                <h3>{{ $data->title }}</h3>
                <hr>
                <p class="text-muted"> {{ $data->description}}</p>
                <div class="">
                    <i class="fa-solid fa-money-bill mr-2 text-primary"></i>{{ $data->fee }} mmk |
                    <i class="fa-solid fa-location-dot mr-2 text-danger"></i>{{ $data->address }} |
                    <i class="fa-solid fa-star mr-2 text-warning"></i> {{ $data->rating }}
                </div>

                {{-- <a href="{{route('blogList')}}"><button class="btn btn-sm bg-black text-white mt-3">Back</button></a> --}}
                <button class="btn btn-sm bg-black text-white mt-3" onclick="history.back()">Back</button>
            </div>
        </div>
    </div>
    
@endsection