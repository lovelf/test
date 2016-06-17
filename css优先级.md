##CSS 优先级
优先级组合用4个数字(a, b, c, d)
比如1，1，1，1 和 0，1，0，1

-  a表示 <font color="red">style</font>的样式
-  b表示为 以id为选择器的
-  c表示为 类选择器(.btn) 和 属性选择器(li[id=red]).
-  d计算元素(table,p,div等）和 伪类元素（就像first-child)

## 选择器
1. 属性选择器
 - [attr=value] 该属性有指定的确切值
 - [attr~=value] 该属性值必须是多个空格隔开的值，比如，class="title featured home", 而且这些值中的一个必须是指定的"value"
 - [attr|=value] 该属性的值就是"value"或者以"value"开始并立即跟上一个"-"字符，也就是"value-",比如lang="zh-cn"
 - [attr^=value] 该属性的值必须以指定的值开始
 - [attr*=value] 该属性的值必须包含特定值（而不论其位置怎么样)
 - [attr$=value] 该属性的值以特定值技术

2. 子选择器
 - CSS里的子元素用符号">"表示。如 .table > thead > tr > th

3. 兄弟选择器

 - 临近兄弟元素用 “+”，比如导航中 li + li {margin-left: 2px}
 - 普通兄弟元素用“~” 后面的兄弟元素 h1 ~ p {font-size: 13px;}

4. 伪类
 - :hover 鼠标滑过时的状态
 - :focus 元素拥有焦点的状态
 - :first-child 第一个子元素
 - :last-child 最后一个子元素
 - :nth-child 一个或多个子元素
   .btn-group > .btn:not(:first-child):not(:last-child):not(.dropdown-toggle) { border-radius: 0;}