-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-09-16 05:39:34
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `home`
--

-- --------------------------------------------------------

--
-- 表的结构 `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `province` varchar(256) NOT NULL,
  `city` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `telephone` char(11) NOT NULL,
  `zcode` char(6) NOT NULL COMMENT '邮编',
  `host` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='收货地址' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `address`
--

INSERT INTO `address` (`id`, `uid`, `province`, `city`, `address`, `name`, `telephone`, `zcode`, `host`) VALUES
(1, 3, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 0),
(2, 3, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 0),
(3, 3, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 0),
(4, 4, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 0),
(5, 4, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 1),
(6, 4, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 0);

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'jin123456batjin123456bat', '250cf8b51c773f3f8dc8b4be867a9a02', 1),
(3, 'jin123456bat', 'b99f1a1c875c4f200449dc55eb4b77a6', 1),
(6, 'test', '098f6bcd4621d373cade4e832627b4f6', 1);

-- --------------------------------------------------------

--
-- 表的结构 `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `logo` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `close` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `brand`
--

INSERT INTO `brand` (`id`, `name`, `logo`, `description`, `close`) VALUES
(1, '雕牌', '', '123', 0),
(2, '飞利浦', '', 'abdsaer', 0),
(3, '牛逼', '', '<html>', 0),
(4, '测啊', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', '啊但是是打发打发', 0),
(5, '哇哈啊哈', 'D:/wamp/www/home/application/upload/c1fed7b4f8e10e08afdb7d9ab5a2584be5e4327a605a1d008871407ab186d56c168b28ea.jpg', '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `carousel`
--

CREATE TABLE IF NOT EXISTS `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL COMMENT '标题',
  `pic` varchar(256) NOT NULL COMMENT '图片地址',
  `stop` tinyint(2) NOT NULL COMMENT '停留时间',
  `type` enum('product','theme','url','none') NOT NULL COMMENT '连接方式',
  `src` varchar(512) NOT NULL COMMENT '连接的地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `pic`, `stop`, `type`, `src`) VALUES
(1, '4', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 5, 'product', '83'),
(2, '标题', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 5, 'url', ''),
(4, '测试内容', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 5, 'product', '82'),
(40, '', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 0, 'none', '');

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '产品id',
  `content` text NOT NULL COMMENT 'collection中的集合',
  `num` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `icon` varchar(256) NOT NULL,
  `cid` int(11) NOT NULL COMMENT '上级分类id，为0顶级分类',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `icon`, `cid`) VALUES
(22, '衣服', '', 0),
(23, '家电', '', 0),
(24, '木材', '', 22),
(25, '男装', '', 22),
(26, '女装', '', 32),
(27, '上衣', '', 24),
(28, '裤子', '', 26),
(29, '鞋子', '', 25),
(30, '上衣', '', 26),
(31, '123', '', 26),
(32, 'bao', '', 22),
(33, 'New node', '', 26),
(34, 'New node', '', 22),
(35, 'New node', '', 22),
(36, '13123123', '', 22),
(37, '你好吗', '', 23);

-- --------------------------------------------------------

--
-- 表的结构 `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `content` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `sku` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- 转存表中的数据 `collection`
--

INSERT INTO `collection` (`id`, `pid`, `content`, `stock`, `price`, `sku`) VALUES
(93, 78, 'a:1:{i:70;s:1:"0";}', 0, 0.00, ''),
(94, 78, 'a:1:{i:70;s:1:"1";}', 0, 0.00, ''),
(95, 78, 'a:1:{i:70;s:1:"2";}', 0, 0.00, '');

-- --------------------------------------------------------

--
-- 表的结构 `combine`
--

CREATE TABLE IF NOT EXISTS `combine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid1` int(11) NOT NULL,
  `pid2` int(11) NOT NULL,
  `pid3` int(11) NOT NULL,
  `pid4` int(11) NOT NULL,
  `pid5` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='组合购买' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `content` text NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `uid`, `pid`, `time`, `content`, `score`) VALUES
(17, 3, 78, 1442313292, 'id为78的商品的评价', 4),
(18, 3, 79, 1442313292, 'id为79的商品的评价', 3),
(19, 3, 78, 1442313321, 'id为78的商品的评价', 4),
(20, 3, 79, 1442313321, 'id为79的商品的评价', 3),
(21, 3, 78, 1442313333, 'id为78的商品的评价', 4),
(22, 3, 79, 1442313333, 'id为79的商品的评价', 3);

-- --------------------------------------------------------

--
-- 表的结构 `comment_pic`
--

CREATE TABLE IF NOT EXISTS `comment_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '评论id',
  `pic_path` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponno` char(16) NOT NULL COMMENT '优惠码编号',
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '限定用户',
  `total` int(11) NOT NULL COMMENT '总共使用次数',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `times` int(11) NOT NULL COMMENT '剩余使用次数',
  `max` double(10,2) NOT NULL,
  `display` tinyint(1) NOT NULL COMMENT '是否所有用户都可以使用',
  `type` enum('fixed','discount') NOT NULL,
  `value` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `couponno` (`couponno`),
  KEY `uid` (`uid`),
  KEY `display` (`display`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='优惠券打折码' AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `coupon`
--

INSERT INTO `coupon` (`id`, `couponno`, `uid`, `total`, `starttime`, `endtime`, `times`, `max`, `display`, `type`, `value`) VALUES
(11, '150809034519TWJF', 0, 100, 1439063121, 1439149521, 100, 0.00, 0, 'discount', 0.70),
(16, '150819155201IAXQ', 0, 121354, 1437840000, 1446048000, 121354, 100.00, 1, 'fixed', 50.00),
(17, '150819155228XFV5', 0, 321, 1437840000, 1446048000, 321, 200.00, 1, 'discount', 0.50),
(18, '150819155456YATT', 0, 12, 1437840000, 1441382400, 12, 200.00, 1, 'discount', 0.90),
(19, '150819155519XPVE', 0, 11, 1437926400, 1441382400, 11, 123.00, 0, 'fixed', 66.00),
(21, '1509151613276D8U', 17, 1, 1442304822, 1442391222, 1, 0.00, 0, 'discount', 0.80);

-- --------------------------------------------------------

--
-- 表的结构 `coupondetail`
--

CREATE TABLE IF NOT EXISTS `coupondetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `couponid` (`couponid`),
  KEY `categoryid` (`categoryid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- 转存表中的数据 `coupondetail`
--

INSERT INTO `coupondetail` (`id`, `couponid`, `categoryid`) VALUES
(7, 11, 0),
(13, 16, 0),
(14, 17, 0),
(15, 18, 0),
(16, 19, 24),
(18, 21, 0);

-- --------------------------------------------------------

--
-- 表的结构 `favourite`
--

CREATE TABLE IF NOT EXISTS `favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `flag`
--

CREATE TABLE IF NOT EXISTS `flag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `file` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `flag`
--

INSERT INTO `flag` (`id`, `name`, `file`) VALUES
(1, '中国', 'D:/wamp/www/home/application/assets/flag/39c0e05dfda7d6de3c27ebfc31f97141883c7ec656be57964afc6581063b36ace048ebf9.jpg'),
(2, '阿尔巴尼亚', 'D:/wamp/www/home/application/assets/flag/c1fed7b4f8e10e08afdb7d9ab5a2584be5e4327a605a1d008871407ab186d56c168b28ea.jpg'),
(3, '阿塞拜疆', 'D:/wamp/www/home/application/assets/flag/674c43602a331c30696c238ee145b148deb4417dbe1f6f6eb20d54e3ee7a810e3595eee3.jpg'),
(4, '爱尔兰', 'D:/wamp/www/home/application/assets/flag/b88ec5eb8086bfd5650851b7737c3bdcfb2320359463164ce7c0e7d035c295b9e997fe62.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `fullcut`
--

CREATE TABLE IF NOT EXISTS `fullcut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(256) NOT NULL,
  `max` int(11) NOT NULL,
  `minus` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `fullcut`
--

INSERT INTO `fullcut` (`id`, `sname`, `max`, `minus`, `starttime`, `endtime`) VALUES
(8, '哈哈哈', 100, 20, 1437840000, 1444406700);

-- --------------------------------------------------------

--
-- 表的结构 `fullcutdetail`
--

CREATE TABLE IF NOT EXISTS `fullcutdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fid` (`fid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fullcutdetail`
--

INSERT INTO `fullcutdetail` (`id`, `fid`, `pid`) VALUES
(2, 8, 80);

-- --------------------------------------------------------

--
-- 表的结构 `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `help`
--

INSERT INTO `help` (`id`, `title`, `content`) VALUES
(4, '相关法规', '&lt;p&gt;啊都发大水发射点&lt;/p&gt;');

-- --------------------------------------------------------

--
-- 表的结构 `hotorder`
--

CREATE TABLE IF NOT EXISTS `hotorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `hotorder`
--

INSERT INTO `hotorder` (`id`, `pid`, `orderby`) VALUES
(4, 78, 1),
(5, 79, 1),
(6, 80, 1);

-- --------------------------------------------------------

--
-- 表的结构 `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `log`
--

INSERT INTO `log` (`id`, `username`, `time`, `content`) VALUES
(1, 'jin123456bat', 1442370329, '登陆了系统'),
(2, 'jin123456bat', 1442370333, '登陆了系统');

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `uid`, `time`, `content`) VALUES
(1, 3, 123456789, 'asdfasdfadsf');

-- --------------------------------------------------------

--
-- 表的结构 `o2ouser`
--

CREATE TABLE IF NOT EXISTS `o2ouser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `qq` varchar(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `rate` double(10,4) NOT NULL COMMENT '佣金比例',
  `num` int(11) NOT NULL,
  `money` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `o2ouser`
--

INSERT INTO `o2ouser` (`id`, `uid`, `ctime`, `name`, `qq`, `address`, `rate`, `num`, `money`) VALUES
(8, 3, 1439448013, '', '', '', 0.3000, 0, 270.00),
(9, 15, 1439534856, '', '', '', 0.0020, 0, 0.00),
(10, 17, 1440571174, '金程晨', '326550324', '杭州西湖区', 0.5000, 0, 0.00);

-- --------------------------------------------------------

--
-- 表的结构 `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '订单id',
  `sku` varchar(256) NOT NULL COMMENT '产品编码',
  `pid` int(11) NOT NULL COMMENT '产品id',
  `productname` varchar(256) NOT NULL COMMENT '货物名称',
  `unitprice` double(10,2) NOT NULL COMMENT '单价',
  `content` text NOT NULL COMMENT '能够标识商品唯一性的可选属性集合',
  `prototype` text NOT NULL COMMENT '属性集合',
  `origin` varchar(256) NOT NULL COMMENT '产销国',
  `score` int(11) NOT NULL COMMENT '涉及的积分',
  `num` int(11) NOT NULL COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单中的货物信息' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `oid`, `sku`, `pid`, `productname`, `unitprice`, `content`, `prototype`, `origin`, `score`, `num`) VALUES
(8, 14, '', 55, '飞利浦', 499.00, '', '', '中国', 0, 1),
(9, 15, '', 78, '飞利浦', 499.00, '', '长度:123米,宽度:25', '中国', 0, 1),
(10, 16, '', 79, '飞利浦', 499.00, '', '长度:123米,宽度:25,大小:23材料:石头', '中国', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `orderlist`
--

CREATE TABLE IF NOT EXISTS `orderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL COMMENT '生成订单时的账号',
  `paytype` varchar(256) NOT NULL COMMENT '支付方式',
  `paynumber` varchar(256) NOT NULL COMMENT '支付编号',
  `ordertotalamount` double(10,2) NOT NULL COMMENT '订单总金额',
  `orderno` varchar(256) NOT NULL COMMENT '订单编号',
  `ordertaxamount` double(10,2) NOT NULL COMMENT '订单税款',
  `ordergoodsamount` double(10,2) NOT NULL COMMENT '订单货款',
  `feeamount` double(10,2) NOT NULL COMMENT '运费',
  `tradetime` int(11) NOT NULL COMMENT '成交时间',
  `createtime` int(11) NOT NULL COMMENT '创建时间',
  `totalamount` double(10,2) NOT NULL COMMENT '成交总价',
  `consignee` varchar(256) NOT NULL COMMENT '收件人',
  `consigneetel` char(11) NOT NULL COMMENT '收件人电话',
  `consigneeaddress` varchar(256) NOT NULL COMMENT '收件人地址',
  `consigneeprovince` varchar(20) NOT NULL,
  `consigneecity` varchar(20) NOT NULL,
  `postmode` varchar(256) NOT NULL COMMENT '物流方式',
  `waybills` varchar(256) NOT NULL COMMENT '运单号使用数组的序列化',
  `sendername` varchar(256) NOT NULL COMMENT '发件人',
  `companyname` varchar(256) NOT NULL COMMENT '公司名称',
  `zipcode` char(6) NOT NULL COMMENT '邮编',
  `note` varchar(256) NOT NULL COMMENT '额外描述',
  `status` int(11) NOT NULL COMMENT '订单状态',
  `discount` double(10,2) NOT NULL COMMENT '使用了什么折扣',
  `client` enum('web','wap','weixin','ios','android') NOT NULL,
  `action_type` int(11) NOT NULL DEFAULT '1' COMMENT '是否已经报过财付通接口，1没有，2已经报过',
  `ship_score` tinyint(1) NOT NULL DEFAULT '0' COMMENT '物流评分',
  `service_score` tinyint(1) NOT NULL DEFAULT '0' COMMENT '服务评分',
  `goods_score` tinyint(1) NOT NULL DEFAULT '0' COMMENT '商品评分',
  `content` varchar(512) NOT NULL DEFAULT '' COMMENT '评价',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `orderlist`
--

INSERT INTO `orderlist` (`id`, `uid`, `paytype`, `paynumber`, `ordertotalamount`, `orderno`, `ordertaxamount`, `ordergoodsamount`, `feeamount`, `tradetime`, `createtime`, `totalamount`, `consignee`, `consigneetel`, `consigneeaddress`, `consigneeprovince`, `consigneecity`, `postmode`, `waybills`, `sendername`, `companyname`, `zipcode`, `note`, `status`, `discount`, `client`, `action_type`, `ship_score`, `service_score`, `goods_score`, `content`) VALUES
(14, 3, 'alipay', '2015090900001000060062404132', 900.00, '20150909214006205544', 0.00, 12.00, 0.00, 0, 1439797592, 0.01, '金', '18548143019', '浙大科技园B606', '浙江', '杭州', 'SF', '', '我们家', '我们家', '301100', '你好吗？', 1, 0.00, 'web', 1, 0, 0, 0, ''),
(15, 3, 'weixin', '', 12.00, '20150911103424207325', 0.00, 12.00, 0.00, 0, 1439797983, 0.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'SF', '', '我们家', '我们家', '301100', '凑合吧', 6, 0.00, 'web', 1, 5, 5, 5, '评价内容'),
(16, 3, 'alipay', '', 12.00, '2015081715553336343', 0.00, 12.00, 0.00, 0, 1442208991, 0.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'SF', '', '我们家', '我们家', '301100', '', 0, 0.00, 'web', 1, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `sku` varchar(256) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `bid` int(11) NOT NULL COMMENT '品牌',
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `short_description` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `origin` int(11) NOT NULL,
  `label` varchar(256) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `orderby` int(11) NOT NULL,
  `meta_title` varchar(256) NOT NULL,
  `meta_keywords` varchar(512) NOT NULL,
  `meta_description` varchar(256) NOT NULL,
  `oldprice` double(10,2) NOT NULL COMMENT '市场价',
  `shipchar` varchar(32) NOT NULL COMMENT '邮递方式,就是app显示用的',
  `score` int(11) NOT NULL COMMENT '购买赠送积分',
  `activity` enum('seckill','fullcut','combine','sale','') NOT NULL COMMENT '活动类型',
  `ordernum` int(11) NOT NULL,
  `complete_ordernum` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`),
  KEY `origin` (`origin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=86 ;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `category`, `bid`, `starttime`, `endtime`, `description`, `short_description`, `price`, `stock`, `origin`, `label`, `status`, `orderby`, `meta_title`, `meta_keywords`, `meta_description`, `oldprice`, `shipchar`, `score`, `activity`, `ordernum`, `complete_ordernum`, `time`) VALUES
(78, '好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字', '测试商品', 22, 0, 1440864000, 1440864000, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;div class=&quot;sub-wrap&quot; id=&quot;J_SubWrap&quot; style=&quot;margin: 0px; padding: 0px; position: relative; z-index: 99999998; width: 750px; color: rgb(0, 0, 0); font-family: tahoma, arial, &amp;#39;Hiragino Sans GB&amp;#39;, 宋体, sans-serif; font-size: 12px; line-height: 18px; white-space: normal;&quot;&gt;&lt;div id=&quot;description&quot; class=&quot;tshop-psm ke-post J_DetailSection&quot; style=&quot;margin: 0px 0px 20px; padding: 0px; clear: both; font-stretch: normal; font-size: 14px; line-height: 1.5; font-family: tahoma, arial, 宋体, sans-serif; background-image: initial !important; background-attachment: initial !important; background-size: initial !important; background-origin: initial !important; background-clip: initial !important; background-position: initial !important; background-repeat: initial !important;&quot;&gt;&lt;div class=&quot;content&quot; id=&quot;J_DivItemDesc&quot; style=&quot;margin: 0px; padding: 10px 0px 0px; width: 750px; word-wrap: break-word; overflow: hidden; position: relative !important;&quot;&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332495&quot; data-title=&quot;2.场景图&quot; id=&quot;ids-module-5332495&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i2/1753596474/TB260aEcFXXXXcOXXXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332498&quot; data-title=&quot;3.产品细节&quot; id=&quot;ids-module-5332498&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i3/1753596474/TB2VXyBcFXXXXaSXpXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2sew_dFXXXXcsXXXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2F2AUdFXXXXbKXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;605&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i2/1753596474/TB2Lkc2dFXXXXXZXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;606&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2QcoSdFXXXXcDXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;605&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB28oJcdVXXXXaRXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;607&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i3/1753596474/TB2g2NadVXXXXbFXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;212&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2OpU_dFXXXXcqXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;285&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB2cL0idVXXXXXDXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;284&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB28twVdFXXXXbxXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;385&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i3/1753596474/TB2T4cTdFXXXXb4XpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;237&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2bsMWdFXXXXaVXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;237&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332500&quot; data-title=&quot;4.产品参数&quot; id=&quot;ids-module-5332500&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB24ceJcFXXXXX6XXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;104&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2GuEMcVXXXXbCXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;573&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332503&quot; data-title=&quot;5.关于材质&quot; id=&quot;ids-module-5332503&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i2/1753596474/TB2Eh1FcFXXXXb3XXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;104&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;关于材质1&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2xZyOcFXXXXbMXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;1085&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332506&quot; data-title=&quot;6.关于包装&quot; id=&quot;ids-module-5332506&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2pAyIcFXXXXalXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;104&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;关于包装1&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB2zHyLcFXXXXXxXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;446&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;J_AsyncDC tb-custom-area tb-shop&quot; data-type=&quot;main&quot; id=&quot;J_AsyncDCMain&quot; style=&quot;margin: 0px; padding: 0px; overflow: hidden; position: relative; color: rgb(0, 0, 0); font-family: tahoma, arial, &amp;#39;Hiragino Sans GB&amp;#39;, 宋体, sans-serif; font-size: 12px; line-height: 18px; white-space: normal;&quot;&gt;&lt;div class=&quot;J_TModule&quot; data-widgetid=&quot;5499259944&quot; id=&quot;shop5499259944&quot; data-componentid=&quot;5003&quot; data-spm=&quot;110.0.5003-5499259944&quot; microscope-data=&quot;5003-5499259944&quot; data-title=&quot;自定义内容区&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div class=&quot;skin-box tb-module tshop-pbsm tshop-pbsm-shop-self-defined&quot; style=&quot;margin: 0px 0px 10px; padding: 0px;&quot;&gt;&lt;span class=&quot;skin-box-tp&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;div class=&quot;skin-box-bd clear-fix&quot; style=&quot;margin: 0px; padding: 0px; border: none; line-height: 1.2; overflow: hidden; width: 750px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://ziin.taobao.com/p/show.htm?spm=a1z10.1.w5003-3906820604.2.UdyyhK&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i2/1753596474/TB2HIfMbFXXXXagXpXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 展会与获奖&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=36609723293&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i3/1753596474/TB2xnvEbFXXXXcNXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-01-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=40867255257&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i1/1753596474/TB2BBzIbFXXXXbnXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-02-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=35431098304&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i4/1753596474/TB2fHjAbFXXXXaRXpXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-03-01-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=35431437171&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i4/1753596474/TB2mYYFbFXXXXcYXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-03-02-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://ziin.taobao.com/p/show.htm?scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img alt=&quot;关于我们&quot; src=&quot;https://gdp.alicdn.com/imgextra/i2/1753596474/TB2M3bxbFXXXXclXpXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;&lt;span class=&quot;skin-box-bt&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;J_TModule&quot; data-widgetid=&quot;3061597196&quot; id=&quot;shop3061597196&quot; data-componentid=&quot;5003&quot; data-spm=&quot;110.0.5003-3061597196&quot; microscope-data=&quot;5003-3061597196&quot; data-title=&quot;自定义内容区&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div class=&quot;skin-box tb-module tshop-pbsm tshop-pbsm-shop-self-defined&quot; style=&quot;margin: 0px 0px 10px; padding: 0px;&quot;&gt;&lt;span class=&quot;skin-box-tp&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;div class=&quot;skin-box-bd clear-fix&quot; style=&quot;margin: 0px; padding: 0px; border: none; line-height: 1.2; overflow: hidden; width: 750px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://ziin.taobao.com/p/reports.htm?scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i3/1753596474/TB2.4C4bXXXXXchXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 材料与工艺&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;&lt;span class=&quot;skin-box-bt&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;J_TModule&quot; data-widgetid=&quot;10973236815&quot; id=&quot;shop10973236815&quot; data-componentid=&quot;5003&quot; data-spm=&quot;110.0.5003-10973236815&quot; microscope-data=&quot;5003-10973236815&quot; data-title=&quot;自定义内容区&quot; data-spm-max-idx=&quot;1&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div class=&quot;skin-box tb-module tshop-pbsm tshop-pbsm-shop-self-defined&quot; style=&quot;margin: 0px 0px 10px; padding: 0px;&quot;&gt;&lt;span class=&quot;skin-box-tp&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;div class=&quot;skin-box-bd clear-fix&quot; style=&quot;margin: 0px; padding: 0px; border: none; line-height: 1.2; overflow: hidden; width: 750px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://favorite.taobao.com/popup/add_collection.htm?spm=2013.1.w5003-10973236815.1.U03jQZ&amp;id=105552592&amp;itemid=105552592&amp;itemtype=0&amp;sellerid=1753596474&amp;scjjc=2&amp;_tb_token_=e333baee107ee&amp;t=1375380689905&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; data-spm-wangpu-module-id=&quot;5003-10973236815&quot; data-spm-anchor-id=&quot;2013.1.w5003-10973236815.1&quot; style=&quot;text-decoration: underline; color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i4/1753596474/TB224mtbXXXXXcmXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 关于服务new&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字', 99999999.99, 0, 1, '', 1, 0, '', '', '', 0.00, '', 0, 'seckill', 0, 0, 1440927191),
(79, '测试商品', '策划', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, 1, '', 1, 0, '', '', '', 0.00, '', 0, 'sale', 0, 0, 0),
(80, '名称', '添加名称', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, 1, '', 1, 0, '', '', '', 0.00, '', 0, 'fullcut', 0, 0, 0),
(81, '测试名称啊啊啊啊啊啊啊啊啊啊啊', '变啊妈啊的fads发', 0, 0, 0, 0, '', '', 0.00, 0, 1, '1', 2, 0, '', '', '', 0.00, '0', 0, '', 0, 0, 1440787987),
(82, '123', '321', 0, 0, 1440864000, 1440864000, '', '', 1.00, 1, 1, '1', 1, 0, '', '', '烦烦烦', 1.00, '0', 0, '', 0, 0, 1440927992),
(83, '名称', '编码', 22, 1, 1439222400, 1441036800, '长描述&lt;p&gt;\n															\n														&lt;/p&gt;', '短描述', 123.00, 10, 1, '1', 0, 999, '元标题', '元关键字', '元描述', 145.00, 'shipchar', 9, '', 0, 0, 1440788234),
(84, '图像测试', '', 0, 0, 1440864000, 1440864000, '', '', 0.00, 0, 1, '1', 1, 0, '', '', '', 0.00, '', 0, '', 0, 0, 1440941574),
(85, '你好吗', '', 0, 0, 0, 0, '&lt;html&gt;&lt;head&gt;\n&lt;meta charset=&quot;utf-8&quot;&gt;\n&lt;title&gt;Metronic | eCommerce - Product Edit&lt;/title&gt;\n&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;IE=edge&quot;&gt;\n&lt;meta content=&quot;width=device-width, initial-scale=1.0&quot; name=&quot;viewport&quot;&gt;\n&lt;meta http-equiv=&quot;Content-type&quot; content=&quot;text/html; charset=utf-8&quot;&gt;\n&lt;meta content=&quot;&quot; name=&quot;description&quot;&gt;\n&lt;meta content=&quot;&quot; name=&quot;author&quot;&gt;\n&lt;!-- BEGIN GLOBAL MANDATORY STYLES --&gt;\n&lt;script src=&quot;http://localhost/home/application/assets/global/plugins/pace/pace.min.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/pace/themes/pace-theme-barber-shop.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/font-awesome/css/font-awesome.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/simple-line-icons/simple-line-icons.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap/css/bootstrap.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/uniform/css/uniform.default.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;!-- END GLOBAL MANDATORY STYLES --&gt;\n&lt;!-- BEGIN PAGE LEVEL STYLES --&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/select2/select2.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap-datepicker/css/datepicker.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/fancybox/source/jquery.fancybox.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;!-- END PAGE LEVEL STYLES --&gt;\n&lt;!-- BEGIN THEME STYLES --&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/css/components.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/css/plugins.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/admin/layout/css/layout.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link id=&quot;style_color&quot; href=&quot;http://localhost/home/application/assets/admin/layout/css/themes/darkblue.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/umeditor/themes/default/css/umeditor.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/admin/layout/css/custom.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;!-- END THEME STYLES --&gt;\n&lt;link rel=&quot;shortcut icon&quot; href=&quot;favicon.ico&quot;&gt;\n&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/link/link.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/image/image.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/video/video.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/map/map.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/formula/formula.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/emotion/emotion.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;/head&gt;&lt;body &gt;&lt;p&gt;&lt;img src=&quot;http://localhost/home/application/assets/umeditor/php/upload/20150901/14410796346785.jpg&quot; _src=&quot;http://localhost/home/application/assets/umeditor/php/upload/20150901/14410796346785.jpg&quot;/&gt;\n															\n														&lt;/p&gt;&lt;/body&gt;&lt;/html&gt;', '', 0.00, 0, 1, '1', 0, 0, '', '', '', 0.00, '', 0, '', 0, 0, 1441079641);

-- --------------------------------------------------------

--
-- 表的结构 `productimg`
--

CREATE TABLE IF NOT EXISTS `productimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `orderby` int(11) NOT NULL,
  `oldimage` varchar(256) NOT NULL,
  `base_path` varchar(256) NOT NULL,
  `small_path` varchar(256) NOT NULL,
  `thumbnail_path` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='异步响应式上传图片，不能加外键约束' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `productimg`
--

INSERT INTO `productimg` (`id`, `pid`, `title`, `orderby`, `oldimage`, `base_path`, `small_path`, `thumbnail_path`) VALUES
(7, 84, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_300x300.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(8, 84, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(9, 78, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_300x300.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(10, 78, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(11, 78, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(12, 0, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(13, 0, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(14, 0, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(15, 0, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(16, 79, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(17, 79, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `prototype`
--

CREATE TABLE IF NOT EXISTS `prototype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `type` enum('text','radio') NOT NULL DEFAULT 'text',
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性表，异步式属性对接，不要约束' AUTO_INCREMENT=83 ;

--
-- 转存表中的数据 `prototype`
--

INSERT INTO `prototype` (`id`, `pid`, `name`, `type`, `value`) VALUES
(61, 83, '长度', 'text', '12米'),
(70, 78, '长度', 'radio', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}'),
(76, 84, '长度', 'radio', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}'),
(82, 78, '大小', 'text', '12吗');

-- --------------------------------------------------------

--
-- 表的结构 `refund`
--

CREATE TABLE IF NOT EXISTS `refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '退款类型，是否包括退货',
  `time` int(11) NOT NULL,
  `reason` varchar(64) NOT NULL,
  `money` double(10,2) NOT NULL,
  `description` text NOT NULL,
  `o_status` tinyint(1) NOT NULL COMMENT '取消之前订单状态',
  `handle` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `refund`
--

INSERT INTO `refund` (`id`, `uid`, `oid`, `type`, `time`, `reason`, `money`, `description`, `o_status`, `handle`) VALUES
(1, 3, 14, 0, 1234567, '测试腿裤哦', 0.00, '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `refundpic`
--

CREATE TABLE IF NOT EXISTS `refundpic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rid` int(11) NOT NULL,
  `path` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rid` (`rid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `register`
--

CREATE TABLE IF NOT EXISTS `register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL COMMENT '活动名称',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `content` text NOT NULL COMMENT '活动显示内容',
  `template_coupon` int(11) NOT NULL,
  `redict_type` enum('index','theme','product','url','none') NOT NULL COMMENT '跳转方式',
  `redict` varchar(256) NOT NULL COMMENT '活动领取后跳转地址',
  `stoptime` tinyint(2) NOT NULL COMMENT '悬浮窗停留时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `template_coupon` (`template_coupon`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='新用户注册登录后的悬浮窗' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `register`
--

INSERT INTO `register` (`id`, `name`, `starttime`, `endtime`, `content`, `template_coupon`, `redict_type`, `redict`, `stoptime`) VALUES
(1, '新用户注册送好礼1123', 1442937600, 1443196800, '&lt;p&gt;123&lt;img src=&quot;http://localhost/home/application/assets/umeditor/php/upload/20150915/14422983408790.jpg&quot; _src=&quot;http://localhost/home/application/assets/umeditor/php/upload/20150915/14422983408790.jpg&quot; style=&quot;width: 179px; height: 321px;&quot;/&gt;&lt;/p&gt;', 18, 'url', 'http://www.nadu', 4);

-- --------------------------------------------------------

--
-- 表的结构 `register_log`
--

CREATE TABLE IF NOT EXISTS `register_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`),
  UNIQUE KEY `cid` (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='新用户注册活动领奖记录' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL COMMENT '用户组名',
  `address` tinyint(2) NOT NULL,
  `brand` tinyint(2) NOT NULL DEFAULT '15',
  `category` tinyint(2) NOT NULL DEFAULT '15',
  `combine` tinyint(2) NOT NULL,
  `comment` tinyint(2) NOT NULL,
  `coupon` tinyint(2) NOT NULL,
  `fullcut` tinyint(2) NOT NULL,
  `product` tinyint(2) NOT NULL,
  `user` tinyint(2) NOT NULL,
  `admin` tinyint(2) NOT NULL,
  `orderlist` tinyint(2) NOT NULL,
  `sale` tinyint(2) NOT NULL,
  `seckill` tinyint(2) NOT NULL,
  `role` tinyint(2) NOT NULL,
  `ship` tinyint(2) NOT NULL,
  `o2ouser` tinyint(2) NOT NULL,
  `theme` tinyint(2) NOT NULL,
  `help` tinyint(2) NOT NULL,
  `carousel` tinyint(2) NOT NULL,
  `refund` tinyint(2) NOT NULL,
  `register` tinyint(2) NOT NULL,
  `system` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `address`, `brand`, `category`, `combine`, `comment`, `coupon`, `fullcut`, `product`, `user`, `admin`, `orderlist`, `sale`, `seckill`, `role`, `ship`, `o2ouser`, `theme`, `help`, `carousel`, `refund`, `register`, `system`) VALUES
(1, '管理员', 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15),
(11, '商品管理员', 0, 15, 15, 15, 15, 15, 15, 15, 0, 0, 15, 15, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, '管理组', 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(256) NOT NULL COMMENT '活动名称',
  `pid` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='限时特卖' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `sale`
--

INSERT INTO `sale` (`id`, `sname`, `pid`, `starttime`, `endtime`, `price`, `orderby`) VALUES
(4, '策划商品活动名称', 79, 1440935446, 1441021846, 123.00, 1);

-- --------------------------------------------------------

--
-- 表的结构 `seckill`
--

CREATE TABLE IF NOT EXISTS `seckill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sname` varchar(256) NOT NULL COMMENT '活动名称',
  `pid` int(11) NOT NULL,
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `orderby` int(11) NOT NULL,
  `price` double(10,2) NOT NULL COMMENT '价格',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `seckill`
--

INSERT INTO `seckill` (`id`, `sname`, `pid`, `starttime`, `endtime`, `orderby`, `price`) VALUES
(3, '测试商品的活动名称', 78, 1440935323, 1441021723, 1, 12.00);

-- --------------------------------------------------------

--
-- 表的结构 `ship`
--

CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `code` varchar(32) NOT NULL,
  `max` double(10,2) NOT NULL,
  `price` double(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配送方案' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ship`
--

INSERT INTO `ship` (`id`, `name`, `code`, `max`, `price`) VALUES
(1, '顺丰', 'SF', 0.00, 0.00);

-- --------------------------------------------------------

--
-- 表的结构 `shipalert`
--

CREATE TABLE IF NOT EXISTS `shipalert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `ok` tinyint(1) NOT NULL DEFAULT '0' COMMENT '管理员是否已经知道该信息',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `oid` (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `smslog`
--

CREATE TABLE IF NOT EXISTS `smslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` char(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='短信日志，用于验证和防止短信轰炸' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `smslog`
--

INSERT INTO `smslog` (`id`, `telephone`, `code`, `time`) VALUES
(3, '18548143019', '268973', 1439889089);

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `value` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表' AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`id`, `name`, `type`, `value`) VALUES
(1, 'companyname', 'system', '我们家'),
(2, 'sendername', 'system', '我们家'),
(3, 'smstemplate', 'system', '感谢您对我们家的支持和信赖，以下是您的验证码%s'),
(4, 'mchid', 'weixin', '1251529901'),
(5, 'appid', 'weixin', 'wx714c70a7a6b93632'),
(6, 'key', 'weixin', 'b02a45a596bfb86fe2578bde75ff5444'),
(7, 'appsecret', 'weixin', '4dd9d79acafd65972898623410b02a5b'),
(8, 'partner', 'alipay', '2088021725054202'),
(9, 'key', 'alipay', '6fn5bgoyoj68dduhfg5grdxgmbt40b5v'),
(10, 'currency', 'alipay', 'EUR'),
(11, 'splitpartner', 'alipay', '2088021554551903'),
(12, 'splitrate', 'alipay', '0.5'),
(13, 'splitcurrency', 'alipay', 'CNY'),
(15, 'timeout', 'payment', '30'),
(20, 'productbasewidth', 'image', '640'),
(21, 'productbaseheight', 'image', '320'),
(22, 'productsmallwidth', 'image', '300'),
(23, 'productsmallheight', 'image', '300'),
(24, 'productthumbnailwidth', 'image', '100'),
(25, 'productthumbnailheight', 'image', '100'),
(26, 'rsaprivatekey', 'alipay', 'D:/wamp/www/home/application/cert/08ec38cab55ccbd9da059eb69ec1228c7e5d16a96b9fa56a98eb34eb3dc43829301ad3d7.pem'),
(27, 'startpage1', 'app', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_414x736.jpg'),
(28, 'startpage4', 'app', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg'),
(29, 'startpage2', 'app', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_414x736.jpg'),
(30, 'startpage3', 'app', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_414x736.jpg'),
(35, 'customsno', 'system', 'PT15012002'),
(36, 'customsname', 'system', '杭州亚平宁网络科技有限公司'),
(37, 'customs', 'system', 'HANGZHOU'),
(38, 'rsapublickey', 'alipay', 'D:/wamp/www/home/application/cert/9b4ee2f5a430c8544a29f2bd89feeae13593bec37372e3633b9dfff324fefc41bbefb605.pem'),
(39, 'weixincertfilepassword', 'costums', '123675'),
(40, 'weixincertfile', 'costums', 'D:/wamp/www/home/application/cert/f80118c8fc527ce2be993bed5170b29219ee4515f0d7be4f166f9880e51848957db6374c.pem');

-- --------------------------------------------------------

--
-- 表的结构 `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `description` varchar(256) NOT NULL,
  `bigpic` varchar(256) NOT NULL,
  `middlepic` varchar(256) NOT NULL,
  `smallpic` varchar(256) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题详情' AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `theme`
--

INSERT INTO `theme` (`id`, `name`, `description`, `bigpic`, `middlepic`, `smallpic`, `orderby`) VALUES
(8, '主题名称', '主题描述', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x280.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_320x260.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_320x130.jpg', 2),
(9, '第二个', '第二个描述', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x280.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_320x260.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_320x130.jpg', 123);

-- --------------------------------------------------------

--
-- 表的结构 `theme_product`
--

CREATE TABLE IF NOT EXISTS `theme_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tid` (`tid`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题和产品关系表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `theme_product`
--

INSERT INTO `theme_product` (`id`, `tid`, `pid`) VALUES
(1, 8, 78);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gravatar` varchar(256) NOT NULL,
  `username` varchar(256) NOT NULL,
  `telephone` char(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` char(32) NOT NULL,
  `regtime` int(11) NOT NULL,
  `logtime` int(11) NOT NULL,
  `money` double(10,2) NOT NULL COMMENT '余额',
  `score` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `cost` double(10,2) NOT NULL COMMENT '花销金额',
  `salt` char(6) NOT NULL,
  `close` tinyint(1) NOT NULL COMMENT '封印',
  `oid` int(11) NOT NULL COMMENT 'o2o用户的id',
  `client` enum('web','ios','android','weixin','wap') NOT NULL COMMENT '注册时的客户端',
  PRIMARY KEY (`id`),
  UNIQUE KEY `telephone` (`telephone`),
  KEY `oid` (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `gravatar`, `username`, `telephone`, `email`, `password`, `regtime`, `logtime`, `money`, `score`, `ordernum`, `cost`, `salt`, `close`, `oid`, `client`) VALUES
(3, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', '123', '12345678901', '326550324@qq.com', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 1, 6300.01, 'QlRRU9', 0, 3, 'web'),
(4, '', '0', '12345678902', '', '0b6ea8fdab7e481a29c1c10b95d82b9a', 1437936558, 1437936558, 0.00, 0, 0, 0.00, 'pS3huq', 1, 3, 'web'),
(5, '', '0', '12345678903', '', '4b35eaed14f338d9b018fe09a2fb8719', 1437968089, 1437968089, 0.00, 0, 0, 0.00, 'Cl8BHd', 1, 0, 'web'),
(7, '', '0', '12345678904', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 0, 0, 'web'),
(8, '', '0', '12345678905', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 1, 0, 'web'),
(15, '', '0', '10987654321', '', '359bf8813a422cd25c57e078b5f7800c', 1438586378, 1438586378, 0.00, 0, 0, 0.00, 'pkyeck', 0, 0, 'web'),
(17, '', '', '18548143019', '', '2ab3dc8e4b03e11beeaaff9cbfb3375e', 1439889196, 1439889196, 0.00, 0, 0, 0.00, 'KtTTiU', 0, 0, 'web'),
(18, '', '', '11111222223', '', '505d5b04b70a7202dd239b0cb6614f6b', 1440641625, 1440641625, 0.00, 0, 0, 0.00, '3mJNXB', 0, 0, 'web'),
(19, '', '', '12312312312', '', 'f8e2408d77a61a1ad6684ea30fec5613', 1440641879, 1440641879, 0.00, 0, 0, 0.00, 'U7cHGD', 0, 0, 'web');

-- --------------------------------------------------------

--
-- 表的结构 `weixinprepay`
--

CREATE TABLE IF NOT EXISTS `weixinprepay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `return_code` varchar(32) NOT NULL,
  `return_msg` varchar(32) NOT NULL,
  `appid` char(32) NOT NULL,
  `mch_id` char(32) NOT NULL,
  `device_info` varchar(32) NOT NULL DEFAULT 'WEB',
  `nonce_str` char(32) NOT NULL DEFAULT '',
  `sign` char(32) NOT NULL DEFAULT '',
  `result_code` varchar(16) NOT NULL DEFAULT '',
  `prepay_id` varchar(64) NOT NULL DEFAULT '',
  `trade_type` varchar(16) NOT NULL DEFAULT '',
  `orderno` varchar(256) NOT NULL,
  `createtime` int(11) NOT NULL COMMENT '创建时间，2小时候无效',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='微信预支付订单信息' AUTO_INCREMENT=1 ;

--
-- 限制导出的表
--

--
-- 限制表 `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- 限制表 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `comment_pic`
--
ALTER TABLE `comment_pic`
  ADD CONSTRAINT `comment_pic_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `comment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `coupondetail`
--
ALTER TABLE `coupondetail`
  ADD CONSTRAINT `coupondetail_ibfk_1` FOREIGN KEY (`couponid`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `fullcutdetail`
--
ALTER TABLE `fullcutdetail`
  ADD CONSTRAINT `fullcutdetail_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `fullcut` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fullcutdetail_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `hotorder`
--
ALTER TABLE `hotorder`
  ADD CONSTRAINT `hotorder_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `o2ouser`
--
ALTER TABLE `o2ouser`
  ADD CONSTRAINT `o2ouser_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orderlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `refund`
--
ALTER TABLE `refund`
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orderlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `refund_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `refundpic`
--
ALTER TABLE `refundpic`
  ADD CONSTRAINT `refundpic_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `refund` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `register_log`
--
ALTER TABLE `register_log`
  ADD CONSTRAINT `register_log_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `register_log_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `seckill`
--
ALTER TABLE `seckill`
  ADD CONSTRAINT `seckill_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `shipalert`
--
ALTER TABLE `shipalert`
  ADD CONSTRAINT `shipalert_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipalert_ibfk_2` FOREIGN KEY (`oid`) REFERENCES `orderlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `theme_product`
--
ALTER TABLE `theme_product`
  ADD CONSTRAINT `theme_product_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `theme_product_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
