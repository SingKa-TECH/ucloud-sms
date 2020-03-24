# Ucloud短信平台

#### 介绍
本项目是基于Ucloud短信PHPSDK二次开发的，支持ThinkPHP5.0、ThinkPHP5.1和ThinkPHP6.0，由宁波晟嘉网络科技有限公司维护，用于Ucloud旗下的短信发送业务。

#### 安装教程

使用 `composer require singka/ucloud-sms` 命令行安装即可。

#### 使用说明


```
use Singka\UcloudSms\UcloudApiClient;

//BASE_URL为API地址，默认为https://api.ucloud.cn
//PUBLIC_KEY为公钥，可在Ucloud面板找到（console - API密钥 - 显示）
//PRIVATE_KEY为私钥，可在Ucloud面板找到（console - API密钥 - 显示）
//PROJECT_ID为项目ID，可从Ucloud面板dashbord获取
$conn = new UcloudApiClient(BASE_URL, PUBLIC_KEY, PRIVATE_KEY, PROJECT_ID);
$params['Action'] = "SendUSMSMessage";

    public function usms_send($mobile,$TemplateId,$templates)
    {
        $conn = new UcloudApiClient(Config::get('usms.BASE_URL'), Config::get('usms.PUBLIC_KEY'), Config::get('usms.PRIVATE_KEY'), Config::get('usms.PROJECT_ID'));
        $params['Action'] = "SendUSMSMessage";
        //判断$mobile是否为数组，如果是数组，就触发群发
        if(is_array($mobile)){
            foreach($mobile as $key => $val){
                $params["PhoneNumbers.".$key] = $val;
            }
        }else{
            $params['PhoneNumbers.0'] = $mobile;
        }
        $params["SigContent"] = '胜家云';
        $params["TemplateId"] = $TemplateId;
        //$templates，如果是数组，就触发多个发送变量
        if(is_array($templates)){
            foreach($templates as $key => $val) {
                $params["TemplateParams.".$key] = $val;
            }
        }else{
            $params["TemplateParams.0"] = $templates;
        }
        print_r($response = $conn->get("/", $params));
    }
```

#### 其他说明
返回的相关错误码请查阅：https://docs.ucloud.cn/management_monitor/usms/error_code