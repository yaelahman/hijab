<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use App\Category;
use App\ImageProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginSmile($phpsid)
    {
        $url = "https://www.smile.one/customer/account";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);

        // return $response;

        curl_close($ch);
        $message = 'Login Gagal !';
        // Check Jika File Cookie.txt ada
        $log = file_get_contents(dirname(__FILE__) . "/cookie.txt");
        preg_match_all('/PHPSESSID.([^\s]{0,200})/', $log, $phpsids);
        $old_phpsid = $phpsids[1][0];
        if ($old_phpsid != $phpsid) {
            $ubah = str_replace($old_phpsid, $phpsid, $log);
            $log = fopen(dirname(__FILE__) . "/cookie.txt", "w+");
            fwrite($log, ($ubah));
            fclose($log);
        }
        if (preg_match("/Nickname/", $response)) {
            $message = 'Login Berhasil !';
        } else {
            $message = 'Login Gagal !';
        }
        return $message;
    }

    function listDiamondML($value)
    {
        if ($value == '86') {
            $diamond = '13';
        } else if ($value == '172') {
            $diamond = '23';
        } else if ($value == '257') {
            $diamond = '25';
        } else if ($value == '706') {
            $diamond = '26';
        } else if ($value == '2195') {
            $diamond = '27';
        } else if ($value == '3688') {
            $diamond = '28';
        } else if ($value == '5532') {
            $diamond = '29';
        } else if ($value == '9288') {
            $diamond = '30';
        } else if ($value == 'starlight') {
            $diamond = '32';
        } else if ($value == 'twilight') {
            $diamond = '33';
        } else if ($value == 'starlightplus') {
            $diamond = '34';
        }
        return $diamond;
    }

    function curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function getCSRFToken($string, $start, $end)
    {
        @$str = explode($start, $string);
        @$str = explode($end, $str[1]);
        return @$str[0];
    }

    /**
     * Auto Order Function.
     *
     * @param  int  $userId
     * @param  int  $zoneId
     * @param  int  $diamond
     */
    function createPayment($userId = '79680016', $zoneId = '2153', $diamond = '86')
    {
        $csrfTokenSmile = $this->curl("https://www.smile.one/merchant/mobilelegends?source=other");
        $csrfToken = $this->getCSRFToken($csrfTokenSmile, '_csrf" value="', '"');

        //AMBIL KODE DIAMOND
        $resp = ["success" => false];
        $headers[] = "accept: application/json, text/javascript, */*; q=0.01";
        $headers[] = "accept-language: en-US,en;q=0.9";
        $headers[] = "content-type: application/x-www-form-urlencoded; charset=UTF-8";
        $headers[] = "origin: https://www.smile.one";
        $headers[] = "referer: https://www.smile.one/merchant/mobilelegends?source=other";
        $headers[] = "sec-fetch-dest: empty";
        $headers[] = "sec-fetch-mode: cors";
        $headers[] = "sec-fetch-site: same-origin";
        $headers[] = "user-agent: Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1";
        $headers[] = "x-requested-with: XMLHttpRequest";
        $kodeDiamond = $this->listDiamondML($diamond);
        $post = "user_id=$userId&zone_id=$zoneId&pid=$kodeDiamond&checkrole=&pay_methond=smilecoin&channel_method=smilecoin"; //pay smilecoin
        $link = "https://www.smile.one/merchant/mobilelegends/query/";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        curl_close($ch);

        // Ambil Flow ID Smile One
        $dataFlow = json_decode($response, true);
        // return $dataFlow;
        $resp = [
            'username' => $dataFlow['username'],
            'nominal'  => $diamond
        ];

        $flowID = $dataFlow['flowid'];

        // PROSES PAYMENT
        $headers[] = "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9";
        $headers[] = "accept-language: en-US,en;q=0.9";
        $headers[] = "cache-control: max-age=0";
        $headers[] = "content-type: application/x-www-form-urlencoded";
        $headers[] = "origin: https://www.smile.one";
        $headers[] = "referer: https://www.smile.one/merchant/mobilelegends?source=other";
        $headers[] = "sec-fetch-dest: document";
        $headers[] = "sec-fetch-mode: navigate";
        $headers[] = "sec-fetch-site: same-origin";
        $headers[] = "sec-fetch-user: ?1";
        $headers[] = "upgrade-insecure-requests: 1";
        $headers[] = "user-agent: Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1";

        $post = "_csrf=$csrfToken&user_id=$userId&zone_id=$zoneId&pay_methond=smilecoin&product_id=$kodeDiamond&flowid=$flowID";
        $link = "https://www.smile.one/merchant/mobilelegends/pay";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__) . "/cookie.txt");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $response = curl_exec($ch);
        $status = curl_getinfo($ch);
        $status = $status['http_code'];
        curl_close($ch);

        return $response;

        // Cek Apabila Transaksi Smile One Berhasil
        if (preg_match("/success/i", $response)) {
            $message = 'Berhasil';
            $resp = [
                'success' => true,
                'message' => $message
            ];
        } else {
            $message = 'Gagal';
            $resp = [
                'success' => false,
                'message' => $message,
                'error'   => 'Saldo Smile One Tidak Cukup'
            ];
        }

        return json_decode(json_encode($resp), true);
    }
}
