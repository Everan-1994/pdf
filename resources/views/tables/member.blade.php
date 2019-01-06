@if (count($members))
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th scope="col">#</th>
            <th scope="col">个人编号</th>
            <th scope="col">姓名</th>
            <th scope="col">身份证</th>
            <th scope="col">所在分组</th>
            <th scope="col">操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($members as $member)
            <tr>
                <th scope="row">{{ $member->id }}</th>
                <td>{{ $member->number }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->id_card }}</td>
                <td>{{ $member->group->name }}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-success">编辑</button>
                    <button style="margin-left: 5px;" type="button" class="btn btn-sm btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
{!! $members->appends(Request::except('page'))->render() !!}