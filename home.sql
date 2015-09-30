-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-09-29 15:04:10
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
  `pic` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

--
-- 转存表中的数据 `collection`
--

INSERT INTO `collection` (`id`, `pid`, `content`, `stock`, `price`, `sku`, `pic`) VALUES
(102, 78, 'a:1:{i:70;s:1:"0";}', 0, 0.00, '', 'http://localhost/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_100x100.jpg'),
(103, 78, 'a:1:{i:70;s:1:"1";}', 0, 0.00, '', ''),
(104, 78, 'a:1:{i:70;s:1:"2";}', 0, 0.00, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `comment`
--

INSERT INTO `comment` (`id`, `uid`, `pid`, `time`, `content`, `score`) VALUES
(17, 3, 78, 1442313292, 'id为78的商品的评价', 4),
(18, 3, 79, 1442313292, 'id为79的商品的评价', 3),
(19, 3, 78, 1442313321, 'id为78的商品的评价', 4),
(20, 3, 79, 1442313321, 'id为79的商品的评价', 3),
(21, 3, 78, 1442313333, 'id为78的商品的评价', 4),
(22, 3, 79, 1442313333, 'id为79的商品的评价', 3),
(23, 3, 78, 1442397223, 'id为78的商品的评价', 4),
(24, 3, 79, 1442397223, 'id为79的商品的评价', 3),
(25, 3, 78, 1442397265, 'id为78的商品的评价', 4),
(26, 3, 79, 1442397265, 'id为79的商品的评价', 3),
(27, 3, 78, 1442397275, 'id为78的商品的评价', 4),
(28, 3, 79, 1442397275, 'id为79的商品的评价', 3);

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
  KEY `display` (`display`),
  KEY `uid_2` (`uid`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `help`
--

INSERT INTO `help` (`id`, `title`, `content`) VALUES
(4, '用户服务协议', '&lt;p&gt;&amp;nbsp; &amp;nbsp; 本协议为您与我们家电子商务平台（域名：www.womanjia.com）管理者之间所订立的契约，具有合同的法律效力，请您仔细阅读。&lt;/p&gt;&lt;p&gt;一、本协议内容、生效、变更&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 1.本协议内容包括协议正文及所有我们家已经发布的或将来可能发布的各类规则。所有规则为本协议不可分割的组成部分，与协议正文具有同等法律效力。除另行明确声明外，任何我们家及其关联公司提供的服务（以下称为我们家电子商务平台服务）均受本协议约束。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 2.本协议中，”用户”、“会员”为买方、卖方的统称；可单指买方，平台注册的采购方用户；也可单指卖方，即我们家电子平台本体及少量经过其精选的优质产品供应商。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 3.您应当在使用我们家电子商务平台服务之前认真阅读全部协议内容。如您对协议有任何疑问，应向我们家咨询。您在同意所有协议条款并完成注册程序，才能成为本站的正式用户，您点击“我已经阅读并同意遵守《我们家电子商务平台服务协议》”按钮后，本协议即生效，对双方产生约束力。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 4.只要您使用我们家电子商务平台服务，则本协议即对您产生约束，届时您不应以未阅读本协议的内容或者未获得我们家电子商务平台对您问询的解答等理由，主张本协议无效，或要求撤销本协议。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 5.您确认：本协议条款是处理双方权利义务的契约，始终有效，法律另有强制性规定或双方另有特别约定的，依其规定。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 6.您承诺接受并遵守本协议的约定。如果您不同意本协议的约定，您应立即停止注册程序或停止使用我们家电子商务平台服务。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 7.我们家有权根据需要不定期地制订、修改本协议及/或各类规则，并在平台公示，不再另行单独通知用户。变更后的协议和规则一经在网站公布，立即生效。如您不同意相关变更，应当立即停止使用我们家电子商务平台服务。您继续使用我们家平台服务的，即表明您接受修订后的协议和规则。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;二、注册&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 1. 注册资格&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; &amp;nbsp; 用户须具有法定的相应权利能力和行为能力的自然人、法人或其他组织，能够独立承担法律责任。您完成注册程序或其他我们家电子商务平台同意的方式实际使用本平台服务时，即视为您确认自己具备主体资格，能够独立承担法律责任。若因您不具备主体资格，而导致的一切后果，由您及您的监护人自行承担。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 2. 注册资料&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.1 &amp;nbsp; 用户应自行诚信向本站提供注册资料，用户同意其提供的注册资料真实、准确、完整、合法有效，用户注册资料如有变动的，应及时更新其注册资料。如果用户提供的注册资料不合法、不真实、不准确、不详尽的，用户需承担因此引起的相应责任及后果，并且我们家 电子商务平台保留终止用户使用本平台各项服务的权利。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.2 &amp;nbsp; 用户在本站进行浏览、下单购物等活动时，涉及用户真实姓名/名称、通信地址、联系电话、电子邮箱等隐私信息的，本站将予以严格保密，除非得到用户的授权或法律另有规定，本站不会向外界披露用户隐私信息。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;3. 账户&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.1 &amp;nbsp;您注册成功后，即成为我们家 电子商务平台的会员，将持有我们家 电子商务平台唯一编号的会员名和密码等账户信息，您可以根据本站规定改变您的密码。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.2 &amp;nbsp; 您设置的会员名不得侵犯或涉嫌侵犯他人合法权益。否则，我们家 有权终止向您提供我们家电子商务平台服务，注销您的账户。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.3 &amp;nbsp;您应谨慎合理的保存、使用您的会员名和密码，应对通过您的会员名和密码实施的行为负责。除非有法律规定或司法裁定，且征得我们家 电子商务平台的同意，否则，会员名和密码不得以任何方式转让、赠与或继承（与账户相关的财产权益除外）。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.4 &amp;nbsp;用户不得将在本站注册获得的账户借给他人使用，否则用户应承担由此产生的全部责任，并与实际使用人承担连带责任。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.5 &amp;nbsp;如果发现任何非法使用等可能危及您的账户安全的情形时，您应当立即以有效方式通知我们家 电子商务平台，要求我们家 暂停相关服务，并向公安机关报案。您理解我们家 对您的请求采取行动需要合理时间，我们家 对在采取行动前已经产生的后果（包括但不限于您的任何损失）不承担任何责任。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;3.6 &amp;nbsp;为方便您使用我们家 平台服务及我们家 关联公司或其他组织的服务（以下称其他服务），您同意并授权我们家将您在注册、使用我们家平台服务过程中提供、形成的信息传递给向您提供其他服务的我们家关联公司或其他组织，或从提供其他服务的我们家关联公司或其他组织获取您在注册、使用其他服务期间提供、形成的信息。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;4. 用户信息的合理使用&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;4.1 您同意，我们家电子商务平台拥有通过邮件、短信电话等形式，向在本站注册、购物用户、收货人发送订单信息、促销活动等告知信息的权利。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;4.2 您了解并同意，我们家电子商务平台有权应国家司法、行政等主管部门的要求，向其提供您在我们家电子商务平台填写的注册信息和交易记录等必要信息。如您涉嫌侵犯他人知识产权，则我们家亦有权在初步判断涉嫌侵权行为存在的情况下，向权利人提供您必要的身份信息。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;4.3 用户同意，我们家电子商务平台有权使用用户的注册信息、用户名、密码等信息，登陆进入用户的注册账户，进行证据保全，包括但不限于公证、见证等。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;三、我们家平台服务规范&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;1.通过我们家电子商务平台及其关联公司提供的我们家平台服务和其它服务，会员可在我们家平台上查询商品和服务信息、达成交易意向并进行交易，参加我们家组织的活动以及使用其它信息服务及技术服务。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 2.在我们家电子商务平台上使用我们家服务过程中，您同意严格遵守以下义务：&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.1) 不得传输或发表损害国家、社会公共利益和涉及国家安全的信息资料或言论；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.2) 不利用本站从事窃取商业秘密、窃取个人信息等违法犯罪活动；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.3) 不采取不正当竞争行为，不扰乱网上交易的正常秩序，不从事与网上交易无关的行为；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.4) 不发布任何侵犯他人著作权、商标权等知识产权或合法权利的内容；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.5) 不以虚构或歪曲事实的方式不当评价其他会员；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.6) 不对我们家电子商务平台上的任何数据作商业性利用，包括但不限于在未经我们家电子商务平台事先书面同意的情况下，以复制、传播等任何方式使用我们家平台上展示的资料。不使用任何装置、软件或程序干预聚我们家电子商务平台的正常运营。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.7) 本站保有删除站内各类不符合法律政策或不真实的信息内容而无须通知用户的权利。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.8) 您同意，若您未遵守以上规定的，本站有权作出独立判断并采取暂停或关闭用户帐号、订单等措施。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.9) 经国家行政或司法机关的生效法律文书确认您存在违法或侵权行为，或者我们家电子商务平台根据自身的判断，认为您的行为涉嫌违反本协议和/或规则的条款或涉嫌违反法律法规的规定的，则我们家有权在本平台上公示您的该等涉嫌违法或违约行为及聚美优品已对您采取的措施。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.10)对于您在我们家电子商务平台上发布的涉嫌违法或涉嫌侵犯他人合法权利或违反本协议和/或规则的信息，我们家有权不经通知您即予以删除，且按照规则的规定进行处罚。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.11)对于您在我们家电子商务平台上实施的行为，包括您未在我们家平台上实施但已经对我们家平台及其用户产生影响的行为，我们家有权单方认定您行为的性质及是否构成对本协议和/或规则的违反，并采取暂停或关闭用户帐号及其他措施。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.12)对于您涉嫌违反承诺的行为对任意第三方造成损害的，您均应当以自己的名义独立承担所有的法律责任，并应确保我们家电子商务平台免于因此产生损失或增加费用。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.13)如您涉嫌违反有关法律或者本协议之规定，使我们家电子商务平台遭受任何损失，或受到任何第三方的索赔，或受到任何行政管理部门的处罚，您应当赔偿我们家因此造成的损失及（或）发生的费用，包括合理的律师费用。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;四、订单&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;1.在本网站平台购物的用户，请您仔细确认所购商品的名称、价格、数量、型号、规格、尺寸等信息。因我们家展示的商品和价格等信息仅仅是要约邀请，您下单时须完整填写您希望购买的商品数量、价款及支付方式、收货人、联系方式、收货地址等内容。如果您提供的注册资料不合法、不真实、不准确、不详尽的，用户需承担因此引起的相应责任及后果，并且我们家终止用户使用聚美东各项服务的权利。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;2.系统生成的订单信息是计算机信息系统根据您填写的内容自动生成的数据，仅是您向我们家电子商务平台及其入驻商户发出的合同要约；我们家平台收到您的订单信息后，将订单中的商品从仓库实际向您发出时（以商品出库为标志），方视为您与店铺商家之间就实际发出的商品建立了合同关系；如果一份订单里订购了多种商品并且店铺商家只给您发出了部分商品时，您与店铺商家之间仅就实际向您发出的商品建立了合同关系。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;3.您了解并同意，本平台上的商品、价格、数量、是否有货等商品信息随时可能发生变动，本站不作特别通知。由于互联网技术原因导致网页显示信息可能会有一定的滞后性或差错，对此在合同未成立前，您接受本平台在发现网页错误，正式向您发出通知后，对商品信息进行调整，订单按照正确的信息执行，或取消订单。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;4.我们家电子商务平台所服务的客户为以中端消费为目的的经销商、企、事业单位及其他社会团体。您了解并同意，如您购买商品，发生缺货，您有权取消订单；本平台无法保证您提交的订单信息中希望购买的商品都会有货。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;5.我们家电子商务平台及其所关联公司或入驻商家将会把商品（货物）送到您所指定的收货地址。您了解本平台所提示的送货时间供参考，实际送货会与参考时间略有差异。平台管理者和所有者或其关联公司不对因您及收货人原因导致无法送货或延迟送货承担责任。若发生不可抗力或其他正当合理理由导致发货延迟的，您将给予充分理解。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;6.我们家保留在中华人民共和国大陆地区法施行之法律允许的范围内独自决定拒绝服务、关闭用户账户、清除或编辑内容或取消订单的权利。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;五、责任范围和责任限制&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp;1.本平台作为您进行了解、咨询、协商、交易的场所，提示您：应谨慎判断确定相关物品及/或信息的真实性、合法性和有效性。除非另有明确的书面说明，本平台不对各商家在本平台上发布的信息、内容、材料、产品和服务及各方在交易中各项义务的履行能力作任何形式的担保，法律法规另有规定的除外。&lt;/p&gt;&lt;p&gt;&amp;nbsp; 2.我们家电子商务平台在接到您投诉、主管机关通知或按照法律法规规定，有合理的理由认为特定会员及具体交易事项可能存在重大违法或违约情形时,我们家可依约定或依法采取相应措施。&lt;/p&gt;&lt;p&gt;&amp;nbsp; 3.您了解并同意，我们家电子商务平台不对因下述任一情况而导致您的任何损害承担赔偿责任，包括但不限于利润、商誉、使用、数据等方面的损失或其它无形损失的损害赔偿：&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.1） 第三方未经批准的使用您的账户或更改您的数据。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.2） 您对我们家电子商务平台服务的误解。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 3.3） 任何非因我们家电子商务平台的原因而引起的与我们家平台服务有关的其它损失。&lt;/p&gt;&lt;p&gt;&amp;nbsp;4.由于法律规定的不可抗力，信息网络正常的设备维护，信息网络连接故障，电脑、通讯或其他系统的故障，电力故障，劳动争议，生产力或生产资料不足，司法行政机关的命令或第三方的不作为及其他本平台无法控制的原因造成的本平台不能服务或延迟服务、丢失数据信息、记录的，我们家电子商务平台不承担责任，但我们家将协助处理相关事宜。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;六、协议终止&lt;/p&gt;&lt;p&gt;&amp;nbsp; 1.您同意，我们家电子商务平台有权自行全权决定以任何理由不经事先通知的中止、终止向您提供部分或全部我们家平台服务，暂时冻结或永久冻结（注销）您的账户，且无须为此向您或任何第三方承担任何责任。&lt;/p&gt;&lt;p&gt;&amp;nbsp; 2.出现以下情况时，我们家电子商务平台有权直接以注销账户的方式终止本协议:&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.1）我们家电子商务平台终止向您提供服务后，您涉嫌再一次直接或间接或以他人名义注册为我们家用户的；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.2） 您提供的电子邮箱不存在或无法接收电子邮件，且没有其他方式可以与您进行联系，或我们家电子商务平台以其它联系方式通知您更改电子邮件信息，而您在我们家通知后三个工作日内仍未更改为有效的电子邮箱的；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.3）您注册信息中的主要内容不真实或不准确或不及时或不完整；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.4）本协议（含规则）变更时，您明示并通知我们家电子商务平台不愿接受新的服务协议的；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 2.5）其它我们家电子商务平台认为应当终止服务的情况。&lt;/p&gt;&lt;p&gt;&amp;nbsp; 3.您有权向我们家要求注销您的账户，经我们家审核同意的，我们家电子商务平台注销（永久冻结）您的账户，届时，您与我们家基于本协议的合同关系即终止。您的账户被注销（永久冻结）后，我们家没有义务为您保留或向您披露您账户中的任何信息，也没有义务向您或第三方转发任何您未曾阅读或发送过的信息。&lt;/p&gt;&lt;p&gt;&amp;nbsp; 4.您同意，您与我们家电子商务平台的合同关系终止后，我们家仍享有下列权利：&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 4.1） 继续保存您的注册信息及您使用我们家电子商务平台服务期间的所有交易信息。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp; 4.2） 您在使用我们家电子商务平台服务期间存在违法行为或违反本协议和/或规则的行为的，我们家仍可依据本协议向您主张权利。&lt;/p&gt;&lt;p&gt;&amp;nbsp; 5.我们家中止或终止向您提供我们家电子商务平台服务后，对于您在服务中止或终止之前的交易行为依下列原则处理，您应独力处理并完全承担进行以下处理所产生的任何争议、损失或增加的任何费用，并应确保我们家免于因此产生任何损失或承担任何费用：&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;5.1） 您在服务中止或终止之前已经上传至我们家电子商务平台的物品尚未交易的，我们家有权在中止或终止服务的同时删除此项物品的相关信息；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;5.2） 您在服务中止或终止之前已经与其他会员达成买卖合同，但合同尚未实际履行的，我们家电子商务平台有权删除该买卖合同及其交易物品的相关信息；&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; &amp;nbsp;5.3） 您在服务中止或终止之前已经与其他会员达成买卖合同且已部分履行的，我们家可以不删除该项交易，但我们家有权在中止或终止服务的同时将相关情形通知您的交易对方。&lt;/p&gt;&lt;p&gt;&amp;nbsp;&lt;/p&gt;&lt;p&gt;七、法律适用、管辖与其他&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 1.本协议包含了您使用我们家电子商务平台需遵守的一般性规范，您在使用某个我们家电子商务平台时还需遵守适用于该平台的特殊性规范。一般性规范如与特殊性规范不一致或有冲突，则特殊性规范具有优先效力。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 2.本协议的订立、执行和解释及争议的解决均应适用在中华人民共和国大陆地区适用之有效法律（但不包括其冲突法规则）。如发生本协议与适用之法律相抵触时，则这些条款将完全按法律规定重新解释，而其它有效条款继续有效。&lt;/p&gt;&lt;p&gt;&amp;nbsp; &amp;nbsp; 3.因本协议履行过程中，因您使用我们家电子商务平台服务产生争议应由我们家与您沟通并协商处理。协商不成时，双方均同意以我们家电子商务平台管理者住所地人民法院为管辖法院。&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;'),
(5, '常见问题', '&lt;p&gt;常见问题&lt;/p&gt;'),
(6, '关于我们', '&lt;p&gt;关于我们&lt;/p&gt;'),
(7, '优惠券使用规则', '&lt;p&gt;1、优惠券分为打折优惠券和减免优惠券&lt;/p&gt;&lt;p&gt;2、优惠券只针对不参加活动的商品有效&lt;/p&gt;&lt;p&gt;3、同时存在参加活动的商品和没有参加活动的商品的时候，优惠券的价格计算只针对没有参加活动的商品&lt;/p&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- 转存表中的数据 `log`
--

INSERT INTO `log` (`id`, `username`, `time`, `content`) VALUES
(1, 'jin123456bat', 1442906534, '登陆了系统'),
(2, 'jin123456bat', 1442906535, '登陆了系统'),
(3, 'jin123456bat', 1442977591, '登陆了系统'),
(4, 'jin123456bat', 1442977595, '登陆了系统'),
(5, 'jin123456bat', 1443071188, '登陆了系统'),
(6, 'jin123456bat', 1443071188, '登陆了系统'),
(7, 'jin123456bat', 1443087503, '登陆了系统'),
(8, 'jin123456bat', 1443087504, '登陆了系统'),
(9, 'jin123456bat', 1443510533, '登陆了系统'),
(10, 'jin123456bat', 1443510534, '登陆了系统'),
(11, 'jin123456bat', 1443510937, '修改了系统配置'),
(12, 'jin123456bat', 1443511030, '修改了系统配置'),
(13, 'jin123456bat', 1443512744, '修改了系统配置'),
(14, 'jin123456bat', 1443512812, '修改了系统配置'),
(15, 'jin123456bat', 1443515144, '登陆了系统'),
(16, 'jin123456bat', 1443515145, '登陆了系统'),
(17, 'jin123456bat', 1443515188, '登陆了系统'),
(18, 'jin123456bat', 1443515189, '登陆了系统'),
(19, 'jin123456bat', 1443515254, '登陆了系统'),
(20, 'jin123456bat', 1443515255, '登陆了系统');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- 转存表中的数据 `o2ouser`
--

INSERT INTO `o2ouser` (`id`, `uid`, `ctime`, `name`, `qq`, `address`, `rate`, `num`, `money`) VALUES
(8, 3, 1439448013, '', '', '', 0.3000, 0, 270.00),
(10, 17, 1440571174, '金程晨', '326550324', '杭州西湖区', 0.5000, 0, 0.00),
(11, 15, 1442906675, '金程晨', '326550324', '杭州', 0.5000, 0, 0.00);

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
  `brand` varchar(64) NOT NULL,
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

INSERT INTO `orderdetail` (`id`, `oid`, `sku`, `pid`, `productname`, `brand`, `unitprice`, `content`, `prototype`, `origin`, `score`, `num`) VALUES
(8, 14, 'LQ10012', 55, '飞利浦', '哇哈哈', 499.00, '', '长度:123米,宽度:25', '中国', 0, 4),
(9, 15, '', 78, '飞利浦', '', 499.00, '', '长度:123米,宽度:25', '中国', 0, 1),
(10, 16, '', 79, '飞利浦', '', 499.00, '', '长度:123米,宽度:25,大小:23材料:石头', '中国', 0, 1);

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
  `postmode` enum('sf','ems') NOT NULL COMMENT '物流方式',
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
  `shiptime` int(11) DEFAULT '0' COMMENT '发货时间',
  `outship` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否出关',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='订单表' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `orderlist`
--

INSERT INTO `orderlist` (`id`, `uid`, `paytype`, `paynumber`, `ordertotalamount`, `orderno`, `ordertaxamount`, `ordergoodsamount`, `feeamount`, `tradetime`, `createtime`, `totalamount`, `consignee`, `consigneetel`, `consigneeaddress`, `consigneeprovince`, `consigneecity`, `postmode`, `waybills`, `sendername`, `companyname`, `zipcode`, `note`, `status`, `discount`, `client`, `action_type`, `ship_score`, `service_score`, `goods_score`, `shiptime`, `outship`) VALUES
(14, 3, 'alipay', '2015090900001000060062404132', 900.00, '20150909214006205544', 0.00, 12.00, 0.00, 1437429600, 1138797592, 12.00, '金', '18548143019', '浙大科技园B606', '浙江', '杭州', 'sf', 'a:1:{i:0;s:12:"212559562003";}', '我们家', '我们家', '301100', '你好吗？', 4, 0.00, 'wap', 1, 0, 0, 0, 0, 1),
(15, 3, 'weixin', '', 12.00, '20150911103424207326', 0.00, 12.00, 0.00, 1437429600, 1442925424, 45.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'sf', 'a:1:{i:0;s:12:"212559562002";}', '我们家', '我们家', '301100', '凑合吧', 1, 0.00, 'ios', 1, 5, 5, 5, 0, 0),
(16, 3, 'alipay', '', 12.00, '2015081715553336343', 0.00, 12.00, 0.00, 1442786400, 1442208991, 345678.00, '金', '18548143019', '浙江杭州浙大科技园', '', '', 'sf', '', '我们家', '我们家', '301100', '', 4, 0.00, 'wap', 1, 0, 0, 0, 0, 1),
(17, 3, 'alipay', '', 0.00, '2015091818254432541', 0.00, 0.00, 0.00, 1443045600, 1442571944, 0.00, '金', '18548143019', '浙大科技园', '浙江', '杭州', 'sf', '', '我们家', '我们家', '301100', '', 1, 0.00, 'wap', 1, 0, 0, 0, 0, 0);

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
(78, '好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字', '测试商品', 22, 0, 1440864000, 1440864000, '&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;p&gt;															&lt;/p&gt;&lt;div class=&quot;sub-wrap&quot; id=&quot;J_SubWrap&quot; style=&quot;margin: 0px; padding: 0px; position: relative; z-index: 99999998; width: 750px; color: rgb(0, 0, 0); font-family: tahoma, arial, &amp;#39;Hiragino Sans GB&amp;#39;, 宋体, sans-serif; font-size: 12px; line-height: 18px; white-space: normal;&quot;&gt;&lt;div id=&quot;description&quot; class=&quot;tshop-psm ke-post J_DetailSection&quot; style=&quot;margin: 0px 0px 20px; padding: 0px; clear: both; font-stretch: normal; font-size: 14px; line-height: 1.5; font-family: tahoma, arial, 宋体, sans-serif; background-image: initial !important; background-attachment: initial !important; background-size: initial !important; background-origin: initial !important; background-clip: initial !important; background-position: initial !important; background-repeat: initial !important;&quot;&gt;&lt;div class=&quot;content&quot; id=&quot;J_DivItemDesc&quot; style=&quot;margin: 0px; padding: 10px 0px 0px; width: 750px; word-wrap: break-word; overflow: hidden; position: relative !important;&quot;&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332495&quot; data-title=&quot;2.场景图&quot; id=&quot;ids-module-5332495&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i2/1753596474/TB260aEcFXXXXcOXXXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332498&quot; data-title=&quot;3.产品细节&quot; id=&quot;ids-module-5332498&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i3/1753596474/TB2VXyBcFXXXXaSXpXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2sew_dFXXXXcsXXXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2F2AUdFXXXXbKXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;605&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i2/1753596474/TB2Lkc2dFXXXXXZXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;606&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2QcoSdFXXXXcDXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;605&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB28oJcdVXXXXaRXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;607&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i3/1753596474/TB2g2NadVXXXXbFXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;212&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2OpU_dFXXXXcqXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;285&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB2cL0idVXXXXXDXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;284&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB28twVdFXXXXbxXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;385&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i3/1753596474/TB2T4cTdFXXXXb4XpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;237&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2bsMWdFXXXXaVXpXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;237&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332500&quot; data-title=&quot;4.产品参数&quot; id=&quot;ids-module-5332500&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB24ceJcFXXXXX6XXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;104&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img align=&quot;absmiddle&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2GuEMcVXXXXbCXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;573&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332503&quot; data-title=&quot;5.关于材质&quot; id=&quot;ids-module-5332503&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i2/1753596474/TB2Eh1FcFXXXXb3XXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;104&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;关于材质1&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2xZyOcFXXXXbMXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;1085&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;dm_module&quot; data-id=&quot;5332506&quot; data-title=&quot;6.关于包装&quot; id=&quot;ids-module-5332506&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;横标&quot; src=&quot;https://img.alicdn.com/imgextra/i1/1753596474/TB2pAyIcFXXXXalXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;104&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&lt;img alt=&quot;关于包装1&quot; src=&quot;https://img.alicdn.com/imgextra/i4/1753596474/TB2zHyLcFXXXXXxXXXXXXXXXXXX_!!1753596474.jpg&quot; class=&quot;&quot; width=&quot;750&quot; height=&quot;446&quot; style=&quot;vertical-align: top; margin: 0px; padding: 0px;&quot;/&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;p style=&quot;margin-top: 1.12em; margin-bottom: 1.12em; padding: 0px;&quot;&gt;&amp;nbsp;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;J_AsyncDC tb-custom-area tb-shop&quot; data-type=&quot;main&quot; id=&quot;J_AsyncDCMain&quot; style=&quot;margin: 0px; padding: 0px; overflow: hidden; position: relative; color: rgb(0, 0, 0); font-family: tahoma, arial, &amp;#39;Hiragino Sans GB&amp;#39;, 宋体, sans-serif; font-size: 12px; line-height: 18px; white-space: normal;&quot;&gt;&lt;div class=&quot;J_TModule&quot; data-widgetid=&quot;5499259944&quot; id=&quot;shop5499259944&quot; data-componentid=&quot;5003&quot; data-spm=&quot;110.0.5003-5499259944&quot; microscope-data=&quot;5003-5499259944&quot; data-title=&quot;自定义内容区&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div class=&quot;skin-box tb-module tshop-pbsm tshop-pbsm-shop-self-defined&quot; style=&quot;margin: 0px 0px 10px; padding: 0px;&quot;&gt;&lt;span class=&quot;skin-box-tp&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;div class=&quot;skin-box-bd clear-fix&quot; style=&quot;margin: 0px; padding: 0px; border: none; line-height: 1.2; overflow: hidden; width: 750px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://ziin.taobao.com/p/show.htm?spm=a1z10.1.w5003-3906820604.2.UdyyhK&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i2/1753596474/TB2HIfMbFXXXXagXpXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 展会与获奖&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=36609723293&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i3/1753596474/TB2xnvEbFXXXXcNXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-01-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=40867255257&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i1/1753596474/TB2BBzIbFXXXXbnXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-02-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=35431098304&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i4/1753596474/TB2fHjAbFXXXXaRXpXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-03-01-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;a href=&quot;https://item.taobao.com/item.htm?id=35431437171&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i4/1753596474/TB2mYYFbFXXXXcYXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 底部-获奖-03-02-20150122&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://ziin.taobao.com/p/show.htm?scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img alt=&quot;关于我们&quot; src=&quot;https://gdp.alicdn.com/imgextra/i2/1753596474/TB2M3bxbFXXXXclXpXXXXXXXXXX_!!1753596474.jpg&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;&lt;span class=&quot;skin-box-bt&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;J_TModule&quot; data-widgetid=&quot;3061597196&quot; id=&quot;shop3061597196&quot; data-componentid=&quot;5003&quot; data-spm=&quot;110.0.5003-3061597196&quot; microscope-data=&quot;5003-3061597196&quot; data-title=&quot;自定义内容区&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div class=&quot;skin-box tb-module tshop-pbsm tshop-pbsm-shop-self-defined&quot; style=&quot;margin: 0px 0px 10px; padding: 0px;&quot;&gt;&lt;span class=&quot;skin-box-tp&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;div class=&quot;skin-box-bd clear-fix&quot; style=&quot;margin: 0px; padding: 0px; border: none; line-height: 1.2; overflow: hidden; width: 750px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://ziin.taobao.com/p/reports.htm?scene=taobao_shop&quot; target=&quot;_blank&quot; style=&quot;color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i3/1753596474/TB2.4C4bXXXXXchXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 材料与工艺&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;&lt;span class=&quot;skin-box-bt&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;/div&gt;&lt;/div&gt;&lt;div class=&quot;J_TModule&quot; data-widgetid=&quot;10973236815&quot; id=&quot;shop10973236815&quot; data-componentid=&quot;5003&quot; data-spm=&quot;110.0.5003-10973236815&quot; microscope-data=&quot;5003-10973236815&quot; data-title=&quot;自定义内容区&quot; data-spm-max-idx=&quot;1&quot; style=&quot;margin: 0px; padding: 0px;&quot;&gt;&lt;div class=&quot;skin-box tb-module tshop-pbsm tshop-pbsm-shop-self-defined&quot; style=&quot;margin: 0px 0px 10px; padding: 0px;&quot;&gt;&lt;span class=&quot;skin-box-tp&quot; style=&quot;text-decoration:line-through;&quot;&gt;&lt;strong&gt;&lt;/strong&gt;&lt;/span&gt;&lt;div class=&quot;skin-box-bd clear-fix&quot; style=&quot;margin: 0px; padding: 0px; border: none; line-height: 1.2; overflow: hidden; width: 750px; background-image: initial; background-attachment: initial; background-size: initial; background-origin: initial; background-clip: initial; background-position: initial; background-repeat: initial;&quot;&gt;&lt;p style=&quot;margin-top: 0px; margin-bottom: 0px; padding: 0px; line-height: 1.4;&quot;&gt;&lt;a href=&quot;https://favorite.taobao.com/popup/add_collection.htm?spm=2013.1.w5003-10973236815.1.U03jQZ&amp;id=105552592&amp;itemid=105552592&amp;itemtype=0&amp;sellerid=1753596474&amp;scjjc=2&amp;_tb_token_=e333baee107ee&amp;t=1375380689905&amp;scene=taobao_shop&quot; target=&quot;_blank&quot; data-spm-wangpu-module-id=&quot;5003-10973236815&quot; data-spm-anchor-id=&quot;2013.1.w5003-10973236815.1&quot; style=&quot;text-decoration: underline; color: rgb(41, 83, 166); outline: 0px; margin: 0px; padding: 0px;&quot;&gt;&lt;img src=&quot;https://gdp.alicdn.com/imgextra/i4/1753596474/TB224mtbXXXXXcmXXXXXXXXXXXX_!!1753596474.jpg&quot; alt=&quot; 关于服务new&quot; style=&quot;margin: 0px; padding: 0px;&quot;/&gt;&lt;/a&gt;&lt;/p&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;&lt;p&gt;&lt;br/&gt;&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;&lt;p&gt;\n														&lt;/p&gt;', '好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字好名字', 99999999.99, 0, 1, '', 1, 0, '', '', '', 0.00, '', 0, 'seckill', 0, 0, 1440927191),
(79, '测试商品', '策划', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, 1, '', 1, 0, '', '', '', 0.00, '', 0, 'sale', 0, 0, 0),
(80, '名称', '添加名称', 0, 0, 1440864000, 1440864000, '', '', 99999999.99, 0, 1, '', 1, 0, '', '', '', 0.00, '', 0, 'fullcut', 0, 0, 0),
(81, '测试名称啊啊啊啊啊啊啊啊啊啊啊', '变啊妈啊的fads发', 0, 0, 0, 0, '', '', 0.00, 0, 1, '1', 2, 0, '', '', '', 0.00, '0', 0, '', 0, 0, 1440787987),
(82, '123', '321', 0, 0, 1440864000, 1440864000, '', '', 1.00, 1, 1, '1', 1, 0, '', '', '烦烦烦', 1.00, '0', 0, '', 0, 0, 1440927992),
(83, '名称', '编码', 22, 1, 1439222400, 1441036800, '长描述&lt;p&gt;\n															\n														&lt;/p&gt;', '短描述', 123.00, 10, 1, '1', 0, 999, '元标题', '元关键字', '元描述', 145.00, 'shipchar', 9, 'seckill', 0, 0, 1440788234),
(84, '图像测试', '', 0, 0, 1440864000, 1440864000, '', '', 0.00, 0, 1, '1', 1, 0, '', '', '', 0.00, '', 0, '', 0, 0, 1440941574),
(85, '你好吗', '', 0, 0, 0, 0, '&lt;html&gt;&lt;head&gt;\n&lt;meta charset=&quot;utf-8&quot;&gt;\n&lt;title&gt;Metronic | eCommerce - Product Edit&lt;/title&gt;\n&lt;meta http-equiv=&quot;X-UA-Compatible&quot; content=&quot;IE=edge&quot;&gt;\n&lt;meta content=&quot;width=device-width, initial-scale=1.0&quot; name=&quot;viewport&quot;&gt;\n&lt;meta http-equiv=&quot;Content-type&quot; content=&quot;text/html; charset=utf-8&quot;&gt;\n&lt;meta content=&quot;&quot; name=&quot;description&quot;&gt;\n&lt;meta content=&quot;&quot; name=&quot;author&quot;&gt;\n&lt;!-- BEGIN GLOBAL MANDATORY STYLES --&gt;\n&lt;script src=&quot;http://localhost/home/application/assets/global/plugins/pace/pace.min.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/pace/themes/pace-theme-barber-shop.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/font-awesome/css/font-awesome.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/simple-line-icons/simple-line-icons.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap/css/bootstrap.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/uniform/css/uniform.default.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;!-- END GLOBAL MANDATORY STYLES --&gt;\n&lt;!-- BEGIN PAGE LEVEL STYLES --&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/select2/select2.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap-datepicker/css/datepicker.css&quot;&gt;\n&lt;link rel=&quot;stylesheet&quot; type=&quot;text/css&quot; href=&quot;http://localhost/home/application/assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/plugins/fancybox/source/jquery.fancybox.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;!-- END PAGE LEVEL STYLES --&gt;\n&lt;!-- BEGIN THEME STYLES --&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/css/components.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/global/css/plugins.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/admin/layout/css/layout.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link id=&quot;style_color&quot; href=&quot;http://localhost/home/application/assets/admin/layout/css/themes/darkblue.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/umeditor/themes/default/css/umeditor.min.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;link href=&quot;http://localhost/home/application/assets/admin/layout/css/custom.css&quot; rel=&quot;stylesheet&quot; type=&quot;text/css&quot;&gt;\n&lt;!-- END THEME STYLES --&gt;\n&lt;link rel=&quot;shortcut icon&quot; href=&quot;favicon.ico&quot;&gt;\n&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/link/link.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/image/image.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/video/video.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/map/map.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/formula/formula.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;script src=&quot;http://localhost/home/application/assets/umeditor/dialogs/emotion/emotion.js&quot; type=&quot;text/javascript&quot; defer=&quot;defer&quot;&gt;&lt;/script&gt;&lt;/head&gt;&lt;body &gt;&lt;p&gt;&lt;img src=&quot;http://localhost/home/application/assets/umeditor/php/upload/20150901/14410796346785.jpg&quot; _src=&quot;http://localhost/home/application/assets/umeditor/php/upload/20150901/14410796346785.jpg&quot;/&gt;\n															\n														&lt;/p&gt;&lt;/body&gt;&lt;/html&gt;', '', 0.00, 0, 1, '1', 0, 0, '', '', '', 0.00, '', 0, 'seckill', 0, 0, 1441079641);

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
  `refundno` varchar(64) NOT NULL,
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
  UNIQUE KEY `refundno` (`refundno`),
  KEY `oid` (`oid`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `refund`
--

INSERT INTO `refund` (`id`, `refundno`, `uid`, `oid`, `type`, `time`, `reason`, `money`, `description`, `o_status`, `handle`) VALUES
(1, '1234567890123', 3, 14, 0, 1234567, '测试腿裤哦', 1.00, '', 0, 0);

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
  `logo` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `seckill`
--

INSERT INTO `seckill` (`id`, `sname`, `pid`, `starttime`, `endtime`, `orderby`, `price`, `logo`) VALUES
(3, '测试商品的活动名称', 78, 1440935323, 1441021723, 1, 12.00, ''),
(4, '八月促销', 83, 1442663615, 1442750015, 1, 123.00, 'http://localhost/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg'),
(5, '123123', 85, 1442664730, 1442751130, 1, 12.00, 'http://localhost/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_640x320.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配送方案' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ship`
--

INSERT INTO `ship` (`id`, `name`, `code`, `max`, `price`) VALUES
(1, '顺丰', 'sf', 0.00, 0.00),
(2, 'EMS', 'ems', 0.00, 0.00);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `shipalert`
--

INSERT INTO `shipalert` (`id`, `uid`, `oid`, `time`, `ok`) VALUES
(1, 3, 15, 0, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='短信日志，用于验证和防止短信轰炸' AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `smslog`
--

INSERT INTO `smslog` (`id`, `telephone`, `code`, `time`) VALUES
(3, '18548143019', '268973', 1439889089),
(4, '18548143019', '772629', 1442910086),
(5, '18548143019', '732776', 1442911799);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表' AUTO_INCREMENT=46 ;

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
(40, 'weixincertfile', 'costums', 'D:/wamp/www/home/application/cert/f80118c8fc527ce2be993bed5170b29219ee4515f0d7be4f166f9880e51848957db6374c.pem'),
(41, 'stockalert', 'system', '10'),
(42, 'printtype', 'shippment', '1'),
(43, 'paytype', 'shippment', '1'),
(44, 'outtrade', 'alipay', '0'),
(45, 'splitopen', 'alipay', '1');

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
(8, '主题名称', '主题描述', 'D:/wamp/www/home/application/upload/2f395384ae3e1aac6fc29513d626f35c825953ec1913ae6550dc85d27cbc75e211464a9c_640x280.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_320x260.jpg', 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_320x130.jpg', 3),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `gravatar`, `username`, `telephone`, `email`, `password`, `regtime`, `logtime`, `money`, `score`, `ordernum`, `cost`, `salt`, `close`, `oid`, `client`) VALUES
(3, 'D:/wamp/www/home/application/upload/e3f6441b6ecb983e2da7f30ff694f7f450b285358900323c3053ce1adab7d22b71a7f2d7_200x200.jpg', '123', '12345678901', '326550324@qq.com', 'c3af0f820a49508b0002b862bcc79e09', 1443002806, 1437936536, 0.00, 0, 2, 6300.01, 'QlRRU9', 0, 17, 'web'),
(4, '', '0', '12345678902', '', '0b6ea8fdab7e481a29c1c10b95d82b9a', 1437936558, 1437936558, 0.00, 0, 0, 0.00, 'pS3huq', 1, 3, 'weixin'),
(5, '', '0', '12345678903', '', '4b35eaed14f338d9b018fe09a2fb8719', 1437968089, 1437968089, 0.00, 0, 0, 0.00, 'Cl8BHd', 1, 0, 'wap'),
(7, '', '0', '12345678904', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 0, 0, 'ios'),
(8, '', '0', '12345678905', '', 'c3af0f820a49508b0002b862bcc79e09', 1437936536, 1437936536, 0.00, 0, 0, 0.00, 'QlRRU9', 1, 0, 'android'),
(15, '', '0', '10987654321', '', '359bf8813a422cd25c57e078b5f7800c', 1438586378, 1438586378, 0.00, 0, 0, 0.00, 'pkyeck', 0, 0, 'web'),
(17, '', '', '18548143019', '', 'c1fdc7e956f248e2bbf63b1ac8c7d006', 1439889196, 1439889196, 0.00, 0, 0, 0.00, '105811', 0, 0, 'web');

-- --------------------------------------------------------

--
-- 表的结构 `user_login_log`
--

CREATE TABLE IF NOT EXISTS `user_login_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `client` enum('ios','android','wap','web') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `waybills`
--

CREATE TABLE IF NOT EXISTS `waybills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` int(11) NOT NULL COMMENT '上次更新时间',
  `postmode` enum('sf','ems') NOT NULL COMMENT '物流方式',
  `content` text NOT NULL COMMENT '物流信息',
  `waybills` text NOT NULL COMMENT '物流单号',
  `orderno` varchar(256) NOT NULL COMMENT '订单号',
  PRIMARY KEY (`id`),
  KEY `orderno` (`orderno`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='物流信息' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `waybills`
--

INSERT INTO `waybills` (`id`, `time`, `postmode`, `content`, `waybills`, `orderno`) VALUES
(13, 1442894313, 'sf', '[{"time":"2015-09-21 10:26:59","context":"\\u7b7e\\u6536\\u4eba\\u662f\\uff1a\\u5df2\\u7b7e\\u6536"},{"time":"2015-09-21 10:26:06","context":"\\u5df2\\u7b7e\\u6536,\\u611f\\u8c22\\u4f7f\\u7528\\u987a\\u4e30,\\u671f\\u5f85\\u518d\\u6b21\\u4e3a\\u60a8\\u670d\\u52a1"},{"time":"2015-09-21 08:06:08","context":"\\u6b63\\u5728\\u6d3e\\u9001\\u9014\\u4e2d,\\u8bf7\\u60a8\\u51c6\\u5907\\u7b7e\\u6536(\\u6d3e\\u4ef6\\u4eba:\\u53f2\\u51b2\\u51b2,\\u7535\\u8bdd:15715725387)"},{"time":"2015-09-20 17:03:57","context":"\\u5feb\\u4ef6\\u6d3e\\u9001\\u4e0d\\u6210\\u529f(\\u56e0\\u4f11\\u606f\\u65e5\\u6216\\u5047\\u671f\\u5ba2\\u6237\\u4e0d\\u4fbf\\u6536\\u4ef6),\\u5f85\\u5de5\\u4f5c\\u65e5\\u518d\\u6b21\\u6d3e\\u9001"},{"time":"2015-09-20 16:10:14","context":"\\u6b63\\u5728\\u6d3e\\u9001\\u9014\\u4e2d,\\u8bf7\\u60a8\\u51c6\\u5907\\u7b7e\\u6536(\\u6d3e\\u4ef6\\u4eba:\\u53f2\\u51b2\\u51b2,\\u7535\\u8bdd:15715725387)"},{"time":"2015-09-20 16:06:17","context":"\\u5feb\\u4ef6\\u5230\\u8fbe \\u3010\\u676d\\u5dde\\u848b\\u6751\\u670d\\u52a1\\u70b9\\u3011"},{"time":"2015-09-20 14:35:29","context":"\\u5feb\\u4ef6\\u5728\\u3010\\u676d\\u5dde\\u8427\\u5c71\\u96c6\\u6563\\u4e2d\\u5fc3\\u3011, \\u6b63\\u8f6c\\u8fd0\\u81f3 \\u3010\\u676d\\u5dde\\u848b\\u6751\\u670d\\u52a1\\u70b9\\u3011"},{"time":"2015-09-20 13:46:53","context":"\\u5feb\\u4ef6\\u5230\\u8fbe \\u3010\\u676d\\u5dde\\u8427\\u5c71\\u96c6\\u6563\\u4e2d\\u5fc3\\u3011"},{"time":"2015-09-20 12:55:05","context":"\\u5feb\\u4ef6\\u5728\\u3010\\u676d\\u5dde\\u603b\\u96c6\\u6563\\u4e2d\\u5fc3\\u3011, \\u6b63\\u8f6c\\u8fd0\\u81f3 \\u3010\\u676d\\u5dde\\u8427\\u5c71\\u96c6\\u6563\\u4e2d\\u5fc3\\u3011"},{"time":"2015-09-20 12:44:13","context":"\\u5feb\\u4ef6\\u5230\\u8fbe \\u3010\\u676d\\u5dde\\u603b\\u96c6\\u6563\\u4e2d\\u5fc3\\u3011"},{"time":"2015-09-20 10:19:55","context":"\\u5feb\\u4ef6\\u5728\\u3010\\u5b81\\u6ce2\\u911e\\u5dde\\u96c6\\u6563\\u4e2d\\u5fc32\\u3011, \\u6b63\\u8f6c\\u8fd0\\u81f3 \\u3010\\u676d\\u5dde\\u603b\\u96c6\\u6563\\u4e2d\\u5fc3\\u3011"},{"time":"2015-09-20 10:10:20","context":"\\u5feb\\u4ef6\\u5230\\u8fbe \\u3010\\u5b81\\u6ce2\\u911e\\u5dde\\u96c6\\u6563\\u4e2d\\u5fc32\\u3011"},{"time":"2015-09-20 09:29:37","context":"\\u5feb\\u4ef6\\u5728\\u3010\\u5b81\\u6ce2\\u671b\\u6625\\u670d\\u52a1\\u70b9\\u3011, \\u6b63\\u8f6c\\u8fd0\\u81f3 \\u3010\\u5b81\\u6ce2\\u911e\\u5dde\\u96c6\\u6563\\u4e2d\\u5fc32\\u3011"},{"time":"2015-09-20 08:33:05","context":"\\u987a\\u4e30\\u901f\\u8fd0 \\u5df2\\u6536\\u53d6\\u5feb\\u4ef6"},{"time":"1970-01-07 07:58:56","context":"\\u60a8\\u7684\\u5feb\\u4ef6\\u5df2\\u987a\\u5229\\u51fa\\u5173\\uff0c\\u4ea4\\u4ed8\\u56fd\\u5185\\u5feb\\u9012"},{"time":"1970-01-07 07:21:20","context":"\\u5feb\\u4ef6\\u5230\\u8fbe\\u676d\\u5dde\\u8427\\u2f2d\\u5c71\\u56fd\\u9645\\u673a\\u573a\\uff0c\\u7b49\\u5f85\\u5173\\u68c0\\uff08\\u51fa\\u5173\\uff09"},{"time":"1970-01-07 07:26:26","context":"\\u5feb\\u4ef6\\u5df2\\u5230\\u8fbeLinate\\u56fd\\u9645\\u673a\\u573a\\uff0c\\u4e0b\\u2f00\\u4e00\\u7ad9\\u8fd0\\u5f80\\u676d\\u5dde\\u8427\\u5c71\\u56fd\\u9645\\u673a\\u573a"},{"time":"1970-01-07 07:06:38","context":"\\u7c73\\u5170\\u96c6\\u8fd0\\u4ed3\\u626b\\u63cf\\u6210\\u529f\\uff0c\\u6b63\\u5728\\u8fd0\\u5f80Linate\\u56fd\\u9645\\u673a\\u573a"},{"time":"1970-01-07 07:28:04","context":"\\u62e3\\u8d27\\u5b8c\\u6bd5\\uff0c\\u5feb\\u9012\\u4e13\\u5458Simone\\u5df2\\u53d6\\u4ef6\\uff0c\\u6b63\\u5728\\u8fd0\\u5f80\\u2f76\\u7c73\\u5170\\u96c6\\u8fd0\\u603b\\u4ed3"},{"time":"1970-01-07 07:11:39","context":"\\u6211\\u4eec\\u5bb6\\u9a7bBrescia\\u96c6\\u8fd0\\u4ed3\\u62e3\\u8d27\\u4e2d"},{"time":"1970-01-07 07:03:36","context":"\\u60a8\\u7684\\u8ba2\\u5355\\u5df2\\u63d0\\u4ea4\\uff0c\\u7cfb\\u7edf\\u5df2\\u786e\\u8ba4"}]', 'a:1:{i:0;s:12:"212559562003";}', '20150909214006205544');

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
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- 限制表 `user_login_log`
--
ALTER TABLE `user_login_log`
  ADD CONSTRAINT `user_login_log_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
