<?php

namespace Boat\Dev;

/**
 * 开发者SDK
 */
class Api {

    private $open_id;
    private $secret;
    private $curl;
    private $url;

    /**
     * 初始化
     * @param type $open_id
     * @param type $secret
     */
    public function __construct($open_id, $secret, $url = '') {
        $this->open_id = $open_id;
        $this->secret = $secret;
        $this->curl = new \lisao\curl\curl('');
        if ($url) {
            $this->url = $url;
        } else {
            $this->url = 'http://boat2.qqplugin.com';
        }
    }

    /**
     * 查询授权
     * @param type $tags
     */
    public function queryAuth($tags) {
        $this->curl->setUrl($this->url . '/dev/auth/query');
        $post = [
            'open_id' => $this->open_id,
            'tags' => $tags,
        ];
        $post['sign'] = $this->sign($post);

        $result = json_decode($this->curl->post($post), true);
        return $result;
    }

    /**
     * 生成卡密
     * @param type $order_num 商户订单订单号（唯一不可重复）
     * @param type $count 生成卡密张数
     * @param type $exp 有效时长（秒）
     * @param type $remark 订单备注
     * @param type $card_remark 卡密备注
     */
    public function createCdk($order_num, $count, $exp, $remark = '', $card_remark = '') {
        $this->curl->setUrl($this->url . '/dev/card/create');
        $post = [
            'open_id' => $this->open_id,
            'order_num' => $order_num,
            'count' => $count,
            'exp' => $exp,
            'remark' => $remark,
            'card_remark' => $card_remark
        ];
        $post['sign'] = $this->sign($post);

        $result = json_decode($this->curl->post($post), true);
        return $result;
    }

    /**
     * 查询生成卡密的订单
     * @param type $order_num 商户订单号
     */
    public function queryCdkOrder($order_num) {
        $this->curl->setUrl($this->url . '/dev/card/order');
        $post = [
            'open_id' => $this->open_id,
            'order_num' => $order_num,
        ];
        $post['sign'] = $this->sign($post);

        $result = json_decode($this->curl->post($post), true);
        return $result;
    }

    /**
     * 卡密充值
     * @param type $tags 待充值用户
     * @param type $cdk 卡密 
     * @return type
     */
    public function charge($tags, $cdk) {
        $this->curl->setUrl($this->url . '/dev/card/charge');
        $post = [
            'open_id' => $this->open_id,
            'card' => $cdk,
            'tags' => $tags,
        ];
        $post['sign'] = $this->sign($post);

        $result = json_decode($this->curl->post($post), true);
        return $result;
    }

    /**
     * 修改授权（增减授权时长）
     * @param sring $order_num 商户订单号（唯一）
     * @param int $exp 增减授权时长（秒）
     * @param string $tags 待修改客户
     * @return array
     */
    public function editAuth($order_num, $exp, $tags) {
        $this->curl->setUrl($this->url . '/dev/auth/charge');
        $post = [
            'open_id' => $this->open_id,
            'order_num' => $order_num,
            'exp' => $exp,
            'tags' => $tags,
        ];
        $post['sign'] = $this->sign($post);

        $result = json_decode($this->curl->post($post), true);
        return $result;
    }

    /**
     * 查询修改授权的订单
     * @param string $order_num 商户订单号
     * @return array
     */
    public function queryAuthOrder($order_num) {
        $this->curl->setUrl($this->url . '/dev/auth/order');
        $post = [
            'open_id' => $this->open_id,
            'order_num' => $order_num,
        ];
        $post['sign'] = $this->sign($post);

        $result = json_decode($this->curl->post($post), true);
        return $result;
    }

    /**
     * 计算签名
     * @param array $arr 待签名数组
     * @return string md5签名
     */
    private function sign($arr) {
        $temp = [];
        foreach ($arr as $val) {

            $temp[] = $val;
        }

        sort($temp, SORT_STRING);
        $str = implode('', $temp);
        return md5($str . $this->secret);
    }

}
