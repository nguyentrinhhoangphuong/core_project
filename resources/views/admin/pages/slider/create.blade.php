@php
    $statusOptions = [
        'active' => config('zvn.template.status.active.name'),
        'inactive' => config('zvn.template.status.inactive.name'),
    ];
@endphp
@extends('admin.main')
@section('content')
    <form action="{{ route('admin.' . $routeName . '.store') }}" method="post" enctype="multipart/form-data" class="card">
        @csrf
        <div class="card-body">
            <div class="row justify-content-center">
                <div class="col-xl-4">
                    @include('admin.templates.error')
                    <div class="row">
                        <div class="col-md-6 col-xl-12">
                            <div class="mb-3">
                                <label class="form-label">name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">description</label>
                                <input type="text" class="form-control" name="description"
                                    value="{{ old('description') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status">
                                    @foreach ($statusOptions as $key => $value)
                                        <option value="{{ $key }}"
                                            @if (old('status', 'active') == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">link</label>
                                <input type="text" class="form-control" name="link" value="{{ old('link') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thumb</label>
                                <input type="file" class="form-control" name="thumb">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-center">
            <a href="{{ route('admin.' . $routeName . '.index') }}" class="btn btn-link me-2">Cancel</a>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
@endsection
