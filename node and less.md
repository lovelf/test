### nodejs安装
1. 选择nodejs v6.2.0版本
2. 之后进入node.js command prompt
3. npm install -g less
4. 就可以使用lessc命令


### less语法
[引用less语法](http://www.1024i.com/demo/less/index.html)

1. 什么是LESSCSS
<p>LESSCSS是一种动态样式语言，属于CSS预处理语言的一种，它使用类似CSS的语法，为CSS的赋予了动态语言的特性，如变量、继承、运算、函数等，更方便CSS的编写和维护。</div>

2. 变量
<p>变量允许我们单独定义一系列通用的样式，然后在需要的时候去调用。所以在做全局样式调整的时候我们可能只需要修改几行代码就可以了。</div>使用@加字母形式。。

3. 混合（Mixins)
<p>混合可以将一个定义好的class A轻松的引入到另一个class B中，从而简单实现class B继承class A中的所有属性。我们还可以带参数地调用，就像使用函数一样。</div>

4. 嵌套
<p>我们可以在一个选择器中嵌套另一个选择器来实现继承，这样很大程度减少了代码量，并且代码看起来更加的清晰。</div>

5. 函数运算
<p>运算提供了加，减，乘，除操作；我们可以做属性值和颜色的运算，这样就可以实现属性值之间的复杂关系。LESS中的函数一一映射了JavaScript代码，如果你愿意的话可以操作属性值。</div>

http://www.ibm.com/developerworks/cn/web/1207_shenyi_lesscss/