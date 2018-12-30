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
        body,
        p {
            padding: 0;
            margin: 0;
        }

        .container {
            width: 600px;
            box-sizing: border-box;
            padding: 38px;
            margin: 0 auto;
        }

        .div1 {
            width: 500px;
            height: 50px;
        }

        header {
            width: 500px;
            margin: 0 auto;
            padding-top: 20px;
            position: relative;
        }

        header h2 {
            width: 500px;
            font-size: 14px;
            color: #000;
            text-align: center;
            margin: 0 auto;
        }

        .table1 {
            width: 500px;
            margin: 0 auto;
            font-size: 10px;
            padding: 5px;
        }

        .table2 {
            width: 500px;
            margin: 0 auto;
            font-size: 10px;
            vertical-align: middle;
            text-align: center;
            border-collapse: collapse;
        }

        .table3 {
            width: 500px;
            margin: 0 auto;
            font-size: 12px;
            padding-top: 10px;
        }
    </style>
</head>

<body>
<!-- 顶部连接 -->
<div class="container">
    <div class="div1">

    </div>
    <header>
        <h2>
            附件：南宁市社会保险参保缴费证明-正常应缴人员名单（单位专用）
        </h2>
    </header>
    <!-- 表格 -->
    <table class="table1">
        <tbody>
        <tr>
            <td>单位名称： 广西振鸿宇水电建筑有限责任公司</td>
            <td>校验码：2000023081240502</td>
        </tr>
        <tr>
            <td>2018年11月</td>
            <td>参保人数(共28人，其中正常应缴28人)</td>
        </tr>
        </tbody>
    </table>
    <table class="table2" border="1">
        <tr>
            <th width="8%">序号</th>
            <th width="14%">个人编号</th>
            <th width="11%">姓名</th>
            <th width="17%">身份证号</th>
            <th width="8%">序号</th>
            <th width="14%">个人编号</th>
            <th width="11%">姓名</th>
            <th width="17%">身份证号</th>
        </tr>
        @foreach ($users as $key => $user)
            <tr>
                @foreach($user as $j => $v)
                    <td>{{ $j + 1 }}</td>
                    <td>{{ $v['code'] }}</td>
                    <td>{{ $v['userName'] }}</td>
                    <td>{{ $v['cardId'] }}</td>
                @endforeach
            </tr>
        @endforeach

    </table>
    <table class="table3">
        <tbody>
        <tr>
            <td width="65%"></td>
            <td width="35%">
                南宁市社会保险事业局（章）
            </td>
        </tr>
        <tr>
            <td width="65%"></td>
            <td width="35%">
                打印时间： 2018-12-20
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>

</html>