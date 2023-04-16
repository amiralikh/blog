@extends('layouts.master')

@section('breadcrumb')
    Posts
@endsection

@section('title')
    {{ $post->title }}
@endsection

@section('body')

    <div class="row">

        <div class="col-10 mx-auto">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $post->title }} By {{ optional($post->user)->name }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 ">{{ $post->title }}</h6>
                    <p class="text-sm ">{{ $post->content }}</p>

                    <div class="row">
                       @foreach($post->tags as $tag)
                            <div class="col-lg-2">
                                <a class="btn bg-gradient-secondary" href="{{ route('posts.tags',$tag->name) }}" >{{ $tag->name }}</a>
                            </div>
                       @endforeach
                    </div>

                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">published</i>
                        <p class="mb-0 text-sm"> {{ $post->created_at }} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-10 mx-auto">
            <div class="card card-body  mt-2">
                <div class="row gx-4 mb-2">

                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                Comments
                            </h5>
                        </div>
                    </div>

                </div>
                @include('layouts.partials.flash')
                <form method="post" action="{{ route('comments.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="input-group input-group-outline my-3">
                                <label class="form-label">Leave your comment</label>
                                <textarea type="text" name="content" rows="5" class="form-control">{{ old('content') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
                <div class="row">
                    @foreach($post->comments as $comment)
                        <div class="col-12">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">{{ optional($comment->user)->name }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <p class="text-sm">
                                        {{ $comment->content }}
                                    </p>
                                    <hr class="horizontal gray-light my-4">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Date:</strong> &nbsp; {{ $comment->created_at }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @if(sizeof($post->comments) === 0)
                        <div class="col-12">
                            <div class="card card-plain h-100">
                                <div class="card-body p-3">
                                    <p class="text-sm">
                                        Be first one who leave comment for this post
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>



    </div>


@endsection
