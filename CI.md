### system/core/CodeIgniter.php

进入system/core/Common.php
- 加载application/config/constants.php
- 加载system/core/Common.php 通用函数
- 
&load_class 加载类或者extension， static $_classes;
is_loaded 验证是否已经加载 static $_is_loaded;
get_config loads the main config.php file

Instantiate the hooks class
Hooks.php 钩子函数
- 初始化钩子函数
- https://codeigniter.com/user_guide/general/hooks.html
- config/hooks.php 钩子模块配置 $hooks['pre_system'][]=array('object', 'method', 'filename', 'filepath', 'params');
- _run_hook is_cacllable 闭包


CI_config.php
初始化config函数
$this->config = & get_config();


### index.php
- 定义$system_path, $application_folder, $view_folder,
- 定义常量 SELF, BASEPATH, FCPATCH, SYSDIR, APPPATH, VIEWPATH， 

### system/core/Common.php
- is_php
- config_item 获取 get_config的字段
- get_config paras=> arrayl replace or added fields （Loads the main config.php file）



### php error
- PHP 错误处理 默认发到浏览器（能否显示及显示error_level级别关系到display_erors, error_reporting)  这条消息带有文件名(filename)、行号(line)及一条描述的错误信息(error_message)
- error_function(error_level, error_message, error_file, error_line, error_context) 


值 | 常量 | 描述
-- | -- | --
2 10 | E_WARNING | 非致命的run-time错误。不暂停脚本执行。
8 1000 | E_NOTICE  | Run-time通知。脚本发现可能有错误发生，但也可能在脚本正常运行时发生。

nesting level 嵌套级别
NO trailing slash 不包含尾部斜线
multi-dimensional 多维度

http://www.cnblogs.com/hust-ghtao/p/4724885.html URL和URI的区别
学习 .htaccess语法

### URI.php
- 初始化
- $_SERVER理解

名字 | 路径1 | 路径2
---| ---| ---
HTP_HOST | www.componser.me | www.composer.me
SERVER_NAME | www.composer.me | www.componser.me
REQUEST_URI | /index.php/pages/index
SCRIPT_NAME | /index.php
PATH_INFO | /pages/index
PHP_SELF | /index.php/pages/index

parse_url
http://blog.csdn.net/qq_35440678/article/details/51778935 CI