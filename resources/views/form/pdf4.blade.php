<div>
    <span style="font-size: 18px;">附 件</span>
</div>
<div></div>
<!-- 表格 -->
<table width="90%"align="right">
    <tbody>
    <tr>
        <td width="60%">
            <span style="font-size: 16px;">单位名称： 广西振鸿宇水电建筑有限责任公司</span>
        </td>
        <td width="40%">校验码：A20183071521_web</td>
    </tr>
    </tbody>
</table>
<div></div>
<table width="100%">
    <tbody>
    <tr>
        <td>
            <span style="font-size: 18px;">2018&nbsp;&nbsp;&nbsp;&nbsp;年&nbsp;&nbsp;&nbsp;&nbsp;11&nbsp;&nbsp;&nbsp;&nbsp;月参保人员&nbsp;&nbsp;（共&nbsp;&nbsp;&nbsp;98&nbsp;&nbsp;&nbsp;人）</span>
        </td>
    </tr>
    </tbody>
</table>
<div ></div>
<table class="table2" border="1" align="center" cellpadding="1px">
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
                <td>{{ $v['number'] }}</td>
                <td>{{ $v['name'] }}</td>
                <td>{{ $v['id_card'] }}</td>
            @endforeach
        </tr>
    @endforeach
</table>
<div></div>
<table class="table3" style="margin-top: 10px;">
    <tbody>
    <tr>
        <td width="50%"></td>
        <td width="50%">
            打印时间： {{ date('Y年m月d日 H时i分s秒') }}
        </td>
    </tr>
    </tbody>
</table>