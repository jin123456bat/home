-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2015-08-05 07:33:46
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
  `city` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `telephone` char(11) NOT NULL,
  `host` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='收货地址' AUTO_INCREMENT=1 ;

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
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'jin123456batjin123456bat', 'b99f1a1c875c4f200449dc55eb4b77a6', 1),
(3, 'jin123456bat', 'b99f1a1c875c4f200449dc55eb4b77a6', 1),
(4, '123123', '4297f44b13955235245b2497399d7a93', 1),
(5, '123123123', 'f5bb0c8de146c67b44babbf4e6584cc0', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL COMMENT '产品id',
  `cid` int(11) NOT NULL DEFAULT '0' COMMENT 'collection的id，属性价格映射id',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `collection`
--

INSERT INTO `collection` (`id`, `pid`, `content`, `stock`, `price`, `sku`) VALUES
(22, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"0";}', 100, 100.00, 'jin'),
(23, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"0";}', 100, 100.00, 'jin'),
(24, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"0";}', 100, 100.00, 'jin'),
(25, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"0";}', 100, 100.00, 'jin'),
(26, 36, 'a:2:{i:34;s:1:"1";i:35;s:1:"0";}', 100, 110.00, 'jin2'),
(27, 36, 'a:2:{i:34;s:1:"2";i:35;s:1:"0";}', 100, 120.00, 'jin3'),
(28, 36, 'a:2:{i:34;s:1:"3";i:35;s:1:"0";}', 100, 130.00, 'jin4'),
(29, 36, 'a:2:{i:34;s:1:"0";i:35;s:1:"1";}', 123465, 0.00, '');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `uid`, `pid`, `time`, `content`, `score`) VALUES
(1, 1, 36, 1234567, '评论内容', 4);

-- --------------------------------------------------------

--
-- 表的结构 `comment_pic`
--

CREATE TABLE IF NOT EXISTS `comment_pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL COMMENT '评论id',
  `pic_path` varchar(256) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `fullcutdetail`
--

CREATE TABLE IF NOT EXISTS `fullcutdetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `log`
--

INSERT INTO `log` (`id`, `username`, `time`, `content`) VALUES
(1, 'jin123456bat', 123456890, '正在building');

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
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `swift` int(11) NOT NULL COMMENT '流水号，订单编号',
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单中的货物信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `sku` varchar(256) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `cid` int(11) NOT NULL COMMENT '商品属性组，商品属性组中的属性可能会影响该字段中的数值',
  `bid` int(11) NOT NULL COMMENT '品牌',
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `description` text NOT NULL,
  `short_description` text NOT NULL,
  `time` int(11) NOT NULL COMMENT '货物上架时间',
  `price` double(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `origin` varchar(256) NOT NULL,
  `label` varchar(256) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `orderby` int(11) NOT NULL,
  `ship` varchar(256) NOT NULL COMMENT '运送方案id，可能有多个，用户自选',
  `meta_title` varchar(256) NOT NULL,
  `meta_keywords` varchar(512) NOT NULL,
  `meta_description` varchar(256) NOT NULL,
  `truth` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `sku`, `category`, `cid`, `bid`, `starttime`, `endtime`, `description`, `short_description`, `time`, `price`, `stock`, `origin`, `label`, `status`, `orderby`, `ship`, `meta_title`, `meta_keywords`, `meta_description`, `truth`) VALUES
(36, '添加的一个商品', '', 24, 0, 0, 1438704000, 1438704000, '', '', 1438749509, 0.00, 0, '中国', '限时热卖', 1, 0, '', '元属性标题', '', '元属性描述', ''),
(37, '一二三次', '', 31, 0, 0, 1438272000, 1438272000, '', '', 1438654297, 0.00, 0, '', '', 1, 0, '', '', '', '', ''),
(49, '哎呦', '', 0, 0, 0, 0, 0, '', '', 1438682509, 0.00, 0, '', '1', 0, 0, '', '', '', '', ''),
(50, 'abcd', '', 0, 0, 0, 0, 0, '&lt;p&gt;&lt;img src=&quot;http://img.baidu.com/hi/jx2/j_0023.gif&quot; _src=&quot;http://img.baidu.com/hi/jx2/j_0023.gif&quot;/&gt;\n															\n														&lt;/p&gt;', '', 1438708384, 0.00, 0, '', '', 1, 0, '', 'asdfasdf', 'adsfasdf', 'asdfasdf', '');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- 转存表中的数据 `productimg`
--

INSERT INTO `productimg` (`id`, `pid`, `title`, `orderby`, `base_path`, `small_path`, `thumbnail_path`) VALUES
(41, 37, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png'),
(43, 36, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png'),
(44, 48, '2014grate.png', 1, 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_200x200.png', 'D:/wamp/www/home/application/upload/0bffea24c2abb9cc9362daf3df64005ecdd2089c798e0fee29f0e6f6ae19e05a273a1c92_100x100.png'),
(45, 0, '2014shop_background_img.png', 1, 'D:/wamp/www/home/application/upload/73b633331d63858739b16a25bd450f52d52461603e1121435ffaa88c098ee40faa85c142.png', 'D:/wamp/www/home/application/upload/73b633331d63858739b16a25bd450f52d52461603e1121435ffaa88c098ee40faa85c142_200x200.png', 'D:/wamp/www/home/application/upload/73b633331d63858739b16a25bd450f52d52461603e1121435ffaa88c098ee40faa85c142_100x100.png'),
(46, 0, '20130330C.png', 1, 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_200x200.png', 'D:/wamp/www/home/application/upload/1d0129ddb80e1d4287fda22e67a171fde60177088ff1c35441220d4701739462b73ff3a8_100x100.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='属性表' AUTO_INCREMENT=44 ;

--
-- 转存表中的数据 `prototype`
--

INSERT INTO `prototype` (`id`, `pid`, `name`, `type`, `value`) VALUES
(4, 48, '长度吗', 'text', '123'),
(26, 36, 'asdfasdf', 'text', 'cccc'),
(34, 36, 'haha', 'radio', 'a:4:{i:0;s:1:"a";i:1;s:1:"b";i:2;s:1:"c";i:3;s:1:"d";}'),
(35, 36, 'c', 'radio', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}'),
(37, 36, '长度', 'text', '100'),
(39, 49, '好的', 'text', '啊哈哈'),
(43, 50, 'aa', 'text', 'bbb');

-- --------------------------------------------------------

--
-- 表的结构 `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL COMMENT '用户组名',
  `brand` tinyint(2) NOT NULL DEFAULT '15',
  `category` tinyint(2) NOT NULL DEFAULT '15',
  `collection` tinyint(2) NOT NULL,
  `comment` tinyint(2) NOT NULL,
  `product` tinyint(2) NOT NULL,
  `user` tinyint(2) NOT NULL,
  `admin` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `role`
--

INSERT INTO `role` (`id`, `name`, `brand`, `category`, `collection`, `comment`, `product`, `user`, `admin`) VALUES
(1, '管理员', 2, 15, 0, 0, 15, 15, 15),
(2, '123123', 15, 15, 0, 0, 0, 0, 0),
(3, '123123', 15, 15, 15, 15, 15, 15, 15);

-- --------------------------------------------------------

--
-- 表的结构 `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `starttime` int(11) NOT NULL,
  `endtime` int(11) NOT NULL,
  `price` double NOT NULL,
  `orderby` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='限时特卖' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `seckill`
--

CREATE TABLE IF NOT EXISTS `seckill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `time` int(11) NOT NULL COMMENT '开始时间',
  `last` int(11) NOT NULL COMMENT '持续时间',
  `orderby` int(11) NOT NULL,
  `rate` double(2,2) NOT NULL COMMENT '折扣率',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ship`
--

CREATE TABLE IF NOT EXISTS `ship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `price` double(10,2) NOT NULL,
  `max` double(10,2) NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '为0则固定运费max无效，运费为price，否则订单价格超过limit则为price',
  `shipuser` varchar(256) NOT NULL COMMENT '运送方代码，SF等',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配送方案' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `smslog`
--

CREATE TABLE IF NOT EXISTS `smslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` char(11) NOT NULL,
  `content` varchar(256) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `system`
--

CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(128) NOT NULL,
  `type` varchar(128) NOT NULL,
  `vaule` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统配置表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `telephone` char(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` char(32) NOT NULL,
  `regtime` int(11) NOT NULL,
  `logtime` int(11) NOT NULL,
  `money` double(10,2) NOT NULL COMMENT '余额',
  `score` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `salt` char(6) NOT NULL,
  `close` tinyint(1) NOT NULL COMMENT '封印',
  `oid` int(11) DEFAULT NULL COMMENT 'o2o店铺id，为空则是自己来的，不为空则是o2o来的',
  PRIMARY KEY (`id`),
  UNIQUE KEY `telephone` (`telephone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `telephone`, `email`, `password`, `regtime`, `logtime`, `money`, `score`, `ordernum`, `salt`, `close`, `oid`) VALUES
(1, '18548143019', '326550324@qq.com', 'abc', 1437936536, 1437936536, 123.00, 0, 0, 'ab', 0, 0),
(3, '12345678901', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 1, 0),
(4, '12345678902', '', '0b6ea8fdab7e481a29c1c10b95d82b9a', 1437936558, 1437936558, 0.00, 0, 0, 'pS3huq', 0, 0),
(5, '12345678903', '', '4b35eaed14f338d9b018fe09a2fb8719', 1437968089, 1437968089, 0.00, 0, 0, 'Cl8BHd', 0, 0),
(7, '12345678904', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 0, 0),
(8, '12345678905', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 0, 0),
(9, '12345678906', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 0, 0),
(10, '12345678907', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 0, 0),
(11, '12345678908', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 0, 0),
(12, '18548143011', 'jin123456bat@hotmail.com', 'abc', 1437936536, 1437936536, 123.00, 0, 0, 'ab', 0, 0),
(13, '12345678909', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 'QlRRU9', 0, 0),
(14, '18548143010', 'test@qq.com', 'abc', 1437936536, 1437936536, 123.00, 0, 0, 'ab', 0, 0),
(15, '10987654321', '', '359bf8813a422cd25c57e078b5f7800c', 1438586378, 1438586378, 0.00, 0, 0, 'pkyeck', 0, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
