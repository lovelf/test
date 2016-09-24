##Boostrap 基础框架
- 1.5 优先级（1,1,1,1）-> (style, id, 类及元素属性， 元素及伪元素) 问题需要区分伪元素与伪类[CSS 伪类与伪元素](http://blog.csdn.net/sadfishsc/article/details/7047595)
- 选择器
   - 子选择器
   - 属性选择器
   - 兄弟选择器
- 媒体查询（Media Query) min-width、max-width and
1. CSS12 栅格系统
  - `.container {
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
     }`
  - @media [响应式资料](http://www.cnblogs.com/mofish/archive/2012/05/23/2515218.html)
  -  `.row { 
     margin-right: -15px;
     margin-left: -15px;
     }`
  - `.col-xs-1,.col-xs-12 {
     position: relative,
     min-height: 1px;
     padding-right: 15px;
     padding-left: 15px;
     }`
  -  `.col-xs-1,.col-xs-12 {
     float: left;
     }`
  - 列组合 col-xs col-md col-sm col-lg 实现原理是 左浮动 和 宽度百分比
  - 列偏移 col-xs-offset-4 使用后margin-left百分比来操作
  - 列嵌套
  - 列排序 col-xs-pull 使用right退 col-xs-push 使用left 拉
  - min-width是向大兼容的
  - 清除浮动问题（高度是没有固定的，依据内容而定）用类clearfix {clear: both}
  
2.  CSS组件设计思想
    - OA O（overwrite) A(append)
    - 基础样式，例如: btn, alert
    - 颜色样式 btn-info, alert-success，primary
    - 尺寸样式 btn-ns, btn-sm, btn-lg
    - 状态样式 active、disabled
    - 特殊元素样式 dropdown-menu>li>a:hover
    - 并列元素样式 btn-group.btn+.btn
    - 嵌套子元素样式 btn-group.btn-group
    - 动画样式 progress.active
    
3. 基础样式
  - font
  - padding margin
  - display
  - border
  - color background
  - 定义颜色从文本 背景 边框
  - 调整尺寸是从 padding 圆角 行距 字体
    

    