# Ucloud短信平台

#### 介绍
本项目是基于Ucloud短信PHPSDK二次开发的，支持ThinkPHP5.0、ThinkPHP5.1和ThinkPHP6.0，由宁波晟嘉网络科技有限公司维护，用于Ucloud旗下的短信发送业务。

#### 安装教程

使用 composer require singka/ucloud_sms:dev-master 命令行安装即可。

#### 使用说明



> use Singka\UcloudSms\UcloudApiClient;
> $conn = new UcloudApiClient(BASE_URL, PUBLIC_KEY, PRIVATE_KEY, PROJECT_ID);
> $params['Action'] = "SendUSMSMessage";
> 
> //手机号码列表
> $phones = explode("|", $argv[1]);
> foreach($phones as $key => $val){
>     $params["PhoneNumbers.".$key] = $val;
> }
> 
> //申请的签名
> $params["SigContent"] = $argv[2];
> 
> //申请的模板ID
> $params["TemplateId"] = $argv[3];
> 
> //模板参数列表
> $templates = explode("|", $argv[4]);
> foreach($templates as $key => $val) {
>     $params["TemplateParams.".$key] = $val;
> }
> 
> print_r($response = $conn->get("/", $params));