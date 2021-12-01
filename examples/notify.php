<?php
/**
 * 支付异步回调示例
 */
require __DIR__ . '/../vendor/autoload.php';

use SmallPay\Payment;

//应用ID
$appId = "10000002";
//应用秘钥
$appKey = "de872154ffbf91a5dcc0e539dd2d5106";

$client = new Payment($appId, $appKey);
//验签
$check = $client->VerifySign($_POST);
if ($check) {
    //执行商户的逻辑
    
    //处理完成返回如下 json
    echo json_encode(['state'=>"SUCCESS"]);
}

//处理失败
echo json_encode(['state'=>"FAIL"]);
exit();
