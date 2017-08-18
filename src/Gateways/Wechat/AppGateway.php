<?php

namespace Yansongda\Pay\Gateways\Wechat;

/**
 * 微信 - 公众号支付.
 */
class AppGateway extends Wechat
{
    /**
     * 交易类型.
     * 
     * @author yansongda <me@yansongda.cn>
     * 
     * @version 2017-08-15
     * 
     * @return  string     [description]
     */
    protected function getTradeType()
    {
        return 'APP';
    }

    /**
     * 对外支付.
     * 
     * @author yansongda <me@yansongda.cn>
     * 
     * @version 2017-08-15
     * 
     * @param   array      $config_biz [description]
     * 
     * @return  array                  [description]
     */
    public function pay(array $config_biz = [])
    {
        $this->config = array_merge($this->config, $config_biz);
        $this->config['appid'] = $this->user_config->get('appid');

        $payRequest = [
            "appid" => $this->user_config->get('appid'),
            'partnerid' => $this->user_config->get('mch_id'),
            'prepayid' => $this->preOrder()['prepay_id'],
            "timestamp" => time(),    
            "noncestr" => $this->createNonceStr(),   
            "package" => "Sign=WXPay", 
        ];
        $payRequest['sign'] = $this->getSign($payRequest);

        return $payRequest;
    }
}
