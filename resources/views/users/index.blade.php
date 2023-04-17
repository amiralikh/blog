@extends('layouts.master')

@section('breadcrumb')
    Users
@endsection

@section('title')
    {{ $title }}
@endsection

@section('body')

    <div class="row">

        @include('layouts.partials.flash')

        <div class="col-12">
            <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">{{ $title }}</h6>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">


                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">submit Date</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Posts count</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">comments count</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $user->id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->name }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->email }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->created_at }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->posts->count() }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $user->comments->count() }}</span>
                                    </td>
                                    <td class="align-middle text-center">
                                        <a href="{{ route('users.edit',$user->id) }}" class="text-secondary font-weight-bold text-xs " data-toggle="tooltip" data-original-title="Edit post">
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy',$user->id) }}" method="post">
                                            @csrf @method('delete')
                                            <button type="submit" class=" text-danger font-weight-bold text-xs btn-reset" data-toggle="tooltip" data-original-title="Deletepost">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if(sizeof($users) === 0)
                                <tr>
                                    <td colspan="4">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm text-center">there is not any user!</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>


@endsection
