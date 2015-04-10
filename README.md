#zmExam
-----------------------
**1.项目介绍**

基于PHP开发的小型问卷调查系统

**2.环境搭建**

本软件在[SAE](http://sae.sina.com.cn)云环境上搭建，当然也可以移植到本地系统，只要安装LAMP环境即可。

**3.相关工具**

- [composer](https://getcomposer.org/)

**4.安装**

- 安装依赖软件包

	`composer install`

- 将exam目录拷贝到http服务目录或创建链接

	`cp -a exam /var/www`

- 导入mysql数据库

	```ruby
	mysql -u root -p
	use zmexam
	source zmexam.sql
	```
