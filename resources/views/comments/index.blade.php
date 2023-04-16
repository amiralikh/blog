@extends('layouts.master')

@section('breadcrumb')
    Comments
@endsection

@section('title')
    Comments List
@endsection

@section('body')

    <div class="row">

        @include('layouts.partials.flash')

        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Comments List</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">


                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Post</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publish Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Approve</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $comment->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ optional($comment->post)->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ optional($comment->user)->name }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $comment->created_at }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $comment->is_approved === 1 ? 'APPROVE' : 'NOT APPROVE' }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('comments.edit',$comment->id) }}" class="text-secondary font-weight-bold text-xs " data-toggle="tooltip" data-original-title="Edit post">
                                            Edit
                                        </a>
                                        <form action="{{ route('comments.destroy',$comment->id) }}" method="post">
                                            @csrf @method('delete')
                                            <button type="submit" class=" text-danger font-weight-bold text-xs btn-reset" data-toggle="tooltip" data-original-title="Deletepost">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if(sizeof($comments) === 0)
                                <tr>
                                    <td colspan="4">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-center">Sorry no comment submitted yet</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $comments->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>


@endsection
