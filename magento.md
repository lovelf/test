###Mage magento调配中心
1. 分析mage
  - `static private $_registry` 注册容器
  - `static private $_appRoot` 应用注册路径
  - `static private $_app` Applicatiion model Mage_Core_Model_App
  - `static private $_config` Config Model Mage_Core_Model_Config
  -  `static private $_events` Event Collection Object Varien_Event_Collection
  -  `static private $_objects` Object cache instance Varien_Object_Cache
  -  `static private $_isDownloader = false` Is developer mode flag
  -   `static private $_isDeveloperMode = false` Is developer mode flag
  -   `public static $headersSentThrowsException = true` Is allow throw Exception about headers already sent
  -    `$_isInstalled` Is installed flag
  -    `const EDITION_COMMUNITY = 'Community'`
  -    `const EDITION_ENTERPRISE = 'Enterprise'`
  -    `const EDITION_PROFESSIONAL = 'Professional'`
  -    `const EDITION_GO = 'Go'`
  -    `static private $_currentEdition = self::EDITION_COMMUNITY`
  -    `public static function getVersion()`
  -    `public static function getVersionInfo()`
  -    `public static functin getEdition()`
  -    `public static function reset()` Set all my static data to defaults, $_registry, $_appRoot, $_app, $_config, $_events, $_objects, $_isDownloader, $_isDeveloperMode, $_isInstalled
  -    `public static function register($key, $value, $graceful = false)` 
  -    `public static function register($key)`
  -    `public static function unregister($key)`
  -    `public static function registry($key)`
  -    `public static function setRoot($appRoot = '')`
  -    `public static function getRoot()`
  -    `public static function getEvents()`
  -    `public static function objects($key = null)` 
  -    `public static function getBaseDir($type = 'base')`
  -    `public static throwException($message, $messageStorage)`
  -    `protected static function _setIsInstalled($options = array())` Set application isInstalled flag based on given options
  -    `protected static function _setConfigModel($options)` Set application Config model self::$_config = new Mage_Core_Model_Config($options);
  -    自动加载路径为 `app/code/local app/code/community app/code/core lib`
  -    加载`Mage/Core/functions.php` __autoload($class) uc_words($class) __()翻译 now() is_empty_date() mageFindClassFile() 
  -    加载`varien/Autoload.php` Varien_Autoload::register();
  -  `public static function getModel(){
          return self::getConfig()->getModelInstance($modelClass, $arguments);
       }` Retrieve model object
  
 

###Varien_Autoload
- Magento自动加载来自此文件
- `__construct` _isIncludePathDefined self::registerScope
-  `public static function instance()`
-  `staitc public function register()`
-  `static public function autoload()`
-  `static public function registerScope()`
-  `static public function getScope()`
-  `public function _destruct()`


###Varien_Profiler分析
- `static private $_timers = array();`
- `static private $_enabled = false;`
- `$_memory_get_usage = false;`
- `public static function enable();`
- `public static function disable();`
- `public static function reset($timerName);`
- `public static function resume($timerName);`
- `public static function stop()`
- `public static function start();`
- `public static function fetch();`
- `public static function getTimers();`
- `public static function getSqlProfiler($res);`

###Mage::run($mageRunCode, $mageRunType) 发起应用
- `Varien_Profiler::start('mage');`
-  `self::setRoot();`
-  `self::$_app = new Mage_Core_Model_App();`
-  `self::$_events = new Varien_Event_Collection();`
-  `self::_setIsInstalled($options);` 
-  `self::_setConfigModel($options):` => self::$_config = new Mage_Core_Config_Model();
-  `self::$_app->run();`

### Mage_Core_Model_App app应用
- Application model should have: areas, locale, translator, design package
- `const DEFAULT_ERROR_HANDLER = 'mageCoreErrorHandler';`
- `const DISTRO_LOCALE_CODE = 'en_Us';`
- `const CACHE_TAG = 'MAGE';`
- `DISTRO_STORE_ID = 1;`
- `DISTRO_STORE_CODE = 'default';`
- `ADMIN_STORE_ID = 0;`
- `protected $_areas = array();`
- `protected $_store;` Application store object  Mage_Core_Model_Store
- `protected $_website;` Application website object Mage_Core_Model_Website
- `protected $_translator;` Application translate object Mage_Core_Model_Translator
- `protect $_design;` Application design package object Mage_Core_Model_Design_Package
- `protect $_layout;` Application layout object Mage_Core_Model_Layout
- `protect $_config;` Application configuration object Mage_Core_Model_Config
- `protect $_frontController;` Application front controller Mage_Core_Controller_Varien_Front
- `protect $_cache;` Cache object Zend_Cache_Core
- `protected $_useCache;` Use Cache Array
- `protected $_websites = array();` Websites cache array
- `protected $_groups = array();` Groups cache array
- `protected $_stores = array();` Stores cache
- `protected $_isSingleStore;` is a single store mode
- `producted $_isSingleStoreAllowed = true;` 
- `protected $_currentStore;` Default store code
- `protected $_request;` Request object Zend_Controller_Request_Http
- `protected $_response;` Response object Zend_Controller_Response_Http
- `protected $_events = array();` Events cache array
- `protected $_updateMode = false;` Update process run flag
- `protected $_useSessionInurl = true;` Use session in URL flag Mage_Core_Model_Url
- `protected $_useSessionVar = false;` Use session var instead of SID for session in url
- `protected $_isCacheLocked = null;` Cache Locked flag
- `public function __construct() ` Controctor
- `public function run($params){
      $options = isset($params['options']) ? $params['options'] : array();
      $this->baseInit($options);
   }`
- `public function baseInit($options){
      $this->_initEnvironment();
      
      $this->_config = Mage::getConfig();
      $this->_config->setOptions($options);

      $this->_initBaseConfig();
      $this->_initCache($cacheInitOptions);
   }`

- `protected function _initEnviroment(){
      $this->setErrorHandler(self::DEFAULT_ERROR_HANDLER);
      date_default_timezone_set(Mage_Core_Model_Locale::DEFAULT_ZONE);
      return $this;
   }`

- `protected function _initBaseConfig(){
      $this->_config->loadBase();// Load base systme configuration (config.xml and local.xml files)
   }`

- `protected function _initCache(array $cacheInitOptions){
      $this->_isCacheLocked = true;
      $options = $this->_config->getNode('global/cache');
      if ($options) {
          $options = $options->asArray();
      } else {
         $options = array();
      }
      $options = array_merge($options,$cacheInitOptions);
      $this_cache = Mage::getModel('core/cache', $options);
      $this->_isCacheLocked = false;
      return $this;
  }`

###Varien_Event_Collection
- Collection of events
- `protected $_events;` Array of events in the collection;@var array
- `protected $_observers;` Global observers , For example regex observers will match all events that ,@var Varien_Event_Observer_Collection
- `public function __construct();` Initializes global observers collection。 `$this->_events = array();`and `$this->_globalObservers = new Varien_Event_Observer_Collection();`
- `public function getAllEvents()` Return all registered events in collection
- `public function getGlobalObservers()` Returns all registered global observers for the collection of events @return Varien_Event_Observer_Collection
- `public function getEventByName($eventName)` Returns event by its name. If event doesn't exist creates new one and returns it.
- `public function addEvent(Varien_Event $event)` Register an event for this collection @return Varien_Event_Collection
- `public function addObserver(Varien_Event_Observer $observer)` Register an observer
- `public function dispatch($eventName, array $data=array())`

###Varien_Event_Observer_Collection
- `protected $_observers;` Arrray of observers @var aray
- `public function __construct()` Initializes observers
- `public function getAllObservers()` Returns all observers in the collection
- `public function getObserverByName($observerName)`
- `public function addObserver(Varien_Event_Observer $observer)` Adds an observer to the collection
-  `public function removeObserverByName($observerName)`
-  `public function dispatch(Varien_Event $event)`  Dispatches an event to all observers in the collection

###Varien_Event_Observer
- `extends Varien_Object`
- `public function isValidFor(Varien_Event $event)`
- `public function dispatch(Varien_Event $event)` Dispatches an event to observer's callback
- `public function getName()` 
- `public function setName()`
- `public function getEventName()`
- `public function setEventName()`
- `public function getCallback()`
- `public function setCallback()`
- `public function getEvent()`
- `public function setEvent()`

###Varien_Event
- `extends Varien_Object`
- `public function __construct(array $data=array())`
- `public function getObservers()` Returns all the registered observers for the event @Varien_Event_Observer_Collection
- `public function addObserver(Varien_Event_Observer $observer)` 
- `public function removeObserverByName($observerName)`
- `public function dipatch()`
- `public function getName()`
- `public function setName()`
- `public function getBlock('block')`

###Varien_Object
- `protected $_data = array();` Object attributes @var array
- `protected $_hasDataChanges = false;` Data changes flag(true after setData|unsetData call)
- `protected $_origData;` Original data that was loaded @var array
- `protected static $_underscoreCache = array();` Setter/Getter underscore transformation cache
- `protected $_isDeleted = false;` Object delete flag @var boolean
- `protected $_oldFieldsMap = array();` Map short fields names to its full names @var array
- `protected $_syncFieldsMap = array();` Map of fields to sync to other fields upon changing their data
- `public function __construct()`


-----

###Mage_Core_Config_Model
- extend Mage_Core_Config_Model_Base
- `const CACHE_TAG = 'CONFIG';`
- `protected $_useCache = false;` Flag which allow use cache logic @var bool
- `protected $_cacheSections = array(
       'admin' => 0,
       'adminhtml' => 0,
       'crontab' => 0,
       'install' => 0,
       'stores' => 1,
       'websites' => 0
   );` 
- `protected $_cacheLoadedSections =array();` Loaded Configuration by cached sections
- `protected $_options;` Configuration options @var Mage_Core_Model_Config_Options
- `protected $_classNameCache = array();` Storage for generated class names @var array
- `protected $_blockClassNameCache = array();` Storage for generated block class names
- `protected $_secureUrlCache = array();` Storage of validate secure urls @var array
- `protected $_distroServerVars;` System environment server variables @var array
- `protected $_substServerVars;`  Array which is using for replace placeholders of server variables @var array
- `protected $_resourceModel;` Resource model Used for operations with DB @var Mage_Core_Model_Mysql4_Config
- `protected $_eventAreas;` Configuration for events by area @var array
- `protected $_dirExists = array();` Flag cache for existing or already created directory @var array
- `protected $_allowCacheForInit = true;` Flach wich allow using cache for config initialization @var bool
-  `protected $_cachePartsForSave = array();`  Property used during cache save process @var array
-  `protected $_prototype;` Empty configuration object for loading and megring configuration parts @var Mage_Core_Model_Config_Base
-  `$_isLocalConfigLoaded = false;` Flag which indentify what local configuration is loaded @var bool
-  `protected $_canUseLocalModules = null;` Flag which allow to use modules from local code pool @var bool
-  `private $_moduleNamespaces = null;` Active modules array per namespace @var array
-  `producted $_allowedModules = array();` Modules allowed to load. If empty - all modules are allowed. @var array
-  `publlic function __construct($sourceData=null){
       $this->setCacheId('config_global');
       $this->_options = new Mage_Core_Model_Config_Options($sourceData);
       $this->_prototype = new Mage_Core_Model_Config_Base();
       parent::__construct($sourceData);
    }`
- `public function loadBase(){
    $etcDir = $this->getOptions()->getEtcDir();
    $files = glob($etcDir.DS.'*.xml');
    $this->loadFile(current($files));
    下面是extend
  }`

- `public function getOptions(){
       return $this->_options; 
  }` Get configuration options object @return Mage_Core_Model_Config_Options
- `public funcction getModelInstance($modelClass, $options){
      $className = $this->getModelInstance($modelClass);
      
      $obj = new $className($arguments);
      
      return $obj;
  }`

- `public function getModelClassName($modelClass){
       $modelClass = trim($modelClass);
       if (strpos($modelClass, '/') === false) {
            return $modelClass;
       }
       return $this->getGroupedClassName('model', $modelClass);
  }` Retrieve module class name

- `public function getGroupedClassName($groupType, $classId, $groupRootNode){
      if (empty($groupRootNode)) {
          $groupRootNode = 'global/'.$groupType.'s';
      }
      
      $classArr = explode('/', trim($classId));
      $group = $classArr[0];
      $class = !empty($classArr[1]) ? $classArr[1] :null;

      if (isset($this->_classNameCache[$groupRootNode][$group][$class]) {
          return $this->_classNameCache[$groupRootNode][$group][$class];
      }
       
      $config = $this->_xml->global->{$groupType.'s'}->{$group};

      // First - check maybe the entity class was rewirtten
      $className = null;
      if (isset($config->rewrite->$class)) {
          $className = (string)$config->rewrite->$class;
      } else {
          if (isset($config->deprecatedNode)) {
              $deprecatedNode = $config->deprecatedNode;
              $configOld = $this->_xml->global->{$groupType.'s'}->$deprecatedNode;
         if (isset($configOld->rewrite->$class)){
             $className = (string) $configOld->rewrite->$class;
         }

         if (empty($className)) {
             if (!empty($config)) {
                 $className = $config->getClassName();
             }
             if (empty($className)) {
                 $className = 'Mage_'.$group.'_'.$groupType;    
             }
             if (!empty($class)) {
                 $className .= '_'.$class;
             }
             $className = uc_words($className);
         }
         
         $this->_classNameCache[$groupRootNode][$group][$class] = $className;
         return $className;
      }
  }`


###<span>Mage_Core_Model_Config_Base</span>
- extend Varien_Simplexml_Config
- `public function __construct($sourceData){
      $this->_elementClass = 'Mage_Core_Model_Config_Element';
      parent::__construct($sourceData);
   }`



###Varien_Simplexml_Config
- Base class for simplexml based configurations
- `protected $_xml = null;` Configuration xml @var Varien_Simplexml_Element
- `protected $_cacheId = null;` Enter description here..@var string
- `protected $_cacheTags = array();` Enter description here... @var array
- `protected $_cacheLifetime = null;` @var int
- `protected $_cacheChecksum = false;`
- `protected $_cacheSaved = false;`
- `protected $_cache = null;` Cache resource object @var Varien_simplexml_Config_Cache_Abstract
- `protected $_elementClass = 'Varien_Simplexml_Element';` Class name of simplexml elements for this configuration @var string
- `protected $_xpathExtends = "//*[extends]";` xpath describing nodes in configuration that need to be extend @example <allResources extends="/config/modules//resource" />
- `public function __construct($sourceData)`
- `public function setCacheId($id){
       $this->_cacheId = $id;
       return $this;
   }`

- `public function loadFile($filePath){
    if (!is_readable($filePath)){
        return false;
    }
    $fileData = file_get_contents($filePath);
    $fileData = $this->processFileData($fileData);
    return $this->loadString($fileData, $this->_elementClass);
  }`

- `public function processFileData($text) {
      return $text;
  }`

- `public function loadString($text) {
      $xml = simplexml_load_sting($string, $this->_elementClass);
      $this->_xml = $xml;
   }`

- `public function extend(Varien_Simplexml_Config $config, $overwrite = true){
     $thsi->getNode->extend($config->getNode(), $overwrite);
  }`
- `public function getNode($path=null){
     if (!this->_xml instanceof Varien_Simplexml_Element){
          return false;
     }else if ($path === null) {
         return $this->_xml;
     }else {
       return $this->_xml->descend($path);
     }
  }`  

###Mage_Core_Model_Config_Options
- Configuration options storage and logic
- extends Varien_Object
- `const VAR_DIRECTORY ='var';` Var directory @var string
- `protected $_dirExists = array();` Flag cache for existing or already created directories @var array
- `protected function _construct(){}`

###Mage_Core_Model_Config_Element
- extends Varien_Simplexml_Element


###Varien_Simplexml_Element
- extends SimpleXMLElement
- `public function extend($source, $overwrite=false){
      if (!$source instanceof Varien_Simplexml_Element){
          return $this;
      }
      
      foreach($source->children() as $child) {
           $this->extendChild($child, $overwrite);
      }
  }`

- `public function extendChild($source) {
       $targetChild = null;
       $sourceName = $source->getName();

   }` 
   首先判断是否有子节点， 有则现在拓展的是否存在， 不存在则生成一个targetChild 为这个设置父节点和属性， 则再用sourceChild遍历到此targetChild上去
   若不存在子节点，则继承的对象上也存在这个节点名称，有子节点则返回， 重写则删除，不重写则返回结束。 再创建这个节点并赋值，设立父节点，设置属性。

- `public function addChild($sourceName, $content){}`

**配置分析**

- 从Mage_Core_Model_Config开始Mage_Core_Model_Config_Base-   Varien_Simplexml_Config 其中牵扯到了 Mage_Core_Model_Config_Option继承至Varien_Object
- xml 来自Mage_Core_Model_Config_Element --> Varien_Simplexml_Element 实际储存数据的对象
- Mage_Core_Model_Config 实际是管理Config Mage_Core_Model_Config_Element储存数据

**Mage_Core_Model_Cache
- `protected $_idPrefix = '';` Id prefix @var string
- `protected $_frontend;` Cache frontend API @var Varien_Cache_Core
- `