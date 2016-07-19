### CSS权威指南

#### 第一章
- 层叠（这是css的核心） 样式可以合并和覆盖
- 元素(element)是文档结构的基础。 这意味着每个元素生成一个**框（box, 也称为盒）**, 其中包含元素的内容。
- 替换元素/费替换元素
- 元素显示角色
  - 块级元素（block-level) 块级元素生产一个元素框，（默认地）它会填充其父元素的内容区，旁边不能有其他元素。在正常文档流中单独占一行
  - 行内元素 (inline-level) 行内在正常文档流中与可与其他行内元素占一行
 
- 解析style
- 每个元素都是一个框

#### 第二章
- 选择器
  - 元素选择器
  - 声明和关键字，声明可能含有多个值则用空格隔开，例如font，border
  - 选择器分组 ，例如 h2,p {color: gray;}
  - 通配选择器， *
  - 声明分组 
  - 类选择器 和 ID选择器
  - 属性选择器
    - 简单属性选择，h1[class], a[href][title] 只有考虑包含此属性，不考虑其值
    - 根据具体属性值选择,a[href="www.dsales.me"],也可以联合
    - 根据部分属性值选择 p[class~="warning"], 根据属性值中出现的一个用空格分隔的词来完成选择。
      - [foo^="bar"] 选择foo属性值以"bar"开头的所有元素
      - [foo$="bar"] 选择foo属性值以"bar"结尾的所有元素
      - [foo*="bar"] 选择foo属性值包含子串"bar"的所有元素
     - 特定属性选择类型 ， [att|="val"]
   - 使用文档结构
     - 后代选择器， h1 em {}，
     - 选择子元素 h1 > strong{color: red;}
     - 选择相邻兄弟元素 ， 要去除紧接在一个h1元素后出现的段落的上边， h1 + p {margin-top: 20px; }, 这个选择器读作`选择紧接在一个h1元素后出现的所有段落，h1要与p元素有共同的父元素`
   - 伪类和伪元素
     - 链接伪类 :link有href属性, :visited
     - 动态伪类 :focus, :hover, :active;
     - 第一个子元素
     

### 第四章长度和单位
- inherit

```html
<style type="text/css">
#toolbar {
	background: blue;
	color: white;
}

#toolbar a {
	color: inherit;
	text-decoration: none;
}
</style>
<div id="toolbar">
<a href="one.html">one</a> | <a href="two.html">two</a> | <a href="three.html">three</a>
</div>

```

- font-family 通用字体 字体系列 字体，后退机制，单引号使用
- font-weight 
- font-size

参数 | 值
----| ----
值 | xx-small <length> <percentage> inherit
初始值 | medium
应用于 | 所有元素
继承性 | 有
百分数 | 根据父元素的字体大小来计算
计算值 | 绝对长度

**字体大小继承是计算值，而不是百分比**
**百分比 浏览器取整**


### 第六章文本属性
- text-indent

参数 | 值
---- | ----
值 | <length> <percentage> inherit
初始值 | 0
应用于 | 块级元素
继承性 | 有
百分数 | 相对于包含块的宽度
计算值 | 对于百分数值，要根据指定确定；对于长度值，则为绝对长度值

**text-indent 总是继承计算值，而不是声明值。**

- text-align

参数 | 值
---- |----
值 | left center right justify inherit
初始值 | 用户代理特定的值，还可能取决于书写方向
应用于 | 块级元素
继承性 | 有
计算值 | 根据指定确定
说明 | null