<?php


            // $url= 'http://opencart.omniselling.net:8888/zhaibin/omnicart/upload/index.php?route=api/v2/order/add';
            $url= 'http://www.dsales.me/index.php?route=api/v2/order/release';
            $method='post';
            //$method='get';
            $secret='LumekoI5r7pVXY4c1IBMfsVu4JLQb5aT2mwwmEWElxJJR8Tz7pQxlrnU48sgHATVi1bhi1i2bNLQqb2KsNjRiXH51XtTV68ZET4XyUd0oxvnzc8d7CHauG2XiILaWfOivF7OrvbLBJAYXVh0P3qEfgCRckEjybbyLrjlttXthwMC2tYECrNH3GJaMPNJNHjY0dEXJJE7qTb2wy2aPfg1CDTkcdRaLEURhAdpvwpY42H7cfoAGtQjddKZGjK0aAh6';
            // $arr=array('key'=>'kuoZjSvnVyLlYbowIrrlbMnTUyu9ddkSVEV2wHQeWeuKiEkE40pmRCUjlsW4HAyqCKqkkCwNDvwaA6qyFtEV20a2yBzL9BIncObkxwFcxkDAAC8TeL1cpaINlW0ql9yHlBXKK3zuXmbpXtdiQAj2RNFBMzxBOYh0CtDDP3lftO4zdgZJbzbvXPIpkJKOxzrAjtSizpEDJlp8bINUj9xt69C6tagu9lre74AoIAAl4QOE2UlmmdBjUZBUKfduYX1k');
            /*$arr = array(
                'account_id' => 107,
                'shipping' => array(
                    'firstname' => 'bin',
                    'lastname'  => 'zhai',
                    'company'   => 'edayun',
                    'address_1' => 'shenzhen',
                    'address_2' => 'nanshanqu',
                    'city'      => 'shenzhen',
                    'postcode'  => '2000',
                    'country'   => 'china',
                    'method'    => 'shipping',
                    'code'      => 'USPS'
                ),
                'customer' => array(
                    'firstname' => 'binzhai',
                    'lastname'  => 'bin',
                    'email'     => 'wendellzhaibin@gmail.com',
                    'telephone' => '199887666',
                    'fax'       => '2928727'
                ),
                'products' => array(
                    array(
                        'sku' => 'GROB-TN360-BZ03',
                        'warehouse_code' => 'AW',
                        'quantity' => 10,
                        'booking_order_sn' => ''
                    )
                )
            );*/
            $arr = array('order_sn' => 'DO20160706082113NOP');

			$data_str=http_build_query($arr);
            $data=  base64_encode($data_str);         
            $sign=md5($secret.$data_str.$secret);
            $post_data=array('data'=>$data,'sign'=>$sign,'token'=>'ABbZiSuUvcb5dXmK4fEZhJ80bz6a9dxE');
          // $post_data=array('data'=>$data,'sign'=>$sign);

           curl($url,$post_data,$method);
          



     function curl($url,$post_data,$method='get') {
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       // $post_data['file'] = curl_file_create('C:\Users\Administrator\Desktop\177870405\177870401\20160504105910_60268.jpg', 'image/jpeg');
       // post数据
       if($method=='post'){
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_POST, 1);
           // post的变量           
           curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
           // curl_setopt($ch, CURLOPT_INFILESIZE,filesize('C:\Users\Administrator\Desktop\177870405\177870401\20160504105910_60268.jpg'));
       }else{
           curl_setopt($ch, CURLOPT_URL, $url. '&'. http_build_query($post_data));
       }
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
       curl_setopt ($ch, CURLOPT_HEADER, 0);
        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        print_r($output);
    }   

?>



