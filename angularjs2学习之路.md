### angularjs2 学习之路
- decorate（装饰器) http://es6.ruanyifeng.com/#docs/decorator
- angular2.io 学习网站
- [typescript学习](http://www.cnblogs.com/tansm/p/TypeScript_Handbook_BasicTypes.html)
#### 模块
- 根模块NgModules 或者 特性模块
- [装饰器](https://medium.com/google-developers/exploring-es7-decorators-76ecb65fb841#.7g5fezuo9) 
```
import { NgModule }      from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
@NgModule({
  imports:      [ BrowserModule ],
  providers:    [ Logger ],
  declarations: [ AppComponent ],
  exports:      [ AppComponent ],
  bootstrap:    [ AppComponent ]
})
export class AppModule { }
```

- 组件
- 模板

```html
<h2>Hero List</h2>
<p><i>Pick a hero from the list</i></p>
<ul>
  <li *ngFor="let hero of heroes" (click)="selectHero(hero)">
    {{hero.name}}
  </li>
</ul>
<hero-detail *ngIf="selectedHero" [hero]="selectedHero"></hero-detail>
```

- 元数据
> 元数据告诉Angular如何处理一个类
- 数据绑定
  - {{hero.name}} 插值表达式： 在显示组件hero.name属性的值
  - [hero] 属性绑定
  -（click) 时间绑定 
  - 双向数据绑定
```
<li>{{hero.name}}</li>
<hero-detail [hero]="selectedHero"></hero-detail>
<li (click)="selectHero(hero)"></li>
```
- 指令（Directive）
  - 属性指令
  - 结构指令
- 服务
- 依赖注入
> 遵照依赖注入模式的要求，组件必须在它的构造函数中请求这些服务， 就像我们以前解释过的那样 
js 成员变量 私有变量 静态变量

- 模板语法
  - HTML
  - 插值表达式
  - 模板表达式

https://www.omniselling.net/git/v5/v5frontv2.git
172.18.1.12/omniv5 admin asdasd123

'git -c core.longpaths=true config --get remote.origin.url‘ 解决方案为 git config --global url."https://".insteadOf git://
http://cnodejs.org/topic/4f9904f9407edba21468f31e npm config set registry https://registry.npm.taobao.org npm下载慢

1. page
2. search
2. edit
3. delete

5. sort

http://www.cnblogs.com/SLchuck/p/5904000.html 组件通信

<Pagination [totalItems]="totalItems" [currentPage]="currentPage" [itemsPerPage]="itemsPerPage" (output)="output($event)"></Pagination>

getAppResourcesService(url: string, body: any): any{
        return this.http.post(url, options)
            .map(res => res.json());
    }
http post提交