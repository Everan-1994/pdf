<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <p></p>
    <table class="table">
        <tr>
            <td width="5%"></td>
            <td width="90%" style="text-align: center">
                附件：南宁市社会保险参保缴费证明-正常应缴人员名单（单位专<br/>用）
            </td>
        </tr>
    </table>
    <!-- 表格 -->
    <table class="table1">
        <tbody>
        <tr>
            <td width="11%"></td>
            <td width="42%">单位名称： 广西振鸿宇水电建筑有限责任公司</td>
            <td width="38%">校验码：2000023081240502</td>
        </tr>
        <tr>
            <td width="11%"></td>
            <td width="42%">2018 年 12 月</td>
            <td width="48%">参保人数（共 {{ $count_member }} 人，其中正常应缴 {{ $count_member }} 人）</td>
        </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td width="9%"></td>
            <td width="81%">
                <table class="table2" border="1">
                    <tr style="line-height: 1.6;">
                        <th width="5%">序号</th>
                        <th width="10%">个人编号</th>
                        <th width="18%">姓名</th>
                        <th width="17%">身份证号</th>
                        <th width="5%">序号</th>
                        <th width="10%">个人编号</th>
                        <th width="18%">姓名</th>
                        <th width="17%">身份证号</th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr>
                            @foreach($user as $j => $v)
                                <td>{{ $number + $j + 1 }}</td>
                                <td>{{ $v['number'] }}</td>
                                <td>{{ $v['name'] }}</td>
                                <td style="line-height: 1.2; font-size: 9px;">{{ $v['id_card'] }}</td>
                            @endforeach
                        </tr>
                    @endforeach

                </table>
            </td>
            <td width="10%"></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td width="10%"></td>
            <td width="80%">
                <table>
                    <tr>
                        <td width="55%"></td>
                        <td width="45%">
                            南宁市社会保险事业局（章）
                        </td>
                    </tr>
                    <tr>
                        <td width="55%"></td>
                        <td width="45%">
                            打印时间： {{ $date }}
                        </td>
                    </tr>
                </table>
            </td>
            <td width="10%"></td>
        </tr>
    </table>
</div>
</body>

</html>