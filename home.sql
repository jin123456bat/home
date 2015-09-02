-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-31 04:21:23
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='优惠券打折码' AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `coupon`
--

INSERT INTO `coupon` (`id`, `couponno`, `uid`, `total`, `starttime`, `endtime`, `times`, `max`, `display`, `type`, `value`) VALUES
(9, '150809034054LK2F', 0, 123, 1438790400, 1440691200, 123, 0.00, 0, 'fixed', 200.00),
(11, '150809034519TWJF', 0, 100, 1439063121, 1439149521, 100, 0.00, 0, 'discount', 0.70),
(16, '150819155201IAXQ', 0, 121354, 1437840000, 1446048000, 121354, 100.00, 1, 'fixed', 50.00),
(17, '150819155228XFV5', 0, 321, 1437840000, 1446048000, 321, 200.00, 1, 'discount', 0.50),
(18, '150819155456YATT', 0, 12, 1437840000, 1441382400, 12, 200.00, 1, 'discount', 0.90),
(19, '150819155519XPVE', 0, 11, 1437926400, 1441382400, 11, 123.00, 0, 'fixed', 66.00),
(20, '150830151130C8NO', 3, 121131, 1438617600, 1441382400, 121131, 500.00, 0, 'discount', 0.70);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `coupondetail`
--

INSERT INTO `coupondetail` (`id`, `couponid`, `categoryid`) VALUES
(3, 9, 24),
(4, 9, 25),
(7, 11, 0),
(13, 16, 0),
(14, 17, 0),
(15, 18, 0),
(16, 19, 24),
(17, 20, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `fullcut`
--

INSERT INTO `fullcut` (`id`, `name`, `max`, `minus`, `starttime`, `endtime`) VALUES
(8, '满100减20', 100, 20, 1437840000, 1444406700);

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
-- 表的结构 `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=322 ;

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
(199, 'jin123456bat', 1440470658, '登陆了系统'),
(200, 'jin123456bat', 1440557594, '登陆了系统'),
(201, 'jin123456bat', 1440557596, '登陆了系统'),
(202, 'jin123456bat', 1440561059, '修改了商品属性1'),
(203, 'jin123456bat', 1440561080, '修改了商品属性1'),
(204, 'jin123456bat', 1440561151, '修改了商品属性1'),
(205, 'jin123456bat', 1440600761, '登陆了系统'),
(206, 'jin123456bat', 1440600763, '登陆了系统'),
(207, 'jin123456bat', 1440640879, '登陆了系统'),
(208, 'jin123456bat', 1440640881, '登陆了系统'),
(209, 'jin123456bat', 1440647973, '登陆了系统'),
(210, 'jin123456bat', 1440647973, '登陆了系统'),
(211, 'jin123456bat', 1440647976, '登陆了系统'),
(212, 'jin123456bat', 1440647977, '登陆了系统'),
(213, 'jin123456bat', 1440647992, '登陆了系统'),
(214, 'jin123456bat', 1440647993, '登陆了系统'),
(215, 'jin123456bat', 1440648030, '登陆了系统'),
(216, 'jin123456bat', 1440648031, '登陆了系统'),
(217, 'jin123456bat', 1440648058, '登陆了系统'),
(218, 'jin123456bat', 1440648059, '登陆了系统'),
(219, 'jin123456bat', 1440648065, '登陆了系统'),
(220, 'jin123456bat', 1440648066, '登陆了系统'),
(221, 'jin123456bat', 1440648493, '登陆了系统'),
(222, 'jin123456bat', 1440648494, '登陆了系统'),
(223, 'jin123456bat', 1440654559, '登陆了系统'),
(224, 'jin123456bat', 1440654560, '登陆了系统'),
(225, 'jin123456bat', 1440669582, '登陆了系统'),
(226, 'jin123456bat', 1440669583, '登陆了系统'),
(227, 'jin123456bat', 1440678897, '登陆了系统'),
(228, 'jin123456bat', 1440678899, '登陆了系统'),
(229, 'jin123456bat', 1440733331, '登陆了系统'),
(230, 'jin123456bat', 1440733333, '登陆了系统'),
(231, 'jin123456bat', 1440734679, '修改了商品(36)的操作方式:3'),
(232, 'jin123456bat', 1440734683, '修改了商品(36)的操作方式:3'),
(233, 'jin123456bat', 1440734711, '修改了商品(36)的操作方式:3'),
(234, 'jin123456bat', 1440735029, '修改了商品(36)的操作方式:3'),
(235, 'jin123456bat', 1440744197, '修改了商品(36)的操作方式:3'),
(236, 'jin123456bat', 1440744275, '修改了商品(36)的操作方式:2'),
(237, 'jin123456bat', 1440744275, '修改了商品(37)的操作方式:2'),
(238, 'jin123456bat', 1440744280, '修改了商品(36)的操作方式:3'),
(239, 'jin123456bat', 1440744467, '修改了商品(36)的操作方式:3'),
(240, 'jin123456bat', 1440744621, '修改了商品(36)的操作方式:3'),
(241, 'jin123456bat', 1440745087, '修改了商品(36)的操作方式:3'),
(242, 'jin123456bat', 1440745355, '修改了商品(36)的操作方式:3'),
(243, 'jin123456bat', 1440746031, '修改了商品(36)的操作方式:3'),
(244, 'jin123456bat', 1440746074, '修改了商品(36)的操作方式:3'),
(245, 'jin123456bat', 1440746456, '修改了商品(36)的操作方式:3'),
(246, 'jin123456bat', 1440746478, '修改了商品(36)的操作方式:3'),
(247, 'jin123456bat', 1440746736, '修改了商品(36)的操作方式:3'),
(248, 'jin123456bat', 1440746790, '修改了商品(36)的操作方式:3'),
(249, 'jin123456bat', 1440747761, '修改了商品(36)的操作方式:3'),
(250, 'jin123456bat', 1440747769, '修改了商品(37)的操作方式:3'),
(251, 'jin123456bat', 1440747773, '修改了商品(37)的操作方式:3'),
(252, 'jin123456bat', 1440747781, '修改了商品(37)的操作方式:3'),
(253, 'jin123456bat', 1440748105, '修改了商品(37)的操作方式:3'),
(254, 'jin123456bat', 1440769354, '登陆了系统'),
(255, 'jin123456bat', 1440769355, '登陆了系统'),
(256, 'jin123456bat', 1440786180, '修改了商品属性74'),
(257, 'jin123456bat', 1440786322, '修改了商品属性75'),
(258, 'jin123456bat', 1440786355, '修改了商品属性76'),
(259, 'jin123456bat', 1440787297, '修改了商品属性77'),
(260, 'jin123456bat', 1440787366, '修改了商品(49)的操作方式:3'),
(261, 'jin123456bat', 1440787366, '修改了商品(50)的操作方式:3'),
(262, 'jin123456bat', 1440787366, '修改了商品(52)的操作方式:3'),
(263, 'jin123456bat', 1440787366, '修改了商品(53)的操作方式:3'),
(264, 'jin123456bat', 1440787366, '修改了商品(54)的操作方式:3'),
(265, 'jin123456bat', 1440787366, '修改了商品(55)的操作方式:3'),
(266, 'jin123456bat', 1440787453, '修改了商品(49)的操作方式:3'),
(267, 'jin123456bat', 1440787453, '修改了商品(50)的操作方式:3'),
(268, 'jin123456bat', 1440787453, '修改了商品(52)的操作方式:3'),
(269, 'jin123456bat', 1440787453, '修改了商品(53)的操作方式:3'),
(270, 'jin123456bat', 1440787453, '修改了商品(54)的操作方式:3'),
(271, 'jin123456bat', 1440787453, '修改了商品(55)的操作方式:3'),
(272, 'jin123456bat', 1440787493, '修改了商品(49)的操作方式:3'),
(273, 'jin123456bat', 1440787493, '修改了商品(50)的操作方式:3'),
(274, 'jin123456bat', 1440787493, '修改了商品(52)的操作方式:3'),
(275, 'jin123456bat', 1440787493, '修改了商品(53)的操作方式:3'),
(276, 'jin123456bat', 1440787493, '修改了商品(54)的操作方式:3'),
(277, 'jin123456bat', 1440787493, '修改了商品(55)的操作方式:3'),
(278, 'jin123456bat', 1440787493, '修改了商品(56)的操作方式:3'),
(279, 'jin123456bat', 1440787493, '修改了商品(57)的操作方式:3'),
(280, 'jin123456bat', 1440787493, '修改了商品(58)的操作方式:3'),
(281, 'jin123456bat', 1440787493, '修改了商品(59)的操作方式:3'),
(282, 'jin123456bat', 1440787493, '修改了商品(60)的操作方式:3'),
(283, 'jin123456bat', 1440787493, '修改了商品(61)的操作方式:3'),
(284, 'jin123456bat', 1440787493, '修改了商品(62)的操作方式:3'),
(285, 'jin123456bat', 1440787493, '修改了商品(63)的操作方式:3'),
(286, 'jin123456bat', 1440787493, '修改了商品(64)的操作方式:3'),
(287, 'jin123456bat', 1440787493, '修改了商品(65)的操作方式:3'),
(288, 'jin123456bat', 1440787493, '修改了商品(66)的操作方式:3'),
(289, 'jin123456bat', 1440787493, '修改了商品(67)的操作方式:3'),
(290, 'jin123456bat', 1440787493, '修改了商品(68)的操作方式:3'),
(291, 'jin123456bat', 1440787493, '修改了商品(69)的操作方式:3'),
(292, 'jin123456bat', 1440787493, '修改了商品(70)的操作方式:3'),
(293, 'jin123456bat', 1440787493, '修改了商品(71)的操作方式:3'),
(294, 'jin123456bat', 1440787493, '修改了商品(72)的操作方式:3'),
(295, 'jin123456bat', 1440787493, '修改了商品(73)的操作方式:3'),
(296, 'jin123456bat', 1440787493, '修改了商品(74)的操作方式:3'),
(297, 'jin123456bat', 1440787493, '修改了商品(75)的操作方式:3'),
(298, 'jin123456bat', 1440787493, '修改了商品(76)的操作方式:3'),
(299, 'jin123456bat', 1440787493, '修改了商品(77)的操作方式:3'),
(300, 'jin123456bat', 1440787510, '修改了商品属性78'),
(301, 'jin123456bat', 1440787663, '修改了商品属性79'),
(302, 'jin123456bat', 1440787708, '修改了商品属性80'),
(303, 'jin123456bat', 1440787987, '修改了商品属性81'),
(304, 'jin123456bat', 1440788066, '修改了商品属性82'),
(305, 'jin123456bat', 1440788234, '修改了商品属性83'),
(306, 'jin123456bat', 1440851839, '登陆了系统'),
(307, 'jin123456bat', 1440851841, '登陆了系统'),
(308, 'jin123456bat', 1440912909, '登陆了系统'),
(309, 'jin123456bat', 1440912910, '登陆了系统'),
(310, 'jin123456bat', 1440912920, '登陆了系统'),
(311, 'jin123456bat', 1440912920, '登陆了系统'),
(312, 'jin123456bat', 1440927191, '修改了商品属性1'),
(313, 'jin123456bat', 1440927992, '修改了商品属性1'),
(314, 'jin123456bat', 1440928185, '修改了商品属性1'),
(315, 'jin123456bat', 1440935551, '修改了商品属性1'),
(316, 'jin123456bat', 1440941574, '修改了商品属性84'),
(317, 'jin123456bat', 1440942376, '修改了商品属性1'),
(318, 'jin123456bat', 1440943791, '登陆了系统'),
(319, 'jin123456bat', 1440943792, '登陆了系统'),
(320, 'jin123456bat', 1440986941, '登陆了系统'),
(321, 'jin123456bat', 1440986943, '登陆了系统');

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
(8, 3, 1439448013, '', '', '', 0.3000, 0, 0.00),
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
(14, 3, 'alipay', '', 900.00, '2015081715463235888', 0.00, 12.00, 0.00, 0, 1439797592, 0.00, '金', '18548143019', '浙大科技园B606', '浙江', '杭州', 'SF', '', '我们家', '我们家', '301100', '你好吗？', 0, '', 'web', 1, 0, 0, 0, ''),
(15, 3, 'alipay', '', 12.00, '2015081715530337185', 0.00, 12.00, 0.00, 0, 1439797983, 0.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'SF', '', '我们家', '我们家', '301100', '凑合吧', 0, '', 'web', 1, 0, 0, 0, ''),
(16, 3, 'alipay', '', 12.00, '2015081715553336343', 0.00, 12.00, 0.00, 0, 1439798133, 0.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'SF', '', '我们家', '我们家', '301100', '', 0, '', 'web', 1, 0, 0, 0, '');

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
  `price` double(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `origin` varchar(256) NOT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=85 ;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `category`, `bid`, `starttime`, `endtime`, `description`, `short_description`, `price`, `stock`, `origin`, `label`, `status`, `orderby`, `meta_title`, `meta_keywords`, `meta_description`, `oldprice`, `shipchar`, `score`, `activity`, `ordernum`, `complete_ordernum`, `time`) VALUES
(78, '好名字', '测试商品', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, '', '', 1, 0, '', '', '', 0.00, '', 0, 'seckill', 0, 0, 1440927191),
(79, '测试商品', '策划', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, '', '', 1, 0, '', '', '', 0.00, '', 0, 'sale', 0, 0, 0),
(80, '名称', '添加名称', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, '', '', 1, 0, '', '', '', 0.00, '', 0, 'fullcut', 0, 0, 0),
(81, '测试名称啊啊啊啊啊啊啊啊啊啊啊', '变啊妈啊的fads发', 0, 0, 0, 0, '', '', 0.00, 0, '', '1', 0, 0, '', '', '', 0.00, '0', 0, '', 0, 0, 1440787987),
(82, '123', '321', 0, 0, 1440864000, 1440864000, '', '', 1.00, 1, '', '1', 1, 0, '', '', '烦烦烦', 1.00, '0', 0, '', 0, 0, 1440927992),
(83, '名称', '编码', 22, 1, 1439222400, 1441036800, '长描述&lt;p&gt;\n															\n														&lt;/p&gt;', '短描述', 123.00, 10, '中国', '1', 0, 999, '元标题', '元关键字', '元描述', 145.00, 'shipchar', 9, '', 0, 0, 1440788234),
(84, '图像测试', '', 0, 0, 1440864000, 1440864000, '', '', 0.00, 0, '', '1', 1, 0, '', '', '', 0.00, '', 0, '', 0, 0, 1440941574);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='异步响应式上传图片，不能加外键约束' AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `productimg`
--

INSERT INTO `productimg` (`id`, `pid`, `title`, `orderby`, `oldimage`, `base_path`, `small_path`, `thumbnail_path`) VALUES
(1, 0, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_300x300.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(2, 0, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(3, 0, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(4, 0, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_300x300.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(5, 0, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(6, 0, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg'),
(7, 84, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_300x300.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(8, 84, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(10, 0, 'TB1..15IVXXXXb6aXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x320.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_300x300.jpg', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(11, 0, 'TB1p_ZzIVXXXXXraXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_300x300.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_100x100.jpg'),
(12, 0, 'TB1QDMWIVXXXXXLXXXXXXXXXXXX_!!0-item_pic.jpg', 1, 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_640x320.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_300x300.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_100x100.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性表，异步式属性对接，不要约束' AUTO_INCREMENT=62 ;

--
-- 转存表中的数据 `prototype`
--

INSERT INTO `prototype` (`id`, `pid`, `name`, `type`, `value`) VALUES
(61, 83, '长度', 'text', '12米');

-- --------------------------------------------------------

--
-- 表的结构 `refund`
--

CREATE TABLE IF NOT EXISTS `refund` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `reason` text NOT NULL,
  `handle` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `oid` (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `refund`
--

INSERT INTO `refund` (`id`, `oid`, `time`, `reason`, `handle`) VALUES
(1, 14, 1234567, '测试腿裤哦', 0);

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
  `num` int(11) NOT NULL COMMENT '赠送优惠券数量',
  `coupon_starttime` int(11) NOT NULL,
  `coupon_endtime` int(11) NOT NULL,
  `redict_type` enum('index','theme','product','url','none') NOT NULL,
  `redict` varchar(256) NOT NULL COMMENT '活动领取后跳转地址',
  `stoptime` tinyint(2) NOT NULL COMMENT '悬浮窗停留时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='新用户注册登录后的悬浮窗' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `register`
--

INSERT INTO `register` (`id`, `name`, `starttime`, `endtime`, `content`, `num`, `coupon_starttime`, `coupon_endtime`, `redict_type`, `redict`, `stoptime`) VALUES
(1, '新用户注册送好礼', 0, 0, '<a href="123">哇哈哈哈哈哈</a>', 0, 0, 0, 'index', '', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表' AUTO_INCREMENT=26 ;

--
-- 转存表中的数据 `system`
--

INSERT INTO `system` (`id`, `name`, `type`, `value`) VALUES
(1, 'companyname', 'system', '我们家'),
(2, 'sendername', 'system', '我们家'),
(3, 'smstemplate', 'system', '感谢您对我们家的支持和信赖，以下是您的验证码%s'),
(4, 'mchid', 'weixin', '1226923702'),
(5, 'appid', 'weixin', 'wxacf21161e3c578f1'),
(6, 'key', 'weixin', 'Zhy781525073AsDfGh12ZgdZxCvBnMlK'),
(7, 'appsecret', 'weixin', 'a9edccfb3018342657334dabd8873357'),
(8, 'partner', 'alipay', '2088021017666931'),
(9, 'key', 'alipay', '4508mayei5zbmsmopp6tlobdf83d2kz6'),
(10, 'currency', 'alipay', 'USD'),
(11, 'splitpartner', 'alipay', '2088801766902304'),
(12, 'splitrate', 'alipay', '0.5'),
(13, 'splitcurrency', 'alipay', 'CNY'),
(15, 'timeout', 'payment', '30'),
(20, 'productbasewidth', 'image', '640'),
(21, 'productbaseheight', 'image', '320'),
(22, 'productsmallwidth', 'image', '300'),
(23, 'productsmallheight', 'image', '300'),
(24, 'productthumbnailwidth', 'image', '100'),
(25, 'productthumbnailheight', 'image', '100');

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
(6, '测试主题标题', '测试主题描述', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x280.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_320x260.jpg', 'D:/wamp/www/home/application/upload/8db3ae15d442d4519226f65b41945f4180ccbd7b8a5a51b7df731f623f2adedc7817bd4a_320x130.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='主题和产品关系表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `theme_product`
--

INSERT INTO `theme_product` (`id`, `tid`, `pid`) VALUES
(3, 6, 82);

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
(3, 'D:/wamp/www/home/application/upload/eb59ac76d245b880de6de5df44d451533e88c90fb029abe0392f7ec0ea5a3c6b78639560_200x200.gif', 'vvvv', '12345678901', '326550324@qq.com', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 1, 0.00, 'QlRRU9', 0, 0, 'web'),
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
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`oid`) REFERENCES `orderlist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- 限制表 `theme_product`
--
ALTER TABLE `theme_product`
  ADD CONSTRAINT `theme_product_ibfk_1` FOREIGN KEY (`tid`) REFERENCES `theme` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `theme_product_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
