@php
    use App\Helpers\Template as Template;
    $showDropdownItemsStatus = Template::showDropdownItemsStatus($routeName, $params);
    $showAreaSearch = Template::showAreaSearch($controllerName, $params, $routeName);
@endphp
@extends('admin.main')
@section('content')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="col-12 d-flex justify-content-between mb-2">
                        <!-- Dropdown bên trái -->
                        {!! $showDropdownItemsStatus !!}
                        <!-- Ô tìm kiếm, Dropdown và Nút tìm kiếm bên phải -->
                        {!! $showAreaSearch !!}
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            @include('admin.pages.' . $controllerName . '.list', ['items' => $items])
                        </div>
                    </div>
                </div>
                @include('admin.templates.pagination')
            </div>
        </div>
    </div>
@endsection
