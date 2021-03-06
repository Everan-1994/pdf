<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{  asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css')  }}">
    
    <link rel="shortcut icon" href="{{ asset('image/favicon.ico') }}"/>

    <title id="titleID"></title>
</head>
<body>
<!--[if lt IE 10]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser
</a> to improve your experience.
</p>
<![endif]-->
<div class="container bodyCss" style="display: block" id="mainbody">
    <div class="row head">
        <div class="col-md-1">
        </div>
        <div class="col-md-2 head_line" style="margin-right: 0">
        </div>
        <div class="col-md-6 head_title" id="topNmae">
        </div>
        <div class="col-md-2 head_line">
        </div>
        <div class="col-md-1">
        </div>
    </div>
    <div id="descript" class="row descript">
        <div class="descript_block">
            <div style="width: 200px">
                <div class="descript_block_text01" style="float: left">
                    1
                </div>
                <div class="descript_block_text02" style="float: left">
                    录入验证号码
                </div>
            </div>
            <div>
                <div class="descript_nbsp">
                    &nbsp;
                </div>
                <div class="descript_block_text03" id="inputNo">
                </div>
            </div>
        </div>
        <div class="descript_block">
            <div style="width: 200px">
                <div class="descript_block_text01" style="float: left">
                    2
                </div>
                <div class="descript_block_text02" style="float: left">
                    图形校验码
                </div>
            </div>
            <div>
                <div class="descript_nbsp">
                    &nbsp;
                </div>
                <div class="descript_block_text03">
                    请按图所示，输入图形验证码，如看不清请按图片刷新
                </div>
            </div>
        </div>
        <div class="descript_block">
            <div style="width: 200px">
                <div class="descript_block_text01" style="float: left">
                    3
                </div>
                <div class="descript_block_text02" style="float: left">
                    点击查询按钮
                </div>
            </div>
            <div>
                <div class="descript_nbsp">
                    &nbsp;
                </div>
                <div class="descript_block_text03">
                    纸质单据内容如有修改，请以在线验证的内容为准
                </div>
            </div>
        </div>
        <div class="descript_block">
            <div style="width: 200px">
                <div class="descript_block_text01" style="float: left">
                    4
                </div>
                <div class="descript_block_text02" style="float: left">
                    显示表单
                </div>
            </div>
            <div>
                <div class="descript_nbsp">
                    &nbsp;
                </div>
                <div class="descript_block_text03" style="">
                    本页面展示的电子表单内容仅提供给用户用于核对纸质单据的真实性
                </div>
            </div>
        </div>
    </div>
    <div id="footer_img2" class="footer_img2">
        <img class="img-responsive" src="{{ asset('image/N_bd04.jpg') }}">
    </div>
    <div id="form" class="row" style="width:50%;margin: 30px auto;height: 160px">
        <div class="col-md-9">
            <div class="row form_row">
                <label class="col-md-4 form_row_label">验证号码：</label><input id="verificationValue" type="text" onfocus="getFocus()" onblur="loseFocus()" class="col-md-8 input_value input_value_hover" placeholder="请输入32位验证号码">
            </div>
            <div class="row form_row">
                <label class="col-md-4 form_row_label">验证码：</label><input id="captchaValue" style="border-right-width: 0" type="text" onfocus="getFocus()" onblur="loseFocus()" placeholder="请输入图片的验证码" class="col-md-5 input_value input_value_hover">
                <img class="col-md-3 pad0" id="captchaImg" onclick="getCaptcha()" style="border: 1px solid #cbcbcb" width="100" height="32">
                <input type="hidden" id="captchaKey">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input_submit" style="margin-top: 65px">
                <div onclick="submintCode()">
                    查 询
                </div>
            </div>
        </div>
    </div>
    <div id="footer_img1" class="footer_img1">
        <img class="img-responsive" src="{{ asset('image/N_bd04.jpg') }}">
    </div>
</div>
<!--<div  style="display: none; height: 25px; position:absolute; z-index:1;float:right;top:0px;right:0px"  id="cover" onclick="hidden_div();">--><!--<img class="img-waring" width=300 src="images/weixin_text.png">--><!--</div>-->
<div id="cover" onclick="hidden_div()" style="position: absolute; right: 0px; bottom: 0px; width: 100%; height: 100%; z-index: 5; left: 0px; top: 0px; background-image: url({{asset('image/mask_bg.png')}}); background-repeat: no-repeat; background-size:100%; display: none">
    <img style="position:absolute; width: 80%; z-index:1;float:right;top:0px;right:0px" src="{{ asset('image/weixin_text.png') }}">
</div>
<script src="{{  asset('js/main.js')  }}"></script>
</body>
</html>