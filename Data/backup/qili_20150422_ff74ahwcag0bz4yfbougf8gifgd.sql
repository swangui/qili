/* This file is created by MySQLReback 2015-04-22 17:05:35 */
 /* 创建表结构 `my_access`  */
 DROP TABLE IF EXISTS `my_access`;/* MySQLReback Separation */ CREATE TABLE `my_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 创建表结构 `my_category`  */
 DROP TABLE IF EXISTS `my_category`;/* MySQLReback Separation */ CREATE TABLE `my_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `modelname` varchar(50) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `listorder` int(11) DEFAULT '0',
  `url` varchar(80) NOT NULL,
  `title` varchar(25) DEFAULT NULL,
  `keywords` varchar(225) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_category` */
 INSERT INTO `my_category` VALUES ('1','0','Vip','0','1','0','vip-membership','VIP会员申请','VIP会员申请','VIP会员申请','1',null),('2','0','Order','0','1','0','pre-order','产品预订','产品预订','产品预订','1','<p>产品预订<br /></p>');/* MySQLReback Separation */
 /* 创建表结构 `my_model`  */
 DROP TABLE IF EXISTS `my_model`;/* MySQLReback Separation */ CREATE TABLE `my_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `table` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_model` */
 INSERT INTO `my_model` VALUES ('1','单页模型','Content'),('2','VIP会员模型','Vip'),('3','产品预订','Order');/* MySQLReback Separation */
 /* 创建表结构 `my_node`  */
 DROP TABLE IF EXISTS `my_node`;/* MySQLReback Separation */ CREATE TABLE `my_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=231 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_node` */
 INSERT INTO `my_node` VALUES ('49','read','查看','-1',null,null,'30','3','0'),('40','Index','我的信息','1',null,'1','91','2','0'),('39','index','列表','-1',null,'0','30','3','0'),('37','resume','恢复','-1',null,null,'30','3','0'),('36','forbid','禁用','-1',null,null,'30','3','0'),('35','foreverdelete','删除','-1',null,null,'30','3','0'),('34','update','更新','-1',null,null,'30','3','0'),('33','edit','修改','-1',null,null,'30','3','0'),('32','insert','写入','-1',null,null,'30','3','0'),('31','add','添加','-1',null,null,'30','3','0'),('30','Public','公共模块','-1',null,'2','91','2','0'),('7','User','管理员管理','1',null,'7','89','2','0'),('6','Role','权限组管理','1',null,'9','89','2','0'),('2','Node','菜单管理','1',null,'11','89','2','0'),('92','index','列表','1',null,null,'7','3','0'),('50','index','系统信息','1',null,'0','40','3','0'),('86','Set','站点设置','1',null,'0','89','2','0'),('88','Model','模块管理','1',null,'2','0','1','0'),('89','System','系统管理','1',null,'4','0','1','0'),('91','Home','起始页','0',null,'0','0','1','0'),('103','Category','栏目管理','1',null,'5','89','2','0'),('105','Databack','数据备份','1',null,'13','89','2','0'),('106','Datarecover','数据恢复','1',null,'15','89','2','0'),('108','Other','扩展功能','1',null,'9','88','2','0'),('152','index','查看','1',null,'0','86','3','0'),('153','add','添加','1',null,'0','103','3','0'),('154','index','列表','1',null,'0','103','3','0'),('155','edit','修改','1',null,'0','103','3','0'),('156','foreverdelete','删除','1',null,'0','103','3','0'),('157','add','添加','1',null,'0','7','3','0'),('158','edit','修改','1',null,'0','7','3','0'),('159','foreverdelete','删除','1',null,'0','7','3','0'),('160','index','列表','1',null,'0','6','3','0'),('161','add','添加','1',null,'0','6','3','0'),('162','edit','修改','1',null,'0','6','3','0'),('163','foreverdelete','删除','1',null,'0','6','3','0'),('165','role','授权','1',null,'0','6','3','0'),('167','index','列表','1',null,'0','2','3','0'),('168','add','添加','1',null,'0','2','3','0'),('169','edit','修改','1',null,'0','2','3','0'),('170','foreverdelete','删除','1',null,'0','2','3','0'),('171','index','显示','1',null,'0','105','3','0'),('172','back','备份','1',null,'0','105','3','0'),('173','index','列表','1',null,'0','106','3','0'),('174','recover','恢复','1',null,'0','106','3','0'),('175','deletebak','删除','1',null,'0','106','3','0'),('176','downloadBak','下载','1',null,'0','106','3','0'),('180','Clearcache','清除缓存','1',null,'25','89','2','0'),('198','index','清除缓存','1',null,'0','180','3','0'),('203','update','修改处理','1',null,'0','108','3','0'),('204','insert','添加处理','1',null,'0','108','3','0'),('205','save','修改','1',null,'0','86','3','0'),('206','update','修改处理','1',null,'0','103','3','0'),('207','insert','添加处理','1',null,'0','103','3','0'),('208','insert','添加处理','1',null,'0','7','3','0'),('209','update','修改处理','1',null,'0','7','3','0'),('210','insert','添加处理','1',null,'0','6','3','0'),('211','update','修改处理','1',null,'0','6','3','0'),('212','update','修改处理','1',null,'0','2','3','0'),('213','insert','添加处理','1',null,'0','2','3','0'),('229','foreverdelete','删除','1',null,'0','226','3','0'),('217','delfile','删除图片权限','1','ajax图片删除权限','0','86','3','0'),('218','index','列表','1',null,'0','108','3','0'),('219','add','添加','1',null,'0','108','3','0'),('220','edit','修改','1',null,'0','108','3','0'),('221','foreverdelete','删除','1',null,'0','108','3','0'),('228','edit','修改','1',null,'0','226','3','0'),('227','index','列表','1',null,'0','226','3','0'),('226','Survey','用户调查','1',null,'0','88','2','0');/* MySQLReback Separation */
 /* 创建表结构 `my_order`  */
 DROP TABLE IF EXISTS `my_order`;/* MySQLReback Separation */ CREATE TABLE `my_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(5) NOT NULL,
  `shopname` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `content` text NOT NULL,
  `operation_people` varchar(30) NOT NULL,
  `audit_results` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `ip` varchar(30) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_order` */
 INSERT INTO `my_order` VALUES ('9','2','绮丽永生花','杨涛','15102157626','330130180','我想预订','徐','处理中','<p>大批量客户</p>','127.0.0.1','1429597722','1429682228');/* MySQLReback Separation */
 /* 创建表结构 `my_orderlist`  */
 DROP TABLE IF EXISTS `my_orderlist`;/* MySQLReback Separation */ CREATE TABLE `my_orderlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderid` int(5) NOT NULL,
  `order_name` varchar(100) NOT NULL,
  `order_num` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_orderlist` */
 INSERT INTO `my_orderlist` VALUES ('39','9','LM110&nbsp;肯尼亚进口永生花&nbsp;保鲜花&nbsp;永生花单色玫瑰花头&nbsp;4-5CM&nbsp;6朵装','10'),('40','9','50510大地农园进口永生花&nbsp;东方鸢尾&nbsp;铃兰花&nbsp;风铃花&nbsp;保鲜花材&nbsp;多色','15');/* MySQLReback Separation */
 /* 创建表结构 `my_other`  */
 DROP TABLE IF EXISTS `my_other`;/* MySQLReback Separation */ CREATE TABLE `my_other` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setname` varchar(80) DEFAULT NULL,
  `settag` varchar(80) DEFAULT NULL,
  `setvalue` text,
  `ifshow` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_other` */
 INSERT INTO `my_other` VALUES ('6','版权信息','copyright','© Company 2015 绮丽进口永生花','1');/* MySQLReback Separation */
 /* 创建表结构 `my_role`  */
 DROP TABLE IF EXISTS `my_role`;/* MySQLReback Separation */ CREATE TABLE `my_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_role` */
 INSERT INTO `my_role` VALUES ('18','内容编辑','1',null,'1413644649','1415369593');/* MySQLReback Separation */
 /* 创建表结构 `my_set`  */
 DROP TABLE IF EXISTS `my_set`;/* MySQLReback Separation */ CREATE TABLE `my_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `errorcount` int(11) DEFAULT NULL,
  `errorinterval` int(11) DEFAULT NULL,
  `messageinterval` int(11) DEFAULT '0',
  `icon` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_set` */
 INSERT INTO `my_set` VALUES ('21','5','1200','3600','2015/4/22/favicon.ico');/* MySQLReback Separation */
 /* 创建表结构 `my_survey`  */
 DROP TABLE IF EXISTS `my_survey`;/* MySQLReback Separation */ CREATE TABLE `my_survey` (
  `id` varchar(32) DEFAULT NULL,
  `shopname` varchar(76) DEFAULT NULL,
  `contactperson` varchar(12) DEFAULT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `email` varchar(24) DEFAULT NULL,
  `province` varchar(24) DEFAULT NULL,
  `city` varchar(21) DEFAULT NULL,
  `district` varchar(21) DEFAULT NULL,
  `scope` varchar(58) DEFAULT NULL,
  `shop` varchar(35) DEFAULT NULL,
  `boughtfromus` varchar(3) DEFAULT NULL,
  `majorsource` varchar(29) DEFAULT NULL,
  `monthlyquota` varchar(58) DEFAULT NULL,
  `currentbrands` varchar(107) DEFAULT NULL,
  `created` bigint(13) DEFAULT NULL,
  `businessage` varchar(13) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('c4ca4238a0b923820dcc509a6f75849b','CHEERS','李小姐','13760882338','395579436@qq.com','广东省','广州市','白云区','永生花成品','其他','否','淘宝','3000','Roseamor,大地农园','1413876577165',null),('3449c9e5e332f1dbb81505cd739fbf3f','花房姑娘','罗雨舟','18383377753','158492495@qq.com','四川省','乐山市','市中区','永生花材','自有网店','否','淘宝','500','国产品牌','1413894512206',null),('61a31db7521059ffbef82b36dec9a8be','闪闪花坊','闪闪','13367266320','xiaokaixinlsh@126.com','湖北省','武汉市','洪山区','永生花成品','自有网店','否','淘宝,品牌代理商','8000','Roseamor,大地农园,Amorosa,Florever','1413980904480',null),('cad5b4df589664244f22a66b3896836c','花美丽花店','刘佳','18082976480','209757457@qq.com','省份／直辖市','null','null','永生花成品,鲜花花艺,鲜花材','自有实体店','否','花市','4000','Roseamor,大地农园,Amorosa,Florever,Rosenana,国产品牌','1414077499126',null),('fe3f209ce609a7f12fcf36e192a02bcf','南阳永爱花艺有限公司','孙小飞','15937701200','365458901@qq.com','河南省','南阳市','卧龙区','永生花成品,永生花材,鲜花花艺,鲜花材,其他','自有实体店,其他','否','淘宝','10000','大地农园,国产品牌','1414121593744',null),('ef2bfac9cc17723473059d1917a94c20','Twinkle','赵雯','15921529198','296309065@qq.com','上海','上海市','虹口区','永生花成品','自有网店','是','淘宝','2000','Vermeille,大地农园','1414138181895',null),('f26232dc35d1d7517ab3386c96c0ade3','Arich Studio 花坊','戴梦瑜','18658662870','faddy_machree@qq.com','云南省','昆明市','五华区','永生花成品,永生花材','自有实体店,其他','否','花市','5000','Roseamor,国产品牌','1414142082141',null),('f26232dc35d1d7517ab3386c96c0ade3','Arich Studio 花坊','戴梦瑜','18658662870','faddy_machree@qq.com','云南省','昆明市','五华区','永生花成品,永生花材','自有实体店,其他','否','花市','5000','Roseamor,国产品牌','1414142082163',null),('5354973521d7eea748f5beea934c4f3e','俄罗斯真彩公司','周天河','15331823206','nmqhwss@qq.com','海外','海外','null','永生花成品,其他','自有实体店','否','淘宝,品牌代理商','20000','Roseamor,Vermeille,大地农园,Amorosa,Florever','1414218106916',null),('e4e19c63dac539d085b64def3351c69b','Jasmine高端定制花馆','李莉','15357699595','498588898@qq.com','安徽省','阜阳市','太和县','永生花成品','自有网店','是','淘宝','5000','Roseamor,Vermeille,大地农园,Amorosa,Florever,Primavera','1414304872889',null),('1d3a133e1e0c36847b488683d5b1d667','flore','程玮','15806220581','yuvivi2008@126.com','江苏省','苏州市','太仓市','永生花成品','自有网店,其他','否','淘宝','2000','Roseamor,Vermeille,大地农园,Florever,Rosenana','1414308009237',null),('c82ade118a86f55d222c59bc454fcf3b','我们快乐的结局','刘苏','18604551209','397391955@qq.com','黑龙江省','哈尔滨市','道里区','其他','其他','是','淘宝','3000左右','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana','1414310255286',null),('24e0ba98527145caee8e258b95abf2b9','Miss Flower 花小姐','刘媛媛','18299108283','181098889@qq.com','新疆维吾尔自治区','乌鲁木齐市','天山区','永生花成品','自有网店','是','花市,淘宝','1000～2500','Roseamor,Vermeille,大地农园,Verdissimo,Amorosa,Lumiere,Rosenana,国产品牌','1414310519401',null),('88d0c1c86b650c066be53dba36de982a','秘蜜花园鲜花体验馆','陈楚玉','18990969110','156174197@qq.com','四川省','宜宾市','翠屏区','永生花成品,永生花材,鲜花花艺,鲜花材,其他','自有实体店,其他','否','花市,淘宝','店面正在装修。','大地农园,Florever','1414374705689',null),('eaf245f1516710f9ed2aa1cc81da56e2','lulu\'s','陆婧','15959608569','284353097@qq.com','福建省','漳州市','芗城区','永生花成品,鲜花花艺,鲜花材','其他','否','淘宝','5000','Roseamor,大地农园,Verdissimo,Vermont,Amorosa,Florever,Primavera','1414402443474',null),('a586545c1bc0835c9164d6cb40c1f25e','小美创意花店','裴小姐','13836021214','714192@qq.com','黑龙江省','哈尔滨市','南岗区','永生花成品,鲜花花艺','自有网店','否','花市,淘宝','3000元左右，这个是鲜花，永生花刚开始做。','Roseamor,大地农园','1414558678833',null),('e4aaa03fbd691868bb2b298ef34b6598','flora\'s whisper','蔡张帆','15057788636','172631772@qq.com','浙江省','温州市','鹿城区','永生花成品','自有网店','是','淘宝','4000','Roseamor,Vermeille,大地农园,Amorosa','1414651430288',null),('29519bb8c41f3efdff20605beb437056','花时间 永生花生活馆','苏桂红','15280236283','345239285@qq.co m','福建省','厦门市','思明区','永生花成品','自有网店','否','淘宝','4000','Vermeille,大地农园,Lumiere,Rosenana','1414811383372',null);/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('0e6aef1067fcb196596f5100e09bbe60','a','a','a','a','北京','北京市','东城区','永生花材','自有实体店','否','花市','1','Roseamor,Lumiere','1414859982053','3个月以下');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('8286f732b9c4033e09edde79184114bb','初心服饰有限公司 注册花品牌 猛虎蔷薇','谭一尔','15068851569','29355589@qq.com','浙江省','杭州市','滨江区','永生花成品','自有网店,其他','是','淘宝','15000元','Roseamor,大地农园,Verdissimo','1414905527207','3个月以下'),('bea1b8d80c7ef2f638409bb50d123af8','今晚打老虎不打飞机/女朋友的花店','唐小姐','15618583581','nyjourney@163.com','上海','上海市','奉贤区','永生花成品','自有网店,自有实体店','是','淘宝','7000~10000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana','1414990570884','1年以下'),('2d0b72089419c512330234e36a651750','名字起好后，会补充给你们的！~','邱蓉','18252011650','105153374@qq.com','江苏省','南京市','鼓楼区','永生花成品,永生花材,其他','其他','是','淘宝','10000','Roseamor,大地农园,Verdissimo,Amorosa,Primavera','1415006562044','筹备中'),('18657b81825c77997032aacc031d28d9','花花的花店','刘缤','18191006553','597605469@qq.com','陕西省','咸阳市','秦都区','永生花成品','自有实体店','否','淘宝','10000','Florever','1415020716197','1年以下'),('501bd711bb413d301e6e3504b431cef9','今晚打老虎不打飞机/女朋友的花店','颜先生','18912655277','290012313@qq.com','江苏省','苏州市','昆山市','永生花成品','自有网店,自有实体店','是','淘宝','5000~10000','Roseamor,Vermeille,大地农园,Verdissimo,Lumiere,Florever,Primavera,Rosenana','1415021185985','1年以下'),('61b3f060c489d17c15eac7c90b60bb66','淮安交通设计院','孙楚楚','18551622010','215047291@qq.com','江苏省','淮安市','清河区','其他','其他','是','淘宝,品牌代理商','不定','Roseamor,Vermeille,大地农园,Amorosa,Rosenana','1415075604425','筹备中'),('aba7d3d453864e1bb04378b68b87d4bb','爱驿','韩婷','18904922336','114347415@qq.com','辽宁省','鞍山市','铁东区','永生花成品,鲜花花艺','其他','否','淘宝','2000','Roseamor,大地农园,Verdissimo','1415081528103','筹备中'),('2cc148153ed3dabf57da1fda0177a352','武汉尚亦品文化传播有限公司','熊雅弦','13971666856','12953330@qq.com','湖北省','武汉市','武昌区','永生花成品,鲜花花艺,鲜花材,其他','自有实体店','是','花市,淘宝,品牌代理商','20000','Roseamor,大地农园,Verdissimo,Amorosa,Florever,Primavera','1415246825074','1年以下'),('4842e4a10774f81bac95fb9f8322ee98','露露de园艺家','姜露','13486070716','113333878@qq.com','浙江省','宁波市','北仑区','永生花成品,鲜花花艺,其他','自有网店,自有实体店,其他','是','花市,品牌代理商','平均下来每个月永生花花材五千左右吧','大地农园,Primavera','1415257218558','1年以上'),('9c8e3964e806148cb8facbf710fda885','Moment时光花卉','马悦','18626139671','175802962@qq.com','江苏省','苏州市','沧浪区','永生花成品','自有网店','是','淘宝','2000到3500左右','Roseamor,Vermeille,大地农园,Lumiere','1415361359315','3个月以下'),('091f5f4b235791a14830ed2d86e9b2b6','绍兴高新区花先生花店','李香红','15957501212','332917577@qq.com','浙江省','绍兴市','越城区','永生花成品,永生花材,鲜花花艺,鲜花材,其他','自有实体店,其他','是','花市,淘宝,品牌代理商','30000元','大地农园','1415449307272','1年以上'),('c49f9ecfdb2e51db649862c6f0cdb3ac','赵华花店','时文振','15609181295','shizhao2007159@126.com','河南省','郑州市','惠济区','鲜花花艺,鲜花材,其他','自有实体店','是','花市','10000','Roseamor,国产品牌','1415548258514','1年以下'),('1d220f34700a83cdaa82dbca95729f92','小熊的花店','熊建科','18658207100','104032708@qq.com','浙江省','宁波市','慈溪市','永生花成品','自有网店','是','淘宝','4000左右','Roseamor,Vermeille,Lumiere,Rosenana','1415618921923','1年以下'),('e3eca6500dfd2adc58f7de66ac305dcd','fun Florist','esther chew','60166542888','esther0424t@hotmail.com','海外','海外','null','永生花材','其他','否','淘宝','不祥','国产品牌','1415685978552','筹备中'),('931839d4638681b750e8abf88e8716bd','小不点怪兽','杨韶仪','13512939330','1035512994@qq.com','天津','天津市','河西区','永生花成品','其他','是','淘宝','1500','Roseamor','1415715711807','筹备中'),('7d29ecfc7d3742269c669951d6c0020e','ROSE LOVE 高端花艺订制','商赫林','18931175229','1571844512@qq.com','河北省','石家庄市','长安区','永生花成品,鲜花花艺','自有网店,自有实体店','否','花市','1000元','Roseamor,大地农园,Amorosa','1415753598909','筹备中'),('b0b5eb5cecc1bb7b325d69087b040f53','花香Aroma','胡小姐','13916005459','360128225@qq.com','上海','上海市','虹口区','永生花成品,鲜花花艺','自有网店','否','花市','3000','Roseamor,大地农园,Amorosa','1416299758658','筹备中');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('7d8cd181493dca9e803a2ff3a1d4dcb0','花园里花店','陈旦钦','15058252951','yychendanqin@163.com','浙江省','宁波市','余姚市','永生花成品,鲜花花艺,鲜花材','自有网店,自有实体店','是','花市,品牌代理商','8000','Roseamor,Vermeille,大地农园,Amorosa,国产品牌','1416469292569','1年以下');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('31c4eb1bacf6e9ac82c6a3d521a0b418','lin‘s花店','林小姐','13533695030','1815978082@qq.com','广东省','广州市','海珠区','永生花成品,永生花材','自有实体店','是','淘宝','6000-10000','Roseamor,Vermeille,大地农园,Florever','1416546908693','1年以下'),('f27bd7e29e1cbe26f576c130d67be975','Lin\'S花店','林小姐','13533695030','1815978082@qq.com','广东省','广州市','海珠区','永生花成品,永生花材','自有网店,自有实体店','是','淘宝','8000','Roseamor,Vermeille,大地农园,Florever','1416547880912','1年以下'),('91c52b53cd214ec13efb3279c0c7fbd2','CASA ART ','叶伟玲','15602802274','517201496@qq.com','省份／直辖市','null','null','永生花成品,永生花材,其他','其他','是','淘宝,品牌代理商','2500','Vermeille,大地农园,Verdissimo,Florever,Primavera','1416589543501','筹备中'),('f996aa228754a62523a073ccdf049218','Fourteen roses','fu ','15164592564','351295125@qq.com','黑龙江省','大庆市','萨尔图区','永生花成品,鲜花花艺','自有网店,自有实体店','否','花市,淘宝','10000','国产品牌','1416722551767','3个月以下'),('4feb1681204f9fcc95552bb2bb4de304','花小姐','柳亨格','15018299996','240201844@qq.com','广东省','揭阳市','榕城区','永生花成品','自有网店','是','淘宝,品牌代理商','2000','Roseamor,Vermeille,大地农园,Amorosa,Florever,Rosenana,国产品牌','1416735402072','3个月以下'),('9a1c7cdac230882f5d8bdc8a831ce5f0','Carpulence鲜花店','邓海燕','15989669418','314588604@qq.com','广东省','东莞市','null','永生花成品,鲜花花艺,鲜花材','自有网店,自有实体店','否','花市','8000','国产品牌','1416811515188','筹备中'),('083ae0aa0dca5b8a8d7755706f27d184','rosa floral','王建梅','13761243255','wjm20010507@163.com','江苏省','无锡市','滨湖区','永生花成品,鲜花花艺,其他','其他','是','花市','5000','Roseamor,Vermeille,大地农园,Verdissimo','1416925544798','1年以上'),('853f2c91debed0407219669d9813bd32','唯美爱','张铭山','13938292118','13938292118@126.com','河南省','郑州市','中原区','永生花材','其他','否','花市,淘宝,品牌代理商','正在筹备','国产品牌','1416987902760','筹备中'),('bfff4db4e5384ba7ac1ea53f515e6eb4','遇见花艺工作室','二月','15332101033','dabaoguai520@126.com','天津','天津市','和平区','永生花成品,永生花材,鲜花花艺,鲜花材','自有网店,自有实体店','是','花市,淘宝,品牌代理商','10000','Roseamor,Vermeille,大地农园,Amorosa,Florever','1416988385548','1年以下'),('49868bfc6b4ff6fe986d4ea30cbfabd7','春暖花开','周','13961117295','janey7295@126.com','江苏省','常州市','金坛市','永生花成品','其他','否','淘宝','1000','Florever','1417061801962','筹备中'),('9ffe5388d8e78ed986cd1f74f6329d78','玫瑰人生永生花工作室','楊如惠','886933951688','westwood4711@hotmail.com','台湾省','高雄市','前金区','永生花成品,永生花材','自有实体店','是','淘宝,品牌代理商','15000','Vermeille,大地农园,Verdissimo,Lumiere,Florever,Primavera','1417083329052','3个月以下'),('5fe5fd61854fd62e4506143a40c7de5b','J-DECO','钟方静','15267787665','88109414@qq.com','浙江省','温州市','瑞安市','永生花成品','自有网店','是','淘宝','5000','Florever,国产品牌','1417158601663','筹备中'),('3f80f21d9cc533f20e152c7f8c05c51c','JadeFlower','黄靖妍','18620986297','492074790@qq.com','广东省','广州市','海珠区','永生花成品','自有网店','是','淘宝','2000','Vermeille,大地农园,Amorosa,Lumiere,Primavera','1417162763178','3个月以下'),('67a8bb382f1188115508d9c4e663d174','精灵永恒花坊','15225179830 ','15225179830','892890492@qq.com','河南省','郑州市','二七区','永生花成品,永生花材,鲜花花艺','自有网店','否','花市,淘宝','3000~4000','国产品牌','1417163481968','筹备中'),('67a8bb382f1188115508d9c4e663d174','精灵永恒花坊','15225179830 ','15225179830','892890492@qq.com','河南省','郑州市','二七区','永生花成品,永生花材,鲜花花艺','自有网店','否','花市,淘宝','3000~4000','国产品牌','1417163485178','筹备中'),('67a8bb382f1188115508d9c4e663d174','精灵永恒花坊','15225179830 ','15225179830','892890492@qq.com','河南省','郑州市','二七区','永生花成品,永生花材,鲜花花艺','自有网店','否','花市,淘宝','3000~4000','国产品牌','1417163491697','筹备中'),('2405a86cc07c90309e2d82a4b81aa6ad','精灵永恒花坊','曾晶晶','15225179830','892890492@qq.com','河南省','郑州市','二七区','永生花成品,永生花材,鲜花花艺','自有网店','否','花市,淘宝','3000～4000','国产品牌','1417164327237','筹备中'),('e85d50c2a988f07015bb59cd903c906f','记梦馆','薛海英','18600156797','25687323@qq.com','吉林省','长春市','经济技术开发区','永生花成品','自有实体店','是','淘宝','2000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana','1417169961900','3个月以下');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('75a5cd91ff9af88bfe3c03eb6187cc44','深圳市拾壹号文化传播有限公司','马先生','13420914896','immaxma@qq.com','广东省','深圳市','宝安区','永生花成品','自有实体店','是','花市','8000','Roseamor,大地农园,Lumiere','1417181668065','1年以上');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('1eafbf78bdc1bb0241eae21d58a923ff','Fourteen roses','李丹','15164592564','fuxuejiao_520@126.com','黑龙江省','大庆市','萨尔图区','永生花材','自有网店','否','淘宝','10000','大地农园,Primavera','1417219662415','1年以下'),('bd61301ab0cb3baff317dae17e5bb91c','Z&Z花艺生活馆','周夏','13566017267','78351472@qq.com','浙江省','宁波市','江东区','永生花成品,永生花材','自有实体店','是','花市,淘宝','3000','Roseamor,Vermeille,大地农园,Amorosa,Lumiere','1417434288106','筹备中'),('1593375c619855bca9ceca020e0f37d7','蓝雪玫瑰（北京）文化有限公司','朱','13811316176','ydjt529@126.com','北京','北京市','通州区','永生花材','其他','是','品牌代理商','0-10W不等','大地农园,Florever,国产品牌','1417592027617','1年以下'),('6452317785ded3e022b91d30eaf2cdc0','时间花艺工作室','黄嘉伟','18933404763','434463087@qq.com','广东省','中山市','null','永生花成品,鲜花花艺,鲜花材','自有网店,其他','是','花市,淘宝','5000','大地农园,Rosenana','1418023032909','1年以下'),('448b7f2c46b39c00dc0c81a49f69402d','热望农场','13888906139','13888906139','362126564@qq.com','云南省','昆明市','五华区','永生花材,鲜花花艺,鲜花材,其他','自有网店,自有实体店','否','品牌代理商','5000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana','1418097279364','1年以上'),('6301a32ba9a3dc61910e29072c4b6c65','forever','杨思渝','13708808074','sherry_yw@126.com','云南省','楚雄彝族自治州','楚雄市','永生花材','自有实体店','否','花市,品牌代理商','不一定','Roseamor,Amorosa,Rosenana,国产品牌','1418367922213','3个月以下'),('98f5dfcea87f2b60a13488b6271aba23','花与她永生花','李小璐','13951506234','578865612@qq.com','湖北省','武汉市','青山区','永生花材,鲜花花艺,鲜花材,其他','自有网店','否','品牌代理商','0','Rosenana,国产品牌','1418369884896','3个月以下'),('4dfc9ccc668e6893e255104b60019ea0','铭月丽香','杨小姐','15618618853','77366384@qq.com','上海','上海市','宝山区','永生花成品','自有网店','否','淘宝,品牌代理商','4000','Vermeille,大地农园,Lumiere','1418444835133','3个月以下'),('7ea9aabb29e9d49f9cb1d7ccf5e25a6f','crapulence','邓小姐','15989669418','314588604@qq.com','广东省','东莞市','null','永生花成品','自有网店','是','淘宝','10000','Roseamor,Vermeille,大地农园,Amorosa,Lumiere','1418627324410','1年以下'),('00198f8e3c99018331813aea045af73b','V587Garden','兔子','18182079000','V587Garden@qq.com','湖南省','株洲市','芦淞区','永生花成品,鲜花花艺,鲜花材,其他','自有网店,自有实体店','否','花市','20000','大地农园,Amorosa','1418709660068','3个月以下'),('f51d186bd02702a2d8faac9d8eb4d66f','爱无间花艺生活馆','秦华','18192319138','674215673@qq.com','陕西省','西安市','雁塔区','永生花成品,鲜花花艺','自有网店','是','淘宝','5000','Roseamor,Vermeille,大地农园,Amorosa,Lumiere,Rosenana','1418772445925','筹备中'),('bc27fa80d05d4107811b70bfc490d7ea','Merci永生花创意集市','杨小姐','18502822477','m18683510807@163.com','广东省','深圳市','南山区','永生花成品','自有实体店','是','淘宝','10000','Roseamor,Vermeille,大地农园,Lumiere','1418987406861','筹备中'),('793f4960851d399d260eec13d03d8ac7','思慕花礼','钱小姐','15381069202','meteor51930@qq.com','浙江省','杭州市','下城区','永生花成品','自有网店','是','花市,淘宝','10000','Roseamor,大地农园,Amorosa,Florever','1419075101478','1年以下'),('2fadd58410ae426893048bc415831fcb','精灵永恒花坊','曾晶晶','15225179830','892890492@qq.com','河南省','郑州市','二七区','永生花成品,永生花材','自有网店,其他','是','花市,淘宝','3000','大地农园','1419254597454','筹备中'),('540afe5bc4a9dc2247cb706eaf8826ef','精灵永恒花坊','曾晶晶','15225179830','470321346@qq.com','省份／直辖市','null','null','永生花成品,永生花材','自有网店,其他','否','淘宝,品牌代理商','1500','大地农园,Florever','1419254803066','3个月以下'),('590bc38f24dd15e528640713b0ba6537','ONLY SHE','骆淑君','15851293178','shujun_1022@163.com','浙江省','金华市','东阳市','永生花成品','自有网店','是','淘宝','待定','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana','1419425596673','筹备中'),('ea6a22d383a55c92415459f24de97d16','爱 恒','秦恒','18637181019','275347332@qq.com','河南省','郑州市','金水区','永生花成品,鲜花花艺','自有网店','是','花市,淘宝','2000','Roseamor,大地农园','1419584903852','1年以下'),('d1c11787e064dd878a0c344743be8905','熙棠手作','乔熙','17090020927','308825474@qq.com','北京','北京市','密云县','鲜花花艺,其他','自有网店','否','淘宝,品牌代理商','1000','Vermeille,大地农园','1419740327351','筹备中');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('f6e50e09778b2fdb76e743808e6e5f5d','for花店','张','18910651886','258450453@qq.com','浙江省','杭州市','滨江区','永生花成品,其他','自有网店,自有实体店','是','品牌代理商','5000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Primavera,Rosenana,国产品牌','1420286877736','3个月以下');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('ce8029b7f84ea519e1e387a20f64659e','香侬花店','刘石万','17708458897','windim@163.com','湖南省','长沙市','宁乡县','永生花成品,永生花材,鲜花花艺,鲜花材','自有网店,自有实体店','否','花市','不一定','国产品牌','1420960495844','3个月以下'),('3911aae2ce7a2bcfaeae24064fe71c48','爱恒','秦恒','18637181019','275347332@qq.com','省份／直辖市','null','null','永生花成品,鲜花花艺','自有网店','是','花市,淘宝','3000','Roseamor,Vermeille,大地农园','1420977832276','1年以下'),('a3a10e848fadb7713a63c2713dfb3c81','sam','sam','18017723066','qljkysh@163.com','北京','北京市','东城区','永生花成品','自有网店','是','花市','1','Roseamor,Amorosa','1422533361674','筹备中'),('f40aa505a37866b20b7100e8d51c8392','唯爱','文静','13541092220','263678197@qq.com','四川省','资阳市','乐至县','永生花成品,永生花材','自有网店','否','花市','未知','国产品牌','1422535044467','筹备中'),('6da5a4097a8607a20334e0315ccb0815','未定','文静','13541092220','263678197@qq.com','四川省','资阳市','乐至县','永生花成品,永生花材,鲜花花艺','自有网店','否','花市','1','国产品牌','1422708194010','筹备中'),('e5c95eda78a6259ac05d6f5d77df066b','Bright Life','吴艳芳','18910174553','heiseyinmai@sina.com','北京','北京市','西城区','永生花成品','其他','否','淘宝,品牌代理商','2000','Roseamor,Vermeille,大地农园,Verdissimo,Florever','1422753312791','筹备中'),('a52f1e56a2ef639b6ab4245b13e32427','蓝园艺工作室','赵小姐','13981728921','13786685@qq.com','四川省','成都市','锦江区','永生花成品,鲜花花艺,其他','自有实体店','是','花市,淘宝,品牌代理商','10000','Roseamor,大地农园,Amorosa,Florever','1422767456285','1年以上'),('fce0ac75fcdc8869763bd041c6b80829','婂花堂','刘晓','13955123422','36723693@qq.com','安徽省','合肥市','包河区','永生花材,鲜花花艺,鲜花材','自有网店,其他','是','淘宝','20000','Roseamor,Vermeille,大地农园,Verdissimo,Amorosa,Lumiere,Florever,Primavera,国产品牌','1423022352284','3个月以下'),('715b5564820c00ecbaec867455460a86','花木楠','贺女士','18706779602','545348012@qq.com','陕西省','西安市','雁塔区','永生花成品','其他','是','花市,淘宝','3000','Roseamor,Vermeille,大地农园','1423323786322','筹备中'),('13e6bea8620212c9339b94e2d2cf1c8a','su小姐手工店','suki','18621379108','75264430@qq.com','上海','上海市','宝山区','永生花成品','其他','是','淘宝,品牌代理商','2000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Rosenana','1423623897113','3个月以下'),('f05c8f98ab8fa18729e8a4bcb718ba1d','冬日暖阳永生花礼品店','张冬月','15840069803','22587217@qq.com','省份／直辖市','null','null','永生花成品','自有网店','是','淘宝','1000','Vermeille,大地农园,Lumiere','1423624191551','筹备中'),('d5f42a41026cad7ad3531ad85b48e1b7','珊瑚礁花坊','李蕊','18829718568','392580053@qq.com ','陕西省','延安市','宝塔区','永生花成品,鲜花花艺','其他','否','花市,淘宝','3000','Roseamor,Florever,国产品牌','1424069990130','筹备中'),('1a8efec1a11cbcb23970e56d448039fc','TIMEROSE时光玫瑰','吉小姐','15861362363','jiyunfei123456@126.com','江苏省','扬州市','维扬区','永生花成品,永生花材,鲜花花艺','自有网店,自有实体店','否','淘宝','5000','Roseamor,Vermeille,大地农园,Amorosa,国产品牌','1424854363442','筹备中'),('578e7034f8f79e6a4934c173961028a2','晨之恋','15047768532','15047768532','510875166@qq.com','内蒙古自治区','鄂尔多斯市','伊金霍洛旗','永生花成品','自有网店','否','品牌代理商','10000元','Roseamor,大地农园','1425031898220','1年以下'),('1198b76c0d567f54f4dee133cb8051c8','永生花盒高端定制','王慧','13643533450','2824129788@qq.com','山西省','阳泉市','城区','永生花成品','其他','否','淘宝','500000','Roseamor,Vermeille,大地农园,Verdissimo,国产品牌','1425222323879','筹备中'),('e5ff4f73f8c98e941ae34d533add7181','Fresh love','李晨','13488854061','Xiaopin@126.com','北京','北京市','东城区','永生花成品,永生花材','自有网店','否','淘宝,品牌代理商','0','Amorosa,国产品牌','1425478991532','筹备中'),('cc0db968f5bb4ebe8eca326f6abe359c','lee live','李腾跃','13464765186','litengyue333@163.com','辽宁省','营口市','站前区','永生花材','自有实体店','否','花市,淘宝','3万','大地农园','1425695759369','筹备中'),('a1511fe52aaafad97f23956747e0713d','成都兄弟会网络科技有限公司/成都市木子婷花艺培训学校','王鹏','13678181880','78870107@qq.com','四川省','成都市','青白江区','永生花成品,永生花材,鲜花花艺,鲜花材,其他','自有实体店,其他','否','花市','20000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Florever,Primavera,Rosenana,国产品牌','1425709463998','1年以上');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('8d527dbad5bf36a997b4468d443a1945','思慕花礼','孙小姐','13588466884','meteor51930@qq.com','浙江省','杭州市','下城区','永生花成品','自有网店','是','花市,淘宝','30000','Roseamor,大地农园,Amorosa,Florever,国产品牌','1425894939150','1年以下');/* MySQLReback Separation */
 /* 插入数据 `my_survey` */
 INSERT INTO `my_survey` VALUES ('0049262f9c4a9bfc3f7b42051280be35','花一','韦思羽','13877528935','17528893@qq.com','广西壮族自治区','玉林市','玉州区','永生花成品,永生花材','自有网店,其他','否','淘宝,品牌代理商','3000---5000元','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana','1425960398162','筹备中'),('f65c876580af042fed7e1f3d4ce3b255','上海熙然商贸有限公司','刘蓉','13701762625','y_rose2015@168.com','上海','上海市','宝山区','永生花成品,永生花材','其他','否','品牌代理商','10000元','大地农园,Verdissimo,Vermont,Primavera','1425971108016','筹备中'),('0712f4d6d3d9314a609fe2d74d8fa84e','imoxi','莫兮','13166265390','229715866@qq.com','上海','上海市','宝山区','永生花成品,永生花材','自有网店,其他','否','淘宝','5000','大地农园','1426124917672','筹备中'),('1b0365ae4c1606d25b76fd9951bc84b3','如遇永生花','张小明','15156086567','475336819@qq.com','安徽省','合肥市','包河区','永生花成品,永生花材,鲜花花艺,鲜花材','自有网店,其他','否','花市,品牌代理商','10000','Roseamor,Amorosa','1426242327101','筹备中'),('ec232dd611146f4f36060be87949ae72','拾壹号花店','马先生','13420914896','immaxma@qq.com','广东省','深圳市','宝安区','永生花成品','自有实体店','是','花市,淘宝,品牌代理商','1W-3W','Roseamor,Vermeille,大地农园,Lumiere','1426939336820','1年以上'),('bfadef15e982455e39199b6e53652741','上海弥尼工贸有限公司','季晔琳','021-62509227','194944046@qq.com','上海','上海市','普陀区','永生花成品,鲜花花艺','其他','是','花市,淘宝','4000','Vermeille,大地农园,Verdissimo,Amorosa,Florever,国产品牌','1427685244181','1年以上'),('a2ed7afe914ef333fe1ee1d834c0abc7','春之语鲜花','张军辉','13991117086','771421569@qq.com','陕西省','西安市','长安区','鲜花花艺','自有网店,自有实体店','否','淘宝','1000','Roseamor','1427818780315','1年以上'),('e45a2cb7e20a0ced12486ce528f4630c','永爱花店','李小姐','13822607710','791126282@qq.com','广东省','肇庆市','端州区','永生花成品,永生花材,其他','自有实体店','否','花市,淘宝','10000','Roseamor,Vermeille,大地农园,Verdissimo,Vermont,Amorosa,Lumiere,Florever,Primavera,Rosenana,国产品牌','1428461353508','筹备中'),('ddc6845cda4b30454e41151c04ba3e11','佑先生的花店','郁晓丽','13564746676','24904373@qq.com','上海','上海市','松江区','永生花成品','自有网店','否','花市,淘宝','3000','Roseamor,Vermeille,大地农园,国产品牌','1428485299517','筹备中'),('7f4702bfe1e91dd40d56b43a8f9f34e3','爱尚花艺','苏先生','13380883207','318312622@qq.com','广东省','中山市','null','永生花成品,鲜花花艺,鲜花材,其他','自有实体店','否','花市','6000','Roseamor,大地农园','1428744212974','1年以上'),('ac426504b4b2bc8579a76b56e0972333','Avina 藝術生活','張心蓓','886-978-989-763','chonaomi@hotmail.com','台湾省','台北市','信义区','永生花材,其他','自有实体店','否','花市','3000---5000人民幣','Vermeille,大地农园,Verdissimo,Amorosa,Florever,Primavera','1428939340522','筹备中'),('c6c7b82cb88158beba181330ab4b8a0e','八分钟的温暖','夏清璃','15280761710','35015325@qq.com','福建省','龙岩市','永定县','永生花成品,永生花材','自有网店','否','品牌代理商','筹备中','Roseamor,大地农园,Amorosa','1428979116564','筹备中'),('794f0904c2afbe8a80ce20eddd7fb92f','芙洛花礼','刘一佳 ','13917813776','545307453@qq.com','浙江省','舟山市','普陀区','永生花成品','自有网店','否','淘宝,品牌代理商','10000','Roseamor,大地农园','1429084678898','筹备中'),('546d0a5c4b0f68ab4e695db45a5cb834','魔幻季节花店','黄小姐','13631159131','443153007@qq.com','广东省','中山市','null','永生花材','其他','否','淘宝','5000','Roseamor','1429099980193','筹备中');/* MySQLReback Separation */
 /* 创建表结构 `my_tjdate`  */
 DROP TABLE IF EXISTS `my_tjdate`;/* MySQLReback Separation */ CREATE TABLE `my_tjdate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_date` int(11) DEFAULT NULL,
  `create_num` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_tjdate` */
 INSERT INTO `my_tjdate` VALUES ('25','20150422','90');/* MySQLReback Separation */
 /* 创建表结构 `my_tjurl`  */
 DROP TABLE IF EXISTS `my_tjurl`;/* MySQLReback Separation */ CREATE TABLE `my_tjurl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_url` varchar(255) DEFAULT NULL,
  `create_num` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_tjurl` */
 INSERT INTO `my_tjurl` VALUES ('172','/qili/index.php/vip/insert','1'),('173','/pre-order','2'),('170','/qili/vip-membership','3'),('171','/qili/common/checkVerify?fieldId=verify&fieldValue=gkub&verify=gkub&_=1429690379110','1'),('168','/qili/index.php/order/insert','18'),('169','/qili/pre-order.html','17'),('166','/qili/pre-order','29'),('167','/qili/common/checkVerify','19');/* MySQLReback Separation */
 /* 创建表结构 `my_user`  */
 DROP TABLE IF EXISTS `my_user`;/* MySQLReback Separation */ CREATE TABLE `my_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `error_count` mediumint(8) DEFAULT '0',
  `error_login_time` int(11) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `role_id` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_user` */
 INSERT INTO `my_user` VALUES ('1','admin','超级管理员','a876cdfcdb4ebfb3f3da4b49587a30a9','1429689999','127.0.0.1','439','0','1429671934',null,null,'1382963329','1384269896','1','0');/* MySQLReback Separation */
 /* 创建表结构 `my_vip`  */
 DROP TABLE IF EXISTS `my_vip`;/* MySQLReback Separation */ CREATE TABLE `my_vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(5) NOT NULL,
  `shopname` varchar(80) NOT NULL,
  `contactperson` varchar(30) NOT NULL,
  `tel` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `qq` varchar(15) NOT NULL,
  `address` varchar(30) NOT NULL,
  `businessage` varchar(5) NOT NULL,
  `monthlyquota` varchar(30) NOT NULL,
  `transaction-img` varchar(80) NOT NULL,
  `shopimg` varchar(80) NOT NULL,
  `operation_people` varchar(30) NOT NULL,
  `audit_results` varchar(50) NOT NULL,
  `remarks` text NOT NULL,
  `ip` varchar(30) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;/* MySQLReback Separation */
 /* 插入数据 `my_vip` */
 INSERT INTO `my_vip` VALUES ('11','1','绮丽永生花','杨涛','15102157626',null,'330130180','上海闵行区','1年以上','1万','2015/4/19/55335ec85f5e1.jpg','2015/4/19/55335ec894c5f.jpg','徐','通过','<p>优质会员</p>','127.0.0.1','1429429961','1429682202');/* MySQLReback Separation */