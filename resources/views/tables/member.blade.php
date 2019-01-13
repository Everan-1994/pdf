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
                    <button type="button" class="member btn btn-sm btn-success"
                            data-id="{{ $member->id }}"
                            data-name="{{ $member->name }}"
                            data-number="{{ $member->number }}"
                            data-id_card="{{ $member->id_card }}"
                            data-group_id="{{ $member->group->id }}">编辑</button>
                    <button style="margin-left: 5px;" type="button" class="btn btn-sm btn-danger del-member" data-id="{{ $member->id }}">删除</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@else
    <div class="empty-block">暂无数据 ~_~ </div>
@endif

<!-- 模态框（Modal） -->
<div class="modal fade" id="member" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form action="javascript:;" id="member_form">

                    <div class="form-group row">
                        <label for="group_id" class="col-md-3 col-form-label text-md-right">用户分组</label>

                        <div class="col-md-9">
                            <select id="group_id" class="form-control" name="group_id" >
                                @foreach ($groups as $key => $group)
                                    <option value="{{ $group->id }}">{{ $group->name }} -- {{ count($group->members) }} 人</option>
                                @endforeach
                            </select>

                            <span id="group_id_error" class="invalid-feedback" role="alert" style="display: none;">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number" class="col-md-3 col-form-label text-md-right">个人编号</label>

                        <div class="col-md-9">
                            <input id="number" type="text" class="form-control" name="number"
                                   placeholder="请输入个人编号" required autofocus>

                            <span id="number_error" class="invalid-feedback" role="alert" style="display: none;">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label text-md-right">用户姓名</label>

                        <div class="col-md-9">
                            <input id="_name" type="text" class="form-control" name="name"
                                   placeholder="请输入用户姓名" required autofocus>

                            <span id="name_error" class="invalid-feedback" role="alert" style="display: none;">
                                <strong></strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="id_card" class="col-md-3 col-form-label text-md-right">身份证号</label>

                        <div class="col-md-9">
                            <input id="id_card" type="text" class="form-control" name="id_card" required
                                   autofocus placeholder="请输入用户身份证号">

                            <span id="id_card_error" class="invalid-feedback" role="alert"
                                  style="display: none;">
                                <strong></strong>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="_member" type="button" class="btn btn-primary">
                    提 交
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- 分页 --}}
{!! $members->appends(Request::except('page'))->render() !!}

<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    var filters = {!! json_encode($filters) !!}

    $(document).ready(function () {
        $('.search-form input[name=name]').val(filters.name);
        $('.search-form select[name=group]').val(filters.group);
        // 重置搜索
        $('#reset').click(() => {
            window.location.href = '/home'
        })

        // 模态框
        $('.member').click((e) => {
            var data = e.currentTarget.dataset
            if (data.id > 0) {
                $('#title').text('编辑用户信息')
                $('#_member').attr('data-id', data.id)
                $('#_name').val(data.name)
                $('#number').val(data.number)
                $('#group_id').val(data.group_id)
                $('#id_card').val(data.id_card)
                $('#member').modal('show')
            } else {
                $('#title').text('新增用户信息')
                $('#_member').attr('data-id', data.id)
                $("#member_form input").val("");
                $('#member').modal('show')
            }
        })

        // 新增 & 编辑
        $('#_member').click((e) => {

            let name = $('#_name').val()
            let number = $('#number').val()
            let group_id = $('#group_id').val()
            let id_card = $('#id_card').val()

            if (name.length === 0) {
                $('#_name').addClass('is-invalid')
                $('#name_error').show()
                $('#name_error > strong').text('姓名不能为空')
                return
            }

            if (number.length === 0) {
                $('#number').addClass('is-invalid')
                $('#number_error').show()
                $('#number_error > strong').text('个人编码不能为空')
                return
            }

            if (group_id < 0) {
                $('#group_id').addClass('is-invalid')
                $('#group_id_error').show()
                $('#group_id_error > strong').text('请选择分组')
                return
            }

            if (id_card.length === 0) {
                $('#id_card').addClass('is-invalid')
                $('#id_card_error').show()
                $('#id_card_error > strong').text('身份证不能为空')
                return
            }
            var id = e.currentTarget.dataset.id
            if (id > 0) {
                var url = 'edit_member'
                var type = 'PUT'
                var data = {
                    _method: 'PUT',
                    id,
                    name,
                    number,
                    group_id,
                    id_card
                }
            } else {
                var url = 'add_member'
                var type = 'POST'
                var data = {
                    name,
                    number,
                    group_id,
                    id_card
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
                    if (response.member_id > 0) {
                        $('#group').modal('hide')
                        layer.alert('提交成功', {icon: 1, title: '温馨提示'}, function () {
                            window.location.reload()
                        })
                    }
                },
                error(error) {
                    layer.alert(error.responseJSON.msg || '提交失败，请检查数据格式', {icon: 2, title: '温馨提示'})
                }
            })

        })

        $('.del-member').click((e) => {
            var id = e.currentTarget.dataset.id
            if (id > 0) {
                layer.confirm('确定删除该条数据吗？', {
                    title: '温馨提示',
                    btn: ['确定', '取消']
                }, function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'del_member/' + id,
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