/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : blognote

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-05-31 14:20:14
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bn_access
-- ----------------------------
DROP TABLE IF EXISTS `bn_access`;
CREATE TABLE `bn_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `node_id` int(11) NOT NULL COMMENT '节点ID',
  `level` tinyint(4) DEFAULT NULL COMMENT '等级',
  `pid` int(11) NOT NULL COMMENT '菜单ID',
  `module` varchar(20) NOT NULL COMMENT '所属模块',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=387 DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of bn_access
-- ----------------------------
INSERT INTO `bn_access` VALUES ('373', '3', '20', '1', '0', '');
INSERT INTO `bn_access` VALUES ('374', '3', '21', '2', '20', '');
INSERT INTO `bn_access` VALUES ('375', '3', '22', '3', '21', '');
INSERT INTO `bn_access` VALUES ('376', '3', '23', '1', '0', '');
INSERT INTO `bn_access` VALUES ('377', '3', '24', '2', '23', '');
INSERT INTO `bn_access` VALUES ('378', '3', '25', '3', '24', '');
INSERT INTO `bn_access` VALUES ('379', '3', '26', '3', '24', '');
INSERT INTO `bn_access` VALUES ('380', '3', '31', '2', '23', '');
INSERT INTO `bn_access` VALUES ('381', '3', '32', '3', '31', '');
INSERT INTO `bn_access` VALUES ('382', '3', '33', '3', '31', '');
INSERT INTO `bn_access` VALUES ('383', '3', '39', '3', '31', '');
INSERT INTO `bn_access` VALUES ('384', '3', '40', '3', '31', '');
INSERT INTO `bn_access` VALUES ('385', '3', '34', '2', '23', '');
INSERT INTO `bn_access` VALUES ('386', '3', '36', '3', '34', '');

-- ----------------------------
-- Table structure for bn_app_access_log
-- ----------------------------
DROP TABLE IF EXISTS `bn_app_access_log`;
CREATE TABLE `bn_app_access_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` bigint(20) NOT NULL DEFAULT '0' COMMENT '品牌UID',
  `target_url` varchar(255) NOT NULL DEFAULT '' COMMENT '访问的url',
  `query_params` longtext NOT NULL COMMENT 'get和post参数',
  `ua` varchar(255) NOT NULL DEFAULT '' COMMENT '访问ua',
  `ip` varchar(32) NOT NULL DEFAULT '' COMMENT '访问ip',
  `note` varchar(1000) NOT NULL DEFAULT '' COMMENT 'json格式备注字段',
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户操作记录表';

-- ----------------------------
-- Records of bn_app_access_log
-- ----------------------------

-- ----------------------------
-- Table structure for bn_article
-- ----------------------------
DROP TABLE IF EXISTS `bn_article`;
CREATE TABLE `bn_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL COMMENT '用户ID',
  `ac_id` int(11) NOT NULL COMMENT '文章分类ID',
  `title` varchar(50) NOT NULL COMMENT '文章标题',
  `label` varchar(100) DEFAULT NULL COMMENT '文章标签',
  `thumb` varchar(200) DEFAULT NULL COMMENT '缩略图',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `top` tinyint(4) DEFAULT '0' COMMENT '是否置顶，0：取消置顶，1：置顶',
  `status` tinyint(4) DEFAULT '1' COMMENT '文章状态,0:隐藏文章,1:正常显示文章',
  `descript` text COMMENT '题记',
  PRIMARY KEY (`id`),
  KEY `ac_id` (`ac_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Records of bn_article
-- ----------------------------
INSERT INTO `bn_article` VALUES ('2', '1', '1', '正则表达式', 'php', '/blogNote/Upload\\image/20170430\\06480cc865f9bbbd8d10114fbfd0d8da.jpg', '2017-04-27 16:11:27', '2017-04-30 12:13:40', '1', '1', '正则表达式正则表达式正则表达式正则表达式正则表达式正则表达式正则表达式正则表达式正则表达式');
INSERT INTO `bn_article` VALUES ('3', '1', '5', '一生所爱', '红尘世间', '/blogNote/Upload\\image/20170430\\a569b52811048acb4b7b352ecd76fe21.jpg', '2017-04-29 19:56:31', '2017-04-30 11:58:30', '1', '1', '“你看那个人样子好奇怪哦。” “他好像条狗啊。”');

-- ----------------------------
-- Table structure for bn_article_classifty
-- ----------------------------
DROP TABLE IF EXISTS `bn_article_classifty`;
CREATE TABLE `bn_article_classifty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL COMMENT '用户ID',
  `cname` varchar(30) NOT NULL COMMENT '文章分类名称',
  `sort` tinyint(4) NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '文章分类显示状态，0：不显示，1：显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of bn_article_classifty
-- ----------------------------
INSERT INTO `bn_article_classifty` VALUES ('1', '1', 'PHP', '0', '1');
INSERT INTO `bn_article_classifty` VALUES ('3', '1', 'JAVA', '1', '1');
INSERT INTO `bn_article_classifty` VALUES ('4', '1', 'C++', '2', '1');
INSERT INTO `bn_article_classifty` VALUES ('5', '1', '红尘世间', '3', '1');

-- ----------------------------
-- Table structure for bn_article_content
-- ----------------------------
DROP TABLE IF EXISTS `bn_article_content`;
CREATE TABLE `bn_article_content` (
  `article_id` int(11) NOT NULL COMMENT '文章ID',
  `content` text COMMENT '文章内容',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章内容表';

-- ----------------------------
-- Records of bn_article_content
-- ----------------------------
INSERT INTO `bn_article_content` VALUES ('2', '&lt;img src=&quot;/blogNote/public/static/kindeditor/php/../../../../Upload/image/20170429/20170429122936_90477.jpg&quot; alt=&quot;&quot; /&gt;');
INSERT INTO `bn_article_content` VALUES ('3', '&lt;p&gt;\r\n	&lt;span style=&quot;font-size:14px;&quot;&gt;“你看那个人样子好奇怪哦。”&lt;/span&gt; \r\n&lt;/p&gt;\r\n&lt;div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“他好像条狗啊。”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div style=&quot;text-align:center;&quot;&gt;\r\n		&lt;img src=&quot;https://blog.521yy.top/Upload/kindEditor/image/20170429/20170429115317_39798.jpg&quot; alt=&quot;&quot; /&gt; \r\n	&lt;/div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;在我第一次接触《大话西游》这部电影的时候，我还停留在那个和小女生不敢拉手的年龄段。我想我根本不懂得叫它成人童话的所在。各种台词却脍炙人口，熟语心口。“曾经有一份真挚的感情放在我面前，但是我没有珍惜。等我失去的时候我才后悔莫及。”这一大段的台词熟在心口无疑只是同龄小孩相互嬉笑显摆的资本，不懂什么是感情，不懂什么是爱，也不懂什么是责任更不懂什么是付出。这样的时光轻松欢乐却一去不返。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;直到我一直反复看。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;第二遍。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;第三遍。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;第四遍。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;。。。。。。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;第不知道多少遍后，曾经手中的棒棒糖已经换成了咬碎过滤嘴的香烟。可能，我或多或少知道了所谓的爱。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;《大话西游》本来就是一部给成年人写的童话，如果它能给受众的孩童带来欢乐，给成人的恐怕是一滴滴强忍的泪水。若是在看完后，你能因为其中无厘头的台词和场景开怀大笑，恭喜，还未记录心力交瘁的感情是幸运的；若是看罢，会默默不作声，怕是已经到了第二层，影片中或有或无有自己情感的影子，可悲可喜，可欢可叹；若是放映结束后，脸上已是泪痕漫漫，脚下一地烟头，我想第三层的含义一定是我在电影里找到了我自己，找到了我曾经的爱情，找到了我想说却无可倾诉的话语。在最近一遍看完后，泪滴最终还是把香烟熄灭了。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;这是《大话西游》一个最可怕的地方：看的遍数越多，在应当欢笑的地方，你会忽然想哭。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“我猜中的开头，却猜不中这结局。”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;紫霞仙子在自己心爱的人怀里说出最后一句话后就死去了。她反复的说：“我的意中人是个盖世英雄，有一天，他会踩着七色云彩来娶我。”这一天他的意中人以英雄的角色来了，紫霞却再也无法看到。然而即便此时，她的意中人已经皈依佛门，再无相爱的力量。孙悟空无论心中有多爱，无论再心有所属，却必须面色平静的离开或者是抛弃紫霞。他造型越怪异，他举止越夸张，都无法让我感受一丝笑点。他的行为不过是在掩饰他痛苦的内心，因为孙悟空已是神，已是超脱凡尘爱恋的生物，他不能爱一个人，他不能去用最单纯最简单最世俗的爱来面对心中的女子。他对紫霞，故意讥讽，挖苦甚至是谩骂；只是想让紫霞不知情的离开，哪怕心里对他再多怨恨也比真像去伤紫霞心来得强。他无法告诉心爱的女子自己的身份，他无法告诉爱人自己已经失去爱的能力，他无法告诉恋人他再也不能与之陪伴了。这些细节，想想现实，仿佛很相似，仿佛又很遥远。每个男子心里都有一个不能靠近不能相陪的爱人。我们用最尖利的语言去伤害她，用一辈子的惭愧来面壁心中的不敢大声言语的爱，用一双不经意的眼睛关注她的身影，用毫无相关的手段守护她的世界。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div style=&quot;text-align:center;&quot;&gt;\r\n		&lt;img src=&quot;https://blog.521yy.top/Upload/kindEditor/image/20170429/20170429115346_26773.jpg&quot; alt=&quot;&quot; /&gt;&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“原来那个女孩子，在我心里面留下了，一滴泪。”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;都是凡人，我不可能有超凡脱俗穿越时空的能力。太多的事情不能回想，再去追寻只剩下追悔莫及四个字。至尊宝为了救爱人的命不断用月光宝盒反复穿越时空，那时候，他只是一个拥有法器的凡人。他为了自己的爱人，为了一段用生命去捍卫的爱情他反复寻找。他只不过想找回那个误打误撞相爱的女子，就此厮守，柴米油盐，漫度一生。相信他并不愿掺杂到别的情感中，甚至在遇到另一段他不可否认的感情后，他还在不断对自己和大家撒谎，为了曾经的爱情，为了寻找回去的爱情。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;但是他穿越了五百年，五百年的时光把人生分成了整整两段，两段人生无法重合却更不能对比。他不能选择孰重孰轻，他在人生的两极都遇到了属于自己的人。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;你，又有的选吗？&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;我到底爱谁？这是问题至尊宝或者叫他孙悟空他不断的思考。他整整思考了两部电影400分钟让我们思考了近二十年。他爱白晶晶的时候，晶晶自杀；救回晶晶让他穿越到500年前，为了得到月光宝盒他在紫霞仙子身前身后不离，紫霞仙子最终爱上了他；偶遇白晶晶后，他发现自己穿越了500年寻找的原来不是晶晶，而是那个在心里留下泪滴的紫霞，终于承认对紫霞的爱，紫霞此时已深陷牛魔王囹圄；为了救紫霞，他带上了从此不能去爱的紧箍，终于他踩这七色云朵出现在紫霞身边时，只能眼睁睁看着紫霞死在怀里。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;爱谁，白晶晶？紫霞仙子？&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;我想至尊宝是不能抉择的，就像是你我他，无法扪心自问一个爱与不爱。至尊宝的爱是不断的错过，不断的放弃。爱着，痛着，拥抱着，放弃着。就像你我他，心中那一滴泪它一直存在着，身边的爱人不断前行着。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“如果我不能开心的活着，那和死了有什么区别？”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;整部电影拉长了空间，把每个人的情感都压抑了起来。本一部喜剧类型的片子，不得不让你细细回味。纷至沓来的，却只有漫漫心酸与悲情。其中，最让人心酸的，不是求之不得的爱情，不是死亡，不是分分合合生离死别，而是紫霞那自始至终的【笑容】。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;在漫长的400分钟里，至始至终有生至死爱的是紫霞；不卑不亢坚持到底爱的是紫霞；真心付出爱的只有紫霞。紫霞仙子对至尊宝的一眨眼，不知泛出了多少的爱。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;我们以为世俗太浮沉，人性太丑陋；梦想大部分时间只能是想想作罢，没什么理由是让人无限付出的，没什么原因是得到理由应当的。除了。。。。。。爱情。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;于是你我把世间所有的关系都一笑置之，把其他的是是非非当成过眼云烟，把爱情当做生命中最重要的，把对人生对世界最美好最渴求的愿望都倾注于爱情。忽然发现，爱情原来是最脆弱，最不堪一击的。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;至尊宝把白晶晶当做生命唯一追了五百年，最后发现爱已远逝；&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;紫霞一次一次地深入爱着至尊宝，而最终只能在至尊宝心里留下一滴泪而远走；&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;到至尊宝发觉自己爱着紫霞时，紫霞已经死在了自己怀中；&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;紫霞终于盼到了意中人踩着七色云朵来，此时至尊宝却戴上了紧箍，由此再也不能爱，两只手再也不能拉到一起。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;你看到了什么？&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;只有，无奈。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;有时候我们认为自己是个强大的人；有时候我们认为自己是个专情的人；有时候我们认为有爱情此生足够；有时候我们以为拥有的不会再失去。在感情的路程里，没有人能主宰，都躲不开命运的安排。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“苦海，翻起爱恨；在世间，难逃避命运。”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“你看那个人样子好怪。”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;“是哦，他好像条狗啊。”&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;你自认潇洒帅气，也许是你少不经事；我肩头已经扛起了人生，或许活着像条狗。我不会否认。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;电影最后一个男主是夕阳武士，只是至尊宝或者叫孙悟空对爱情最后的执念与付出。我已戴上紧箍，从此七情六欲再不能沾染。而你，是我最后一次的执着。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;确实好像一条狗，孙悟空不敢也不能再面对深爱的紫霞仙子。他只有借着吹起的风沙去认真凝视爱人，他只有借着夕阳武士的身躯才能说出心中最深沉的爱，他只有在吻紫霞那两秒时间来消失，来心碎，来流泪。堂堂齐天大圣，居然不敢言语说爱，活着像条狗，风尘仆仆的像条狗，狼狈的像条狗。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;夕阳武士只是孙悟空的化身和夙愿。借助那么一副身躯，他在抱住紫霞的时候他不愿意放手啊他不要放手，他甚至抓疼了紫霞可他不得不松手。他只能拥抱紫霞最后两秒，他想用最炙热最大声最真情的声音告诉紫霞：我爱你！我会一直陪着你！然而，他压在心底的花最终还是没说，他应该大声告诉紫霞：我是孙悟空。但是他没有，确实，狼狈的像条狗。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;主题曲是《一生所爱》&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;从前，现在，过去了不再回来；情人，别后，永远再不来；&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;鲜花虽会凋谢，只愿，但会再开，为你；&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;p&gt;\r\n		&lt;span style=&quot;font-size:14px;&quot;&gt;一生所爱隐约，守候，在白云外，期待。&lt;/span&gt; \r\n	&lt;/p&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n	&lt;div&gt;\r\n		&lt;br /&gt;\r\n	&lt;/div&gt;\r\n&lt;span style=&quot;font-size:14px;&quot;&gt;只愿，你我一生所爱，白云外，期待。&lt;/span&gt; \r\n&lt;/div&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;p&gt;\r\n	&lt;br /&gt;\r\n&lt;/p&gt;\r\n&lt;div&gt;\r\n	&lt;span style=&quot;font-size:14px;&quot;&gt;作者：已悲&lt;/span&gt; \r\n&lt;/div&gt;\r\n&lt;span style=&quot;font-size:14px;&quot;&gt;链接：https://www.zhihu.com/question/20803100/answer/69735931&lt;/span&gt;&lt;span&gt;&lt;/span&gt; \r\n&lt;p&gt;\r\n	&lt;span style=&quot;font-size:14px;&quot;&gt;来源：知乎&lt;/span&gt; \r\n&lt;/p&gt;');

-- ----------------------------
-- Table structure for bn_menu
-- ----------------------------
DROP TABLE IF EXISTS `bn_menu`;
CREATE TABLE `bn_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '上级菜单ID',
  `title` varchar(20) NOT NULL COMMENT '菜单标题',
  `url` varchar(200) NOT NULL COMMENT '菜单链接',
  `icon` varchar(20) NOT NULL COMMENT '图标',
  `dev` tinyint(1) NOT NULL COMMENT '是否开发模式可见',
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  `sort` smallint(6) NOT NULL COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：启用，0：禁用',
  `module` varchar(20) NOT NULL COMMENT '所属模块',
  `node_id` int(11) NOT NULL COMMENT '节点ID',
  `alt` varchar(20) DEFAULT NULL COMMENT '菜单alt提示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of bn_menu
-- ----------------------------
INSERT INTO `bn_menu` VALUES ('11', '0', '系统', 'Admin/Index/welcome', 'fa fa-gear', '0', '2017-04-19 10:37:17', '2017-04-20 10:08:17', '1', '1', 'ADMIN', '36', null);
INSERT INTO `bn_menu` VALUES ('12', '11', '系统功能', '', 'fa fa-asterisk', '0', '2017-04-19 10:44:24', '2017-04-20 10:07:42', '1', '1', 'ADMIN', '25', null);
INSERT INTO `bn_menu` VALUES ('13', '12', '菜单管理', 'Admin/Menu/index', 'fa fa-tasks', '0', '2017-04-19 10:49:08', '2017-04-19 11:06:19', '0', '1', 'ADMIN', '32', null);
INSERT INTO `bn_menu` VALUES ('14', '11', '权限管理', '', 'fa fa-anchor', '0', '2017-04-19 10:50:03', '2017-04-20 10:07:53', '2', '1', 'ADMIN', '25', null);
INSERT INTO `bn_menu` VALUES ('15', '14', '用户列表', 'Admin/Access/user', 'fa fa-users', '0', '2017-04-19 10:50:24', '0000-00-00 00:00:00', '0', '1', 'ADMIN', '25', null);
INSERT INTO `bn_menu` VALUES ('16', '14', '角色管理', 'Admin/Access/roleList', 'fa fa-male', '0', '2017-04-19 10:50:51', '0000-00-00 00:00:00', '1', '1', 'ADMIN', '27', null);
INSERT INTO `bn_menu` VALUES ('17', '14', '节点管理', 'Admin/Access/nodeList', 'fa fa-asterisk', '0', '2017-04-19 10:51:11', '0000-00-00 00:00:00', '2', '1', 'ADMIN', '29', null);
INSERT INTO `bn_menu` VALUES ('18', '0', '用户后台', 'User/Customer/index', 'fa fa-user', '0', '2017-04-19 10:51:55', '0000-00-00 00:00:00', '0', '1', 'USER', '22', null);
INSERT INTO `bn_menu` VALUES ('19', '18', '首页', 'User/Customer/index', 'fa fa-archive', '0', '2017-04-19 10:52:21', '2017-04-25 17:45:35', '0', '1', 'ADMIN', '22', '');
INSERT INTO `bn_menu` VALUES ('20', '19', '客户列表', 'User/Customer/index', 'fa fa-bars', '0', '2017-04-19 10:53:05', '2017-04-19 11:08:10', '0', '10', 'ADMIN', '22', null);
INSERT INTO `bn_menu` VALUES ('21', '11', '首页', '', 'fa fa-bell-o', '0', '2017-04-19 15:45:57', '2017-04-25 17:43:27', '0', '1', 'ADMIN', '25', '后台首页');
INSERT INTO `bn_menu` VALUES ('22', '21', '欢迎首页', 'Admin/Index/welcome', '', '0', '2017-04-19 15:46:43', '2017-04-25 17:43:55', '0', '0', 'ADMIN', '25', '');
INSERT INTO `bn_menu` VALUES ('23', '21', '欢迎页面', 'Admin/Index/welcome', 'fa fa-calendar', '0', '2017-04-19 15:47:08', '2017-04-25 17:43:37', '0', '1', 'ADMIN', '25', '');
INSERT INTO `bn_menu` VALUES ('24', '11', '个人中心', '', 'fa fa-child', '0', '2017-04-26 18:00:47', '2017-04-26 18:01:03', '3', '1', 'ADMIN', '25', '');
INSERT INTO `bn_menu` VALUES ('25', '24', '文章列表', 'Admin/User/Article', 'fa fa-code', '0', '2017-04-26 18:02:26', '0000-00-00 00:00:00', '0', '1', 'ADMIN', '42', '');
INSERT INTO `bn_menu` VALUES ('26', '24', '文章分类', 'Admin/User/ArticleClassifty', 'fa fa-ellipsis-v', '0', '2017-04-26 21:47:38', '0000-00-00 00:00:00', '1', '1', 'ADMIN', '44', '');

-- ----------------------------
-- Table structure for bn_node
-- ----------------------------
DROP TABLE IF EXISTS `bn_node`;
CREATE TABLE `bn_node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '节点标题',
  `name` varchar(50) NOT NULL COMMENT '节点名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '节点状态,0：禁用、1：启用、10：删除列表不显示',
  `remark` varchar(200) NOT NULL COMMENT '备注',
  `sort` smallint(6) NOT NULL COMMENT '排序',
  `pid` int(11) NOT NULL,
  `level` smallint(6) NOT NULL COMMENT '等级',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of bn_node
-- ----------------------------
INSERT INTO `bn_node` VALUES ('20', '用户后台', 'User', '1', '', '1', '0', '1');
INSERT INTO `bn_node` VALUES ('21', '客户管理', 'Customer', '1', '', '0', '20', '2');
INSERT INTO `bn_node` VALUES ('22', '客户列表', 'index', '1', '', '0', '21', '3');
INSERT INTO `bn_node` VALUES ('23', '系统后台', 'Admin', '1', '', '0', '0', '1');
INSERT INTO `bn_node` VALUES ('24', '权限管理', 'Access', '1', '', '0', '23', '2');
INSERT INTO `bn_node` VALUES ('25', '管理员列表', 'user', '1', '', '0', '24', '3');
INSERT INTO `bn_node` VALUES ('26', '添加管理员', 'userAdd', '1', '', '0', '24', '3');
INSERT INTO `bn_node` VALUES ('27', '角色管理', 'roleList', '1', '', '1', '24', '3');
INSERT INTO `bn_node` VALUES ('28', '添加角色组', 'roleAdd', '1', '', '0', '24', '3');
INSERT INTO `bn_node` VALUES ('29', '节点管理', 'nodeList', '1', '', '2', '24', '3');
INSERT INTO `bn_node` VALUES ('30', '添加节点', 'nodeAdd', '1', '', '0', '24', '3');
INSERT INTO `bn_node` VALUES ('31', '系统功能', 'Menu', '1', '', '1', '23', '2');
INSERT INTO `bn_node` VALUES ('32', '菜单列表', 'index', '1', '', '0', '31', '3');
INSERT INTO `bn_node` VALUES ('33', '添加菜单', 'addMenu', '1', '', '100', '31', '3');
INSERT INTO `bn_node` VALUES ('34', '首页', 'Index', '1', '', '0', '23', '2');
INSERT INTO `bn_node` VALUES ('35', '欢迎首页', 'index', '1', '', '0', '34', '2');
INSERT INTO `bn_node` VALUES ('36', '欢迎登录', 'welcome', '1', '', '0', '34', '3');
INSERT INTO `bn_node` VALUES ('37', '改变状态', 'changeStatus', '1', '', '0', '24', '3');
INSERT INTO `bn_node` VALUES ('38', '分配权限', 'changeRole', '1', '', '0', '24', '3');
INSERT INTO `bn_node` VALUES ('39', '更改菜单状态', 'menuStatus', '1', '', '0', '31', '3');
INSERT INTO `bn_node` VALUES ('40', '菜单节点', 'node_change_select', '1', '', '0', '31', '3');
INSERT INTO `bn_node` VALUES ('41', '个人中心', 'User', '1', '文章管理，日志管理等', '3', '23', '2');
INSERT INTO `bn_node` VALUES ('42', '文章列表', 'article', '1', '', '0', '41', '3');
INSERT INTO `bn_node` VALUES ('43', '添加文章', 'addArticle', '1', '', '1', '41', '3');
INSERT INTO `bn_node` VALUES ('44', '文章分类', 'articleClassifty', '1', '', '2', '41', '3');
INSERT INTO `bn_node` VALUES ('45', '添加文章分类', 'addArtcleClassifty', '1', '', '3', '41', '3');

-- ----------------------------
-- Table structure for bn_role
-- ----------------------------
DROP TABLE IF EXISTS `bn_role`;
CREATE TABLE `bn_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '角色名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：有效 0：无效',
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次更新时间',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  `remark` varchar(200) DEFAULT NULL COMMENT '说明',
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of bn_role
-- ----------------------------
INSERT INTO `bn_role` VALUES ('1', '行政组', '1', '0000-00-00 00:00:00', '2017-04-14 14:53:42', '我是一直小小鸟', '0');
INSERT INTO `bn_role` VALUES ('2', '行政一组', '1', '2017-04-14 15:27:41', '2017-04-14 14:57:31', '行政组下的', '1');
INSERT INTO `bn_role` VALUES ('3', '管理员', '1', '0000-00-00 00:00:00', '2017-04-17 10:58:32', '', '0');

-- ----------------------------
-- Table structure for bn_user
-- ----------------------------
DROP TABLE IF EXISTS `bn_user`;
CREATE TABLE `bn_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `name` varchar(20) NOT NULL COMMENT '名字',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(50) NOT NULL COMMENT '登录密码',
  `email` varchar(50) NOT NULL COMMENT '邮箱地址',
  `is_admin` tinyint(1) NOT NULL COMMENT '是否管理员',
  `status` tinyint(1) NOT NULL COMMENT '状态 1:有效，0：无效，10：删除',
  `loginip` varchar(15) NOT NULL COMMENT '登录IP地址',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `last_time` datetime DEFAULT NULL COMMENT '最近登录时间',
  `loginaddr` varchar(20) DEFAULT NULL COMMENT '登录地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of bn_user
-- ----------------------------
INSERT INTO `bn_user` VALUES ('1', '超级管理员', 'admin', 'e9fd363bedc114628fe2cdce1493db15', '1193782678@qq.com', '1', '1', '::1', '2017-03-23 09:17:30', '2017-04-30 09:41:08', null);
INSERT INTO `bn_user` VALUES ('11', '张三', 'zhangsan', 'd93a5def7511da3d0f2d171d9c344e91', 'zhangsan@qq.com', '0', '1', '::1', '2017-04-29 10:28:37', '2017-04-29 13:30:01', null);

-- ----------------------------
-- Table structure for bn_user_role
-- ----------------------------
DROP TABLE IF EXISTS `bn_user_role`;
CREATE TABLE `bn_user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `role_id` int(11) NOT NULL COMMENT '角色ID',
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '插入时间',
  PRIMARY KEY (`id`),
  KEY `idx_uid` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='用户角色表';

-- ----------------------------
-- Records of bn_user_role
-- ----------------------------
INSERT INTO `bn_user_role` VALUES ('27', '11', '3', '2017-04-29 10:28:37');
