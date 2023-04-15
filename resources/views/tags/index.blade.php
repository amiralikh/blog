@extends('layouts.master')

@section('breadcrumb')
    Tags
@endsection

@section('title')
    Tags List
@endsection

@section('body')

    <div class="row">

        @include('layouts.partials.flash')

        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Tags List</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">


                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Publish Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $tag->name }}</h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $tag->created_at }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('tags.edit',$tag->id) }}" class="text-secondary font-weight-bold text-xs " data-toggle="tooltip" data-original-title="Edit post">
                                            Edit
                                        </a>
                                        <form action="{{ route('tags.destroy',$tag->id) }}" method="post">
                                            @csrf @method('delete')
                                            <button type="submit" class=" text-danger font-weight-bold text-xs btn-reset" data-toggle="tooltip" data-original-title="Deletepost">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if(sizeof($tags) === 0)
                                <tr>
                                    <td colspan="4">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-center">Sorry no tag yet</h6>
                                            <p class="text-xs text-secondary text-center mb-0">be first one who <a
                                                    href="{{ route('tags.create') }}">submit</a> new tag!</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $tags->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>


@endsection
