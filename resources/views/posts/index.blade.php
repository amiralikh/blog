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

        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Posts List</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">


                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publish Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ optional($post->user)->name }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ optional($post->user)->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $post->title }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $post->created_at }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('posts.edit',$post->id) }}" class="text-secondary font-weight-bold text-xs " data-toggle="tooltip" data-original-title="Edit post">
                                            Edit
                                        </a>
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="post">
                                            @csrf @method('delete')
                                            <button type="submit" class=" text-danger font-weight-bold text-xs btn-reset" data-toggle="tooltip" data-original-title="Deletepost">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if(sizeof($posts) === 0)
                                <tr>
                                    <td colspan="4">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-center">Sorry no post yet</h6>
                                            <p class="text-xs text-secondary text-center mb-0">be first one who <a
                                                    href="{{ route('posts.create') }}">submit</a> amazing post!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $posts->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>


@endsection
