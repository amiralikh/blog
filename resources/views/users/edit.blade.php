@extends('layouts.master')

@section('breadcrumb')
    Users
@endsection

@section('title')
    Edit User #{{ $user->id }}
@endsection

@section('body')

    <div class="row min-vh-80">

        <div class="col-8 mx-auto">


            <div class="card mt-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit User #{{ $user->id }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.flash')

                    <form method="post" action="{{ route('users.update',$user->id) }}">
                        @csrf @method('patch')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $user->name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ old('email') ? old('email') : $user->email }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="is_admin" value="{{ true }}" @if($user->is_admin == 1) checked @endif class="form-check-input" id="customCheckDisabled" >
                                    <label class="custom-control-label" for="customCheckDisabled">IS THIS USER ADMIN?</label>
                                </div>
                            </div>


                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
