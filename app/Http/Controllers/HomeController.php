<?php

namespace App\Http\Controllers;

use App\Count;
use App\Group;
use App\Member;
use App\Statistic;
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
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $members = Member::query()
            ->when($request->filled('group'), function ($query) use ($request) {
                return $query->whereHas('group', function ($sql) use ($request) {
                    return $sql->where('name', $request->input('group'));
                });
            })
            ->when($request->filled('name'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->input('name') . '%');
            })
            ->paginate(20);

        $groups = Group::query()->get();

        $filters = [
            'group' => $request->input('group'),
            'name' => $request->input('name'),
        ];

        return view('home', compact(['members', 'groups', 'filters']));
    }

    // 分组列表页
    public function group()
    {
        $groups = Group::query()->paginate(10);

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
            'number' => 'required|string',
            'date' => 'required|string',
            'publish' => 'required|date:"Y-d-m"',
        ], [
            'name.required' => '分组名称不能为空',
            'publish.required' => '打印日期不能为空',
            'publish.date' => '打印日期格式不正确'
        ]);

        $group_id = Group::query()->insertGetId($params);

        return response()->json(compact('group_id'), 201);
    }

    /**
     * 更新分组
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editGroup(Request $request)
    {
        $params = $this->validate($request, [
            'id' => 'required|int',
            'name' => 'required',
            'number' => 'required|string',
            'date' => 'required|string',
            'publish' => 'required|date:"Y-d-m"',
        ], [
            'name.required' => '分组名称不能为空',
            'publish.required' => '打印日期不能为空',
            'publish.date' => '打印日期格式不正确'
        ]);

        Group::query()
            ->where('id', $params['id'])
            ->update([
            'name' => $params['name'],
            'number' => $params['number'],
            'date' => $params['date'],
            'publish' => $params['publish']
        ]);

        return response()->json(['group_id' => $params['id']]);
    }

    /**
     * 删除分组
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delGroup($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => 'required|int',
        ]);

        try {
            \DB::beginTransaction();

            Group::query()
                ->where('id', $id)
                ->delete();

            Member::query()
                ->where('group_id', $id)
                ->delete();

            \DB::commit();

            return response()->json(['code' => 0]);
        } catch (\Exception $exception) {
            \DB::rollback();
            return response()->json(['code' => 1]);
        }
    }

    /**
     * 新增 User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addMember(Request $request)
    {
        $params = $this->validate($request, [
            'name' => 'required',
            'number' => 'required|string|max:8',
            'group_id' => 'required|int',
            'id_card' => 'required|string|max20',
        ], [
            'name.required' => '姓名不能为空',
            'number.required' => '个人编号不能为空',
            'id_card.required' => '身份证号不能为空',
            'group_id.required' => '分组不能为空'
        ]);

        $builder = Member::query();

        if ($builder->where('group_id', $params['group_id'])->count() == 48) {
            return response()->json(['msg' => '该分组已满48人'], 400);
        }

        $member_id = $builder->insertGetId($params);

        return response()->json(compact('member_id'), 201);
    }

    /**
     * 编辑 User
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editMember(Request $request)
    {
        $params = $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'number' => 'required|string|max:8',
            'group_id' => 'required|int',
            'id_card' => 'required|string|max:20',
        ], [
            'name.required' => '姓名不能为空',
            'number.required' => '个人编号不能为空',
            'id_card.required' => '身份证号不能为空',
            'group_id.required' => '分组不能为空'
        ]);

        $data = [
            'name' => $params['name'],
            'number' => $params['number'],
            'id_card' => $params['id_card']
        ];

        if (Member::query()->where('id', $params['id'])->value('group_id') !== $params['group_id']) {
            $data['group_id'] = $params['group_id'];
        }

        if (Member::query()->where('group_id', $params['group_id'])->count() == 48) {
            return response()->json(['msg' => '该分组已满48人'], 400);
        }

        Member::query()->where('id', $params['id'])->update($data);

        return response()->json(['member_id' => $params['id']]);
    }

    /**
     * 删除用户
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delMember($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => 'required|int',
        ]);

        try {

            Member::query()
                ->where('id', $id)
                ->delete();
            return response()->json(['code' => 0]);

        } catch (\Exception $exception) {
            return response()->json(['code' => 1]);
        }
    }

    public function count()
    {
        $counts = Count::query()->paginate(10);

        return view('tables.count', compact(['counts']));
    }

    /**
     * 新增统计
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function addCount(Request $request)
    {
        $params = $this->validate($request, [
            'name' => 'required',
            'number' => 'required|string|max:100',
            'year' => 'required|string',
            'publish' => 'required|date:"Y-d-m"',
        ], [
            'number.max' => '查询码长度过长',
            'name.required' => '分组名称不能为空',
            'publish.required' => '打印日期不能为空',
            'publish.date' => '打印日期格式不正确'
        ]);

        $params['num'] = $request->input('num', 0);

        $count_id = Count::query()->insertGetId($params);

        return response()->json(compact('count_id'), 201);
    }

    /**
     * 更新统计
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editCount(Request $request)
    {
        $params = $this->validate($request, [
            'id' => 'required|int',
            'name' => 'required',
            'number' => 'required|string|max:100',
            'year' => 'required|string',
            'publish' => 'required|date:"Y-d-m"',
        ], [
            'number.max' => '查询码长度过长',
            'name.required' => '分组名称不能为空',
            'publish.required' => '打印日期不能为空',
            'publish.date' => '打印日期格式不正确'
        ]);

        Count::query()
            ->where('id', $params['id'])
            ->update([
                'name' => $params['name'],
                'number' => $params['number'],
                'year' => $params['year'],
                'publish' => $params['publish'],
                'num' => $request->input('num', 0)
            ]);

        return response()->json(['count_id' => $params['id']]);
    }

    /**
     * 删除统计
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delCount($id)
    {
        $validator = \Validator::make(['id' => $id], [
            'id' => 'required|int',
        ]);

        try {
            \DB::beginTransaction();

            Count::query()
                ->where('id', $id)
                ->delete();

            Statistic::query()
                ->where('count_id', $id)
                ->delete();

            \DB::commit();

            return response()->json(['code' => 0]);
        } catch (\Exception $exception) {
            \DB::rollback();
            return response()->json(['code' => 1]);
        }
    }
}
