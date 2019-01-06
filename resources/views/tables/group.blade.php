@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addGroup">
                            新增分组
                        </button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($groups))
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">组名</th>
                                    <th scope="col">用户数</th>
                                    <th scope="col">打印日期</th>
                                    <th scope="col">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <th scope="row">{{ $group->id }}</th>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ count($group->members) }} 人</td>
                                        <td>{{ $group->publish->toDateTimeString() }}</td>
                                        <td>
                                            <button type="button" class=" edit-group btn btn-sm btn-success"
                                                    data-id="{{ $group->id }}">编辑
                                            </button>
                                            <button style="margin-left: 5px;" type="button"
                                                    class="btn btn-sm btn-danger">删除
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        @else
                            <div class="empty-block">暂无数据 ~_~</div>
                        @endif

                        {{-- 分页 --}}
                        {!! $groups->appends(Request::except('page'))->render() !!}

                    </div>
                </div>
            </div>
        </div>

        <!-- 新增模态框（Modal） -->
        <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            新增分组
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:;">

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">分组名称</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

                                    <span id="name_error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publish" class="col-md-3 col-form-label text-md-right">打印时间</label>

                                <div class="col-md-8">
                                    <input id="publish" type="text" class="form-control" name="publish" required
                                           autofocus placeholder="2019-01-01 18:18:18" value="2019-01-01 18:18:18">

                                    <span id="publish_error" class="invalid-feedback" role="alert"
                                          style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">姓名</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>--}}

                            {{--@if ($errors->has('name'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('name') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                            {{--<label for="id_card" class="col-md-4 col-form-label text-md-right">身份证号</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="id_card" type="text" class="form-control{{ $errors->has('id_card') ? ' is-invalid' : '' }}" name="id_card" value="{{ old('id_card') }}" required autofocus>--}}

                            {{--@if ($errors->has('id_card'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('id_card') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="_addGroup" type="button" class="btn btn-primary">
                            提 交
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- 编辑模态框（Modal） -->
        <div class="modal fade" id="editGroup" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            编辑用户信息
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        按下 ESC 按钮退出。
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">
                            提 交
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
@endsection

<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function () {
        // 新增
        $('#_addGroup').click(() => {
            let name = $('#name').val()
            let publish = $('#publish').val()

            if (name.length === 0) {
                $('#name').addClass('is-invalid')
                $('#name_error').show()
                $('#name_error > strong').text('分组名称不能为空')
            }

            if (publish.length === 0) {
                $('#publish').addClass('is-invalid')
                $('#publish_error').show()
                $('#publish_error > strong').text('打印日期不能为空')
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'add_group',
                type: 'POST',
                dataType: 'json',
                data: {
                    name,
                    publish
                },
                success(response) {
                    if (response.group_id > 0) {
                        alert('新增成功')
                        setTimeout(() => {
                            $('#addGroup').modal('hide')
                            window.location.reload()
                        }, 1500)
                    }
                },
                error(error) {
                    alert('新增失败，请检查数据格式')
                }
            })

            // $('meta[name="csrf-token"]').attr('content')

        })

        // 编辑
        $('.edit-group').click((e) => {
            $('#editGroup').modal('show')
            let id = e.currentTarget.dataset.id
            console.log(id)
        })
    })
</script>
