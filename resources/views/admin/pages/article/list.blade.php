@php
    use App\Helpers\Template as Template;
    $statusOptions = [
        'active' => config('zvn.template.status.active.name'),
        'inactive' => config('zvn.template.status.inactive.name'),
    ];
@endphp
<table class="table table-vcenter card-table table-striped">
    <thead>
        <tr>
            <th class="w-1">#</th>
            <th class="w-1">Hình</th>
            <th class="w-1">Tiêu đề</th>
            <th class="w-1">Danh mục</th>
            <th class="w-1">Trạng thái</th>
            <th class="w-1">Nội dung</th>
            <th class="w-2">Hành động</th>
        </tr>
    </thead>
    <tbody id="result">
        @if (count($items) > 0)
            @foreach ($items as $key => $item)
                @php
                    $index = $key + 1;
                    $id = $item['id'];
                    $thumb = Template::showItemThumb($item['thumb'], $item['name'], $controllerName);
                    $name = $item['title'];
                    $category_name = $item['category_name'];
                    $description = Template::showContent($item['content']);
                    $status = $statusOptions[$item['status']];
                @endphp
                <tr>
                    <td>{!! $index !!}</td>
                    <td class="text-secondary">{!! $thumb !!}</td>
                    <td class="text-secondary">{!! $name !!}</td>
                    <td class="text-secondary">{!! $category_name !!}</td>
                    <td>{!! $status !!}</td>
                    <td>{!! $description !!}</td>
                    <td>
                        <a class="btn btn-outline-primary"
                            href="{{ route('admin.' . $routeName . '.edit', ['item' => $id]) }}">Edit</a>
                        <a class="btn btn-outline-danger item_delete" data-id="{{ $id }}"
                            data-type="{!! $routeName !!}">Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7" class="text-center">Không có dữ liệu để hiển thị.</td>
            </tr>
        @endif

    </tbody>
</table>
