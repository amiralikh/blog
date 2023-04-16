@extends('layouts.master')

@section('breadcrumb')
    Comments
@endsection

@section('title')
    {{ 'Comment #'.$comment->id }}
@endsection

@section('body')

    <div class="row">
        <div class="col-10 mx-auto">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ optional($comment->post)->title }} By {{ optional($comment->user)->name }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-sm ">{{ $comment->content }}</p>

                    <hr class="dark horizontal">
                    <div class="d-flex ">
                        <i class="material-icons text-sm my-auto me-1">published</i>
                        <p class="mb-0 text-sm"> {{ $comment->created_at }} </p>
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
                                Approve
                            </h5>
                        </div>
                    </div>

                </div>
                @include('layouts.partials.flash')
                <form method="post" action="{{ route('comments.approve',$comment->id) }}">
                    @csrf
                    <button type="submit" @if($comment->is_approved == 1) disabled @endif class="btn btn-primary">Approve</button>

                </form>
            </div>
        </div>



    </div>


@endsection
