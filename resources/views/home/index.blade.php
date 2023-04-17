@extends('layouts.master')

@section('breadcrumb')
    Home
@endsection

@section('title')
    Home Page
@endsection

@section('body')
    <h5>Most interesting post according to user comments</h5>
    <div class="row">

        @foreach($data['comments_posts'] as $post)
            <div class="col-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ $post->title }}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 "><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h6>
                        <p class="text-sm ">{{ \Illuminate\Support\Str::limit($post->content,250) }}</p>
                        <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">published</i>
                            <p class="mb-0 text-sm"> {{ $post->created_at->diffForHumans() }} </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <h5>Posts with most Tags</h5>
    <div class="row">

        @foreach($data['tags_posts'] as $post)
            <div class="col-4">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">{{ $post->title }}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0 "><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h6>
                        <p class="text-sm ">{{ \Illuminate\Support\Str::limit($post->content,250) }}</p>
                        <hr class="dark horizontal">
                        <div class="d-flex ">
                            <i class="material-icons text-sm my-auto me-1">published</i>
                            <p class="mb-0 text-sm"> {{ $post->created_at->diffForHumans() }} </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <h6>Top 5 Active Users</h6>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Comments Count</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data['active_users'] as $user)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $user->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $user->email }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                    <span class="text-xs font-weight-bold">{{ $user->comments_count }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
