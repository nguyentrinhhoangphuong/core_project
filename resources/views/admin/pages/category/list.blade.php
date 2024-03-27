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
            <th>#</th>
            <th>Tên</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody id="result">
        @if (count($items) > 0)
            @foreach ($items as $key => $item)
                @php
                    $index = $key + 1;
                    $id = $item['id'];
                    $name = $item['name'];
                    $description = $item['description'];
                    $status = $statusOptions[$item['status']];
                @endphp
                <tr>
                    <td>{!! $index !!}</td>
                    <td>{!! $name !!}</td>
                    <td>{!! $status !!}</td>
                    <td>
                        <a class="btn btn-outline-primary"
                            href="{{ route('admin.categories.edit', ['item' => $id]) }}">Edit</a>
                        <a class="btn btn-outline-danger item_delete" data-id="{{ $id }}"
                            data-type="categories">Delete</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Không có dữ liệu để hiển thị.</td>
            </tr>
        @endif

    </tbody>
</table>
