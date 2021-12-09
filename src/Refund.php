<?php
/**
 * 退款
 */

namespace SmallPay;

use SmallPay\Library\Tools;

class Refund
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
     * 设置商户单号(与下单同一编号)
     * @param $out_trade_no
     * @return $this
     */
    public function SetOutTradeNo($out_trade_no)
    {
        $this->params["out_trade_no"] = $out_trade_no;
        return $this;
    }

    /**
     * 发送请求
     * @param $url
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
        $this->params["sign"] = Tools::Sign($this->params, $this->appKey);
        return Tools::curlPost($url, $this->params);
    }
}