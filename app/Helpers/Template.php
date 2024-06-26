<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

class Template
{
    public $arrItems = [];


    public static function showAreaSearch($controllerName, $params, $routeName)
    {
        $xhtml = '';
        $tmplField = config('zvn.template.search');
        $fieldInController = config('zvn.config.search');
        $linkAddSlider = route("admin." . $routeName . ".create");


        $oldField = isset($params['search']['field']) && isset($tmplField[$params['search']['field']]['name'])
            ? $tmplField[$params['search']['field']]['name']
            : $tmplField['all']['name'];

        $oldValue = isset($params['search']['value']) ? $params['search']['value'] : '';

        if (!array_key_exists($controllerName, $fieldInController)) {
            return ''; // Nếu controllerName không tồn tại trong cấu hình, không hiển thị gì cả.
        }

        $xhtmlField = null;
        foreach ($fieldInController[$controllerName] as $field) {
            $fieldDisplayName = $tmplField[$field]['name'];
            $xhtmlField .= sprintf('<li>
                                        <a class="dropdown-item select-field" data-field="%s">%s</a>
                                    </li>', $field, $fieldDisplayName);
        }


        $xhtml = sprintf('<div class="d-flex justify-content-end align-items-center">
                            <div class="input-group">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" id="selectDataField" data-bs-toggle="dropdown" aria-expanded="false">
                                        %s
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="selectDataField">
                                        %s
                                    </ul>
                                </div>
                                <input type="text" class="form-control" name="search_value" value="%s" placeholder="Nhập từ khóa tìm kiếm">
                                <button class="btn btn-outline-primary" type="button" id="btn-search">Tìm kiếm</button>
                            </div>
                            <!-- Nút Add ở bên phải -->
                            <a href="%s" class="btn btn-primary ms-4">Thêm %s</a>
                            <input type="hidden" name="search_field">
                        </div>', $oldField, $xhtmlField, $oldValue, $linkAddSlider, $controllerName);
        return $xhtml;
    }

    public static function showItemHistory($by, $time)
    {
        if ($time === null) {
            $time = 'now';
        }
        $xhtml = sprintf(
            '<p><i class="fa fa-user"></i> %s</p>
        <p><i class="fa fa-clock-o"></i> %s</p>',
            $by,
            date(config('zvn.format.long_time'), strtotime($time))
        );
        return $xhtml;
    }

    public static function showItemStatus($id, $status, $controllerName)
    {
        $tmplStatus = config('zvn.template.status');
        if (!array_key_exists($status, $tmplStatus)) {
            $status = 'default';
        }
        $currentTemplateStatus = $tmplStatus[$status];
        $link = route($controllerName . '/change-status', ['id' => $id, 'status' => $status]);
        $xhtml = sprintf('<a href="%s" type="button"class="btn btn-round %s">%s</a>', $link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
        return $xhtml;
    }

    public static function showItemIsHome($id, $status, $controllerName)
    {
        $tmplStatus = config('zvn.template.isHome');
        $currentTemplateStatus = $tmplStatus[$status];
        $link = route($controllerName . '/change-is-home', ['id' => $id, 'status' => $status]);
        $xhtml = sprintf('<a href="%s" type="button"class="btn btn-round %s">%s</a>', $link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
        return $xhtml;
    }

    public static function showItemSelect($id, $display, $controllerName, $fieldName)
    {
        $tmplDisplay = config('zvn.template.' . $fieldName);
        $link = route($controllerName . '/change-' . $fieldName, [$fieldName => $fieldName, 'id' => $id]);
        $xhtml = sprintf('<select name="select_change_attr" data-url="%s" class="form-control">', $link);
        foreach ($tmplDisplay as $key => $value) {
            $xhtmlSelected = '';
            if ($key == $display) $xhtmlSelected = 'selected="selected"';
            $xhtml .= sprintf('<option value="%s" %s>%s</option>', $key, $xhtmlSelected, $value['name']);
        }
        return $xhtml;
    }

    // $thumbName là tên của controllerName
    public static function showItemThumb($thumbName, $thumbAlt, $folder)
    {
        $xhtml = sprintf('<img src="%s" alt="%s" style="width: 200px;">', asset('images/' . $folder . '/' . $thumbName), $thumbAlt);
        return $xhtml;
    }

    public static function showAvatar($thumbName, $thumbAlt, $folder)
    {
        $xhtml = sprintf('<img src="%s" alt="%s" width=50>', asset('images/' . $folder . '/' . $thumbName), $thumbAlt);
        return $xhtml;
    }

    public static function showDateTimeFrontEnd($dataTime)
    {
        return date_format(date_create($dataTime), config('zvn.format.short_time'));
    }

    public static function showContent($content, $lenContent = 150)
    {
        if (strlen($content) > $lenContent) {
            $content = trim(substr($content, 0, $lenContent));
            $content = substr($content, 0, strrpos($content, " ")) . "&hellip;";
        } else {
            $content .= "&hellip;";
        }
        return $content;
    }


    public static function showDropdownItemsStatus($nameRoutes, $params)
    {
        $li = '';
        $buttonName = 'Lọc trạng thái';
        $tmplStatus = config('zvn.template.status');

        $filterStatus = isset($params['filter']['status']) ? $params['filter']['status'] : null;

        foreach ($tmplStatus as $key => $value) {
            $link = route('admin.' . $nameRoutes . '.index') . '?filter_status=' . $key;
            $class = $value['class'];
            $name = $value['name'];

            // Kiểm tra xem trạng thái có trùng khớp với giá trị đã chọn không
            $buttonName = ($filterStatus === $key) ? $tmplStatus[$key]['name'] : $buttonName;

            $li .= sprintf('<li><a class="%s" href="%s">%s</a></li>', $class, $link, $name);
        }

        $xhtml = sprintf('<div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="searchDropdownButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        %s
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="searchDropdownButton">%s</ul>
                </div>', $buttonName, $li);

        return $xhtml;
    }
}
