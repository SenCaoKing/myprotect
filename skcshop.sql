/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : skcshop

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 24/05/2018 20:59:25
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ecshop_admin
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_admin`;
CREATE TABLE `ecshop_admin`  (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `role_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '所属角色的id',
  `is_use` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否启用 1：启用0：禁用',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_admin
-- ----------------------------
INSERT INTO `ecshop_admin` VALUES (1, 'Sen', '0a61c973a3fdf8562188db5737de29a7', '1,2,3', 1);

-- ----------------------------
-- Table structure for ecshop_attr
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_attr`;
CREATE TABLE `ecshop_attr`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL COMMENT '所在的类型的id',
  `attr_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性名',
  `attr_type` tinyint(4) NOT NULL COMMENT '属性的类型0：唯一 1：可选',
  `attr_option_values` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '属性的可选值，多个可选值用，隔开',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `type_id`(`type_id`) USING BTREE,
  INDEX `type_id_2`(`type_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '属性表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_attr
-- ----------------------------
INSERT INTO `ecshop_attr` VALUES (1, 2, '出版社', 0, '');
INSERT INTO `ecshop_attr` VALUES (3, 2, '页数', 0, '');
INSERT INTO `ecshop_attr` VALUES (4, 1, '像素', 1, '1600万,1200万');
INSERT INTO `ecshop_attr` VALUES (5, 1, '内存', 1, '4G,8G,16G');
INSERT INTO `ecshop_attr` VALUES (6, 1, '颜色', 1, '白色,黑色,红色');
INSERT INTO `ecshop_attr` VALUES (7, 1, '是否智能', 0, '是,不是');

-- ----------------------------
-- Table structure for ecshop_auth
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_auth`;
CREATE TABLE `ecshop_auth`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `pid` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '父级权限的id，0表示顶级权限',
  `auth_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '权限名称',
  `module_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块名称',
  `controller_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器名称',
  `action_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '方法名称',
  `auth_level` tinyint(5) NOT NULL DEFAULT 2 COMMENT '权限等级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '权限表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ecshop_auth
-- ----------------------------
INSERT INTO `ecshop_auth` VALUES (1, 0, '商品管理', 'null', 'null', 'null', 0);
INSERT INTO `ecshop_auth` VALUES (2, 1, '商品列表', 'Admin', 'Goods', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (3, 2, '删除商品', 'Admin', 'Goods', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (4, 2, '编辑商品', 'Admin', 'Goods', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (5, 2, '添加商品', 'Admin', 'Goods', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (6, 1, '商品分类列表', 'Admin', 'Category', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (7, 6, '添加分类', 'Admin', 'Category', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (8, 6, '修改分类', 'Admin', 'Category', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (9, 6, '删除分类', 'Admin', 'Category', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (10, 0, '权限管理', 'null', 'null', 'null', 0);
INSERT INTO `ecshop_auth` VALUES (11, 10, '权限列表', 'Admin', 'Auth', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (12, 11, '添加权限', 'Admin', 'Auth', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (13, 11, '编辑权限', 'Admin', 'Auth', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (14, 11, '删除权限', 'Admin', 'Auth', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (15, 10, '角色列表', 'Admin', 'Role', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (16, 15, '添加角色', 'Admin', 'Role', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (17, 15, '编辑角色', 'Admin', 'Role', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (18, 15, '删除角色', 'Admin', 'Role', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (19, 10, '管理员列表', 'Admin', 'Admin', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (20, 19, '添加管理员', 'Admin', 'Admin', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (21, 19, '编辑管理员', 'Admin', 'Admin', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (22, 19, '删除管理员', 'Admin', 'Admin', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (23, 19, '禁用管理员', 'Admin', 'Admin', 'setUnuse', 2);
INSERT INTO `ecshop_auth` VALUES (24, 1, '类型列表', 'Admin', 'Type', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (25, 24, '添加类型', 'Admin', 'Type', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (26, 24, '修改类型', 'Admin', 'Type', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (27, 24, '删除类型', 'Admin', 'Type', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (28, 24, '属性列表', 'Admin', 'Attr', 'lst', 2);
INSERT INTO `ecshop_auth` VALUES (29, 28, '添加属性', 'Admin', 'Attr', 'add', 3);
INSERT INTO `ecshop_auth` VALUES (30, 28, '修改属性', 'Admin', 'Attr', 'edit', 3);
INSERT INTO `ecshop_auth` VALUES (31, 28, '删除属性', 'Admin', 'Attr', 'delete', 3);
INSERT INTO `ecshop_auth` VALUES (33, 2, 'ajax获取商品属性', 'Admin', 'Goods', 'ajaxGetAttr', 2);
INSERT INTO `ecshop_auth` VALUES (34, 1, '品牌列表·', 'Admin', 'Brand', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (35, 34, '添加品牌', 'Admin', 'Brand', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (36, 34, '修改品牌', 'Admin', 'Brand', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (37, 34, '删除品牌', 'Admin', 'Auth', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (38, 0, '会员管理', 'null', 'null', 'null', 0);
INSERT INTO `ecshop_auth` VALUES (39, 38, '会员等级列表', 'Admin', 'MemberLevel', 'lst', 1);
INSERT INTO `ecshop_auth` VALUES (40, 39, '添加会员等级', 'Admin', 'MemberLevel', 'add', 2);
INSERT INTO `ecshop_auth` VALUES (41, 39, '修改会员等级', 'Admin', 'MemberLevel', 'edit', 2);
INSERT INTO `ecshop_auth` VALUES (42, 39, '删除会员等级', 'Admin', 'MemberLevel', 'delete', 2);
INSERT INTO `ecshop_auth` VALUES (43, 2, 'ajax删除商品图片', 'Admin', 'Goods', 'ajaxDeletePic', 2);
INSERT INTO `ecshop_auth` VALUES (44, 2, 'ajax删除商品属性', 'Admin', 'Goods', 'ajaxDeleteAttr', 2);
INSERT INTO `ecshop_auth` VALUES (45, 2, '商品放入回收站', 'Admin', 'Goods', 'recycle', 2);
INSERT INTO `ecshop_auth` VALUES (46, 1, '商品回收站', 'Admin', 'Goods', 'recyclelst', 1);
INSERT INTO `ecshop_auth` VALUES (47, 46, '还原商品', 'Admin', 'Goods', 'restore', 2);
INSERT INTO `ecshop_auth` VALUES (48, 2, '库存量', 'Admin', 'Goods', 'number', 2);

-- ----------------------------
-- Table structure for ecshop_brand
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_brand`;
CREATE TABLE `ecshop_brand`  (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '品牌名称',
  `site_url` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '品牌网站地址',
  `logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '品牌logo',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '品牌表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_brand
-- ----------------------------
INSERT INTO `ecshop_brand` VALUES (1, '诺基亚', 'gwe', 'Brand/2016-11-28/583c28eb83516.png');
INSERT INTO `ecshop_brand` VALUES (2, '小米', 'www.xiaomi.com', '');

-- ----------------------------
-- Table structure for ecshop_cart
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_cart`;
CREATE TABLE `ecshop_cart`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品ID',
  `goods_attr_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '选择的商品属性ID，多个用，隔开',
  `goods_number` int(10) UNSIGNED NOT NULL COMMENT '购买的数量',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '购物车' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ecshop_category
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_category`;
CREATE TABLE `ecshop_category`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '分类名称',
  `pid` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上级分类的ID，0：代表顶级',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品分类表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_category
-- ----------------------------
INSERT INTO `ecshop_category` VALUES (1, '图像、音像、数字商品', 0);
INSERT INTO `ecshop_category` VALUES (2, '电子书', 1);
INSERT INTO `ecshop_category` VALUES (3, '数字音乐', 1);
INSERT INTO `ecshop_category` VALUES (4, '音像', 1);
INSERT INTO `ecshop_category` VALUES (5, '免费', 2);
INSERT INTO `ecshop_category` VALUES (6, '小说', 2);
INSERT INTO `ecshop_category` VALUES (7, '励志与成功', 2);
INSERT INTO `ecshop_category` VALUES (8, '两性/婚恋', 2);
INSERT INTO `ecshop_category` VALUES (9, '古典音乐', 3);
INSERT INTO `ecshop_category` VALUES (10, '流行音乐', 3);
INSERT INTO `ecshop_category` VALUES (11, '摇滚音乐', 3);
INSERT INTO `ecshop_category` VALUES (12, '音乐', 4);
INSERT INTO `ecshop_category` VALUES (13, '影视', 4);
INSERT INTO `ecshop_category` VALUES (14, '游戏', 4);
INSERT INTO `ecshop_category` VALUES (15, '手机、数码', 0);
INSERT INTO `ecshop_category` VALUES (16, '智能手机', 15);
INSERT INTO `ecshop_category` VALUES (17, '小米', 16);
INSERT INTO `ecshop_category` VALUES (18, '三星', 16);
INSERT INTO `ecshop_category` VALUES (19, '苹果', 16);
INSERT INTO `ecshop_category` VALUES (20, '华为', 16);
INSERT INTO `ecshop_category` VALUES (21, '数码', 15);
INSERT INTO `ecshop_category` VALUES (22, '数码相机', 21);
INSERT INTO `ecshop_category` VALUES (23, '数码电视', 21);
INSERT INTO `ecshop_category` VALUES (24, '家用电器', 0);
INSERT INTO `ecshop_category` VALUES (25, '大家电', 24);
INSERT INTO `ecshop_category` VALUES (26, '冰箱', 25);
INSERT INTO `ecshop_category` VALUES (27, '洗衣机', 25);
INSERT INTO `ecshop_category` VALUES (28, '空调', 25);
INSERT INTO `ecshop_category` VALUES (29, '饮水机', 25);
INSERT INTO `ecshop_category` VALUES (30, '厨房电器', 24);
INSERT INTO `ecshop_category` VALUES (31, '电饭煲', 30);
INSERT INTO `ecshop_category` VALUES (32, '豆浆机', 30);
INSERT INTO `ecshop_category` VALUES (33, '面包机', 30);
INSERT INTO `ecshop_category` VALUES (34, '微波炉', 30);

-- ----------------------------
-- Table structure for ecshop_clicked_use
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_clicked_use`;
CREATE TABLE `ecshop_clicked_use`  (
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员ID',
  `comment_id` mediumint(8) UNSIGNED NOT NULL COMMENT '评论的ID',
  PRIMARY KEY (`member_id`, `comment_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户点击过有用的评论' ROW_FORMAT = Fixed;

-- ----------------------------
-- Table structure for ecshop_comment
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_comment`;
CREATE TABLE `ecshop_comment`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '评论的内容',
  `star` tinyint(3) UNSIGNED NOT NULL DEFAULT 3 COMMENT '打的分',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '评论时间',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员ID',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品的ID',
  `used` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '有用的数量',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '评论' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_comment
-- ----------------------------
INSERT INTO `ecshop_comment` VALUES (1, '商品很好', 5, 1480951394, 1, 3, 0);
INSERT INTO `ecshop_comment` VALUES (2, '真的很好噢', 5, 1481026639, 1, 3, 0);
INSERT INTO `ecshop_comment` VALUES (3, '是不错', 5, 1481030970, 1, 3, 0);

-- ----------------------------
-- Table structure for ecshop_goods
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_goods`;
CREATE TABLE `ecshop_goods`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品名称',
  `cat_id` smallint(5) UNSIGNED NOT NULL COMMENT '主分类的id',
  `brand_id` smallint(5) UNSIGNED NOT NULL COMMENT '品牌的id',
  `market_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '市场价',
  `shop_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '本店价',
  `jifen` int(10) UNSIGNED NOT NULL COMMENT '赠送积分',
  `jyz` int(10) UNSIGNED NOT NULL COMMENT '赠送经验值',
  `jifen_price` int(10) UNSIGNED NOT NULL COMMENT '如果要用积分兑换，需要的积分数',
  `is_promote` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否促销',
  `promote_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '促销价',
  `promote_start_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '促销开始时间',
  `promote_end_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '促销结束时间',
  `logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'logo原图',
  `sm_logo` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'logo缩略图',
  `is_hot` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否热卖',
  `is_new` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否新品',
  `is_best` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否精品',
  `is_on_sale` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否上架：1：上架，0：下架',
  `seo_keyword` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'seo优化[搜索引擎【百度、谷歌等】优化]_关键字',
  `seo_description` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'seo优化[搜索引擎【百度、谷歌等】优化]_描述',
  `type_id` mediumint(8) UNSIGNED NOT NULL DEFAULT 0 COMMENT '商品类型id',
  `sort_num` tinyint(3) UNSIGNED NOT NULL DEFAULT 100 COMMENT '排序数字',
  `is_delete` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '是否放到回收站：1：是，0：否',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '添加时间',
  `goods_desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '商品描述',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `shop_price`(`shop_price`) USING BTREE,
  INDEX `cat_id`(`cat_id`) USING BTREE,
  INDEX `brand_id`(`brand_id`) USING BTREE,
  INDEX `is_on_sale`(`is_on_sale`) USING BTREE,
  INDEX `is_hot`(`is_hot`) USING BTREE,
  INDEX `is_new`(`is_new`) USING BTREE,
  INDEX `is_best`(`is_best`) USING BTREE,
  INDEX `is_delete`(`is_delete`) USING BTREE,
  INDEX `sort_num`(`sort_num`) USING BTREE,
  INDEX `promote_start_time`(`promote_start_time`) USING BTREE,
  INDEX `promote_end_time`(`promote_end_time`) USING BTREE,
  INDEX `addtime`(`addtime`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_goods
-- ----------------------------
INSERT INTO `ecshop_goods` VALUES (2, '小米4', 17, 2, 2000.00, 1.00, 120, 200, 60, 1, 1.00, 1480435200, 1482422400, 'Goods/2016-11-30/583ef13350bc1.jpg', 'Goods/2016-11-30/thumb_0_583ef13350bc1.jpg', 0, 0, 0, 1, '小米4', '小米4', 1, 100, 0, 1480519987, '<p>小米4手机</p>');
INSERT INTO `ecshop_goods` VALUES (3, '红米3', 17, 2, 1100.00, 1000.00, 2000, 178, 100, 0, 0.00, 1480694400, 1480694400, 'Goods/2016-12-03/5842d059a052b.jpg', 'Goods/2016-12-03/thumb_0_5842d059a052b.jpg', 1, 1, 1, 1, '小米', '小米', 1, 100, 0, 1480773721, '<p>红米</p>');
INSERT INTO `ecshop_goods` VALUES (4, '诺基亚', 16, 1, 1100.00, 1000.00, 123, 123, 23435, 0, 0.00, 1480694400, 1480694400, 'Goods/2016-12-03/5842d4fa5abd9.jpg', 'Goods/2016-12-03/thumb_0_5842d4fa5abd9.jpg', 0, 1, 0, 1, '', '', 1, 100, 0, 1480774906, '<p>诺基亚</p>');

-- ----------------------------
-- Table structure for ecshop_goods_attr
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_goods_attr`;
CREATE TABLE `ecshop_goods_attr`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品的id',
  `attr_id` mediumint(8) UNSIGNED NOT NULL COMMENT '属性的id',
  `attr_value` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '属性的值',
  `attr_price` decimal(10, 2) NOT NULL DEFAULT 0.00 COMMENT '属性的价格',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `attr_id`(`attr_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品属性表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_goods_attr
-- ----------------------------
INSERT INTO `ecshop_goods_attr` VALUES (1, 2, 4, '1600万', 2100.00);
INSERT INTO `ecshop_goods_attr` VALUES (2, 2, 4, '1200万', 2000.00);
INSERT INTO `ecshop_goods_attr` VALUES (3, 2, 5, '4G', 1990.00);
INSERT INTO `ecshop_goods_attr` VALUES (4, 2, 5, '16G', 2100.00);
INSERT INTO `ecshop_goods_attr` VALUES (5, 2, 5, '8G', 2000.00);
INSERT INTO `ecshop_goods_attr` VALUES (6, 2, 6, '白色', 2000.00);
INSERT INTO `ecshop_goods_attr` VALUES (7, 2, 6, '红色', 2000.00);
INSERT INTO `ecshop_goods_attr` VALUES (8, 2, 6, '黑色', 2000.00);
INSERT INTO `ecshop_goods_attr` VALUES (9, 2, 7, '是', 0.00);
INSERT INTO `ecshop_goods_attr` VALUES (10, 3, 4, '1600万', 1200.00);
INSERT INTO `ecshop_goods_attr` VALUES (11, 3, 4, '1200万', 1100.00);
INSERT INTO `ecshop_goods_attr` VALUES (12, 3, 5, '8G', 1100.00);
INSERT INTO `ecshop_goods_attr` VALUES (13, 3, 5, '4G', 1000.00);
INSERT INTO `ecshop_goods_attr` VALUES (14, 3, 6, '白色', 1000.00);
INSERT INTO `ecshop_goods_attr` VALUES (15, 3, 7, '是', 0.00);
INSERT INTO `ecshop_goods_attr` VALUES (16, 4, 4, '1600万', 1000.00);
INSERT INTO `ecshop_goods_attr` VALUES (17, 4, 4, '1200万', 900.00);
INSERT INTO `ecshop_goods_attr` VALUES (18, 4, 5, '4G', 1233.00);
INSERT INTO `ecshop_goods_attr` VALUES (19, 4, 6, '请选择', 0.00);
INSERT INTO `ecshop_goods_attr` VALUES (20, 4, 6, '白色', 1000.00);
INSERT INTO `ecshop_goods_attr` VALUES (21, 4, 7, '是', 0.00);

-- ----------------------------
-- Table structure for ecshop_goods_cat
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_goods_cat`;
CREATE TABLE `ecshop_goods_cat`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品id',
  `cat_id` smallint(5) UNSIGNED NOT NULL COMMENT '分类id',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `cat_id`(`cat_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品扩展分类表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of ecshop_goods_cat
-- ----------------------------
INSERT INTO `ecshop_goods_cat` VALUES (8, 2, 16);
INSERT INTO `ecshop_goods_cat` VALUES (7, 3, 16);
INSERT INTO `ecshop_goods_cat` VALUES (9, 4, 16);

-- ----------------------------
-- Table structure for ecshop_goods_number
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_goods_number`;
CREATE TABLE `ecshop_goods_number`  (
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品的id',
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_number` int(10) UNSIGNED NOT NULL COMMENT '库存量',
  `goods_attr_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'goods_attr表里的id，并且要满足该goods_attr表的attr_id是可选的属性id，即属性表里的attr_type为1',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品库存量表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ecshop_goods_number
-- ----------------------------
INSERT INTO `ecshop_goods_number` VALUES (3, 5, 899, '10,12');
INSERT INTO `ecshop_goods_number` VALUES (2, 6, 1228, '1,4,6');
INSERT INTO `ecshop_goods_number` VALUES (2, 7, 1100, '1,5,7');
INSERT INTO `ecshop_goods_number` VALUES (2, 8, 1230, '2,5,6');
INSERT INTO `ecshop_goods_number` VALUES (2, 9, 1100, '2,3,7');

-- ----------------------------
-- Table structure for ecshop_goods_pics
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_goods_pics`;
CREATE TABLE `ecshop_goods_pics`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品的id',
  `pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片',
  `sm_pic` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '缩略图',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品相册表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ecshop_goods_pics
-- ----------------------------
INSERT INTO `ecshop_goods_pics` VALUES (1, 2, 'Goods/2016-11-30/583ef133aa449.jpg', 'Goods/2016-11-30/thumb_0_583ef133aa449.jpg');
INSERT INTO `ecshop_goods_pics` VALUES (2, 2, 'Goods/2016-11-30/583ef133cfd64.jpg', 'Goods/2016-11-30/thumb_0_583ef133cfd64.jpg');
INSERT INTO `ecshop_goods_pics` VALUES (3, 3, 'Goods/2016-12-03/5842d05a01a4c.jpg', 'Goods/2016-12-03/thumb_0_5842d05a01a4c.jpg');
INSERT INTO `ecshop_goods_pics` VALUES (4, 3, 'Goods/2016-12-03/5842d05a2dbcb.jpg', 'Goods/2016-12-03/thumb_0_5842d05a2dbcb.jpg');
INSERT INTO `ecshop_goods_pics` VALUES (5, 4, 'Goods/2016-12-03/5842d4fa92dc2.jpg', 'Goods/2016-12-03/thumb_0_5842d4fa92dc2.jpg');

-- ----------------------------
-- Table structure for ecshop_impression
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_impression`;
CREATE TABLE `ecshop_impression`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `imp_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '印象的标题',
  `imp_count` smallint(5) UNSIGNED NOT NULL DEFAULT 1 COMMENT '印象出现的次数',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '印象' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_impression
-- ----------------------------
INSERT INTO `ecshop_impression` VALUES (1, '质量好', 1, 3);
INSERT INTO `ecshop_impression` VALUES (2, '问问', 1, 3);
INSERT INTO `ecshop_impression` VALUES (3, '很好', 1, 3);

-- ----------------------------
-- Table structure for ecshop_member
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_member`;
CREATE TABLE `ecshop_member`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '会员账号',
  `password` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `face` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '注册时间',
  `email_code` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '邮件验证的验证码，当会员验证通过之后，会把这个字段清空，所以如果这个字段为空就说明会员已经通过email验证了',
  `jifen` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '积分',
  `jyz` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '经验值',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_member
-- ----------------------------
INSERT INTO `ecshop_member` VALUES (1, '986992484@qq.com', '4bc26ff76fc3ecffd96f385246725ec3', '', 1480693714, '', 0, 60000);
INSERT INTO `ecshop_member` VALUES (2, '3021555169@qq.com', '4bc26ff76fc3ecffd96f385246725ec3', '', 1480943072, '', 0, 0);
INSERT INTO `ecshop_member` VALUES (3, '2814073941@qq.com', '477551fa311e8d6ae88dde02bc638389', '', 1527166671, '', 0, 0);

-- ----------------------------
-- Table structure for ecshop_member_level
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_member_level`;
CREATE TABLE `ecshop_member_level`  (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '级别名称',
  `bottom_num` int(10) UNSIGNED NOT NULL COMMENT '积分下限',
  `top_num` int(10) UNSIGNED NOT NULL COMMENT '积分上限',
  `rate` tinyint(4) NOT NULL DEFAULT 100 COMMENT '折扣率，90为9折',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '会员级别表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_member_level
-- ----------------------------
INSERT INTO `ecshop_member_level` VALUES (1, '注册会员', 0, 2000, 100);
INSERT INTO `ecshop_member_level` VALUES (2, '中级会员', 2001, 8000, 98);
INSERT INTO `ecshop_member_level` VALUES (3, '高级会员', 8001, 20000, 95);
INSERT INTO `ecshop_member_level` VALUES (4, '白金会员', 20001, 50000, 92);
INSERT INTO `ecshop_member_level` VALUES (5, '黄金会员', 50001, 100000, 90);

-- ----------------------------
-- Table structure for ecshop_member_price
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_member_price`;
CREATE TABLE `ecshop_member_price`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goods_id` mediumint(9) NOT NULL COMMENT '商品id',
  `level_id` mediumint(9) NOT NULL COMMENT '级别id',
  `price` decimal(10, 0) NOT NULL COMMENT '这个级别的价格',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `level_id`(`level_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '会员价格表' ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of ecshop_member_price
-- ----------------------------
INSERT INTO `ecshop_member_price` VALUES (40, 2, 5, 1600);
INSERT INTO `ecshop_member_price` VALUES (39, 2, 4, 1700);
INSERT INTO `ecshop_member_price` VALUES (38, 2, 3, 1808);
INSERT INTO `ecshop_member_price` VALUES (37, 2, 2, 1900);
INSERT INTO `ecshop_member_price` VALUES (36, 2, 1, 2000);
INSERT INTO `ecshop_member_price` VALUES (35, 3, 5, 900);
INSERT INTO `ecshop_member_price` VALUES (34, 3, 4, 920);
INSERT INTO `ecshop_member_price` VALUES (33, 3, 3, 950);
INSERT INTO `ecshop_member_price` VALUES (32, 3, 2, 980);
INSERT INTO `ecshop_member_price` VALUES (31, 3, 1, 1000);
INSERT INTO `ecshop_member_price` VALUES (41, 4, 1, 1200);
INSERT INTO `ecshop_member_price` VALUES (42, 4, 2, 1100);
INSERT INTO `ecshop_member_price` VALUES (43, 4, 3, 1000);
INSERT INTO `ecshop_member_price` VALUES (44, 4, 4, 950);
INSERT INTO `ecshop_member_price` VALUES (45, 4, 5, 900);

-- ----------------------------
-- Table structure for ecshop_order
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_order`;
CREATE TABLE `ecshop_order`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员id',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '下单时间',
  `shr_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人姓名',
  `shr_province` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '省',
  `shr_city` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '市',
  `shr_area` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '地区',
  `shr_tel` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人电话',
  `shr_address` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '收货人地址',
  `total_price` decimal(10, 2) NOT NULL COMMENT '定单总价',
  `post_method` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '发货方式',
  `pay_method` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '支付方式',
  `pay_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '支付状态，0：未支付 1：已支付',
  `post_status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '发货状态，0：未发货 1：已发货 2：已收到货',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '定单基本信息' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ecshop_order
-- ----------------------------
INSERT INTO `ecshop_order` VALUES (1, 1, 1481201743, '钟林生', '上海', '东城区', '西二旗', '18296764976', '江西省', 2.00, '顺风', '支付宝', 0, 0);

-- ----------------------------
-- Table structure for ecshop_order_goods
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_order_goods`;
CREATE TABLE `ecshop_order_goods`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` mediumint(8) UNSIGNED NOT NULL COMMENT '定单id',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员id',
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品ID',
  `goods_attr_id` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '选择的属性的ID，如果有多个用，隔开',
  `goods_attr_str` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '选择的属性的字符串',
  `goods_price` decimal(10, 2) NOT NULL COMMENT '商品的价格',
  `goods_number` int(10) UNSIGNED NOT NULL COMMENT '购买的数量',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `order_id`(`order_id`) USING BTREE,
  INDEX `goods_id`(`goods_id`) USING BTREE,
  INDEX `member_id`(`member_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '定单商品' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ecshop_order_goods
-- ----------------------------
INSERT INTO `ecshop_order_goods` VALUES (1, 1, 1, 2, '1,4,6', '像素:1600万<br />内存:16G<br />颜色:白色', 1.00, 2);

-- ----------------------------
-- Table structure for ecshop_reply
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_reply`;
CREATE TABLE `ecshop_reply`  (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '回复的内容',
  `addtime` int(10) UNSIGNED NOT NULL COMMENT '回复时间',
  `member_id` mediumint(8) UNSIGNED NOT NULL COMMENT '会员ID',
  `comment_id` mediumint(8) UNSIGNED NOT NULL COMMENT '评论的ID',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `comment_id`(`comment_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '回复' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for ecshop_role
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_role`;
CREATE TABLE `ecshop_role`  (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '角色名称',
  `auth_id` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '拥有的权限的id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '角色表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of ecshop_role
-- ----------------------------
INSERT INTO `ecshop_role` VALUES (1, '商品管理员', '1,2,3,4,5,6,7,8,9');
INSERT INTO `ecshop_role` VALUES (2, '商品分类管理员', '1,6,7,8,9');
INSERT INTO `ecshop_role` VALUES (3, '超级管理员', '1,2,3,4,5,33,43,44,45,48,6,7,8,9,24,25,26,27,28,29,30,31,34,35,36,37,46,47,10,11,12,13,14,15,16,17,18,19,20,21,22,23,38,39,40,41,42');

-- ----------------------------
-- Table structure for ecshop_type
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_type`;
CREATE TABLE `ecshop_type`  (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '商品类型',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ecshop_type
-- ----------------------------
INSERT INTO `ecshop_type` VALUES (1, '手机');
INSERT INTO `ecshop_type` VALUES (2, '书');
INSERT INTO `ecshop_type` VALUES (3, '光盘');

-- ----------------------------
-- Table structure for ecshop_youhui_price
-- ----------------------------
DROP TABLE IF EXISTS `ecshop_youhui_price`;
CREATE TABLE `ecshop_youhui_price`  (
  `goods_id` mediumint(8) UNSIGNED NOT NULL COMMENT '商品id',
  `youhui_num` int(10) UNSIGNED NOT NULL COMMENT '数量',
  `youhui_price` decimal(10, 2) NOT NULL COMMENT '优惠价格',
  INDEX `goods_id`(`goods_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '商品的优惠价格' ROW_FORMAT = Fixed;

SET FOREIGN_KEY_CHECKS = 1;
