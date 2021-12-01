<?php
/**
 * 退款示例
 */
require __DIR__ . '/../vendor/autoload.php';

use SmallPay\Refund;

$notifyUrl = "http://api.weituma.cn/api/pay/refund";
//应用ID
$appId = "10000002";
//应用秘钥
$appKey = "de872154ffbf91a5dcc0e539dd2d5106";

$client = new Refund($appId, $appKey);
$client->SetOutTradeNo("IMD121545112545");
$res = $client->Send($notifyUrl);
var_dump($res);
//{"code":1,"msg":"订单无效","data":""}
//{"code":0,"msg":"申请成功","data":""}
exit();
