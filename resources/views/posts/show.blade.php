@extends('layouts.master')

@section('breadcrumb')
    Posts
@endsection

@section('title')
    Posts List
@endsection

@section('body')

    <div class="row">

        @include('layouts.partials.flash')

        <div class="col-10 mx-auto">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $post->title }} By {{ optional($post->user)->name }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-0 "><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h6>
                    <p class="text-sm ">{{ $post->content }}</p>
                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">published</i>
                        <p class="mb-0 text-sm"> {{ $post->created_at }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
