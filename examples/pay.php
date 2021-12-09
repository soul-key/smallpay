<?php
/**
 * 发起支付示例
 */
require __DIR__ . '/../vendor/autoload.php';

use SmallPay\Payment;

//支付地址
$payUrl = "http://api.weituma.cn/api/pay/go";
//应用ID
$appId = "10000002";
//应用秘钥
$appKey = "de872154ffbf91a5dcc0e539dd2d5106";

//设置支付相关
$client = new Payment($appId, $appKey);
$client->SetPayCode(2001);//设置支付能力
$client->SetOutTradeNo("IMD" . time());//设置商户订单号
$client->SetMoney(1);
$client->SetGoodsName("测试商品");
$client->SetNotifyUrl("http://www.baidu.com");
$client->SetReturnUrl("http://www.baidu.com");
//发送支付请求
$res = $client->Send($payUrl);
$res = json_decode($res, true);
if (isset($res['data']['url'])) {
    //返回的支付url 经过了 urlencode 转码，故此处要解码
    $pay_url = urldecode($res['data']['url']);
    header("location:" . $pay_url);
} else {
    var_dump($res);
}
die;