@extends('layouts.master')

@section('breadcrumb')
    Tags
@endsection

@section('title')
    Edit {{ $tag->name }}
@endsection

@section('body')

    <div class="row min-vh-80">

        <div class="col-8 mx-auto">


            <div class="card mt-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                        <h6 class="text-white text-capitalize ps-3">Edit {{ $tag->name }}</h6>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.partials.flash')

                    <form method="post" action="{{ route('tags.update',$tag->id) }}">
                        @csrf @method('patch')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-outline my-3">
                                    <label class="form-label">Tag Name</label>
                                    <input type="text" name="name" value="{{ old('name') ? old('name') : $tag->name }}" class="form-control">
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
