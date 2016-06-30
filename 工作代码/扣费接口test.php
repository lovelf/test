<?php
    $url= 'http://183.57.41.211/omnibilling/billing/charge';
    $method='post';

    $params = array(
        'products' => array(
            array(
                'price' => 20,
                'proAmount' => 10,
                'discount' => 100,
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



