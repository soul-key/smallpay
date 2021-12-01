# SmallPay

#### 小微支付的PHP版本SDK

---

# 一、安装

- 使用Composer v2安装，仓库 `https://github.com/soul-key/smallpay`
```bash
composer require soul-key/smallpay
```

* #### 发起支付示例

```php
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
$client->SetOutTradeNo("IMD".time());//设置商户订单号
$client->SetMoney(1);
$client->SetGoodsName("测试商品");
$client->SetNotifyUrl("http://www.baidu.com");
$client->SetReturnUrl("http://www.baidu.com");
//发送支付请求
$res = $client->Send($payUrl);

var_dump($res);
```
* #### 支付异步通知示例
```php
/**
 * 支付异步通知示例
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
}else {
    //验签失败
    echo json_encode(['state' => "FAIL"]);
    exit();
}
```
* ### 退款示例
```php
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
```