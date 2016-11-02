### thinkphp5
### loader.php
- register注册
  - self::addNamespace([
            'think'    => LIB_PATH . 'think' . DS,
            'behavior' => LIB_PATH . 'behavior' . DS,
            'traits'   => LIB_PATH . 'traits' . DS,
        ]);添加命名空间
- addNamespace函数 
  - 调用self::addPsr4($prefix . '\\', rtrim($paths, DS), true);
- addPsr4($prefix, $paths, $prepend = false) 函数
  - self::$prefixLengthsPrs4[$prefix[0]][$prefix] = $lenght;
  - self::$prefixDirsPsr4[$prefix] = (array) $paths;
  
- autoload
  - findFile($class) 