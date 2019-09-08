-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 
-- 服务器版本: 5.5.53
-- PHP 版本: 7.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `kangliyan`
--

-- --------------------------------------------------------

--
-- 表的结构 `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `address_name` varchar(30) DEFAULT NULL COMMENT '收件人名字',
  `address` varchar(80) DEFAULT NULL COMMENT '详情地址',
  `address_mobile` char(11) DEFAULT NULL COMMENT '手机号码',
  `zip_code` varchar(15) DEFAULT NULL COMMENT '邮编',
  `address_mail` varchar(30) DEFAULT NULL COMMENT '邮箱',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `address`
--

INSERT INTO `address` (`id`, `address_name`, `address`, `address_mobile`, `zip_code`, `address_mail`) VALUES
(1, '徐志聪', '广东省广州市白云区', '13711420797', '87875980', '103203@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `comfireorder`
--

CREATE TABLE IF NOT EXISTS `comfireorder` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '订单ID',
  `order_num` varchar(30) DEFAULT NULL COMMENT '订单编号',
  `pro_id` int(10) DEFAULT NULL COMMENT '产品ID',
  `pro_name` varchar(30) DEFAULT NULL COMMENT '产品名称',
  `pro_size` varchar(30) DEFAULT NULL COMMENT '产品属性',
  `pro_color` varchar(40) DEFAULT NULL COMMENT '产品图片',
  `pro_num` int(10) DEFAULT NULL COMMENT '产品数量',
  `pro_price` float(10,2) DEFAULT NULL COMMENT '产品单价',
  `pro_total` float(10,2) DEFAULT NULL COMMENT '产品总价',
  `user_id` int(10) DEFAULT NULL COMMENT '用户ID',
  `username` varchar(30) DEFAULT NULL COMMENT '用户名',
  `address_name` varchar(30) DEFAULT NULL COMMENT '收件人',
  `address_mobile` char(11) DEFAULT NULL COMMENT '手机',
  `address` varchar(80) DEFAULT NULL COMMENT '地址',
  `zip_code` varchar(20) DEFAULT NULL COMMENT '邮编',
  `create_time` int(10) DEFAULT NULL COMMENT '生成时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=68 ;

--
-- 转存表中的数据 `comfireorder`
--

INSERT INTO `comfireorder` (`id`, `order_num`, `pro_id`, `pro_name`, `pro_size`, `pro_color`, `pro_num`, `pro_price`, `pro_total`, `user_id`, `username`, `address_name`, `address_mobile`, `address`, `zip_code`, `create_time`, `update_time`) VALUES
(67, '216136020181225', NULL, '秋泓齐 春秋季长袖可爱猫头鹰睡裙 韩版卡通女人宽松家居服睡裙', '160（M）', '/static/home/img/color_01_16.jpg', 2, 41.00, NULL, NULL, NULL, '徐志聪', '13711420797', '广东省广州市白云区', '87875980', NULL, NULL),
(64, '216136020181225', NULL, '秋泓齐 春秋季长袖可爱猫头鹰睡裙 韩版卡通女人宽松家居服睡裙', '160（M）', '/static/home/img/color_01_16.jpg', 1, 41.00, NULL, NULL, NULL, '徐志聪', '13711420797', '广东省广州市白云区', '87875980', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `cate_id` int(10) NOT NULL,
  `cate_name` varchar(20) NOT NULL,
  `url_path` varchar(30) NOT NULL,
  `is_show` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- 转存表中的数据 `menu`
--

INSERT INTO `menu` (`id`, `cate_id`, `cate_name`, `url_path`, `is_show`) VALUES
(1, 0, '后台    ', '', 1),
(2, 0, '前台', '', 1),
(3, 1, '菜单分类管理', '', 1),
(4, 3, '菜单分类列表', 'admin/menu/index', 1),
(5, 1, '管理员管理', '', 1),
(6, 5, '管理员列表', 'admin/user/index', 1),
(7, 5, '权限分配列表', 'admin/level/index', 1),
(8, 1, '图片管理', '', 1),
(9, 8, 'Banner图片 ', 'admin/picture/banner', 1),
(11, 1, '商品管理', '', 1),
(12, 11, '商品分类', 'admin/procategory/index', 1),
(14, 1, '订单管理', '', 1),
(15, 14, '国内新闻列表  ', 'ctl=news&act=index', 1),
(16, 2, '首页 ', 'ctl=index', 1),
(18, 25, '最新资讯', '', 1),
(19, 25, '国内新闻', '', 1),
(20, 25, '区域动态 ', '', 1),
(21, 25, '出游攻略', '', 1),
(22, 1, '售后管理', '', 1),
(23, 22, '境外旅游产品', 'ctl=product&act=index', 1),
(24, 2, '公司介绍', 'ctl=about', 1),
(25, 2, '国内旅游', 'ctl=news', 1),
(26, 2, '境外旅游', 'ctl=product', 1),
(27, 2, '联系我们', 'ctl=contact', 1),
(28, 1, '问题反馈 ', '', 1),
(29, 28, '评论列表', 'ctl=feedback&act=index', 1),
(31, 24, '公司简介', '', 1),
(32, 24, '企业文化', '', 1),
(33, 24, '发展历程', '', 1),
(34, 24, '经营理念', '', 1),
(35, 26, '澳新南太', '', 1),
(36, 26, '美洲游', '', 1),
(37, 26, '欧洲游', '', 1),
(38, 26, '中东非', '', 1),
(39, 1, '联系管理', '', 1),
(40, 39, '联系列表', 'ctl=contact&act=index', 1),
(41, 8, 'Logo图片', 'admin/picture/logo', 1),
(42, 5, '角色管理', 'admin/role/index', 1),
(44, 11, '商品列表', 'admin/shops/index', 1),
(46, 42, '添加功能', 'admin/role/add', 0),
(47, 42, '编辑功能', 'admin/role/editor', 0),
(48, 3, '前台导航管理', 'admin/nav/index', 1);

-- --------------------------------------------------------

--
-- 表的结构 `nav`
--

CREATE TABLE IF NOT EXISTS `nav` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `nav_id` int(10) NOT NULL COMMENT '导航ID',
  `nav_name` varchar(20) NOT NULL COMMENT '导航名称',
  `url_path` varchar(30) NOT NULL COMMENT '路径',
  `is_show` int(3) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `nav`
--

INSERT INTO `nav` (`id`, `nav_id`, `nav_name`, `url_path`, `is_show`) VALUES
(1, 0, '顶部导航', '', 0),
(2, 0, '中间导航', '', 0),
(3, 0, '底部导航', '', 0),
(4, 1, '我的订单', 'index/comfireorder/order', 1),
(5, 1, '会员中心', '', 1),
(6, 1, '客户服务', '', 1),
(7, 1, '企业采购', '', 1),
(8, 1, '网站导航', '', 1),
(9, 2, '首页', 'index/index/index', 1),
(10, 2, '聚划算', 'index/shoplist/index', 1),
(11, 2, '包邮专区', 'index/shoplist/index', 1),
(12, 2, '正在热卖', 'index/shoplist/index', 1),
(13, 2, '设计师', 'index/shoplist/index', 1),
(14, 2, '天天特价', 'index/shoplist/index', 1),
(15, 3, '购物指南', '', 1),
(16, 3, '配送方式', '', 1),
(17, 3, '支付方式', '', 1),
(18, 3, '售后服务', '', 1),
(19, 15, '免费注册', '', 1),
(20, 15, '购物流程', '', 1),
(21, 15, '会员介绍', '', 1),
(22, 15, '常见问题', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `pay`
--

CREATE TABLE IF NOT EXISTS `pay` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `order_num` varchar(40) DEFAULT NULL COMMENT '订单编号',
  `consignee` varchar(30) DEFAULT NULL COMMENT '收货人',
  `receiving_add` varchar(120) DEFAULT NULL COMMENT '收货人地址',
  `con_mobile` char(11) DEFAULT NULL COMMENT '收货人电话',
  `pay_method` varchar(30) DEFAULT NULL COMMENT '付款方式',
  `total_price` float(10,2) DEFAULT NULL COMMENT '订单总价',
  `frieight` float(10,2) DEFAULT NULL COMMENT '运费',
  `service` float(10,2) DEFAULT NULL COMMENT '服务费',
  `replacement` float(10,2) DEFAULT NULL COMMENT '退换无忧',
  `status` varchar(30) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `pay`
--

INSERT INTO `pay` (`id`, `order_num`, `consignee`, `receiving_add`, `con_mobile`, `pay_method`, `total_price`, `frieight`, `service`, `replacement`, `status`) VALUES
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '247517220181210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '757584020181210', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `pro_category`
--

CREATE TABLE IF NOT EXISTS `pro_category` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `pro_cate_id` int(10) DEFAULT NULL COMMENT '产品分类ID',
  `pro_cate_name` varchar(30) DEFAULT NULL COMMENT '产品分类名称',
  `pro_url_path` varchar(40) DEFAULT NULL COMMENT '产品分类路径',
  `is_show` int(3) DEFAULT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `pro_category`
--

INSERT INTO `pro_category` (`id`, `pro_cate_id`, `pro_cate_name`, `pro_url_path`, `is_show`) VALUES
(10, 7, '休闲', '', 1),
(9, 7, '套头', '', 1),
(8, 0, '男士睡衣', '', 1),
(7, 0, '女士睡衣', '', 1),
(11, 7, '睡眠', '', 1),
(12, 10, '休闲牛仔', '', 1);

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `rolename` varchar(30) DEFAULT NULL COMMENT '角色名称',
  `desc` varchar(30) DEFAULT NULL COMMENT '权限',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `rolename`, `desc`, `create_time`) VALUES
(1, '超级管理员', '最高权限', 1544697133),
(2, '高级管理员', '最高权限之下', 1544697207),
(3, '一般员工', '一般权限', 1544697378);

-- --------------------------------------------------------

--
-- 表的结构 `role_menu`
--

CREATE TABLE IF NOT EXISTS `role_menu` (
  `role_id` int(10) DEFAULT NULL COMMENT '角色ID',
  `cate_id` int(10) DEFAULT NULL COMMENT '菜单ID',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `static` tinyint(3) DEFAULT NULL COMMENT '状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `role_menu`
--

INSERT INTO `role_menu` (`role_id`, `cate_id`, `create_time`, `update_time`, `static`) VALUES
(2, 47, NULL, NULL, NULL),
(2, 46, NULL, NULL, NULL),
(2, 42, NULL, NULL, NULL),
(2, 7, NULL, NULL, NULL),
(2, 6, NULL, NULL, NULL),
(2, 5, NULL, NULL, NULL),
(2, 8, NULL, NULL, NULL),
(2, 41, NULL, NULL, NULL),
(3, 48, NULL, NULL, NULL),
(2, 3, NULL, NULL, NULL),
(2, 9, NULL, NULL, NULL),
(2, 48, NULL, NULL, NULL),
(3, 4, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `shops`
--

CREATE TABLE IF NOT EXISTS `shops` (
  `shops_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品ID',
  `shops_name` varchar(30) DEFAULT NULL COMMENT '商品名称',
  `shops_num` varchar(20) DEFAULT NULL COMMENT '商品编号',
  `shops_cate` int(10) DEFAULT NULL COMMENT '商品分类ID',
  `shops_image` varchar(60) DEFAULT NULL COMMENT '商品首页大图/列表大图',
  `is_display` tinyint(2) DEFAULT NULL COMMENT '是否上架：1上架，0下架',
  `is_hot` tinyint(2) DEFAULT NULL COMMENT '是否热销：1热销，0不热销',
  `is_news` tinyint(2) DEFAULT NULL COMMENT '是否新品',
  `is_best` tinyint(2) DEFAULT NULL COMMENT '是否推荐',
  `shops_desc` text COMMENT '商品描述',
  `shops_sort` int(11) DEFAULT NULL COMMENT '商品置顶',
  `seo_keyword` varchar(50) DEFAULT NULL COMMENT 'seo优化关键字',
  `is_freight` tinyint(2) DEFAULT NULL COMMENT '是否包邮',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`shops_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `shops_image`
--

CREATE TABLE IF NOT EXISTS `shops_image` (
  `shops_id` int(11) DEFAULT NULL,
  `image_path` varchar(150) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  `static` int(11) DEFAULT NULL,
  `other_image` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `shop_cart`
--

CREATE TABLE IF NOT EXISTS `shop_cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '购物车ID',
  `pro_id` int(10) DEFAULT NULL COMMENT '产品ID',
  `pro_name` varchar(120) DEFAULT NULL COMMENT '产品名称',
  `price` float(10,2) DEFAULT NULL COMMENT '价格',
  `pro_price` float(10,2) DEFAULT NULL COMMENT '促销价',
  `pro_size` varchar(40) DEFAULT NULL COMMENT '尺码大小',
  `pro_color` varchar(40) DEFAULT NULL COMMENT '产品颜色',
  `pro_num` int(10) DEFAULT NULL COMMENT '购物数量',
  `user_id` int(10) DEFAULT NULL COMMENT '用户ID',
  `usesname` varchar(20) DEFAULT NULL COMMENT '用户名',
  `image_path` varchar(100) DEFAULT NULL COMMENT '产品图片路径',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `updat_time` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `shop_cart`
--

INSERT INTO `shop_cart` (`id`, `pro_id`, `pro_name`, `price`, `pro_price`, `pro_size`, `pro_color`, `pro_num`, `user_id`, `usesname`, `image_path`, `create_time`, `updat_time`) VALUES
(18, NULL, '秋泓齐 春秋季长袖可爱猫头鹰睡裙 韩版卡通女人宽松家居服睡裙', 328.00, 41.00, '165（L）', '/static/home/img/color_01_16.jpg', 1, NULL, NULL, NULL, NULL, NULL),
(20, NULL, '秋泓齐 春秋季长袖可爱猫头鹰睡裙 韩版卡通女人宽松家居服睡裙', 328.00, 41.00, '165（L）', '/static/home/img/color_01_16.jpg', 3, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(30) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `mobile` varchar(20) NOT NULL COMMENT '手机',
  `mail` varchar(30) NOT NULL COMMENT '邮箱',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=118 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `mobile`, `mail`, `create_time`, `update_time`) VALUES
(113, '123', '202cb962ac59075b964b07152d234b70', '123', '123', 1545276395, 1545298393),
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '110', '110', 1545296199, 1545296199);

-- --------------------------------------------------------

--
-- 表的结构 `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `create_time` int(10) DEFAULT NULL COMMENT '创建时间',
  `update_time` int(10) DEFAULT NULL COMMENT '更新时间',
  `static` tinyint(3) DEFAULT NULL COMMENT '状态'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`, `create_time`, `update_time`, `static`) VALUES
(113, 2, 1545276395, 1545298393, NULL),
(1, 1, 1545296199, 1545296199, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
