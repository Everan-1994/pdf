<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // 分组列表页
    public function group()
    {
        $groups = Group::query()->paginate(5);

        return view('tables.group', compact('groups'));
    }

    /**
     * 新增分组
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addGroup(Request $request)
    {
        $params = $this->validate($request, [
            'name' => 'required',
            'publish' => 'required|date:"Y-d-m H:i:s"',
        ], [
            'name.required' => '分组名称不能为空',
            'publish.required' => '打印日期不能为空',
            'publish.date' => '打印日期格式不正确'
        ]);

        $group_id = Group::query()->insertGetId($params);

        return response()->json(compact('group_id'), 201);
    }
}
