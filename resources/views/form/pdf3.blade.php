<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}"/>

    <title>人社表单验证</title>
    <style>
        .table {
            font-size: 14px;
            font-weight: bold;
        }

        .table1 {
            font-size: 9px;
            padding: 4px;
        }

        .table2 {
            text-align: center;
            font-size: 9px;
        }

        .table2 td {
            height: 20px;
            line-height: 20px;
            text-align: center;
        }
    </style>
</head>

<body>
<!-- 顶部连接 -->
<div>
    <br/>
    <br/>
    <table class="table">
        <tr>
            <td width="13%"></td>
            <td width="75%" style="text-align: center; line-height: 1.7;">
                附件：南宁市社会保险参保缴费证明
            </td>
            <td width="12%"></td>
        </tr>
        <tr>
            <td width="13%"></td>
            <td width="75%" style="text-align: center; line-height: 1.7;">
                正常应缴人员名单（单位专用）
            </td>
            <td width="12%"></td>
        </tr>
    </table>
    <!-- 表格 -->
    <table class="table1">
        <tbody>
        <tr>
            <td width="15%"></td>
            <td width="40%">单位名称： 广西振鸿宇水电建筑有限责任公司</td>
            <td width="35%">校验码：{{ $info['code'] }}</td>
        </tr>
        <tr>
            <td width="15%"></td>
            <td width="40%">{{ $info['date'] }}</td>
            <td width="45%">参保人数（共 {{ $count_member }} 人，其中正常应缴 {{ $count_member }} 人）</td>
        </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td width="12%"></td>
            <td width="77%">
                <table class="table2" border="1">
                    <tr style="line-height: 1.7;">
                        <th width="5%">序号</th>
                        <th width="10%">个人编号</th>
                        <th width="14%">姓名</th>
                        <th width="21%">身份证号</th>
                        <th width="5%">序号</th>
                        <th width="10%">个人编号</th>
                        <th width="14%">姓名</th>
                        <th width="21%">身份证号</th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr style="line-height: 1.9;">
                            @foreach($user as $j => $v)
                                <th>{{ $number + $j + 1 }}</th>
                                <th>{{ $v['number'] }}</th>
                                <th>{{ $v['name'] }}</th>
                                <th>{{ $v['id_card'] }} </th>
                            @endforeach
                            @if (count($user) == 1)
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            @endif
                        </tr>
                    @endforeach

                </table>
            </td>
            <td width="11%"></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td width="14%"></td>
            <td width="80%">
                <table cellpadding="2" style="font-size: 9px;">
                    <tr>
                        <td width="55%"></td>
                        <td width="45%">
                            南宁市社会保险事业局（章）
                        </td>
                    </tr>
                    <tr>
                        <td width="55%"></td>
                        <td width="45%">
                            打印时间： &nbsp;&nbsp;&nbsp;{{ $date }}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="6%"></td>
        </tr>
    </table>
</div>
</body>

</html>