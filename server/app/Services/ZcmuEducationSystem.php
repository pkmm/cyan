<?php
/**
 * Author: robotgg@126.com
 * Date: 2019/4/14 - 13:51
 */

namespace App\Services;

use App\Contracts\EducationSystemInterface;
use App\Contracts\StudentInterface;
use App\Contracts\VerifyCodeRecognizeInterface;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Throwable;

class ZcmuEducationSystem implements EducationSystemInterface
{
    const HOST = 'zfxk.zcmu.edu.cn';
    const MAIN_PAGE_URL = 'http://' . self::HOST . '/';
    const VERIFY_CODE_URL = 'CheckCode.aspx';
    const DEFAULT_URL = 'default2.aspx';
    const USER_AGENT = 'cyan phone';
    const VIEW_STATE = '__VIEWSTATE';
    /** @var StudentInterface */
    private $student;
    /** @var VerifyCodeRecognizeInterface */
    private $verifyCodeRecognize;
    /** @var Client */
    private $client;

    /** @var string */
    private $currentPage; // 当前的页面

    private $schoolReportUrl;


    public function __construct(StudentInterface $student, VerifyCodeRecognizeInterface $verifyCodeRecognize)
    {
        $this->student = $student;
        $this->verifyCodeRecognize = $verifyCodeRecognize;
        $cookieJar = new CookieJar();
        $this->client = new Client([
            'timeout' => 10,
            'verify' => false,
            'cookies' => $cookieJar,
        ]);
    }


    public function login()
    {
        //1. open main page and get viewState from page.
        $html = $this->client->get(self::MAIN_PAGE_URL)->getBody()->getContents();
        $viewState = $this->getViewStateFromHtmlPage($html);
        // post login
        $code = $this->verifyCodeRecognize->decode(
            $this->client
                ->get(self::MAIN_PAGE_URL . self::VERIFY_CODE_URL)
                ->getBody()
                ->getContents()
        );
        $html = $this->client->post(self::MAIN_PAGE_URL, [
            'form_params' => [
                self::VIEW_STATE => $viewState,
                'txtUserName' => $this->student->getStudentNumber(),
                'Textbox1' => '',
                'TextBox2' => $this->student->getStudentPassword(),
                'txtSecretCode' => $code,
                'RadioButtonList1' => urldecode('学生'),
                'Button1' => '',
                'lbLanguage' => '',
                'hidPdrs' => '',
                'hidsc' => '',
            ],
            'headers' => [
                'Referer' => self::MAIN_PAGE_URL,
            ]
        ])->getBody()->getContents();
        $this->currentPage = $this->convertToUtf8FromGb2312($html);

    }

    // 输入筛选条件 查询成绩
    public function pressQuerySchoolReportButton()
    {
        $viewState = $this->getViewStateFromHtmlPage($this->currentPage);
        $html = $this->client->post(self::MAIN_PAGE_URL . $this->schoolReportUrl, [
            'form_params' => [
                self::VIEW_STATE => $viewState,
                'ddlXN' => '',
                'ddlXQ' => '',
                'Button2' => urlencode('在校学习成绩查询')
            ],
            'headers' => [
                'Referer' => self::MAIN_PAGE_URL . '/xs_main.aspx?xh=' . $this->student->getStudentNumber(),
                'Host' => self::HOST,
            ]
        ])->getBody()->getContents();

        $this->currentPage = $this->convertToUtf8FromGb2312($html);
    }

    private function getViewStateFromHtmlPage(string $html): string
    {
        preg_match(
            '#<input type="hidden" name="__VIEWSTATE" value="(.*?)" />#',
            $html,
            $matches
        );
        if (!empty($matches)) {
            return $matches[1];
        }
        throw new CanNotDecodeViewStateException("无法获取viewState");
    }

    private function convertToUtf8FromGb2312(string $html)
    {
        return mb_convert_encoding($html, 'utf-8', 'gb2312');
    }

    private function retrieveSchoolReport()
    {
        $html = htmlspecialchars_decode($this->currentPage);
        $pattern = '#(?s)<table .+?id="Datagrid1"[\s\S]*?>(.*?)</table>#';
        preg_match_all($pattern, $html, $matches);
        if (!isset($matches[1][0])) {
            throw new GetSchoolReportException('获取成绩单失败');
        }
        $table = $matches[1][0];

        $pattern = '#(?s)<td>(.*?)</td><td>(.*?)</td><td>.*?</td><td>(.*?)</td><td>(.*?)</td><td>.*?</td><td>(.*?)</td><td>(.*?)</td><td>(.*?)</td><td>.*?</td><td>(.*?)</td><td>(.*?)</td><td>.*?</td><td>.*?</td><td>.*?</td><td>.*?</td>#';

        preg_match_all($pattern, $table, $matches);

        if (empty($matches)) {
            throw new GetSchoolReportException('获取成绩单失败');
        }

        unset($matches[0]);
        $count = sizeof($matches[1]);

        $scores = [];
        for ($i = 0; $i < $count; $i++) {
            $item = [];
            for ($j = 1; $j <= 9; $j++) {
                $item[] = $matches[$j][$i] == '&nbsp;' ? '' : $matches[$j][$i];
            }
            $scores[] = $item;
        }

        unset($scores[0]);
        return $scores;
    }

    public function getSchoolReport(): array
    {
        $this->login();
        $this->pressQueryInformationButton();
        $this->pressQuerySchoolReportButton();
        return $this->retrieveSchoolReport();
    }

    public function getStudent(): StudentInterface
    {
        return $this->student;
    }

    // 点击 ‘查询信息’ 按钮.
    private function pressQueryInformationButton()
    {
        // 1. 获取成绩的按钮的地址
        $pattern = '#(?s)xscj_gc\.aspx\?xh=(.*?)\&xm=(.*?)\&gnmkdm=(.*?)"#';
        preg_match($pattern, $this->currentPage, $matches);
        if (empty($matches)) {
            throw new GetUrlOfGetSchoolReportFailedException('获取 信息查询 按钮失败');
        }
        $studentName = $matches[2];
        $this->student->setStudentName($studentName);
        $this->schoolReportUrl = mb_substr($matches[0], 0, -1);

        $html = $this->client->get(self::MAIN_PAGE_URL . $this->schoolReportUrl, [
            'headers' => [
                'Referer' => self::MAIN_PAGE_URL . 'xs_main.aspx?xh= ' . $this->student->getStudentNumber(),
            ]
        ])->getBody()->getContents();

        $html = $this->convertToUtf8FromGb2312($html);

        $this->currentPage = $html;
    }
}

// exceptions.
class CanNotDecodeViewStateException extends Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }
}

class PasswordWrongException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class VerifyCodeWrongException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class CanNotFindUserAccountException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

// 账号欠费
class AccountShutdownException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class GetUrlOfGetSchoolReportFailedException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class GetSchoolReportException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
