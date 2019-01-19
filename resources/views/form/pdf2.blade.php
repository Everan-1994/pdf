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
            padding: 2px;
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
            <td width="97%" style="text-align: center">
                南宁市社会保险参保缴费证明（单位专用）
            </td>
            <td width="3%"></td>
        </tr>
    </table>
    <!-- 表格 -->
    <table class="table1">
        <tbody>
            <tr>
                <td width="19%"></td>
                <td width="34%" style="text-align: right;">({{ $count->year }}年度)</td>
                <td width="31%"></td>
                <td width="8%"></td>
                <td width="8%"></td>
            </tr>
            <tr>
                <td width="42%" style="text-align: right;">校验码：</td>
                <td width="17%" style="text-align: right;">{{ $count->number }}</td>
                <td width="13%"></td>
                <td width="14%" style="text-align: right;">单位：人</td>
                <td width="14%"></td>
            </tr>
        </tbody>
    </table>
    <table>
        <tr>
            <td width="8%"></td>
            <td width="77%">
                <table class="table2" border="1">
                    <tr style="line-height: 1.7;">
                        <th width="11%">单位编号</th>
                        <th width="30%" colspan="2">20007809</th>
                        <th width="15%">单位名称</th>
                        <th width="44%" colspan="3">广西振鸿宇水电建筑有限公司</th>
                    </tr>
                    <tr>
                        <td colspan="7" style="height: 25px; line-height: 25px;">
                            参保人数及缴费情况
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 18px; line-height: 35px;">月份</td>
                        <td style="height: 18px; line-height: 35px;">基本养老保险</td>
                        <td style="height: 18px; line-height: 35px;">基本医疗保险</td>
                        <td style="height: 18px; line-height: 35px;">失业保险</td>
                        <td style="height: 18px; line-height: 35px;">工伤保险</td>
                        <td style="height: 18px; line-height: 35px;">生育保险</td>
                        <td style="height: 18px; line-height: 1.3;">缴费状态（已缴费或欠费或中断）</td>
                    </tr>
                    @foreach($count->statistics as $statistic)
                    <tr>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->month }}</td>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->pension }}</td>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->medical }}</td>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->unemployment }}</td>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->work_injury }}</td>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->fertility }}</td>
                        <td style="height: 8px; line-height: 15px;">{{ $statistic->status }}</td>
                    </tr>
                        @endforeach
                </table>
            </td>
            <td width="15%"></td>
        </tr>
        <tr>
            <td width="8%"></td>
            <td width="77%">
                <table border="1">
                    <tr>
                        <td style="font-size: 9px; height: 50px; line-height: 14px;">
                            &nbsp;备注：<br/>
                            1.本证明核查真伪可扫描二维码或通过互联网登录南宁市人力资源和社会保障局网站（
                            www.nn12333.gov.cn）进行比对。<br/>
                            2、本证明涉及参保单位及个人信息，因保管不当或向第三方泄露引起的一切后果由参保单位承担。<br/>
                            3、本证明的信息，仅供参考，不作为待遇计发的最终依据。本证明自打印六个月内有效。<br/>
                            4、打印参保人员名单详见附件。
                        </td>
                    </tr>
                </table>
            </td>
            <td width="15%"></td>
        </tr>
        <tr>
            <td width="8%"></td>
            <td width="52%" style="text-align: right; font-size: 9px; height: 15px; line-height: 15px;">
                打印时间：&nbsp;&nbsp;{{ $count->publish->toDateString() }}
            </td>
            <td width="40%"></td>
        </tr>
    </table>
</div>
</body>

</html>