-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-26 04:49:41
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `brand`
--

INSERT INTO `brand` (`id`, `name`, `logo`, `description`, `close`) VALUES
(1, '雕牌', '', '123', 0),
(2, '飞利浦', '', 'abdsaer', 0),
(3, '牛逼', '', '<html>', 0),
(4, '测啊', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', '啊但是是打发打发', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `carousel`
--

INSERT INTO `carousel` (`id`, `title`, `pic`, `stop`, `type`, `src`) VALUES
(1, '4', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 5, 'product', '58'),
(2, '标题', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 5, 'url', 'http://www.baidu.com'),
(4, '测试内容', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 5, 'product', '58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='购物车' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `cart`
--

INSERT INTO `cart` (`id`, `uid`, `pid`, `content`, `num`, `time`) VALUES
(4, 3, 55, 'a:2:{i:59;s:1:"1";i:60;s:1:"0";}', 1, 1439731036),
(6, 3, 37, '', 2, 1234678);

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
(27, '上衣', '', 25),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=78 ;

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
(63, 55, 'a:2:{i:59;s:1:"0";i:60;s:1:"0";}', 123, 123.00, ''),
(64, 55, 'a:2:{i:59;s:1:"1";i:60;s:1:"0";}', 316, 12.00, ''),
(65, 55, 'a:2:{i:59;s:1:"2";i:60;s:1:"0";}', 12, 123.00, ''),
(66, 55, 'a:2:{i:59;s:1:"3";i:60;s:1:"0";}', 23, 32.00, ''),
(67, 55, 'a:2:{i:59;s:1:"0";i:60;s:1:"1";}', 13, 12.30, ''),
(68, 55, 'a:2:{i:59;s:1:"1";i:60;s:1:"1";}', 31, 52.60, ''),
(69, 55, 'a:2:{i:59;s:1:"2";i:60;s:1:"1";}', 567, 38.20, ''),
(70, 55, 'a:2:{i:59;s:1:"3";i:60;s:1:"1";}', 345, 26.40, ''),
(71, 55, 'a:2:{i:59;s:1:"0";i:60;s:1:"2";}', 567, 10.20, ''),
(72, 55, 'a:2:{i:59;s:1:"1";i:60;s:1:"2";}', 678, 0.20, ''),
(73, 55, 'a:2:{i:59;s:1:"2";i:60;s:1:"2";}', 9, 0.20, ''),
(74, 55, 'a:2:{i:59;s:1:"3";i:60;s:1:"2";}', 567, 3.50, ''),
(75, 58, 'a:1:{i:55;s:1:"0";}', 0, 0.00, ''),
(76, 58, 'a:1:{i:55;s:1:"1";}', 0, 0.00, ''),
(77, 58, 'a:1:{i:55;s:1:"2";}', 0, 0.00, '');

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
  `max` double(10,2) NOT NULL,
  `display` tinyint(1) NOT NULL COMMENT '是否所有用户都可以使用',
  `type` enum('fixed','discount') NOT NULL,
  `value` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `couponno` (`couponno`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='优惠券打折码' AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `coupon`
--

INSERT INTO `coupon` (`id`, `couponno`, `total`, `starttime`, `endtime`, `times`, `max`, `display`, `type`, `value`) VALUES
(9, '150809034054LK2F', 123, 1438790400, 1440691200, 123, 0.00, 0, 'fixed', 200.00),
(11, '150809034519TWJF', 100, 1439063121, 1439149521, 100, 0.00, 0, 'discount', 0.70),
(12, '150809215031CAQB', 11, 1439128236, 1439214636, 11, 0.00, 0, 'fixed', 1.00),
(13, '150814164528WZIR', 12, 1438531200, 1440950400, 12, 0.00, 1, 'fixed', 20000.00),
(14, '150816182636LORI', 20, 1438358400, 1440950400, 20, 0.00, 0, 'fixed', 200.00),
(15, '150816182859ZQ79', 1213, 1438531200, 1440691200, 1213, 20.00, 0, 'discount', 0.80),
(16, '150819155201IAXQ', 121354, 1437840000, 1446048000, 121354, 100.00, 1, 'fixed', 50.00),
(17, '150819155228XFV5', 321, 1437840000, 1446048000, 321, 200.00, 1, 'discount', 0.50),
(18, '150819155456YATT', 12, 1437840000, 1441382400, 12, 200.00, 1, 'discount', 0.90),
(19, '150819155519XPVE', 11, 1437926400, 1441382400, 11, 123.00, 0, 'fixed', 66.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `coupondetail`
--

INSERT INTO `coupondetail` (`id`, `couponid`, `categoryid`) VALUES
(3, 9, 24),
(4, 9, 25),
(7, 11, 0),
(8, 12, 0),
(9, 13, 0),
(10, 13, 0),
(11, 14, 0),
(12, 15, 29),
(13, 16, 0),
(14, 17, 0),
(15, 18, 0),
(16, 19, 24);

-- --------------------------------------------------------

--
-- 表的结构 `favourite`
--

CREATE TABLE IF NOT EXISTS `favourite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `fullcutdetail`
--

INSERT INTO `fullcutdetail` (`id`, `fid`, `pid`) VALUES
(1, 6, 53),
(2, 5, 59);

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
-- 表的结构 `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=200 ;

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
(68, 'jin123456bat', 1439372468, '登陆了系统'),
(69, 'jin123456bat', 1439443651, '登陆了系统'),
(70, 'jin123456bat', 1439451512, '修改了商品属性57'),
(71, 'jin123456bat', 1439451674, '修改了商品属性58'),
(72, 'jin123456bat', 1439451936, '修改了商品属性59'),
(73, 'jin123456bat', 1439452167, '修改了商品属性60'),
(74, 'jin123456bat', 1439452211, '修改了商品属性61'),
(75, 'jin123456bat', 1439452428, '修改了商品属性62'),
(76, 'jin123456bat', 1439452476, '修改了商品属性63'),
(77, 'jin123456bat', 1439452826, '修改了商品属性64'),
(78, 'jin123456bat', 1439452866, '修改了商品属性65'),
(79, 'jin123456bat', 1439453008, '修改了商品属性66'),
(80, 'jin123456bat', 1439453048, '修改了商品属性67'),
(81, 'jin123456bat', 1439453104, '修改了商品属性68'),
(82, 'jin123456bat', 1439453158, '修改了商品属性69'),
(83, 'jin123456bat', 1439453241, '修改了商品属性70'),
(84, 'jin123456bat', 1439453267, '修改了商品属性71'),
(85, 'jin123456bat', 1439453483, '修改了商品属性1'),
(86, 'jin123456bat', 1439453584, '修改了商品属性1'),
(87, 'jin123456bat', 1439453673, '修改了商品属性1'),
(88, 'jin123456bat', 1439453685, '修改了商品属性1'),
(89, 'jin123456bat', 1439453808, '修改了商品(36)的操作方式:1'),
(90, 'jin123456bat', 1439453808, '修改了商品(37)的操作方式:1'),
(91, 'jin123456bat', 1439453808, '修改了商品(49)的操作方式:1'),
(92, 'jin123456bat', 1439453808, '修改了商品(50)的操作方式:1'),
(93, 'jin123456bat', 1439453808, '修改了商品(52)的操作方式:1'),
(94, 'jin123456bat', 1439453808, '修改了商品(53)的操作方式:1'),
(95, 'jin123456bat', 1439453808, '修改了商品(54)的操作方式:1'),
(96, 'jin123456bat', 1439453808, '修改了商品(57)的操作方式:1'),
(97, 'jin123456bat', 1439453808, '修改了商品(58)的操作方式:1'),
(98, 'jin123456bat', 1439453808, '修改了商品(59)的操作方式:1'),
(99, 'jin123456bat', 1439453815, '修改了商品(36)的操作方式:1'),
(100, 'jin123456bat', 1439453815, '修改了商品(37)的操作方式:1'),
(101, 'jin123456bat', 1439453815, '修改了商品(49)的操作方式:1'),
(102, 'jin123456bat', 1439453815, '修改了商品(50)的操作方式:1'),
(103, 'jin123456bat', 1439453815, '修改了商品(52)的操作方式:1'),
(104, 'jin123456bat', 1439453815, '修改了商品(53)的操作方式:1'),
(105, 'jin123456bat', 1439453815, '修改了商品(54)的操作方式:1'),
(106, 'jin123456bat', 1439453815, '修改了商品(57)的操作方式:1'),
(107, 'jin123456bat', 1439453815, '修改了商品(58)的操作方式:1'),
(108, 'jin123456bat', 1439453815, '修改了商品(59)的操作方式:1'),
(109, 'jin123456bat', 1439453815, '修改了商品(60)的操作方式:1'),
(110, 'jin123456bat', 1439453815, '修改了商品(56)的操作方式:1'),
(111, 'jin123456bat', 1439453815, '修改了商品(55)的操作方式:1'),
(112, 'jin123456bat', 1439453815, '修改了商品(61)的操作方式:1'),
(113, 'jin123456bat', 1439453815, '修改了商品(62)的操作方式:1'),
(114, 'jin123456bat', 1439453815, '修改了商品(63)的操作方式:1'),
(115, 'jin123456bat', 1439453815, '修改了商品(64)的操作方式:1'),
(116, 'jin123456bat', 1439453815, '修改了商品(65)的操作方式:1'),
(117, 'jin123456bat', 1439453815, '修改了商品(66)的操作方式:1'),
(118, 'jin123456bat', 1439453815, '修改了商品(67)的操作方式:1'),
(119, 'jin123456bat', 1439453815, '修改了商品(68)的操作方式:1'),
(120, 'jin123456bat', 1439453815, '修改了商品(69)的操作方式:1'),
(121, 'jin123456bat', 1439453815, '修改了商品(70)的操作方式:1'),
(122, 'jin123456bat', 1439453815, '修改了商品(71)的操作方式:1'),
(123, 'jin123456bat', 1439453876, '修改了商品属性1'),
(124, 'jin123456bat', 1439454336, '修改了商品属性1'),
(125, 'jin123456bat', 1439454346, '修改了商品属性1'),
(126, 'jin123456bat', 1439454365, '修改了商品属性1'),
(127, 'jin123456bat', 1439454426, '修改了商品属性1'),
(128, 'jin123456bat', 1439454611, '修改了商品属性1'),
(129, 'jin123456bat', 1439454871, '修改了商品属性1'),
(130, 'jin123456bat', 1439458885, '登陆了系统'),
(131, 'jin123456bat', 1439478220, '登陆了系统'),
(132, 'jin123456bat', 1439481418, '登陆了系统'),
(133, 'jin123456bat', 1439481481, '登陆了系统'),
(134, 'jin123456bat', 1439517910, '登陆了系统'),
(135, 'jin123456bat', 1439528676, '登陆了系统'),
(136, 'jin123456bat', 1439557639, '登陆了系统'),
(137, 'jin123456bat', 1439557657, '登陆了系统'),
(138, 'jin123456bat', 1439617558, '登陆了系统'),
(139, 'jin123456bat', 1439626858, '登陆了系统'),
(140, 'jin123456bat', 1439626900, '登陆了系统'),
(141, 'jin123456bat', 1439628081, '登陆了系统'),
(142, 'jin123456bat', 1439628661, '登陆了系统'),
(143, 'jin123456bat', 1439718166, '登陆了系统'),
(144, 'jin123456bat', 1439719740, '登陆了系统'),
(145, 'jin123456bat', 1439719759, '登陆了系统'),
(146, 'jin123456bat', 1439719778, '登陆了系统'),
(147, 'jin123456bat', 1439720194, '登陆了系统'),
(148, 'jin123456bat', 1439730662, '登陆了系统'),
(149, 'jin123456bat', 1439730822, '修改了商品属性1'),
(150, 'jin123456bat', 1439731034, '修改了商品属性1'),
(151, 'jin123456bat', 1439731152, '修改了商品属性1'),
(152, 'jin123456bat', 1439731162, '修改了商品属性1'),
(153, 'jin123456bat', 1439731197, '修改了商品属性1'),
(154, 'jin123456bat', 1439780934, '登陆了系统'),
(155, 'jin123456bat', 1439782204, '登陆了系统'),
(156, 'jin123456bat', 1439782206, '登陆了系统'),
(157, 'jin123456bat', 1439782230, '登陆了系统'),
(158, 'jin123456bat', 1439785386, '修改了商品属性1'),
(159, 'jin123456bat', 1439800234, '登陆了系统'),
(160, 'jin123456bat', 1439800619, '添加了一个分类'),
(161, 'jin123456bat', 1439862752, '登陆了系统'),
(162, 'jin123456bat', 1439878533, '登陆了系统'),
(163, 'jin123456bat', 1439949936, '登陆了系统'),
(164, 'jin123456bat', 1439949982, '登陆了系统'),
(165, 'jin123456bat', 1439949999, '登陆了系统'),
(166, 'jin123456bat', 1439951068, '修改了商品属性1'),
(167, 'jin123456bat', 1439951074, '修改了商品属性1'),
(168, 'jin123456bat', 1439951083, '修改了商品属性1'),
(169, 'jin123456bat', 1439951273, '修改了商品属性1'),
(170, 'jin123456bat', 1439951364, '修改了商品属性1'),
(171, 'jin123456bat', 1439951364, '修改了商品属性72'),
(172, 'jin123456bat', 1439951384, '修改了商品属性73'),
(173, 'jin123456bat', 1439951463, '修改了商品属性1'),
(174, 'jin123456bat', 1439951646, '修改了商品属性1'),
(175, 'jin123456bat', 1439951735, '修改了商品属性1'),
(176, 'jin123456bat', 1439951742, '修改了商品属性1'),
(177, 'jin123456bat', 1439951752, '修改了商品属性1'),
(178, 'jin123456bat', 1439951768, '修改了商品属性1'),
(179, 'jin123456bat', 1439951830, '修改了商品属性1'),
(180, 'jin123456bat', 1439951870, '修改了商品属性1'),
(181, 'jin123456bat', 1439951872, '修改了商品属性1'),
(182, 'jin123456bat', 1439951905, '修改了商品属性1'),
(183, 'jin123456bat', 1439951923, '修改了商品属性1'),
(184, 'jin123456bat', 1439951962, '修改了商品属性1'),
(185, 'jin123456bat', 1439952027, '修改了商品属性1'),
(186, 'jin123456bat', 1439952033, '修改了商品属性1'),
(187, 'jin123456bat', 1439952041, '修改了商品属性1'),
(188, 'jin123456bat', 1439955528, '登陆了系统'),
(189, 'jin123456bat', 1439994186, '登陆了系统'),
(190, 'jin123456bat', 1439994267, '登陆了系统'),
(191, 'jin123456bat', 1440080357, '登陆了系统'),
(192, 'jin123456bat', 1440136622, '登陆了系统'),
(193, 'jin123456bat', 1440136624, '登陆了系统'),
(194, 'jin123456bat', 1440138665, '添加了一个品牌测啊'),
(195, 'jin123456bat', 1440138708, '添加了一个品牌测啊'),
(196, 'jin123456bat', 1440138718, '添加了一个品牌测啊'),
(197, 'jin123456bat', 1440138719, '登陆了系统'),
(198, 'jin123456bat', 1440470657, '登陆了系统'),
(199, 'jin123456bat', 1440470658, '登陆了系统');

-- --------------------------------------------------------

--
-- 表的结构 `o2ouser`
--

CREATE TABLE IF NOT EXISTS `o2ouser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `ctime` int(11) NOT NULL,
  `rate` double(10,4) NOT NULL COMMENT '佣金比例',
  `num` int(11) NOT NULL,
  `money` double(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `o2ouser`
--

INSERT INTO `o2ouser` (`id`, `uid`, `ctime`, `rate`, `num`, `money`) VALUES
(8, 3, 1439448013, 0.3000, 0, 0.00),
(9, 15, 1439534856, 0.0020, 0, 0.00);

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
  KEY `oid` (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单中的货物信息' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `orderdetail`
--

INSERT INTO `orderdetail` (`id`, `oid`, `sku`, `pid`, `productname`, `unitprice`, `content`, `prototype`, `origin`, `score`, `num`) VALUES
(8, 14, '', 55, '飞利浦', 499.00, '', '', '中国', 0, 1),
(9, 15, '', 55, '飞利浦', 499.00, '', '长度:123米,宽度:25', '中国', 0, 1),
(10, 16, '', 55, '飞利浦', 499.00, '', '长度:123米,宽度:25,大小:23材料:石头', '中国', 0, 1);

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
  `discount` varchar(256) NOT NULL COMMENT '使用了什么折扣',
  `client` enum('web','wap','weixin','ios','android') NOT NULL,
  `action_type` int(11) NOT NULL DEFAULT '1' COMMENT '是否已经报过财付通接口，1没有，2已经报过',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=17 ;

--
-- 转存表中的数据 `orderlist`
--

INSERT INTO `orderlist` (`id`, `uid`, `paytype`, `paynumber`, `ordertotalamount`, `orderno`, `ordertaxamount`, `ordergoodsamount`, `feeamount`, `tradetime`, `createtime`, `totalamount`, `consignee`, `consigneetel`, `consigneeaddress`, `consigneeprovince`, `consigneecity`, `postmode`, `waybills`, `sendername`, `companyname`, `zipcode`, `note`, `status`, `discount`, `client`, `action_type`) VALUES
(14, 3, 'alipay', '', 1200.00, '2015081715463235884', 0.00, 12.00, 0.00, 0, 1439797592, 0.00, '金', '18548143019', '浙大科技园B606', '浙江', '杭州', 'SF', '', '我们家', '我们家', '301100', '', 0, '', 'web', 1),
(15, 3, 'alipay', '', 12.00, '2015081715530337185', 0.00, 12.00, 0.00, 0, 1439797983, 0.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'SF', '', '我们家', '我们家', '301100', '', 0, '', 'web', 1),
(16, 3, 'alipay', '', 12.00, '2015081715553336343', 0.00, 12.00, 0.00, 0, 1439798133, 0.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'SF', '', '我们家', '我们家', '301100', '', 0, '', 'web', 1);

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
  `score` int(11) NOT NULL COMMENT '购买赠送积分',
  `ordernum` int(11) NOT NULL,
  `complete_ordernum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=74 ;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `category`, `bid`, `starttime`, `endtime`, `description`, `short_description`, `time`, `price`, `stock`, `origin`, `label`, `status`, `orderby`, `meta_title`, `meta_keywords`, `meta_description`, `activity`, `oldprice`, `shipchar`, `score`, `ordernum`, `complete_ordernum`) VALUES
(36, '添加的一个商品', '', 24, 0, 1440950400, 1440950400, '', '', 1439951364, 0.00, 0, '英国', '限时热卖', 1, 0, '元属性标题', '', '元属性描述', 'seckill', 12.00, '意大利米兰直邮回国内', 12, 0, 0),
(37, '一二三次', '', 31, 2, 1438272000, 1638272000, '', '', 1438654297, 0.00, 0, '英国', '', 1, 0, '', '', '', '', 0.00, '', 0, 0, 0),
(49, '哎呦', '', 0, 2, 0, 0, '', '', 1438682509, 0.00, 0, '英国', '1', 1, 0, '', '', '', 'seckill', 0.00, '', 0, 0, 0),
(50, 'abcd', '', 0, 3, 1439395200, 1440864000, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0023.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0023.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '', 1439952041, 0.00, 0, '英国', '', 1, 0, 'asdfasdf', '', 'asdfasdf', 'sale', 0.00, '', 0, 0, 0),
(52, '测试用的名字哈', '', 0, 0, 1438704000, 1438704000, '', '', 1438787988, 0.00, 0, '英国', '1', 1, 0, '', '', '', 'seckill', 0.00, '', 0, 0, 0),
(53, '啊哈', '', 0, 0, 1438790400, 1440691200, '', '', 1439731197, 99.00, 5, '英国', '', 1, 0, '', '', '', 'fullcut', 100.00, '', 0, 0, 0),
(54, '哎呦 不错哦', '', 0, 0, 1439222400, 1439222400, '', '', 1439287383, 10.00, 0, '英国', '1', 1, 0, '', '', '', '', 0.00, '', 0, 0, 0),
(55, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 1439395200, 1440864000, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0002.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0002.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '和田玉', 1439731034, 499.00, 102, '英国', '热卖商品', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', 'seckill', 0.00, '意大利直邮', 0, 0, 0),
(56, '啊打发手动阀手动阀啊手动阀手动阀打发', '123123123', 31, 2, 1438358400, 1440777600, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;\n															啊的说法是打发打发打发打发的&lt;/p&gt;&lt;p&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '短描述', 1439287479, 123.00, 1234, '英国', '1', 1, 132, '', '', '', '', 0.00, '', 0, 0, 0),
(57, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '', 22, 2, 1439395200, 1440777600, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '和田玉', 1439454871, 497.00, 104, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', 'sale', 0.00, '从意大利米兰发货直邮回国', 0, 0, 0),
(58, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '', 22, 2, 1439395200, 1439395200, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '和田玉', 1439454365, 497.00, 104, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(59, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '', 22, 2, 1439395200, 1439395200, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '和田玉', 1439454426, 0.00, 0, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(60, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439452167, 0.00, 0, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(61, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439452211, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(62, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439452428, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(63, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439452476, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(64, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439452826, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(65, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439452866, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(66, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439453008, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(67, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439453048, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(68, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439453104, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(69, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439453158, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(70, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 0, 0, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\r\n															\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;&lt;p&gt;\r\n														&lt;/p&gt;', '和田玉', 1439453241, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(71, '1元拍卖和田玉 真皮籽料吊坠天然白玉男女玉石挂件正品带证书热卖', '123123123123', 22, 2, 1439395200, 1439395200, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0001.gif&quot;/&gt;\n															\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '和田玉', 1439453876, 501.00, 102, '英国', '', 1, 1, '啊啊啊啊啊', '', '踩踩踩踩踩踩踩踩踩', '', 0.00, '', 0, 0, 0),
(72, '', '添加的一个商品', 0, 24, 0, 0, '', '', 0, 99999999.99, 0, '英国', '中国', 0, 0, '0', '元属性标题', '', '', 12.00, '意大利米兰直邮回国内', 0, 0, 0),
(73, '', '添加的一个商品', 0, 24, 0, 0, '', '', 0, 99999999.99, 0, '英国', '中国', 0, 0, '0', '元属性标题', '', '', 12.00, '意大利米兰直邮回国内', 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='异步响应式上传图片，不能加外键约束' AUTO_INCREMENT=86 ;

--
-- 转存表中的数据 `productimg`
--

INSERT INTO `productimg` (`id`, `pid`, `title`, `orderby`, `base_path`, `small_path`, `thumbnail_path`) VALUES
(41, 37, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png'),
(43, 36, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png'),
(44, 48, '2014grate.png', 1, 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_200x200.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_100x100.png'),
(71, 55, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_200x200.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(72, 55, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(73, 55, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_200x200.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(74, 71, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_200x200.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(75, 71, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(76, 71, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_200x200.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(77, 59, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_200x200.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(78, 59, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(79, 59, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_200x200.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(80, 57, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_200x200.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(81, 57, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(82, 57, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_200x200.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(83, 58, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_200x200.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(84, 58, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(85, 58, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_200x200.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性表，异步式属性对接，不要约束' AUTO_INCREMENT=61 ;

--
-- 转存表中的数据 `prototype`
--

INSERT INTO `prototype` (`id`, `pid`, `name`, `type`, `value`) VALUES
(4, 48, '长度吗', 'text', '123'),
(26, 73, '重量', 'text', 'cccc'),
(34, 37, '长度', 'radio', 'a:4:{i:0;s:1:"a";i:1;s:1:"b";i:2;s:1:"c";i:3;s:1:"d";}'),
(35, 37, '尺码', 'radio', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}'),
(39, 37, '好的', 'text', '啊哈哈'),
(43, 37, 'aa', 'text', 'bbb'),
(51, 52, 'xx', 'radio', 'a:2:{i:0;s:2:"aa";i:1;s:2:"bb";}'),
(52, 62, '品种', 'text', '羊脂白玉'),
(53, 61, '品牌', 'text', '语石良园'),
(54, 60, '大小', 'radio', 'a:4:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";i:3;s:1:"4";}'),
(55, 58, '长度', 'radio', 'a:3:{i:0;s:1:"a";i:1;s:1:"b";i:2;s:1:"c";}'),
(56, 57, '啊', 'text', '额'),
(57, 55, '长度', 'text', '123米'),
(58, 55, '宽度', 'text', '25'),
(59, 55, '大小', 'radio', 'a:4:{i:0;s:2:"12";i:1;s:2:"23";i:2;s:2:"34";i:3;s:2:"45";}'),
(60, 55, '材料', 'radio', 'a:3:{i:0;s:6:"石头";i:1;s:6:"木头";i:2;s:3:"铁";}');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `address`, `brand`, `category`, `combine`, `comment`, `coupon`, `fullcut`, `product`, `user`, `admin`, `orderlist`, `sale`, `seckill`, `role`, `ship`, `o2ouser`, `theme`, `help`, `carousel`) VALUES
(1, '管理员', 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15, 15),
(11, '商品管理员', 0, 15, 15, 15, 15, 15, 15, 15, 0, 0, 15, 15, 15, 0, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='限时特卖' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `sale`
--

INSERT INTO `sale` (`id`, `sname`, `pid`, `starttime`, `endtime`, `price`, `orderby`) VALUES
(2, '八月活动', 50, 1438617600, 1439222400, 13.00, 1),
(3, '八月活动', 56, 1265058000, 1441036200, 121.00, 100),
(4, '八月活动', 55, 1438621200, 1447293600, 501.00, 5),
(5, '八月活动', 58, 1438677000, 1440777600, 497.00, 5),
(6, '八月活动', 59, 1438704300, 1440086400, 0.00, 5),
(7, '八月活动', 57, 1438531200, 1440780300, 497.00, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `seckill`
--

INSERT INTO `seckill` (`id`, `sname`, `pid`, `starttime`, `endtime`, `orderby`, `price`) VALUES
(4, '八月促销', 52, 1438444800, 1438531200, 1, 14.00),
(5, '限时折扣', 57, 1438531200, 1441017000, 66, 497.00),
(6, '', 36, 1439723840, 1439810240, 1, 0.00),
(7, '', 49, 1439723999, 1439810399, 1, 0.00),
(8, '八月销售', 55, 1438565100, 1440950400, 3, 123.00);

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
  `value` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`id`, `name`, `type`, `value`) VALUES
(1, 'companyname', 'system', '我们家'),
(2, 'sendername', 'system', '我们家'),
(3, 'smstemplate', 'system', '感谢您对我们家的支持和信赖，以下是您的验证码%s');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题详情' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `theme`
--

INSERT INTO `theme` (`id`, `name`, `description`, `bigpic`, `middlepic`, `smallpic`) VALUES
(6, '名称123', '山东分公司分公司的风格', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x280.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_320x260.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_320x130.jpg');

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
(1, 6, 36);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `gravatar`, `username`, `telephone`, `email`, `password`, `regtime`, `logtime`, `money`, `score`, `ordernum`, `cost`, `salt`, `close`, `oid`, `client`) VALUES
(3, 'D:/wamp/www/home/application/upload/eb59ac76d245b880de6de5df44d451533e88c90fb029abe0392f7ec0ea5a3c6b78639560_200x200.gif', 'vvvv', '12345678901', '326550324@qq.com', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 1, 0.00, 'QlRRU9', 0, 0, 'web'),
(4, '', '0', '12345678902', '', '0b6ea8fdab7e481a29c1c10b95d82b9a', 1437936558, 1437936558, 0.00, 0, 0, 0.00, 'pS3huq', 1, 3, 'web'),
(5, '', '0', '12345678903', '', '4b35eaed14f338d9b018fe09a2fb8719', 1437968089, 1437968089, 0.00, 0, 0, 0.00, 'Cl8BHd', 0, 0, 'web'),
(7, '', '0', '12345678904', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 1, 0, 'web'),
(8, '', '0', '12345678905', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 1, 0, 'web'),
(15, '', '0', '10987654321', '', '359bf8813a422cd25c57e078b5f7800c', 1438586378, 1438586378, 0.00, 0, 0, 0.00, 'pkyeck', 0, 0, 'web'),
(17, '', '', '18548143019', '', '2ab3dc8e4b03e11beeaaff9cbfb3375e', 1439889196, 1439889196, 0.00, 0, 0, 0.00, 'KtTTiU', 0, 0, 'web');

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
  ADD CONSTRAINT `theme_product_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `theme_product_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
