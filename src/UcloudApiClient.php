<?php
// +----------------------------------------------------------------------
// | 胜家云 [ SingKa Cloud ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2019 https://www.singka.net All rights reserved.
// +----------------------------------------------------------------------
// | 宁波晟嘉网络科技有限公司
// +----------------------------------------------------------------------
// | Author: ShyComet <shycomet@qq.com>
// +----------------------------------------------------------------------
namespace Singka\UcloudSms;

use Singka\UcloudSms\UConnection;

class UcloudApiClient {

    function __construct( $base_url, $public_key, $private_key, $project_id)
    {
        $this->conn = new UConnection($base_url);
        $this->public_key = $public_key;
        $this->private_key = $private_key;

        if ($project_id !== "") {
            $this->project_id = $project_id;
        }
    }

    function _verfy_ac($private_key, $params) {
        ksort($params);
        $params_data = "";
        foreach($params as $key => $value){
            $params_data .= $key;
            $params_data .= $value;
        }
        $params_data .= $private_key;
        return sha1($params_data);
    }

    function get($api, $params){
        $params["PublicKey"] = $this->public_key;

        if ( isset($this->project_id) && !empty($this->project_id) )
        {
            $params["ProjectId"] = $this->project_id;
        }
        $params["Signature"] = $this->_verfy_ac($this->private_key, $params);
        return $this->conn->get($api, $params);
    }

    function post($api, $params){
        $params["PublicKey"] = $this->PublicKey;
        if ( isset($this->project_id) && !empty($this->project_id) )
        {
            $params["ProjectId"] = $this->project_id;
        }
        $params["Signature"] = $this->_verfy_ac($this->private_key, $params);
        return $this->conn->post($api, $params);
    }
}