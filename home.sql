-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-13 04:39:52
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
(2, 3, '浙江', '杭州', '浙大科技园', '金', '18548143019', '301100', 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `brand`
--

INSERT INTO `brand` (`id`, `name`, `logo`, `description`, `close`) VALUES
(1, '雕牌', '', '', 0),
(2, '飞利浦', '', '', 0),
(3, '牛逼', '', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `content`, `num`, `time`) VALUES
(3, 3, 55, 'a:2:{i:54;s:1:"0";i:55;s:1:"1";}', 1, 1439259994);

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `cid` int(11) NOT NULL COMMENT '上级分类id，为0顶级分类',
  PRIMARY KEY (`id`),
  KEY `cid` (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `name`, `cid`) VALUES
(22, '衣服', 0),
(23, '家电', 0),
(24, '木材', 22),
(25, '男装', 22),
(26, '女装', 32),
(27, '上衣', 25),
(28, '裤子', 26),
(29, '鞋子', 26),
(30, '上衣', 26),
(31, '123', 24),
(32, 'bao', 22),
(33, 'New node', 26),
(34, 'New node', 22),
(35, 'New node', 22),
(36, '13123123', 22);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- 转存表中的数据 `collection`
--

INSERT INTO `collection` (`id`, `pid`, `content`, `stock`, `price`, `sku`) VALUES
(33, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"0";}', 10, 12.00, '编码2'),
(34, 36, 'a:2:{i:34;s:1:"1";i:35;s:1:"0";}', 0, 0.00, ''),
(35, 36, 'a:2:{i:34;s:1:"2";i:35;s:1:"0";}', 0, 0.00, ''),
(36, 36, 'a:2:{i:34;s:1:"3";i:35;s:1:"0";}', 0, 0.00, ''),
(37, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"1";}', 0, 0.00, ''),
(38, 36, 'a:2:{i:34;s:1:"1";i:35;s:1:"1";}', 0, 0.00, ''),
(39, 36, 'a:2:{i:34;s:1:"2";i:35;s:1:"1";}', 0, 0.00, ''),
(40, 36, 'a:2:{i:34;s:1:"3";i:35;s:1:"1";}', 0, 0.00, ''),
(41, 52, 'a:2:{i:51;s:1:"0";i:52;s:1:"0";}', 0, 0.00, ''),
(42, 52, 'a:2:{i:51;s:1:"1";i:52;s:1:"0";}', 0, 0.00, ''),
(43, 52, 'a:2:{i:51;s:1:"0";i:52;s:1:"1";}', 123123, 0.00, ''),
(44, 52, 'a:2:{i:51;s:1:"1";i:52;s:1:"1";}', 0, 0.00, ''),
(45, 52, 'a:2:{i:51;s:1:"0";i:52;s:1:"2";}', 0, 0.00, ''),
(46, 52, 'a:2:{i:51;s:1:"1";i:52;s:1:"2";}', 0, 0.00, ''),
(51, 55, 'a:2:{i:54;s:1:"0";i:55;s:1:"0";}', 101, 500.00, ''),
(52, 55, 'a:2:{i:54;s:1:"1";i:55;s:1:"0";}', 102, 499.00, ''),
(53, 55, 'a:2:{i:54;s:1:"2";i:55;s:1:"0";}', 103, 498.00, ''),
(54, 55, 'a:2:{i:54;s:1:"3";i:55;s:1:"0";}', 104, 497.00, ''),
(55, 55, 'a:2:{i:54;s:1:"0";i:55;s:1:"1";}', 95, 500.00, ''),
(56, 55, 'a:2:{i:54;s:1:"1";i:55;s:1:"1";}', 102, 499.00, ''),
(57, 55, 'a:2:{i:54;s:1:"2";i:55;s:1:"1";}', 103, 498.00, ''),
(58, 55, 'a:2:{i:54;s:1:"3";i:55;s:1:"1";}', 104, 497.00, ''),
(59, 55, 'a:2:{i:54;s:1:"0";i:55;s:1:"2";}', 101, 500.00, ''),
(60, 55, 'a:2:{i:54;s:1:"1";i:55;s:1:"2";}', 102, 499.00, ''),
(61, 55, 'a:2:{i:54;s:1:"2";i:55;s:1:"2";}', 103, 498.00, ''),
(62, 55, 'a:2:{i:54;s:1:"3";i:55;s:1:"2";}', 104, 497.00, '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `uid`, `pid`, `time`, `content`, `score`) VALUES
(1, 3, 36, 123456, 'sdgsdfgsdfgsdfgsdfg', 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `comment_pic`
--

INSERT INTO `comment_pic` (`id`, `cid`, `pic_path`) VALUES
(1, 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png'),
(2, 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png');

-- --------------------------------------------------------

--
-- 表的结构 `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `couponno` char(16) NOT NULL COMMENT '优惠码编号',
  `total` int(11) NOT NULL COMMENT '总共使用次数',
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `times` int(11) NOT NULL COMMENT '剩余使用次数',
  `type` enum('fixed','discount') NOT NULL,
  `value` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `couponno` (`couponno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='优惠券打折码' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `coupon`
--

INSERT INTO `coupon` (`id`, `couponno`, `total`, `starttime`, `endtime`, `times`, `type`, `value`) VALUES
(9, '150809034054LK2F', 123, 1438790400, 1440691200, 123, 'fixed', 200.00),
(11, '150809034519TWJF', 100, 1439063121, 1439149521, 100, 'discount', 0.70),
(12, '150809215031CAQB', 11, 1439128236, 1439214636, 11, 'fixed', 1.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `coupondetail`
--

INSERT INTO `coupondetail` (`id`, `couponid`, `categoryid`) VALUES
(3, 9, 24),
(4, 9, 25),
(7, 11, 0),
(8, 12, 0);

-- --------------------------------------------------------

--
-- 表的结构 `fullcut`
--

CREATE TABLE IF NOT EXISTS `fullcut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `max` int(11) NOT NULL,
  `minus` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `fullcut`
--

INSERT INTO `fullcut` (`id`, `name`, `max`, `minus`, `starttime`, `endtime`) VALUES
(4, '满1000减100', 1000, 100, 1438929000, 1439222400),
(5, '测试名称', 200, 100, 1438704000, 1440000000),
(6, '满1000减1', 1000, 1, 1438929000, 1438711500);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `fullcutdetail`
--

INSERT INTO `fullcutdetail` (`id`, `fid`, `pid`) VALUES
(1, 6, 53);

-- --------------------------------------------------------

--
-- 表的结构 `help`
--

CREATE TABLE IF NOT EXISTS `help` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- 转存表中的数据 `log`
--

INSERT INTO `log` (`id`, `username`, `time`, `content`) VALUES
(1, 'jin123456bat', 123456890, '正在building'),
(2, 'jin123456bat', 1439183070, '删除了一个用户'),
(3, 'jin123456bat', 1439183105, '删除了一个用户'),
(4, 'jin123456bat', 1439183107, '删除了一个用户'),
(5, 'jin123456bat', 1439183109, '删除了一个用户'),
(6, 'jin123456bat', 1439183117, '删除了一个用户'),
(7, 'jin123456bat', 1439183117, '删除了一个用户'),
(8, 'jin123456bat', 1439183117, '删除了一个用户'),
(9, 'jin123456bat', 1439183261, '删除了一个用户'),
(10, 'jin123456bat', 1439212531, '登陆了系统'),
(11, 'jin123456bat', 1439213158, '修改了商品属性55'),
(12, 'jin123456bat', 1439213207, '修改了商品属性1'),
(13, 'jin123456bat', 1439213217, '修改了商品属性1'),
(14, 'jin123456bat', 1439213269, '修改了商品属性1'),
(15, 'jin123456bat', 1439213330, '修改了商品属性1'),
(16, 'jin123456bat', 1439214876, '修改了商品属性1'),
(17, 'jin123456bat', 1439214893, '修改了商品属性1'),
(18, 'jin123456bat', 1439214947, '修改了商品属性1'),
(19, 'jin123456bat', 1439214968, '修改了商品属性1'),
(20, 'jin123456bat', 1439226088, '给0个用户发送了短信:'),
(21, 'jin123456bat', 1439226207, '给0个用户发送了短信:你好世界'),
(22, 'jin123456bat', 1439226248, '给0个用户发送了短信:你好世界'),
(23, 'jin123456bat', 1439226252, '给0个用户发送了短信:你好世界'),
(24, 'jin123456bat', 1439226273, '给0个用户发送了短信:你好世界'),
(25, 'jin123456bat', 1439226301, '给1个用户发送了短信:你好世界'),
(26, 'jin123456bat', 1439226345, '给1个用户发送了短信:你好世界'),
(27, 'jin123456bat', 1439226364, '给1个用户发送了短信:你好世界'),
(28, 'jin123456bat', 1439226405, '给1个用户发送了短信:你好世界'),
(29, 'jin123456bat', 1439226570, '给1个用户发送了短信:你好世界'),
(30, 'jin123456bat', 1439226594, '给1个用户发送了短信:你好世界'),
(31, 'jin123456bat', 1439226814, '给1个用户发送了短信:你好世界，这是一条验证短信，顺带着一个验证码:01013011'),
(32, 'jin123456bat', 1439258997, '登陆了系统'),
(33, 'jin123456bat', 1439259255, '修改了商品属性1'),
(34, 'jin123456bat', 1439259336, '修改了商品属性1'),
(35, 'jin123456bat', 1439264405, '登陆了系统'),
(36, 'jin123456bat', 1439275173, '登陆了系统'),
(37, 'jin123456bat', 1439275263, '登陆了系统'),
(38, 'jin123456bat', 1439277609, '修改了商品属性1'),
(39, 'jin123456bat', 1439284375, '登陆了系统'),
(40, 'jin123456bat', 1439287125, '修改了商品属性56'),
(41, 'jin123456bat', 1439287257, '修改了商品属性1'),
(42, 'jin123456bat', 1439287266, '修改了商品属性1'),
(43, 'jin123456bat', 1439287383, '修改了商品属性1'),
(44, 'jin123456bat', 1439287443, '修改了商品属性1'),
(45, 'jin123456bat', 1439287479, '修改了商品属性1'),
(46, 'jin123456bat', 1439303027, '登陆了系统'),
(47, 'jin123456bat', 1439303155, '修改了商品(36)的操作方式:2'),
(48, 'jin123456bat', 1439303155, '修改了商品(37)的操作方式:2'),
(49, 'jin123456bat', 1439303155, '修改了商品(49)的操作方式:2'),
(50, 'jin123456bat', 1439303155, '修改了商品(50)的操作方式:2'),
(51, 'jin123456bat', 1439303155, '修改了商品(52)的操作方式:2'),
(52, 'jin123456bat', 1439303155, '修改了商品(53)的操作方式:2'),
(53, 'jin123456bat', 1439303155, '修改了商品(54)的操作方式:2'),
(54, 'jin123456bat', 1439303155, '修改了商品(56)的操作方式:2'),
(55, 'jin123456bat', 1439303155, '修改了商品(55)的操作方式:2'),
(56, 'jin123456bat', 1439303165, '修改了商品(36)的操作方式:1'),
(57, 'jin123456bat', 1439303165, '修改了商品(37)的操作方式:1'),
(58, 'jin123456bat', 1439303165, '修改了商品(49)的操作方式:1'),
(59, 'jin123456bat', 1439303165, '修改了商品(50)的操作方式:1'),
(60, 'jin123456bat', 1439303165, '修改了商品(52)的操作方式:1'),
(61, 'jin123456bat', 1439303165, '修改了商品(53)的操作方式:1'),
(62, 'jin123456bat', 1439303165, '修改了商品(54)的操作方式:1'),
(63, 'jin123456bat', 1439303165, '修改了商品(56)的操作方式:1'),
(64, 'jin123456bat', 1439303165, '修改了商品(55)的操作方式:1'),
(65, 'jin123456bat', 1439310006, '修改了商品属性1'),
(66, 'jin123456bat', 1439310025, '修改了商品属性1'),
(67, 'jin123456bat', 1439370905, '登陆了系统'),
(68, 'jin123456bat', 1439372468, '登陆了系统');

-- --------------------------------------------------------

--
-- 表的结构 `o2oshop`
--

CREATE TABLE IF NOT EXISTS `o2oshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `address` varchar(256) NOT NULL,
  `telphone` int(11) NOT NULL,
  `backrate` double(3,3) NOT NULL COMMENT '返还利润比例',
  `logo` varchar(256) NOT NULL,
  `eqpic` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `o2oshop`
--

INSERT INTO `o2oshop` (`id`, `name`, `address`, `telphone`, `backrate`, `logo`, `eqpic`) VALUES
(1, '测试o2o商店', '武林广场', 123456, 0.226, '', '');

-- --------------------------------------------------------

--
-- 表的结构 `orderdetail`
--

CREATE TABLE IF NOT EXISTS `orderdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL COMMENT '订单id',
  `pid` int(11) NOT NULL COMMENT '产品id',
  `productname` varchar(256) NOT NULL COMMENT '货物名称',
  `unitprice` double(10,2) NOT NULL COMMENT '单价',
  `prototype` text NOT NULL COMMENT '属性集合',
  `origin` varchar(256) NOT NULL COMMENT '产销国',
  `score` int(11) NOT NULL COMMENT '涉及的积分',
  `num` int(11) NOT NULL COMMENT '数量',
  `discount` varchar(256) NOT NULL COMMENT '使用了什么折扣',
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单中的货物信息' AUTO_INCREMENT=1 ;

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
  `postmode` varchar(256) NOT NULL COMMENT '物流方式',
  `waybills` varchar(256) NOT NULL COMMENT '运单号使用数组的序列化',
  `sendername` varchar(256) NOT NULL COMMENT '发件人',
  `companyname` varchar(256) NOT NULL COMMENT '公司名称',
  `zipcode` char(6) NOT NULL COMMENT '邮编',
  `note` varchar(256) NOT NULL COMMENT '额外描述',
  `status` int(11) NOT NULL COMMENT '订单状态',
  `discount` varchar(256) NOT NULL COMMENT '使用了什么折扣',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=1 ;

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
  `description` text NOT NULL,
  `short_description` text NOT NULL,
  `time` int(11) NOT NULL COMMENT '创建时间',
  `price` double(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `origin` varchar(256) NOT NULL,
  `label` varchar(256) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `orderby` int(11) NOT NULL,
  `meta_title` varchar(256) NOT NULL,
  `meta_keywords` varchar(512) NOT NULL,
  `meta_description` varchar(256) NOT NULL,
  `activity` enum('seckill','fullcut','combine','sale') NOT NULL COMMENT '活动类型',
  `oldprice` double(10,2) NOT NULL COMMENT '市场价',
  `shipchar` varchar(32) NOT NULL COMMENT '邮递方式,就是app显示用的',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `category`, `bid`, `starttime`, `endtime`, `description`, `short_description`, `time`, `price`, `stock`, `origin`, `label`, `status`, `orderby`, `meta_title`, `meta_keywords`, `meta_description`, `activity`, `oldprice`, `shipchar`) VALUES
(36, '添加的一个商品', '', 24, 0, 1439308800, 1439308800, '', '', 1439310025, 0.00, 0, '中国', '限时热卖', 1, 0, '元属性标题', '', '元属性描述', '', 12.00, '意大利米兰直邮回国内'),
(37, '一二三次', '', 31, 2, 1438272000, 1638272000, '', '', 1438654297, 0.00, 0, '', '', 1, 0, '', '', '', 'sale', 0.00, ''),
(49, '哎呦', '', 0, 2, 0, 0, '', '', 1438682509, 0.00, 0, '', '1', 1, 0, '', '', '', 'seckill', 0.00, ''),
(50, 'abcd', '', 0, 3, 0, 0, '&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0023.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0023.gif&quot;/&gt;\n															\n														&lt;/p&gt;', '', 1438708384, 0.00, 0, '', '', 1, 0, 'asdfasdf', 'adsfasdf', 'asdfasdf', 'sale', 0.00, ''),
(52, '测试用的名字哈', '', 0, 0, 1438704000, 1438704000, '', '', 1438787988, 0.00, 0, '', '1', 1, 0, '', '', '', 'seckill', 0.00, ''),
(53, '啊哈', '', 0, 0, 0, 0, '', '', 1438792278, 0.00, 10, '', '', 1, 0, '', '', '', 'fullcut', 0.00, ''),
(54, '哎呦 不错哦', '', 0, 0, 1439222400, 1439222400, '', '', 1439287383, 10.00, 0, '', '1', 1, 0, '', '', '', '', 0.00, ''),
(55, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 1439222400, 1439222400, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '和田玉', 1439277609, 501.00, 102, '中国', '热卖商品', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, ''),
(56, '啊打发手动阀手动阀啊手动阀手动阀打发', '123123123', 31, 2, 1438358400, 1440777600, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;\n															啊的说法是打发打发打发打发的&lt;/p&gt;&lt;p&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '短描述', 1439287479, 123.00, 1234, '韩国', '1', 1, 132, '', '', '', '', 0.00, '');

-- --------------------------------------------------------

--
-- 表的结构 `productimg`
--

CREATE TABLE IF NOT EXISTS `productimg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `orderby` int(11) NOT NULL,
  `base_path` varchar(256) NOT NULL,
  `small_path` varchar(256) NOT NULL,
  `thumbnail_path` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='异步响应式上传图片，不能加外键约束' AUTO_INCREMENT=48 ;

--
-- 转存表中的数据 `productimg`
--

INSERT INTO `productimg` (`id`, `pid`, `title`, `orderby`, `base_path`, `small_path`, `thumbnail_path`) VALUES
(41, 37, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png'),
(43, 36, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png'),
(44, 48, '2014grate.png', 1, 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_200x200.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_100x100.png'),
(47, 0, '2014grate.png', 1, 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_200x200.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_100x100.png');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性表，异步式属性对接，不要约束' AUTO_INCREMENT=57 ;

--
-- 转存表中的数据 `prototype`
--

INSERT INTO `prototype` (`id`, `pid`, `name`, `type`, `value`) VALUES
(4, 48, '长度吗', 'text', '123'),
(26, 36, '重量', 'text', 'cccc'),
(34, 37, '长度', 'radio', 'a:4:{i:0;s:1:"a";i:1;s:1:"b";i:2;s:1:"c";i:3;s:1:"d";}'),
(35, 37, '尺码', 'radio', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}'),
(39, 37, '好的', 'text', '啊哈哈'),
(43, 37, 'aa', 'text', 'bbb'),
(51, 52, 'xx', 'radio', 'a:2:{i:0;s:2:"aa";i:1;s:2:"bb";}'),
(52, 55, '品种', 'text', '羊脂白玉'),
(53, 55, '品牌', 'text', '语石良园'),
(54, 55, '大小', 'radio', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}'),
(55, 55, '长度', 'radio', 'a:3:{i:0;s:1:"a";i:1;s:1:"b";i:2;s:1:"c";}'),
(56, 55, '啊', 'text', '额');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `address`, `brand`, `category`, `combine`, `comment`, `coupon`, `fullcut`, `product`, `user`, `admin`, `orderlist`, `sale`, `seckill`, `role`, `ship`) VALUES
(1, '管理员', 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15),
(11, '商品管理员', 0, 15, 15, 15, 15, 15, 15, 15, 0, 0, 15, 15, 15, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='限时特卖' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `sale`
--

INSERT INTO `sale` (`id`, `pid`, `starttime`, `endtime`, `price`, `orderby`) VALUES
(1, 37, 1438790400, 1599398800, 11.00, 2),
(2, 50, 1438617600, 1439222400, 13.00, 1),
(3, 56, 1265058000, 1441036200, 121.00, 100);

-- --------------------------------------------------------

--
-- 表的结构 `seckill`
--

CREATE TABLE IF NOT EXISTS `seckill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `starttime` int(11) NOT NULL COMMENT '开始时间',
  `endtime` int(11) NOT NULL COMMENT '结束时间',
  `orderby` int(11) NOT NULL,
  `price` double(10,2) NOT NULL COMMENT '价格',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `seckill`
--

INSERT INTO `seckill` (`id`, `pid`, `starttime`, `endtime`, `orderby`, `price`) VALUES
(2, 36, 1438942579, 1439028979, 2, 12.00),
(3, 49, 1438704000, 1439024400, 2, 0.00),
(4, 52, 1438444800, 1438531200, 1, 14.00);

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
-- 表的结构 `smslog`
--

CREATE TABLE IF NOT EXISTS `smslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` char(11) NOT NULL,
  `code` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信日志，用于验证和防止短信轰炸' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `vaule` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`id`, `name`, `type`, `vaule`) VALUES
(1, 'companyname', 'system', '我们家'),
(2, 'sendername', 'system', '我们家');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题详情' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `theme`
--

INSERT INTO `theme` (`id`, `name`, `description`, `bigpic`, `middlepic`, `smallpic`) VALUES
(4, '测试主题', '测试主题测试主题测试主题', '', '', '');

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
  `oid` int(11) DEFAULT NULL COMMENT 'o2o店铺id，为空则是自己来的，不为空则是o2o来的',
  PRIMARY KEY (`id`),
  UNIQUE KEY `telephone` (`telephone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `gravatar`, `username`, `telephone`, `email`, `password`, `regtime`, `logtime`, `money`, `score`, `ordernum`, `cost`, `salt`, `close`, `oid`) VALUES
(3, '', '0', '12345678901', '326550324@qq.com', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 1, 0),
(4, '', '0', '12345678902', '', '0b6ea8fdab7e481a29c1c10b95d82b9a', 1437936558, 1437936558, 0.00, 0, 0, 0.00, 'pS3huq', 1, 0),
(5, '', '0', '12345678903', '', '4b35eaed14f338d9b018fe09a2fb8719', 1437968089, 1437968089, 0.00, 0, 0, 0.00, 'Cl8BHd', 1, 0),
(7, '', '0', '12345678904', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 0, 0),
(8, '', '0', '12345678905', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 0, 0),
(15, '', '0', '10987654321', '', '359bf8813a422cd25c57e078b5f7800c', 1438586378, 1438586378, 0.00, 0, 0, 0.00, 'pkyeck', 1, NULL),
(16, '', '', '18548143019', '', 'f4224724a65b499f9b4270c9b56bede5', 1439226079, 1439226079, 0.00, 0, 0, 0.00, 'yaaXxY', 0, NULL);

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
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- 限制表 `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`);

--
-- 限制表 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`);

--
-- 限制表 `comment_pic`
--
ALTER TABLE `comment_pic`
  ADD CONSTRAINT `comment_pic_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `comment` (`id`);

--
-- 限制表 `coupondetail`
--
ALTER TABLE `coupondetail`
  ADD CONSTRAINT `coupondetail_ibfk_1` FOREIGN KEY (`couponid`) REFERENCES `coupon` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 限制表 `fullcutdetail`
--
ALTER TABLE `fullcutdetail`
  ADD CONSTRAINT `fullcutdetail_ibfk_1` FOREIGN KEY (`fid`) REFERENCES `fullcut` (`id`),
  ADD CONSTRAINT `fullcutdetail_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`);

--
-- 限制表 `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `orderdetail_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orderlist` (`id`);

--
-- 限制表 `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `orderlist_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`);

--
-- 限制表 `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`);

--
-- 限制表 `seckill`
--
ALTER TABLE `seckill`
  ADD CONSTRAINT `seckill_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `product` (`id`);

--
-- 限制表 `theme_product`
--
ALTER TABLE `theme_product`
  ADD CONSTRAINT `theme_product_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `theme_product_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
