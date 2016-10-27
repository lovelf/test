### system/core/CodeIgniter.php

进入system/core/Common.php
&load_class 加载类或者extension， static $_classes;
is_loaded 验证是否已经加载 static $_is_loaded;
get_config loads the main config.php file
Hooks.php 钩子函数
初始化钩子函数


CI_config.php
初始化config函数
$this->config = & get_config();