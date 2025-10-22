@extends('layouts.master')

@section('content')

    <div class="container m-5">
        <div class="row">
            <div class="col-4">
                <form action="{{ route('blogCreate') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <img src="" id="output" class="img-thumbnail">
                    <input type="file" name="image" id="" class="form-control @error ('image') is-invalid @enderror" onchange="loadFile(event)">
                    @error('image') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control @error ('title') is-invalid @enderror my-2" placeholder="Enter Blog Title...">
                    @error('title') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <textarea name="description" class="form-control @error ('description') is-invalid @enderror " cols="30" rows="10" placeholder="Enter Blogs Description...">{{ old('description') }}</textarea>
                    @error('description') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="number" name="fee" value="{{ old('fee') }}" class="form-control @error ('fee') is-invalid @enderror my-2" placeholder="Enter Blog Fee...">
                    @error('fee') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="text" name="address" value="{{ old('address') }}" class="form-control @error ('address') is-invalid @enderror my-2" placeholder="Enter Blog Address...">
                    @error('address') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <select name="rating" id="" class="form-control @error ('rating') is-invalid @enderror">
                        <option value="">Choose Rating...</option>
                        <option value="1" @if (old('rating') == 1) selected  @endif>1Star</option>
                        <option value="2" @if (old('rating') == 2) selected  @endif>2Stars</option>
                        <option value="3" @if (old('rating') == 3) selected  @endif>3Stars</option>
                        <option value="4" @if (old('rating') == 4) selected @endif>4Stars</option>
                        <option value="5" @if (old('rating') == 5) selected  @endif>5Stars</option>
                    </select>
                    @error('rating') 
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <input type="submit" value="Create" class="btn btn-danger my-3">
                </form>
            </div>
            <div class="col offset-1">
                <div class="row">
                    <div class="col offset-6">
                            <form action="{{ route('blogList') }}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="searchKey" value="{{ request('searchKey')}}" class="form-control" placeholder="Search keywords..." aria-label="Recipient’s username" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                        Search<i class="ms-1 fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
                @foreach ($data as $item)
                    <div class="card shadow-sm mt-3">
                        <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="">{{ $item->title}}</div>
                            <div class="">{{ $item->created_at->format('j-F-Y') }}</div>
                        </div>
                        <div class="my-2 text-muted">
                            {{ Str::words($item->description, 20, '...') }}
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <i class="fa-solid fa-money-bill mr-2 text-primary"></i>{{ $item->fee}} mmk |
                                <i class="fa-solid fa-location-dot mr-2 text-danger"></i>{{ $item->address}} |
                                <i class="fa-solid fa-star mr-2 text-warning"></i>{{ $item->rating}} |
                            </div>
                            <div class="">
                                <a href="{{ route('blogDetail', $item->id) }}"><button class="btn btn-primary"><i class="fa-solid fa-eye"></i></button></a>
                                <a href="{{ route('blogEdit', $item->id) }}"><button class="btn btn-secondary"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                <a href="{{ route('blogDelete',$item->id) }}"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <span class="d-flex justify-content-end mt-2">{{ $data->links()}}</span>
            </div>
        </div>
    </div>
    
@endsection