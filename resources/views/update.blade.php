
@extends('layouts.master')

@section('content')

    <div class="container mt-4">
        <form action="{{ route('blogUpdate') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    @if ($data->image == null)
                        <img src="{{ asset('defaultImage/default-image.png') }}" id="output" alt="" class="img-thumbnail w-100">
                    @else
                        <img src="{{ asset('uploads/'.$data->image) }}" id="output" alt="" class="img-thumbnail">
                    @endif
                    <input type="file" name="image" class="form-control my-2 @error ('image') is-invalid @enderror" onchange="loadFile(event)">
                    @error('image') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-6">
                    <input type="hidden" name="blog_id" value="{{ $data->id }}">
                    <input type="hidden" name="old_image" value="{{ $data->image }}">
                    <input type="text" name="title" class="form-control my-2 @error ('title') is-invalid @enderror" value="{{ old('title', $data->title) }}" placeholder="Enter title...">
                    @error('title') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <textarea name="description" class="form-control my-2 @error ('description') is-invalid @enderror" cols="30" rows="10" placeholder="Enter description...">{{ old('description', $data->description) }}</textarea>
                    @error('description') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="number" name="fee" class="form-control my-2 @error ('fee') is-invalid @enderror" value="{{ old('fee', $data->fee) }}" placeholder="Enter fee...">
                    @error('fee') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="address" class="form-control my-2 @error ('address') is-invalid @enderror" value="{{ old('address', $data->address) }}" placeholder="Enter address...">
                    @error('address') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <select name="rating" id="" class="form-control my-2 @error ('rating') is-invalid @enderror">
                        {{-- <option value="">Choose Rating...</option> --}}
                        <option value="1" @if(old('rating', $data->rating) == 1) selected @endif>1Star</option>
                        <option value="2" @if(old('rating', $data->rating) == 2) selected @endif>2Stars</option>
                        <option value="3" @if(old('rating', $data->rating) == 3) selected @endif>3Stars</option>
                        <option value="4" @if(old('rating', $data->rating) == 4) selected @endif>4Stars</option>
                        <option value="5" @if(old('rating', $data->rating) == 5) selected @endif>5Stars</option>
                    </select>
                    @error('rating') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    {{-- <button type="button" class="btn btn-sm bg-black text-white mt-3" onclick="history.back()">Back</button> --}}
                    
                    <a href="{{ route('blogList')}}"><button type="button" class="btn btn-sm bg-black text-white mt-3">Back</button></a>
                    <button type="submit" class="btn btn-sm bg-primary text-white mt-3">Update</button>
                </div>
            </div>
        </form>
    </div>
    
@endsection