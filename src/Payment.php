<?php
/**
 * 发起支付
 */

namespace SmallPay;

use SmallPay\Library\Tools;

class Payment
{
    protected $appId;
    protected $appKey;
    protected $params = array();

    /**
     * @param string $appId 应用ID
     * @param string $appKey 应用秘钥
     */
    public function __construct($appId, $appKey)
    {
        $this->appId = $appId;
        $this->appKey = $appKey;
    }

    /**
     * 设置支付能力
     * @param string $pay_code
     * @return $this
     */
    public function SetPayCode($pay_code)
    {
        $this->params["pay_code"] = $pay_code;
        return $this;
    }

    /**
     * 设置商户单号
     * @param string $out_trade_no
     * @return $this
     */
    public function SetOutTradeNo($out_trade_no)
    {
        $this->params["out_trade_no"] = $out_trade_no;
        return $this;
    }

    /**
     * 设置金额，单位分
     * @param int $money
     * @return $this
     */
    public function SetMoney($money)
    {
        $this->params["money"] = $money;
        return $this;
    }

    /**
     * 设置商品名称
     * @param string $goods_name
     * @return $this
     */
    public function SetGoodsName($goods_name)
    {
        $this->params["goods_name"] = $goods_name;
        return $this;
    }

    /**
     * 设置支付成功回跳地址
     * @param string $return_url
     * @return $this
     */
    public function SetReturnUrl($return_url)
    {
        $this->params["return_url"] = $return_url;
        return $this;
    }

    /**
     * 设置异步回调地址
     * @param int $notify_url
     * @return $this
     */
    public function SetNotifyUrl($notify_url)
    {
        $this->params["notify_url"] = $notify_url;
        return $this;
    }

    /**
     * 设置商户自己的公众号 appid
     * @param string $sub_appid
     * @return $this
     */
    public function SetSubAppId($sub_appid)
    {
        $this->params["money"] = $sub_appid;
        return $this;
    }

    /**
     * 设置商户自己的公众号 appid
     * @param string $sub_openid
     * @return $this
     */
    public function SetSubOpenid($sub_openid)
    {
        $this->params["sub_openid"] = $sub_openid;
        return $this;
    }

    /**
     * 设置用户的客户端IP
     * @param string $payer_client_ip
     * @return $this
     */
    public function SetPayerClientIp($payer_client_ip)
    {
        $this->params["payer_client_ip"] = $payer_client_ip;
        return $this;
    }

    /**
     * 设置商户端设备号
     * @param string $device_id
     * @return $this
     */
    public function SetDeviceId($device_id)
    {
        $this->params["device_id"] = $device_id;
        return $this;
    }

    /**
     * 设置浏览器类型
     * @param string $browse_type
     * @return $this
     */
    public function SetBrowseType($browse_type)
    {
        $this->params["browse_type"] = $browse_type;
        return $this;
    }

    /**
     * 设置请求时的时间戳
     * @param int $stamptime
     * @return $this
     */
    public function SetStampTime($stamptime)
    {
        $this->params["stamptime"] = $stamptime;
        return $this;
    }

    /**
     * 发送请求
     * @param string $url
     * @return bool|string
     */
    public function Send($url)
    {
        if ($url == "") {
            return false;
        }
        if (!isset($this->params["app_id"]) || $this->params["app_id"] == "") {
            $this->params["app_id"] = $this->appId;
        }
        $this->SetStampTime(time());
        $this->params["sign"] = Tools::Sign($this->params, $this->appKey);
        return Tools::curlPost($url, $this->params);
    }

    /**
     * 验签
     * @param array $param
     * @return bool
     */
    public function VerifySign(array $param)
    {
        return isset($param['sign']) && $param['sign'] == Tools::Sign($param, $this->appKey);
    }
}