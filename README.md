# Ucloud短信平台

#### 介绍
本项目是基于Ucloud短信PHPSDK二次开发的，支持ThinkPHP5.0、ThinkPHP5.1和ThinkPHP6.0，由宁波晟嘉网络科技有限公司维护，用于Ucloud旗下的短信发送业务。

#### 安装教程

使用 composer require singka/ucloud_sms:dev-master 命令行安装即可。

#### 使用说明


```
$conn = new UcloudApiClient(BASE_URL, PUBLIC_KEY, PRIVATE_KEY, PROJECT_ID);
$params['Action'] = "SendUSMSMessage";

//群发
$phones = array();
foreach($phones as $key => $val){
    $params["PhoneNumbers.".$key] = $val;
}

//单发
$params["PhoneNumbers.0"] = $phone;

$params["SigContent"] = '签名';

$params["TemplateId"] = ’短信模板ID‘;

//模板参数列表
$templates = array();
foreach($templates as $key => $val) {
    $params["TemplateParams.".$key] = $val;
}

$response = $conn->get("/", $params);
```
#### 其他说明
返回的相关错误码请查阅：https://docs.ucloud.cn/management_monitor/usms/error_code