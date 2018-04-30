SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `skcshop`
--

CREATE DATABASE IF NOT EXISTS 'skcshop' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use 'skcshop';

-- --------------------------------------------------------
--
-- 商品表 `ecshop_goods`
--
CREATE TABLE IF NOT EXISTS ecshop_goods (
  id mediumint(8) unsigned not null auto_increment,
  goods_name varchar(45) not null comment '商品名称',
  cat_id smallint(5) unsigned not null comment '主分类的id',
  brand_id smallint(5) unsigned not null comment '品牌的id',
  market_price decimal(10,2) not null default '0.00' comment '市场价',
  shop_price decimal(10,2) not null default '0.00' comment '本店价',
  jifen int(10) unsigned not null comment '赠送积分',
  jyz int(10) unsigned not null comment '赠送经验值',
  jifen_price int(10) unsigned not null comment '如果要用积分兑换，需要的积分数',
  is_promote tinyint(3) unsigned not null default '0' comment '是否促销',
  promote_price decimal(10,2) not null default '0.00' comment '促销价',
  promote_start_time int(10) unsigned not null default '0' comment '促销开始时间',
  promote_end_time int(10) unsigned not null default '0' comment '促销结束时间',
  logo varchar(150) not null default '' comment 'logo原图',
  sm_logo varchar(150) not null default '' comment 'logo缩略图',
  is_hot tinyint(3) unsigned not null default '0' comment '是否热卖',
  is_new tinyint(3) unsigned not null default '0' comment '是否新品',
  is_best tinyint(3) unsigned not null default '0' comment '是否精品',
  is_on_sale tinyint(3) unsigned not null default '1' comment '是否上架：1：上架，0：下架',
  seo_keyword varchar(150) not null default '' comment 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字',
  seo_description varchar(150) not null default '' comment 'seo优化[搜索引擎【百度、谷歌等】优化]_描述',
  type_id mediumint(8) unsigned not null default '0' comment '商品类型id',
  sort_num tinyint(3) unsigned not null default '100' comment '排序数字',
  is_delete tinyint(3) unsigned not null default '0' comment '是否放到回收站：1：是，0：否',
  addtime int(10) unsigned not null comment '添加时间',
  goods_desc text comment '商品描述',
  primary key (id),
  key (shop_price),
  key (cat_id),
  key (brand_id),
  key (is_on_sale),
  key (is_hot),
  key (is_new),
  key (is_best),
  key (is_delete),
  key (sort_num),
  key (promote_start_time),
  key (promote_end_time),
  key (addtime)
) engine=Myisam default charset=utf8 comment='商品表';

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- 管理员表 `ecshop_admin`
--
CREATE TABLE IF NOT EXISTS ecshop_admin (
  id smallint(5) unsigned not null auto_increment,
  username varchar(30) not null comment '账号',
  password char(32) not null comment '密码',
  role_id varchar(30) not null comment '所属角色的id',
  is_use tinyint(3) unsigned not null default '1' comment '是否启用 1：启用 0：禁用',
  primary key (id)
) engine=Myisam default charset=utf8 comment='管理员表';

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- 权限表 `ecshop_auth`
--
CREATE TABLE IF NOT EXISTS ecshop_auth (
  id smallint(6) unsigned not null auto_increment,
  pid smallint(5) unsigned not null default '0' comment '父级权限的id，0表示顶级权限',
  auth_name varchar(30) not null comment '权限名称',
  module_name varchar(30) not null comment '模块名称',
  controller_name varchar(30) not null comment '控制器名称',
  action_name varchar(30) not null comment '方法名称',
  auth_level tinyint(5) not null default '2' comment '权限等级',
  primary key (id)
) engine=InnoDB default charset=utf8 comment='管理员表';

-- --------------------------------------------------------

-- --------------------------------------------------------
--
-- 角色表 `ecshop_role`
--
CREATE TABLE IF NOT EXISTS ecshop_role (
  id smallint(5) unsigned not null auto_increment,
  role_name varchar(20) not null comment '角色名称',
  auth_id varchar(500) not null comment '拥有的权限id',
  primary key (id)
) engine=InnoDB default charset=utf8 comment='角色表';

-- --------------------------------------------------------

