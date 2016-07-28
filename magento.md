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
  -    `public static function getBaseDir($type = 'base'){
            return $this->config->getOptions->getDir($type);  
       }`
  -    `public static throwException($message, $messageStorage)`
  -    `protected static function _setIsInstalled($options = array())` Set application isInstalled flag based on given options
  -    `protected static function _setConfigModel($options)` Set application Config model self::$_config = new Mage_Core_Model_Config($options);
  -    自动加载路径为 `app/code/local app/code/community app/code/core lib`
  -    加载`Mage/Core/functions.php` __autoload($class) uc_words($class) __()翻译 now() is_empty_date() mageFindClassFile() 
  -    加载`varien/Autoload.php` Varien_Autoload::register();
  -  `public static function getModel(){
          return self::getConfig()->getModelInstance($modelClass, $arguments);
       }` Retrieve model object
  - `public static function isInstalled($option){
        @return bool
     }`
- `function getResourceModel($string){
     return self::getConfig()->getResourceModelInstance($modelClass, $argument);
   }`
 

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
      
      if ($this->_cache->processRequest()) {
          $this->getResponse()->sendResponse();
      } else {
          $this->_initModules();
      }
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
      $this_cache = Mage::getModel('core/cache', $options); // Frontend API
      $this->_isCacheLocked = false;
      return $this;
  }`

- `private function _initModules(){
     $this->_config->loadModules();
     $this->_config->loadDb();
     
  }`
- `function useCache($string) {
     return $this->_cache->canUse($type); // Varien_Core_Cache
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

- `public function loadModulesCache(){
      if (Mage::isInstalled(array('etc_dir' => $this->getOptions->getEtcDir())) {
          $loaded = $this->loadCache();
      }
  }`
- `private function _canUseCacheForInit() {
     return Mage::app()->useCache('config')&& $this->_allowCacheForInit && !this->_loadCache($this->_getCacheLockId()); 
   }`
- `public function loadCache(){}`

- `public function loadModules(){
       $this->_loadDeclaredModules();
       
       $resourceConfig = 'config.mysql4.xml';
       $this->loadModulesConfiguration(array('config.xml','config.mysql4.xml')), $this); 
   }` // Load modules configuration
- `protected function _loadDecaredModules(){
      $moduleFiles = $this->_getDeclaredModuleFiles();
      
  }` // Load declared modules configuration

- `protected function _getDeclaredModuleFiles(){
       // 获取etc/modules/*.xml文件 分成base,mage,custom
  }`

- `protected _isAllowedModule($string){

   }`
- `protected function _getResourceConnectionModel($string)`
- `public function getResourceConnectionConfig('Core_setup')`
- `pulbic function getResourceConfig($name)` 
- `public function loadModulesConfiguration()`
- `function _canUseLocalModules()' //是否允许加载local模块
- `function getModuleDir()` 模块目录
- `function getModuleConfig()` //模块配置xml对象
- `function get`
- `public function applyExtends()`
- `public function loadDb(){
      $dbConf = $this->getResourceModel();
      $dbConf->loadToXml($this);
   }`
- `public function getResourceModel(){
     $this->_resourceModel = Mage::getResourceModel('core/config');
   }`
- `public function getResourceModelInstance($modelClass,$arugment){
    $factoryName = $this->_getResourceModelFactoryClassName($modelClass);
    return $this->getModelInstance($factoryName, $argument);
  }`
- `protected function _getResourceModelFactoryClassName(){
       $classArray = explode('/', $modelClass);
   }` // Get factory class name for a resource
- `public function getModelInstance($factoryName, $construargument){
    $obj = new Mage_Core_Resource_Model_Config();
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
- `public function getDir($type)`
- `public function 

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

- `public function __construct(array $options = array()){
      $this_defaultBackendOptions['cache_dir'] = isset($options['cache_dir']) $options['cache_dir'] : Mage::getBaseDir('cache');
      // Initialize id prefix
      
      $this->_idPrefix = substr(md5(Mage::getConfig()->getOptions()->getEtcDir()), 0, 3).'_';
      
      $backend = $this->_getBackendOptions($options);
      $frontend = $this->_getFrontendOptions($options);
      $this->_frontend = Zend_Cache::factory('Varien_Core_Cache', $backend['type'], $frontend, $backend['options'], true, true, true);
   }`
- `protected function _getBackendOptions(array $cacheOptions) {
    $enable2levels = false;
    $type = 'file';
    $options = array();
    
    $backendType = false;
    
    return array('type'=> $type, 'options' => $options);
  }`

- `protected function _getFrontendOptions(array) {
       return $options;
   }`

###Zend_Cache
- abstract class Zend_Cache
- `public static factory()`; 全部为factory服务
- `public function _makeBackend($backend, $backOptions, true, ture, true){
     $backendClass = 'Zend_Cache_Backend_file';
     
     return new $backendClass($backendOptions);
  }` Backend Constructor

- `public function _makeFrontend(){
      return new Varien_Cache_Core($options);
   }`  // Frontend Constructor

###Zend_Cache_Backend_file
- extends Zend_Cache_Backend
- implement Zend_Cache_Backend_ExtendInterface
- __construct options参数来自Mage_Cache_Model_Core

###Zend_Cache_Backend
- `public function __construct(array $options = array()){
       while(list($name, $value) = each($options)) {
          $this->setOption($name, $value);
       }
   }`

###Varien_Cache_Core
- extends Zend_Cache_Core
- 

###Zend_Cache_Core






### 问题
- 出现在app->_initModules();

### Mage_Core_Model_Resource_Config

    extends Mage_Core_Model_Resource_Db_Abstract
    // 初始函数
    protected function _construct() {
        $this->_init('core/config_data', 'config_id');
    }


### Mage_Core_Model_Resource_Db_Abstract
    extends Mage_Core_Model_Resource_Abstract
    
    public function _init() {
    
    }

### Mage_Core_Model_Resource_Abstract

属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
public protected  | __construct |null  | $this->_construct();| Main contructor
static protected | $_commitCallBack | null  array() | 提交事务回调函数
abstract protected function | _construct | null |null  | Resource initalisation
abstract protected function | _getReadAdapter |null | null | Retrieve connection for read data
abstract protected function | _getWriteAdapter | null |null  | Retrieve connection for write data
public function | beginTransaction |null  | null | Start resource transaction
public function | addCommitCallBack | $callback |null | Subscribe some callback to transaction commit
public function | commit | null | null | commit resource transaction
public function | rollBack | null | null | rollback resource transaction
public function | formatDate | $date, $includeTime| null | format date to internal format
public function | mktime |$date | null | Convert internal date to UNIX timestamp
protected function | _serializeField | null | null | null
protected function | _unserializeField | null | null | null
protected function | _prepareDataForTable | $object , $table | null |  Prepare data for passed table
protected function | _prepareTableValueForSave | $value, $type | null | Prepare value for save

### Mage_Core_Model_Resource_Db_Abstract
属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
protected | $_resources | null | @var Mage_Core_Model_Resource | Cached resources singleton
protected | $_resourcePrefix | null | @var string | Prefix for resources that will be used in this resource  Model
protected | $_connections | array(); | @var array | Connections cache for this resource model
protected | $_resourceModel | null | @var string | Resource model name that contains entities (names of tables)
protected | $_tables | array() | @var array() | Tables in the resource model
protected | $_mainTable | null | @var string  | Main Table name
protected | $_idFieldName | null |@var string | Main table primary key field name
protected | $_isPkAutoIncrement | true | @var bool | primary key auto increment flag
protected | $_useIsObjectNew | false | @var bool | Use is object new method for save of object
protected | $_fieldsForUpdate | null | @var array | Fields List for update in forsedSave
protected | $_mainTableFields | null | @var array | Fields of main table
protected | $_uniqueField | null | @var array | null
protected | $_serializableFields | null | @var array | null
protected function | _init | $mainTable, $idFieldName | @var string | Standard resource model initialization
protected function | _setResource | $connections, $tables=null | null | Initialize connections and tables
protected function | _setMainTable | $mainTable, $idFieldName = null | @var string | set main entity table name and primary key field name If field name is ommited {table_name}_id will be used
public function | getIdFieldName | null | @return string | get primary key field name
public function | getMainTable | null | @return string | Returns main table name - extracted from "module/table" style and validate by db adapter
public function | getTable | $entityName | @param string | get table name for the entity,validated by db adapter
public function | getValueTable | $entityName, $valueType | @param string , @param string | Retrieve table name for the entity separated value
protected function | _getConnection | @param string $connection | Get connection by name or type
protected function | _getReadAdapter | null | @varien_Db_Apdater_Interface | Retrieve connection for read data 
protected function | _getWriteAdpater | null | @return Varien_Db_Adapter_Interface | Retrieve connection for write data
public function | getReadConnection | null | @return Varien_Db_Adapter_Interface | Temporary resolving collection compatibility
public function | load| Mage_Core_Model_Abstract $object , $value, $field | null | load an object
public function | _getLoadSelect | $field, $value $object |Retrieve select object for load object data
public function | save | Mage_Core_Model_Abstract $object | null | save object object data
public function | forsedSave | Mage_Core_Model_Abstract $object | Forsed save object data 
public function | delete | Mage_Core_Model_Abstract $object | delete the object
public function | addUniqueField | $field | @return Mage_Core_Model_Resource_Db_Abstract | Add unique field restriction
public function | resetUniqueField | null | @return Mage_Core_Model_Resource_Db_Abstract | Reset unique fields restrictions
pubic function | unserializeFields | Mage_Core_Model_Abstract $object | Unserialize serializeable object fields 
public function | _initUniqueFields | null | @return Mage_Core_Model_Resource_Db_Abstract | Initialize unique fields
public function | getUniqueFields | null | @return array | Get configuration of all unique fields
protected function | _prepareDataForSave | Mage_Core_Model_Abstract $object | prepare data for save
public function | hasDataChanged | $object | check that model data fields that can be saved has changed comparing with origData
protected function | _prepareValueForSave | $value, $type | prepare value for save 
protected function | _checkUnique | Mage_Core_Model_Abstract $object | check for unique values existence
public function | afterLoad | Mage_Core_Model_Abstract $object | After load
protected function | _afterload | Mage_Core_Model_Abstract | perform actions after object load
protected function | _beforeSave | Mage_Core_Model_Abstract $object | perform action before object save
protected function | _afterSave | Mage_Core_Model_Abstract $object | @param Varien_Object $object | Perform actions after object save
protected function | _beforeDelete | Mage_Core_Model_Abstract $object | Perform actions before object delete
protected function|  _afterDelete | Mage_Core_Model_Abstract | Perform actions after object delete
protected function | _serializeFields | Mage_Core_Model_Abstract $object | Serialize serializeable fields of the object
public function | getChecksum | $table | null | Retrieve table name

### Mage_Core_Model_Resource_Config
属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
extends | Mage_Core_Model_Resource_Db_Abstract | null | null | null
protected function | _construct | null | null | Define main table
public function | loadToXml | Mage_Core_Model_Config $xmlConfig, condition=null | Load configuration values into xml config object 
public function | saveConfig | $path,$value,$scope, $scopeId | null | save config value
public function | deleteConfig | $path, $scope, $scopeId | null | delete config value

### Mage_Core_Model_Resource_Config
- 执行函数
- __construct->_construct->_init('core/config_data', 'config_id')->_setMainTable('core/config_data', 'config_id')
- 设置mainTable $this->_setResource('core');
- $this->_setMainTable('config_data', 'config_id');
    - _setResource('core') $this->_resources = new Mage_Core_Model_Resource(), $this->_resourcePrefix = 'core', $this->_resourceModel = 'core';
    - $this->_mainTable = 'config_data';
    - $this->_idFieldName = 'config_id';
    - new Mage_Core_Model_Resource();

### Mage
属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
public static function | getSingleton | $modelClass, $arguments | @string, @array, @return Mage_Core_Abstract | Retrieve model object singleton 
public static function | getModel | $modelClass, $argument | Retrieve model object
public static function | getResourceSingleton | $modelClass, $arguments | @string，@array | null | Retrieve resource model object singleton
public function | getResourceModel | null | null | 
```php
// 获取model单例对象
public static function getSingleton($modelClass = '', array arguments = array()) {
   $registryKey = '_singleton/'.$modelClass;
   if (!self::registry($registrykey)) {
       self::register($registryKey, self::getModel($modelClass, $arguments));
   }
   return self::registry($registryKey);
}

```

```php
// 获取model对象--> core
public static function getModel($modelClass, $arguments) {
    return self::getConfig()->getModelInstance($modelCalss, $argument);
}
```

### Mage_Core_Model_Config
属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
public function | getModelInstance | $modelClass, $object | @return Mage_Core_Model_Abstract 或false | Get model class instance
public function | getModelClassName | $modelClass | @string | Retrieve module class name
public function | getGroupedClassName | $groupType, $classId, $groupRootNode=null | $groupType->model, block,helper | Retrieve class name by class group


```php
// 获取model类实例 -->core
public function getModelInstance($modelClass, $constructArguments) {
    $className = $this->getModelClassName($modelClass);
    if (class_exists($className)) {
        Varien_Profiler::start('CORE::create_object_of::'.$className);
        $obj = new $className($constructArguments);
        Varien_Profiler::stop('CORE::create_object_of::'.$className);
        return $obj;
    } else {
        return false;
    }
}
```

```php
// 获取类名
public function getModelClassName($modelClass) {
    $modelClass = trim($modelClass);
    if (strpos($modelClass, '/')===false) {
        return $modelClass;
    }
    return $this->getGroupedClassName('model', $modelClass);
}
```

```php
// 获取类名/类组
public function getGroupedClassName($groupType, $classId, $groupRootNode=null) {
   if (empty($groupTootNode)) {
       $groupRootNode = 'global/'.$groupType.'s';
   }

    $classArr = explode('/', trim($classId));
    $group = $classArr[0];
    $class = !empty($classArr[1]) ? $classArr[1] : null;

    if (isset($this->_classNameCache[$groupRootNode][$group][$class]) {
        return $this->_classNameCache[$groupRootNode][$group][$class];
    }

    $config = $this->_xml->global->{$group.'s'}->$groupType;
    
    $className = null;
    if (isset($config->rewirte->$class)){
       $className = (string)$config->rewrite->$class;
    } else {
        if (isset($config->deprecatedNode)) {
                $deprecatedNode = $config->deprecatedNode;
                $configOld = $this->_xml->global->{$groupType.'s'}->$deprecatedNode;
                if (isset($configOld->rewrite->$class)) {
                    $className = (string) $configOld->rewrite->$class;
                }
         }
    }

    // Second - if entity is not rewritten then use class prefix to form class name
    if (empty($className)) {
            if (!empty($config)) {
                $className = $config->getClassName();
            }
            if (empty($className)) {
                $className = 'mage_'.$group.'_'.$groupType;
            }
            if (!empty($class)) {
                $className .= '_'.$class;
            }
            $className = uc_words($className);
    }

    $this->_classNameCache[$groupRootNode][$group][$class] = $className;
    return $className;
}
```

### Mage_Core_Model_App
解读_initCurrentStore('', 'store');
- $this->_initStores();
  - 解读


```php
// init store, group and website collections
protected function _initStores() 
{
    $this_stores = array();
    $this->_groups = array();
    $this->_website = null;
    $this->_websites = array();

   $websiteCollection = Mage::getModel('core/website')->getCollection()->initCache($this->getCache(), 'app', array(Mage_Core_Model_website::CACHE_TAG));
   
}



### Mage_Core_Model_Abstract
属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
extends | Varien_Object | null | null | null
protected | $_eventPrefix | 'core_abstraact' | @var string | Prefix of model events names
protected | $_eventObject | 'object' | @var string | Parameter name in event 
protected | $_resourceName | @var string | null | Name of the resource model


### Mage_Core_Model_Website
初始化
$this->_init('core/website');
下一步解析$this->_setResourceModel('core/website')
下一步解析
$this->_resourceName = 'core/website';
$this->_resourceCollectionName = 'core/website_collection';

调用getcollection
->getCollection()
下一步$this->getResourceCollection();
下一步 return Mage::getResourceModel('core/website_collection', $this->_getResource = new Mage_Core_Model_Resource_website);
-> config->getResourceModelInstance('core/website_collection', $object);
-> config->_getResourceModelFactoryClassName('core/website_collection'); = core_resource/website_collection
-> config->getModelInstance('core_resource/website_collection', $object);
-> config->getModelClassName('core_resource/website_collection'); = Mage_Core_Model_Resource_Website_Collection;
new Mage_Core_Model_Resource_Website_Collection;
-> Mage_Core_Model_Resource_Db_Collection_Abstract

解析_getResource()
return Mage::getResourceSingleton('core/website');
-> Mage::getResourceModel('core/website')
-> config::getResourceModelInstance('core/website');
->_getResouceModelFactoryClassName('core/website')-> core_resource/website -> getModelInstance('core_resource/website', $constructArguments) -> getModelClassName('core_resource/website') = Mage_Core_Model_Resource_website
-> getGroupedClassname('model', 'core_resource/website');
return new Mage_Core_Model_Resource_website();



Mage_Core_Model_Resource_Website->Mage_Core_Model_Resource_Db_Abstract


### app->_initRequest()分析
- $this->getRequest()  ->setPathInfo();
       ->$this->_request = new Mage_Core_Controller_Request_Http();
       <- $this->_request->_requestUri = "/";
       -> setPathInfo();
   
### Mage_Core_Controller_Request_Http
- 初始化看看流程
- extends Zend_Controller_Request_Http
- extends Zend_Controller_Request_Abstract
- 扒到底了哈哈
- 分析Zend_Controller_Request_Abstract

属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
protected | $_dispatched | false | @var boolean | has the action been dispatched？
protected | $_module | null | @var string | Module
protected | $_moduleKey | 'module' | @var string | Module Key for retrieving module from params
protected | $_controller | null | @var string | Controller
protected | $_controllerKey | 'controller' | @var string | Controller key for retrieving controller from params
protected | $_action | null | @var string | Action
protected | $_params | array() | @var array | request parameters
public function | getModuleName | null | @return string | Retrieve the module name
public function | setModuleName | $value | @string
public function | getControllerName | 
public function | getParam | $key, $default |null | get an action parameter
pubic function | getUserParams | null | @return array | Retrieve only user params
public function | getUserParam | $key, $default| null | null
public function | setParam | $key, $value | null | Set an action parameter A $value of null will unset the $key if it exists
public function | getParams | null | @return array | Get all action parameters
public function | setParams | 
public function | clearParams |
public function | setDispatched
public function | isDispatched 

属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
protected | $_paramSources | null | array('_GET','_POST')|Allowed parameter sources
protected | $_requestUri | @var string | null | REQUEST_URI
protected | $_baseUrl | @var string | null | Base URL of request
protected | $_basePath | @var string | null | Base Path of request
protected | $_pathInfo | @var string | ''| PATH_INFO
protected | $_params | @var string | array() | Instance parameters
protected | $_rawBody | @var string or false | null | Raw request body
protected | $_aliases | @var array | array() | Alias key for request parameters 
public function | __construct| $uri 
public function | __get
public function | get
public function | set
public function | __set
public function | __isset
public function | has
public function | setQuery | $spec, $value | set GET values
public function | getQuery | $key, $default | Retrieve a member of the $_GET superglobal
public function | setPost 
public function | getPost
public function | getCookie
public function | getServer
public function | getEnv
public function | setRequestUri
public function | getRequestUri
public function | setBaseUrl
public function | getBaseUrl
public function | setBasePath
public function | getBasePath
public function | setPathInfo
public function | getPathInfo
public function | setParamSources
public function | getParamSources
pubic function | setParam
public function | getParam
public function | getParams
public function | setParam
public function | setAlias
public function | getAlias
public function | getAliases
public function | getMethod
public function | isPost
public function | isGet
public function | isPut
public function | isDelete
public function | isHead
public function | isOptions
public function | isXmlHttpRequest
public function | isFlashRequest
public function | isSecure
public function | getRawBody
public function | getHeader
public function | getScheme
public function | getHttpHost
public function | getClientIp

### Mage_Core_Controller_Request_Http

### app->_initFrontController
- $this->_initFrontController = new Mage_Core_Controller_Varien_Front();

属性 | 名称 | 参数 | 内容 | 描述
---| --- | ---| --- | ---
protected | $_defaults | array()| null | null
protected | $_routes | array()
protected | $_urlCache | array();
public function | setDefault | key, $value=null
public function | getDefault | $key = null
public function | getRequest | Retrieve request object
public function | getResonse |
public function | addRouter
public function | getRouter
public function | init
public function | dispatch
public function | _getRequestRewriteController
public function | getRouterByRoute
public function | getRouterByFrontName
public function | rewrite
 | _processRewriteurl
 | _checkBaseUrl
 protected function | _isAdminFrontNameMatche