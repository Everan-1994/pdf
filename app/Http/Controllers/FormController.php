<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

    public function getFileWebServerUrl()
    {
        $pdf = new \TCPDF();
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
        $pdf->setPrintFooter(false); //设置打印页脚

        // 设置默认等宽字体
        $pdf->SetDefaultMonospacedFont('courier');

        // 设置间距
        // $pdf->SetMargins(15, 15, 15);//页面间隔
        $pdf->SetHeaderMargin(1);//页眉top间隔
        // $pdf->SetFooterMargin(10);//页脚bottom间隔

        // 设置分页
        // $pdf->SetAutoPageBreak(true, 25);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        //设置字体 stsongstdlight支持中文
        $pdf->SetFont('stsongstdlight', '', 10, false);

        // 需要转换成 pdf 的 html 页面
        $list = [
            [
                'code'     => '123',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '124',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '125',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],
            [
                'code'     => '126',
                'userName' => '小李',
                'cardId'   => '450103022904059281',
            ],

        ];

        $users = collect($list)->chunk(2);
        $page = view('form.pdf3', compact('users'));
//        $page = view('form.pdf3');
        $html = response($page)->getContent();

        //第一页
        $pdf->AddPage(1);
        $pdf->writeHTML($html);
        // $pdf->writeHTML('<div>您可以使用手机扫描二维码或访问人社局网站https://ggfw.nn12333.com:8081/form/验证此单据真伪，验证号码39377288fefd40a5a56d5d6317302a5e</div>');

        $pdf->Image(public_path() . '/pdf/h.png', 10, 5, '', 5, '', '', '', false, 100);
        $pdf->Image(public_path() . '/pdf/img_01.png', 10, 5, 20, 20, '', '', '', false, 100);
        $pdf->Image(public_path() . '/pdf/img_02.png', 150, 15, 42, 42, '', '', '', false, 100);

        //第二页
        // $pdf->AddPage();
        // $pdf->writeHTML('<h1>第二页内容</h1>');

        //输出PDF
        $pdf->Output('renshe.pdf', 'I'); // I输出、D下载
        // return view('form.pdf');
    }
}
