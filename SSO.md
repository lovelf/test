###client
- `__construct()`函数； $this->_server['version'], ['hostname'], ['port'],['uri']; 处理ticket， ticket以SPT开头$this->setTicket($ticket); 初始化
- `forceAuthentication()` 发起点 先判断是否认证，没有认证则跳转到登陆
- `function isAuthenticated()` , _wasPreviouslyAuthenticated,若没登录则validateCAS20();
- `redirectToCas(false)` 直接跳转到登陆界面/login/
- `function getServerLoginURL()` 获取URL
- `function _wasPrieviouslyAuthenticated()` 判读先前是否已登陆
- `isSessionAuthenticated(){
       return !empty($this->session->data['user']); //验证是否存在的核心。。
   }` 
- `validateCAS20()` 

     // api代码
     
        $url = 'http://183.57.41.211/coreservice/account/getaccountbyloginid';
        $method ='post';        
        $arr = array(
               'operatorId' => -99999,
               'loginId' => 'aaaaa',
               'language' => 'en-us',
               'data' => 'admin',
               'asyncRequest'=> false
        );
        $arr = json_encode($arr);      
        curl($url,$arr,$method);`
       
        function curl($url,$post_data,$method='get') 
        {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
       
        // post数据
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
           // post的变量           
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Charset:UTF-8'));
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        print_r($output);
        }


    {"errors":null,"data":{"id":107,"loginId":"admin","accountName":"Admin","nonceToken":null,"parentId":null,"accountType":"MAIN","password":null,"accountStatus":"ACTIVE","accountStatusLabel":"active","email":null,"mobileNumber":null,"phoneNumber":null,"contactNumber":null,"faxNumber":null,"qqId":null,"siteLink":null,"webchatId":null,"bizAccountRoles":[{"id":3,"roleName":"warehouse","roleLabel":"warehouse","roleStatus":"ACTIVE","roleStatusLabel":"Enable","roleDescription":"仓库"},{"id":4,"roleName":"operations","roleLabel":"operations","roleStatus":"ACTIVE","roleStatusLabel":"Enable","roleDescription":"运营"},{"id":2,"roleName":"seller","roleLabel":"seller","roleStatus":"ACTIVE","roleStatusLabel":"Enable","roleDescription":"卖家"},{"id":5,"roleName":"customerservice","roleLabel":"customer service","roleStatus":"ACTIVE","roleStatusLabel":"Enable","roleDescription":"客服"},{"id":1,"roleName":"admin","roleLabel":"admin","roleStatus":"ACTIVE","roleStatusLabel":"Enable","roleDescription":"系统管理员"},{"id":6,"roleName":"testRole","roleLabel":"","roleStatus":"ACTIVE","roleStatusLabel":"Enable","roleDescription":"添加描述"},{"id":7,"roleName":"test_role","roleLabel":"","roleStatus":"DISABLE","roleStatusLabel":"disabled","roleDescription":null},{"id":25,"roleName":"test","roleLabel":"","roleStatus":"DISABLE","roleStatusLabel":"disabled","roleDescription":"只是测试一下"}],"accountSysConfig":null},"nonceToken":null,"errorsToString":""}

字段|描述
---|---
id:107| id
"loginId":"admin"|登陆名
"accountName":"Admin"|账号名
"nonceToken":null|noceToken
"parentId":null|父Id
"accountType":"MAIN"|账号类型
“accountStatus":"ACTIVE"|ACTIVE
"email":null| email
"mobileNumber":null|
bizaAccountRoles|


### [Cookie/Session机制详解](http://blog.csdn.net/fangaoxin/article/details/6952954)

- session_id 获取/设置当前会话ID。 session_id() 返回当前会话ID。 如果当前没有会话，则返回空字符串（""）。
- session_name 获取/设置当前会话名称。请求开始的时候，会话名称会被重置并且存储到 session.name 配置项。 因此，要想设置会话名称，那么对于每个请求，都需要在 调用 session_start() 或者 session_register() 函数 之前调用 session_name() 函数。


### 扣费接口对接
- 接口调用方式 HTTP POST
- 接口说明 收费接口
- 访问路径 http://{hostname[ip]:port}/omnibilling/billing/charge
- 参数

  参数  |  类型  | 是否必填 | 说明
  ----- | -----|---|-----
  operatorId | int | 是 | 操作者Id
  language   | varchar|是|操作语言code， 'en'
  loginId   | varchar | 是|操作人登陆账号
  asyncRequest|bool|否|是否异步请求
  data        | array | 是 | 提交内容
      billingItem|    | 是 | 计费项
          billingItemCode|varchar|是|计费项代码
      billingObject| |是 | 计费对象
      billingObjectCode||是|计费对象代码
      billingParamString||是扣费参数json格式
      billingPoint|||计费点
      billingPointCode|字符|是|计费点代码
      binessNum|varchar|是|业务订单号
      targetObjectId|数字|是|计费目标 分销预订单的id
      accountId|int|是|账户Id 扣费账户的Id（主账号）
      resourceId|int|是|资源Id (使用收款的账号Id)

resourceId 描述资源用的，我们这边的计费的话，是以资源为载体进行计费的，提供资源的可以收钱，使用资源的扣钱。
### 产品字段

参数名|类型|是否必填|说明
---|---|---|---
price|decimal|是|产品单价
proAmount|int|是|产品单价
discount|decimal|是|扣费比例（全额100%）取值是0.1(代表10%）
sku|varchar|是|分销预定产品sku
currencyCode |字符|否|币种（默认美元）

### warehouseAddress
---| --- | ---| ---
zipcode | 字符|是|邮编
province|字符|否|省份
country|字符|是|国家
city|字符|否|城市
street|字符|否|街道

JSON实例

    {
        "accountId":111
        ,"bussinessNum":"OSO1000100"
        ,"resourceId":113
        ,"targetObjectId":111
        ,"billingItem":{
            "billingItemCode":"distribution"
        }
        ,"billingObject":{
            "billingObjectCode":"distributionOrder"
        }
        ,"billingParamString":{
            "products":[{}]
        }
    }


调试程序

    <?php
    $url= 'http://183.57.41.211/omnibilling/billing/charge';
    $method='post';
    $params = array(
        'products' => array(
            array(
                'price' => 20,
                'proAmount' => 10,
                'discount' => 1,
                'sku' => 'GROH-CB541A-BZ01',
                'warehouseAddress' =>'city-001'
            )
        ),
        'currencyCode' => 'USD',
        'mallAccountId' => 110
    );
    
    $paramString = json_encode($params);
    
    $data = array(
        'billingItem' => array(
            'billingItemCode' => 'distribution'
        ),
        'billingObject' => array(
            'billingObjectCode' => 'distributionOrder'
        ),
        'binessNum' => 'BO20160513115856HIJ',
        'targetObjectId' => 25,
        'accountId' => 107,
        'resourceId' => 110,
        'billingParamString' => $paramString
    );
    
    // $data = json_encode($data);
    
    $arr = array(
        'nonceToken'=> time(),
        'operatorId' => 107,
        'loginId' => 'admin',
        'language' => 'zh-cn',
        'data' => $data,
        'asyncRequest'=> false
    );
    
    $arr = json_encode($arr);  
    // print_r($arr);exit;
    curl($url,$arr,$method);
          
    function curl($url,$post_data,$method='get') {
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       
       // post数据
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
           // post的变量           
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt ($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Charset:UTF-8'));
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        print_r($output);
    }
    ?>
