<?php

namespace App\Http\Controllers;

use App\Group;
use App\Member;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use SimpleSoftwareIO\QrCode\BaconQrCodeGenerator;

class FormController extends Controller
{
    /**
     * 获取验证码
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function getImgCaptchaDTO(Request $request, Client $client)
    {
        if ($request->has('captchaId')) {
            $captchaId = $request->input('captchaId');

            $response = $client->get('https://ggfw.nn12333.com:8081/form/api/verify/getImgCaptchaDTO/' . $captchaId);

            $captcha = $response->getBody()->getContents();

            return $captcha;

        } else {
            $response = $client->get('https://ggfw.nn12333.com:8081/form/api/verify/getImgCaptchaDTO');

            $result = $response->getBody()->getContents();

            return response()->json(json_decode($result, true));
        }
    }

    public function verify(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'signNumber' => [
                    'required',
                    'string',
                    function ($attribute, $value, $fail) {
                        if ($value !== '39377288fefd40a5a56d5d6317302a5e') {
                            return $fail('验证号码不正确');
                        }
                    },
                ],
                'captcha'    => ['required', 'captcha'],
            ], [
                'captcha.required' => '验证码不能为空。',
                'captcha.captcha'  => '验证码不正确。',
            ]);

            return response()->json([
                'url' => true,
            ]);
        } catch (\Exception $exception) {
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'title'  => "未找到资源",
                    'type'   => "http://httpstatus.es/404",
                    'status' => 400,
                    'detail' => array_first(array_collapse($exception->errors())),
                ], 400);
            }
        }


    }

    public function getFileWebServerUrl(Request $request, \TCPDF $pdf, BaconQrCodeGenerator $qrCode)
    {
        // $pdf = new \TCPDF();
        // 设置文档信息
        // $pdf->SetCreator('懒人开发网');
        // $pdf->SetAuthor('懒人开发网');
        $pdf->SetTitle('getFileWebServerUrl');
        // $pdf->SetSubject('getFileWebServerUrl2');
        // $pdf->SetKeywords('TCPDF, PDF, PHP');
        // 设置页眉和页脚信息
        $pdf->SetHeaderData(
            '',
            0,
            '您可以使用手机扫描二维码或访问人社局网站https://ggfw.nn12333.com:8081/form/验证此单据真伪，验证号码39377288fefd40a5a56d5d6317302a5e',
            '',
            [0, 0, 0],
            [0, 0, 0]
        );
        // $pdf->setFooterData([0, 64, 0], [0, 64, 128]);
        // 设置页眉和页脚字体
        $pdf->setHeaderFont(['stsongstdlight', '', 7]);
        // $pdf->setFooterFont(['helvetica', '', '8']);
        // $pdf->setPrintHeader(false); //设置打印页眉
        // $pdf->setPrintFooter(false); //设置打印页脚
        // 设置默认等宽字体
        // $pdf->SetDefaultMonospacedFont('courier');
        // 设置间距
        // $pdf->SetMargins(15, 15, 15);//页面间隔
        $pdf->SetHeaderMargin(1);//页眉top间隔
        // $pdf->SetFooterMargin(10);//页脚bottom间隔

        // remove default header/footer
        // $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // set default monospaced font
        // set image scale factor

        // 设置分页
        // $pdf->SetAutoPageBreak(true, 25);
        // set default font subsetting mode
        // $pdf->setFontSubsetting(true);
        //设置字体 stsongstdlight支持中文
        $pdf->SetFont('stsongstdlight', '', 12, false);
        // $pdf->SetMargins(30, 0, 30);//左、上、右
        // $pdf->SetAutoPageBreak(TRUE, 15);//下

        // 数据
        $list = Group::query()
            ->when($request->filled('group_id'), function ($query) use ($request) {
                return $query->where('id', $request->input('group_id'));
            })
            ->get();

        // 用户总数
        $count_member = 0;
        foreach ($list as $key => $collect) {
            $count_member += count($collect->members);
        }

        $qrCode->format('png')->margin(0)->size(260)->generate(
            $url = env('APP_URL') . $_SERVER['REQUEST_URI'],
            '../public/pdf/renshe.png'
        );

        $number = 0;
        foreach ($list as $key => $collect) {
            if ($collect->members->isNotEmpty()) {
                $users = $collect->members->chunk(2);
                $count = count($collect->members);
                $date = $collect->publish->toDateString();
                $page = view('form.pdf3', compact(['users', 'count_member', 'date', 'number']));
                $html = response($page)->getContent();

                $number += $count; // 下一个循环开始位置

                // 加页
                $pdf->AddPage();
                $pdf->writeHTML($html);

                // 生成二维码
//                if ($request->filled('group_id')) {
//                    $url = env('APP_URL') . $_SERVER['REQUEST_URI'];
//                } else {
//                    $url = env('APP_URL') . $_SERVER['REQUEST_URI'] . '&group_id=' . $collect->id;
//                }


//                $imgdata = base64_decode('iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABlBMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDrEX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==');
//                // The '@' character is used to indicate that follows an image data stream and not an image file name
//                $pdf->Image('@'.$imgdata);

                $pdf->Image(public_path() . '/pdf/h.jpg', 10, 5, 200, 10, 'JPG', '', '', false, 100);
                $pdf->Image(public_path() . '/pdf/renshe.png', 10, 5, 20, 20, 'PNG', '', '', false, 100);
                $pdf->Image(public_path() . '/pdf/img_02.png', 163, 12, 42, 42, 'PNG', '', '', false, 100);

                unset($users);
                unset($page);
                unset($html);
            }
        }

        // $pdf->SetMargins(10, 10, 10, true);

        $pdf->setCellPaddings(1, 1, 1, 1);

        // 输出PD
        $pdf->Output($request->input('code', '39377288fefd40a5a56d5d6317302a5e').'.pdf',
            $request->input('tp') == 'android' ? 'D' : 'I' ); // I输出、D下载
        // return view('form.pdf');
    }

    public function getFileWebServerUrl1()
    {
        $pdf = new \TCPDF();
        // 设置文档信息
        // $pdf->SetCreator('懒人开发网');
        // $pdf->SetAuthor('懒人开发网');
        $pdf->SetTitle('getFileWebServerUrl');
        // $pdf->SetSubject('getFileWebServerUrl2');
        // $pdf->SetKeywords('TCPDF, PDF, PHP');
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

// set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // 设置页眉和页脚字体
        // $pdf->setHeaderFont(['stsongstdlight', '', 7]);
        // $pdf->setFooterFont(['helvetica', '', '8']);
        // $pdf->setPrintHeader(false); //设置打印页眉
        // $pdf->setPrintFooter(false); //设置打印页脚

        // $pdf->setPageUnit('mm');
        // 设置默认等宽字体
        // $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        // $pdf->SetMargins(15, 15, 15);//页面间隔
        // $pdf->SetHeaderMargin(15);//页眉top间隔
        // $pdf->SetFooterMargin(10);//页脚bottom间隔

        // 设置分页
        // $pdf->SetAutoPageBreak(true, 25);

        // set default font subsetting mode
        // $pdf->setFontSubsetting(true);

        // 设置字体 stsongstdlight支持中文
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('stsongstdlight', '', 10, false);

        // 需要转换成 pdf 的 html 页面
        $list = Member::query()->get();

        $users = collect($list)->chunk(2);
        $page = view('form.pdf3', compact('users'));
        $html = response($page)->getContent();

        //第一页
        $pdf->AddPage();
        $pdf->writeHTML($html);
        // $pdf->writeHTML('<div>您可以使用手机扫描二维码或访问人社局网站https://ggfw.nn12333.com:8081/form/验证此单据真伪，验证号码39377288fefd40a5a56d5d6317302a5e</div>');

        $pdf->Image(public_path() . '/pdf/img_02.png', 10, 28, 40, 40, '', '', '', false, 100);
        $pdf->Image(public_path() . '/pdf/renshe.png', 105, $pdf->getY(), 22, 22, '', '', '', false, 100);

        //第二页
        // $pdf->AddPage();
        // $pdf->writeHTML('<h1>第二页内容</h1>');

        ///输出PDF
        $pdf->Output('renshe.pdf', 'I'); // I输出、D下载
        // return view('form.pdf');
    }
}
