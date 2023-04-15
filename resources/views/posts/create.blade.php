@extends('layouts.master')

@section('breadcrumb')
    Posts
@endsection

@section('title')
    Create New Post
@endsection

@section('body')

    <div class="row min-vh-80">

        <div class="col-8 mx-auto">


            <div class="card mt-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Create New Post</h6>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.flash')

                    <form method="post" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Post Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Post Content</label>
                                    <textarea type="text" name="content" rows="5" class="form-control">{{ old('content') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <select class="form-select" name="tags[]" multiple aria-label="multiple select example">
                                    <option selected>Open this select tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" @if(old('tag_id') == $tag->id) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
