<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category as MainMoDel;
use App\Http\Requests\CategoryRequest as MainRequest;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    public function __construct(MainMoDel $model)
    {
        parent::__construct($model);
        $this->params['pagination']['totalItemsPerPage'] = 5;
        $this->pathViewController = 'admin.pages.category.';
        $this->controllerName = 'category';
        $this->routeIndex = 'admin.categories.index';
        $this->routeName = 'categories';
        view()->share('controllerName', $this->controllerName);
        view()->share('routeName', $this->routeName);
    }

    public function index(Request $request)
    {
        $params = $this->params; // Tạo một bản sao của $this->params
        $items = $this->getAllItems($params, $request);
        return view($this->pathViewController . 'index', [
            'params' => $params,
            'title' => ucfirst($this->controllerName) . 's Management',
            'items' => $items,
        ]);
    }

    public function store(MainRequest $request)
    {
        $this->save($request->all());
        return redirect()->route($this->routeIndex)->with('success', ucfirst($this->controllerName) . ' created successfully');
    }

    public function edit($item)
    {
        $result = $this->getSingleItem($item);
        return view($this->pathViewController . 'edit', [
            'title' => 'Edit ' . $this->controllerName,
            'item' => $result,
        ]);
    }

    public function create()
    {
        return view($this->pathViewController . 'create', [
            'title' => 'Add ' . $this->controllerName
        ]);
    }

    public function update(MainRequest $request, MainMoDel $item)
    {
        $this->updateItem($request, $item);
        return redirect()->route($this->routeIndex)->with('success', ucfirst($this->controllerName) . ' updated successfully');
    }

    public function destroy(MainMoDel $item)
    {
        $this->deleteItem($item);
        return response()->json(['success' => true, 'message' => ucfirst($this->controllerName) . ' deleted successfully']);
    }
}
