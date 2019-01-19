@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary count" data-id="0">
                            新增统计
                        </button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (count($counts))
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">查询码</th>
                                    <th scope="col">校验码</th>
                                    <th scope="col">年份</th>
                                    <th scope="col">打印日期</th>
                                    <th scope="col">总人数</th>
                                    <th scope="col" style="text-align: center;">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($counts as $count)
                                    <tr>
                                        <th scope="row">{{ $count->id }}</th>
                                        <td>{{ $count->name }}</td>
                                        <td>{{ $count->number }}</td>
                                        <td>{{ $count->year }}</td>
                                        <td>{{ $count->publish->toDateString() }}</td>
                                        <td>{{ $count->num }}</td>
                                        <td style="text-align: center;">
                                            <button type="button"
                                                    class="count-data btn btn-sm btn-primary"
                                                    data-id="{{ $count->id }}">统计表
                                            </button>
                                            <button style="margin-left: 5px;" type="button" class="count btn btn-sm btn-success"
                                                    data-id="{{ $count->id }}"
                                                    data-name="{{ $count->name }}"
                                                    data-number="{{ $count->number }}"
                                                    data-year="{{ $count->year }}"
                                                    data-num="{{ $count->num }}"
                                                    data-publish="{{ $count->publish->toDateString() }}">编辑
                                            </button>
                                            <button style="margin-left: 5px;" type="button"
                                                    class="del-count btn btn-sm btn-danger"
                                                    data-id="{{ $count->id }}">删除
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
                        {!! $counts->appends(Request::except('page'))->render() !!}

                    </div>
                </div>
            </div>
        </div>

        <!-- 模态框（Modal） -->
        <div class="modal fade" id="count" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <form action="javascript:;" id="count_form">

                            <div class="form-count row" style="margin-bottom: 1rem;">
                                <label for="name" class="col-md-3 col-form-label text-md-right">查询码</label>

                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control" name="name" placeholder="请输入查询码"
                                           required autofocus>

                                    <span id="name_error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-count row" style="margin-bottom: 1rem;">
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

                            <div class="form-count row" style="margin-bottom: 1rem;">
                                <label for="year" class="col-md-3 col-form-label text-md-right">年份</label>

                                <div class="col-md-8">
                                    <input id="year" type="text" class="form-control" name="year"
                                           placeholder="2019" required autofocus>

                                    <span id="year_error" class="invalid-feedback" role="alert" style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-count row" style="margin-bottom: 1rem;">
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

                            <div class="form-count row" style="margin-bottom: 1rem;">
                                <label for="num" class="col-md-3 col-form-label text-md-right">总人数</label>

                                <div class="col-md-8">
                                    <input id="num" type="text" class="form-control" name="num" required
                                           autofocus placeholder="不填默认为 0 人" value="0">

                                    <span id="num_error" class="invalid-feedback" role="alert"
                                          style="display: none;">
                                        <strong></strong>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="_count" type="button" class="btn btn-primary">
                            提 交
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- 模态框（data） -->
        <div class="modal fade" id="count_data" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            参保人数及缴费情况
                        </h4>
                        <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">×
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table" id="table_data" style="text-align: center;">
                            <thead>
                            <tr>
                                <th scope="col">月份</th>
                                <th scope="col">养老保险</th>
                                <th scope="col">医疗保险</th>
                                <th scope="col">失业保险</th>
                                <th scope="col">工伤保险</th>
                                <th scope="col">生育保险</th>
                                <th scope="col">缴费状态</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button id="_count_data" type="button" class="btn btn-primary" data-count_id="0">
                            保 存
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
        $('.count').click((e) => {
            var data = e.currentTarget.dataset
            if (data.id > 0) {
                $('#title').text('编辑统计信息')
                $('#_count').attr('data-id', data.id)
                $('#name').val(data.name)
                $('#number').val(data.number)
                $('#year').val(data.year)
                $('#publish').val(data.publish)
                $('#num').val(data.num)
                $('#count').modal('show')
            } else {
                $('#title').text('新增统计信息')
                $('#_count').attr('data-id', data.id)
                $("#count_form input").val("");
                $('#count').modal('show')
            }
        })

        // 新增&编辑 分组
        $('#_count').click((e) => {

            let name = $('#name').val()
            let number = $('#number').val()
            let year = $('#year').val()
            let publish = $('#publish').val()
            let num = $('#num').val() || 0

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

            if (year.length === 0) {
                $('#year').addClass('is-invalid')
                $('#year_error').show()
                $('#year_error > strong').text('年份不能为空')
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
                var url = 'edit_count'
                var type = 'PUT'
                var data = {
                    _method: 'PUT',
                    id,
                    name,
                    number,
                    year,
                    publish,
                    num
                }
            } else {
                var url = 'add_count'
                var type = 'POST'
                var data = {
                    name,
                    number,
                    year,
                    publish,
                    num
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
                    if (response.count_id > 0) {
                        $('#count').modal('hide')
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

        $('.del-count').click((e) => {
            var id = e.currentTarget.dataset.id
            if (id > 0) {
                layer.confirm('该分组下的全部数据也会删除，确定删除吗？', {
                    title: '温馨提示',
                    btn: ['确定删除', '我再想想']
                }, function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: 'del_count/' + id,
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

        $('.count-data').click((e) => {
            var id = e.currentTarget.dataset.id

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'count_data/' + id,
                type: 'get',
                dataType: 'json',
                data: [],
                success(response) {
                    var html_data = ''
                    response.forEach((item, i) => {
                        html_data += `<tr>
                                    <th scope="row">
                                        <input disabled type="text" style="text-align:center;" class="input_${i} form-control" name="month" value="${item.month}">
                                    </th>
                                    <td>
                                        <input type="text" style="text-align:center;" class="input_${i} form-control" name="pension" value="${item.pension}">
                                    </td>
                                    <td>
                                        <input type="text" style="text-align:center;" class="input_${i} form-control" name="medical" value="${item.medical}">
                                    </td>
                                    <td>
                                        <input type="text" style="text-align:center;" class="input_${i} form-control" name="unemployment" value="${item.unemployment}">
                                    </td>
                                    <td>
                                        <input type="text" style="text-align:center;" class="input_${i} form-control" name="work_injury" value="${item.work_injury}">
                                    </td>
                                    <td>
                                        <input type="text" style="text-align:center;" class="input_${i} form-control" name="fertility" value="${item.fertility}">
                                    </td>
                                    <td>
                                        <input type="text" style="text-align:center;" class="input_${i} form-control" name="status" value="${item.status}">
                                    </td>
                                </tr>`
                    })
                    $('#table_data > tbody').append(html_data);
                },
                error(error) {
                    console.log(error)
                    layer.alert('获取数据失败', {icon: 2, title: '温馨提示'})
                }
            })

            $('#_count_data').attr('data-count_id', id)
            $('#count_data').modal('show')
        })

        // 监听 modal 关闭
        $('#count_data').on('hide.bs.modal', function () {
            $('#_count_data').attr('data-count_id', 0)
            $('#table_data > tbody').empty();
        });

        // 格式化数据
        $('#_count_data').click((e) => {
            var count_id = e.currentTarget.dataset.count_id
            var vals = []

            for (let i = 0; i < 12; i++) {
                let arr = []
                $('.input_' + i).each((e, item) => {
                    arr.push($(item).val() || 0)
                })
                vals.push(arr)
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'count_data',
                type: 'post',
                dataType: 'json',
                data: {
                    count_id,
                    vals
                },
                success(response) {
                    layer.alert('保存成功', {icon: 1, title: '温馨提示'})
                },
                error(error) {
                    console.log(error)
                    layer.alert('保存失败', {icon: 2, title: '温馨提示'})
                }
            })

        })
    })
</script>
