
##第三章-布局，块和模板
- [引用地址](http://justcoding.iteye.com/blog/1584694)
- 模型，布局，和块。Magento的执行控制器不直接将数据传给视图，相反的视图将直接引用模型，从模型取数据。这样的设计就导致了视图被拆分成两部分，块（Block)和模板（Template).
- 块是对象，而模板是原始php文件，混合了xhtml和php代码。每一个块都和一个唯一的模板文件绑定。在模板文件phtml中，“$this”就是指该模板文件对应的快对象。
- `File: app/design/frontend/base/default/template/catalog/product/list.phtml`
- ee