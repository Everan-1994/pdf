@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary group" data-id="0">
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
                                    <th scope="col">查询码</th>
                                    <th scope="col">校验码</th>
                                    <th scope="col">年月</th>
                                    <th scope="col">打印日期</th>
                                    <th scope="col">用户数</th>
                                    <th scope="col">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($groups as $group)
                                    <tr>
                                        <th scope="row">{{ $group->id }}</th>
                                        <td>{{ $group->name }}</td>
                                        <td>{{ $group->number }}</td>
                                        <td>{{ $group->date }}</td>
                                        <td>{{ $group->publish->toDateString() }}</td>
                                        <td>{{ count($group->members) }} 人</td>
                                        <td>
                                            <button type="button" class="group btn btn-sm btn-success"
                                                    data-id="{{ $group->id }}"
                                                    data-name="{{ $group->name }}"
                                                    data-number="{{ $group->number }}"
                                                    data-date="{{ $group->date }}"
                                                    data-publish="{{ $group->publish->toDateString() }}">编辑
                                            </button>
                                            <button style="margin-left: 5px;" type="button"
                                                    class="del-group btn btn-sm btn-danger"
                                                    data-id="{{ $group->id }}">删除
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

        <!-- 模态框（Modal） -->
        <div class="modal fade" id="group" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            <span id="title"></span>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:;" id="group_form">

                            <div class="form-group row">
                                <label for="name" class="col-md-3 col-form-label text-md-right">查询码</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="请输入查询码"
                                           required autofocus>

                                    <span id="name_error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="number" class="col-md-3 col-form-label text-md-right">校验码</label>

                                <div class="col-md-8">
                                    <input id="number" type="text" class="form-control" name="number"
                                           placeholder="请输入校验码" required autofocus>

                                    <span id="number_error" class="invalid-feedback" role="alert"
                                          style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-3 col-form-label text-md-right">年月</label>

                                <div class="col-md-8">
                                    <input id="date" type="text" class="form-control" name="date"
                                           placeholder="2019 年 1 月" required autofocus>

                                    <span id="date_error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="publish" class="col-md-3 col-form-label text-md-right">打印时间</label>

                                <div class="col-md-8">
                                    <input id="publish" type="text" class="form-control" name="publish" required
                                           autofocus placeholder="2019-01-01" value="2019-01-01">

                                    <span id="publish_error" class="invalid-feedback" role="alert"
                                          style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="_group" type="button" class="btn btn-primary">
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
        $('.group').click((e) => {
            var data = e.currentTarget.dataset
            if (data.id > 0) {
                $('#title').text('编辑分组信息')
                $('#_group').attr('data-id', data.id)
                $('#name').val(data.name)
                $('#number').val(data.number)
                $('#date').val(data.date)
                $('#publish').val(data.publish)
                $('#group').modal('show')
            } else {
                $('#title').text('新增分组信息')
                $('#_group').attr('data-id', data.id)
                $("#group_form input").val("");
                $('#group').modal('show')
            }
        })

        // 新增&编辑 分组
        $('#_group').click((e) => {

            let name = $('#name').val()
            let number = $('#number').val()
            let date = $('#date').val()
            let publish = $('#publish').val()

            if (name.length === 0) {
                $('#name').addClass('is-invalid')
                $('#name_error').show()
                $('#name_error > strong').text('查询码不能为空')
                return
            }

            if (number.length === 0) {
                $('#number').addClass('is-invalid')
                $('#number_error').show()
                $('#number_error > strong').text('校验码不能为空')
                return
            }

            if (date.length === 0) {
                $('#date').addClass('is-invalid')
                $('#date_error').show()
                $('#date_error > strong').text('年月不能为空')
                return
            }

            if (publish.length === 0) {
                $('#publish').addClass('is-invalid')
                $('#publish_error').show()
                $('#publish_error > strong').text('打印日期不能为空')
                return
            }
            var id = e.currentTarget.dataset.id
            if (id > 0) {
                var url = 'edit_group'
                var type = 'PUT'
                var data = {
                    _method: 'PUT',
                    id,
                    name,
                    number,
                    date,
                    publish
                }
            } else {
                var url = 'add_group'
                var type = 'POST'
                var data = {
                    name,
                    number,
                    date,
                    publish
                }
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: type,
                dataType: 'json',
                data: data,
                success(response) {
                    if (response.group_id > 0) {
                        $('#group').modal('hide')
                        layer.alert('提交成功', {icon: 1, title: '温馨提示'}, function () {
                            window.location.reload()
                        })
                    }
                },
                error(error) {
                    console.log(error)
                    layer.alert('提交失败，请检查数据格式', {icon: 2, title: '温馨提示'})
                }
            })

        })

        $('.del-group').click((e) => {
            var id = e.currentTarget.dataset.id
            if (id > 0) {
                layer.confirm('该分组下的全部用户也会删除，确定删除吗？', {
                    title: '温馨提示',
                    btn: ['确定删除', '我再想想']
                }, function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'del_group/' + id,
                        type: 'delete',
                        dataType: 'json',
                        data: {
                            _method: 'delete'
                        },
                        success(response) {
                            if (response.code === 0) {
                                layer.alert('删除成功', {icon: 1, title: '温馨提示'}, function () {
                                    window.location.reload()
                                })
                            } else {
                                layer.alert('系统错误，删除失败。', {icon: 2, title: '温馨提示'})
                            }
                        },
                        error(error) {
                            console.log(error)
                            layer.alert('系统错误，删除失败。', {icon: 2, title: '温馨提示'})
                        }
                    })
                });
            } else {
                layer.msg('缺失参数', {icon: 2, title: '温馨提示'})
            }
        })
    })
</script>
