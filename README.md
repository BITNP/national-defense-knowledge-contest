本仓库仅供历史项目存档
=========

## 国防知识竞赛 web 答题系统

PHP 5.6

Bootstrap v4.0.0

MySQL

​     


#### 重要文件和目录

- `/config.php`

  数据库、CAS、题库设置

- `/database.sql`

  数据库结构导出

- `/paper.php` & `/js/paper.js/`

  答题页

- `/certificate/`

  证书模板图片、证书字体文件、证书生成等（我是说**合格**证书）

- `/auth.php`

  CAS 登录认证


- `/vendor/`  & `/scss/`  & `/layer/`  & `/css/`

  sources for Bootstrap & other frameworks

- `/CAS/`

  PHPCAS Client



#### Progress

- 2018/4/22

  实现合格证书生成：添加姓名和日期