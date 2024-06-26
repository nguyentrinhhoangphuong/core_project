@php
    $statusOptions = [
        'active' => config('zvn.template.status.active.name'),
        'inactive' => config('zvn.template.status.inactive.name'),
    ];
@endphp
@extends('admin.main')
@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data" class="card">
        @csrf
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-xl-4">
                    @include('admin.templates.error')
                    <div class="row">
                        <div class="col-md-6 col-xl-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    {{-- <option value="active" @if (old('status', 'active') == 'active') selected @endif>Kích hoạt
                                    </option>
                                    <option value="inactive" @if (old('status', 'active') == 'inactive') selected @endif>Không kích
                                        hoạt
                                    </option> --}}
                                    @foreach ($statusOptions as $key => $value)
                                        <option value="{{ $key }}"
                                            @if (old('status', 'active') == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Ordering</label>
                                <input type="text" class="form-control" name="ordering" value="{{ old('ordering') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Is home</label>
                                <select class="form-select" name="is_home">
                                    <option value="yes" @if (old('is_home', 'yes') == 'yes') selected @endif>Yes</option>
                                    <option value="no" @if (old('is_home', 'yes') == 'no') selected @endif>No
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="{{ route('admin.categories.index') }}" class="btn btn-link me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
