<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>人社表单验证</title>
    <style>
        .table-class {
            width: 100%;
        }
        .table-class table {
            text-align: center;
            margin: 0px auto; /* table在页面的居中属性*/
            width: 100%;
            height: 100px;
            border-width: 1px; /*外边框粗细  */
            border-collapse: collapse; /* 合并边框  border一定要存在且不为零 */
        }
    </style>
</head>
<body>
<div class="table-class">
    <table border="1px">
        <tr>
            <td width="105">序号</td>
            <td width="181">个人编号</td>
            <td width="112">姓名</td>
            <td width="112">身份证号</td>
            <td width="105">序号</td>
            <td width="181">个人编号</td>
            <td width="112">姓名</td>
            <td width="112">身份证号</td>
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
</div>
</body>
</html>