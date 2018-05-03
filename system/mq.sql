/*
Navicat MySQL Data Transfer

Source Server         : localhost_wamp
Source Server Version : 50520
Source Host           : localhost:3306
Source Database       : mq

Target Server Type    : MYSQL
Target Server Version : 50520
File Encoding         : 65001

Date: 2016-01-20 22:04:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for mq_auth
-- ----------------------------
DROP TABLE IF EXISTS `mq_auth`;
CREATE TABLE `mq_auth` (
  `auth_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`auth_id`),
  UNIQUE KEY `mq_auth1` (`role_id`,`menu_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=481 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mq_auth
-- ----------------------------
INSERT INTO `mq_auth` VALUES ('345', '1', '25');
INSERT INTO `mq_auth` VALUES ('344', '1', '2');
INSERT INTO `mq_auth` VALUES ('343', '1', '54');
INSERT INTO `mq_auth` VALUES ('342', '1', '17');
INSERT INTO `mq_auth` VALUES ('341', '1', '16');
INSERT INTO `mq_auth` VALUES ('340', '1', '15');
INSERT INTO `mq_auth` VALUES ('339', '1', '21');
INSERT INTO `mq_auth` VALUES ('338', '1', '3');
INSERT INTO `mq_auth` VALUES ('337', '1', '12');
INSERT INTO `mq_auth` VALUES ('336', '1', '51');
INSERT INTO `mq_auth` VALUES ('335', '1', '52');
INSERT INTO `mq_auth` VALUES ('334', '1', '50');
INSERT INTO `mq_auth` VALUES ('333', '1', '49');
INSERT INTO `mq_auth` VALUES ('351', '2', '13');
INSERT INTO `mq_auth` VALUES ('352', '2', '14');
INSERT INTO `mq_auth` VALUES ('332', '1', '11');
INSERT INTO `mq_auth` VALUES ('331', '1', '53');
INSERT INTO `mq_auth` VALUES ('350', '2', '1');
INSERT INTO `mq_auth` VALUES ('473', '3', '58');
INSERT INTO `mq_auth` VALUES ('477', '3', '26');
INSERT INTO `mq_auth` VALUES ('476', '3', '25');
INSERT INTO `mq_auth` VALUES ('472', '3', '7');
INSERT INTO `mq_auth` VALUES ('460', '3', '24');
INSERT INTO `mq_auth` VALUES ('478', '3', '27');
INSERT INTO `mq_auth` VALUES ('464', '3', '37');
INSERT INTO `mq_auth` VALUES ('463', '3', '36');
INSERT INTO `mq_auth` VALUES ('462', '3', '32');
INSERT INTO `mq_auth` VALUES ('479', '3', '60');
INSERT INTO `mq_auth` VALUES ('457', '3', '55');
INSERT INTO `mq_auth` VALUES ('456', '3', '14');
INSERT INTO `mq_auth` VALUES ('455', '3', '13');
INSERT INTO `mq_auth` VALUES ('469', '3', '5');
INSERT INTO `mq_auth` VALUES ('467', '3', '62');
INSERT INTO `mq_auth` VALUES ('330', '1', '48');
INSERT INTO `mq_auth` VALUES ('329', '1', '47');
INSERT INTO `mq_auth` VALUES ('328', '1', '10');
INSERT INTO `mq_auth` VALUES ('327', '1', '57');
INSERT INTO `mq_auth` VALUES ('326', '1', '46');
INSERT INTO `mq_auth` VALUES ('325', '1', '45');
INSERT INTO `mq_auth` VALUES ('324', '1', '9');
INSERT INTO `mq_auth` VALUES ('323', '1', '44');
INSERT INTO `mq_auth` VALUES ('322', '1', '43');
INSERT INTO `mq_auth` VALUES ('321', '1', '42');
INSERT INTO `mq_auth` VALUES ('320', '1', '41');
INSERT INTO `mq_auth` VALUES ('319', '1', '56');
INSERT INTO `mq_auth` VALUES ('318', '1', '40');
INSERT INTO `mq_auth` VALUES ('317', '1', '39');
INSERT INTO `mq_auth` VALUES ('316', '1', '8');
INSERT INTO `mq_auth` VALUES ('315', '1', '58');
INSERT INTO `mq_auth` VALUES ('314', '1', '35');
INSERT INTO `mq_auth` VALUES ('313', '1', '34');
INSERT INTO `mq_auth` VALUES ('312', '1', '33');
INSERT INTO `mq_auth` VALUES ('311', '1', '7');
INSERT INTO `mq_auth` VALUES ('310', '1', '28');
INSERT INTO `mq_auth` VALUES ('309', '1', '31');
INSERT INTO `mq_auth` VALUES ('308', '1', '30');
INSERT INTO `mq_auth` VALUES ('307', '1', '29');
INSERT INTO `mq_auth` VALUES ('306', '1', '6');
INSERT INTO `mq_auth` VALUES ('305', '1', '5');
INSERT INTO `mq_auth` VALUES ('304', '1', '63');
INSERT INTO `mq_auth` VALUES ('303', '1', '62');
INSERT INTO `mq_auth` VALUES ('302', '1', '61');
INSERT INTO `mq_auth` VALUES ('301', '1', '38');
INSERT INTO `mq_auth` VALUES ('300', '1', '37');
INSERT INTO `mq_auth` VALUES ('299', '1', '36');
INSERT INTO `mq_auth` VALUES ('298', '1', '32');
INSERT INTO `mq_auth` VALUES ('297', '1', '4');
INSERT INTO `mq_auth` VALUES ('296', '1', '24');
INSERT INTO `mq_auth` VALUES ('295', '1', '23');
INSERT INTO `mq_auth` VALUES ('294', '1', '22');
INSERT INTO `mq_auth` VALUES ('293', '1', '55');
INSERT INTO `mq_auth` VALUES ('292', '1', '14');
INSERT INTO `mq_auth` VALUES ('291', '1', '13');
INSERT INTO `mq_auth` VALUES ('290', '1', '1');
INSERT INTO `mq_auth` VALUES ('346', '1', '26');
INSERT INTO `mq_auth` VALUES ('347', '1', '27');
INSERT INTO `mq_auth` VALUES ('348', '1', '60');
INSERT INTO `mq_auth` VALUES ('349', '1', '65');
INSERT INTO `mq_auth` VALUES ('353', '2', '55');
INSERT INTO `mq_auth` VALUES ('354', '2', '22');
INSERT INTO `mq_auth` VALUES ('355', '2', '23');
INSERT INTO `mq_auth` VALUES ('356', '2', '24');
INSERT INTO `mq_auth` VALUES ('357', '2', '4');
INSERT INTO `mq_auth` VALUES ('358', '2', '32');
INSERT INTO `mq_auth` VALUES ('359', '2', '36');
INSERT INTO `mq_auth` VALUES ('360', '2', '37');
INSERT INTO `mq_auth` VALUES ('361', '2', '38');
INSERT INTO `mq_auth` VALUES ('362', '2', '61');
INSERT INTO `mq_auth` VALUES ('363', '2', '62');
INSERT INTO `mq_auth` VALUES ('364', '2', '63');
INSERT INTO `mq_auth` VALUES ('365', '2', '5');
INSERT INTO `mq_auth` VALUES ('366', '2', '6');
INSERT INTO `mq_auth` VALUES ('367', '2', '29');
INSERT INTO `mq_auth` VALUES ('368', '2', '30');
INSERT INTO `mq_auth` VALUES ('369', '2', '31');
INSERT INTO `mq_auth` VALUES ('370', '2', '28');
INSERT INTO `mq_auth` VALUES ('371', '2', '7');
INSERT INTO `mq_auth` VALUES ('372', '2', '33');
INSERT INTO `mq_auth` VALUES ('373', '2', '34');
INSERT INTO `mq_auth` VALUES ('374', '2', '35');
INSERT INTO `mq_auth` VALUES ('375', '2', '58');
INSERT INTO `mq_auth` VALUES ('376', '2', '8');
INSERT INTO `mq_auth` VALUES ('377', '2', '39');
INSERT INTO `mq_auth` VALUES ('378', '2', '40');
INSERT INTO `mq_auth` VALUES ('379', '2', '56');
INSERT INTO `mq_auth` VALUES ('380', '2', '41');
INSERT INTO `mq_auth` VALUES ('381', '2', '42');
INSERT INTO `mq_auth` VALUES ('382', '2', '43');
INSERT INTO `mq_auth` VALUES ('383', '2', '44');
INSERT INTO `mq_auth` VALUES ('384', '2', '9');
INSERT INTO `mq_auth` VALUES ('385', '2', '45');
INSERT INTO `mq_auth` VALUES ('386', '2', '46');
INSERT INTO `mq_auth` VALUES ('387', '2', '57');
INSERT INTO `mq_auth` VALUES ('388', '2', '10');
INSERT INTO `mq_auth` VALUES ('389', '2', '47');
INSERT INTO `mq_auth` VALUES ('390', '2', '48');
INSERT INTO `mq_auth` VALUES ('391', '2', '53');
INSERT INTO `mq_auth` VALUES ('392', '2', '11');
INSERT INTO `mq_auth` VALUES ('393', '2', '49');
INSERT INTO `mq_auth` VALUES ('394', '2', '50');
INSERT INTO `mq_auth` VALUES ('395', '2', '52');
INSERT INTO `mq_auth` VALUES ('396', '2', '51');
INSERT INTO `mq_auth` VALUES ('397', '2', '2');
INSERT INTO `mq_auth` VALUES ('398', '2', '25');
INSERT INTO `mq_auth` VALUES ('399', '2', '26');
INSERT INTO `mq_auth` VALUES ('400', '2', '27');
INSERT INTO `mq_auth` VALUES ('401', '2', '60');
INSERT INTO `mq_auth` VALUES ('402', '2', '65');
INSERT INTO `mq_auth` VALUES ('474', '3', '10');
INSERT INTO `mq_auth` VALUES ('459', '3', '23');
INSERT INTO `mq_auth` VALUES ('461', '3', '4');
INSERT INTO `mq_auth` VALUES ('475', '3', '2');
INSERT INTO `mq_auth` VALUES ('470', '3', '6');
INSERT INTO `mq_auth` VALUES ('465', '3', '38');
INSERT INTO `mq_auth` VALUES ('468', '3', '63');
INSERT INTO `mq_auth` VALUES ('471', '3', '28');
INSERT INTO `mq_auth` VALUES ('480', '3', '65');
INSERT INTO `mq_auth` VALUES ('466', '3', '61');
INSERT INTO `mq_auth` VALUES ('458', '3', '22');
INSERT INTO `mq_auth` VALUES ('454', '3', '1');

-- ----------------------------
-- Table structure for mq_department
-- ----------------------------
DROP TABLE IF EXISTS `mq_department`;
CREATE TABLE `mq_department` (
  `department_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL COMMENT '用户登录名',
  `desc` varchar(1000) DEFAULT NULL COMMENT '部门介绍',
  PRIMARY KEY (`department_id`),
  KEY `mq_department1` (`department_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='登录用户';

-- ----------------------------
-- Records of mq_department
-- ----------------------------
INSERT INTO `mq_department` VALUES ('1', '农办', '农办 农办农办 农办农办 农办农办 农办农办');
INSERT INTO `mq_department` VALUES ('2', '党政办', '党政办党政办党政办党政办党政办党政办党政办党政办党政办');
INSERT INTO `mq_department` VALUES ('3', '村建办', '村建办村建办村建办村建办村建办村建办村建办');
INSERT INTO `mq_department` VALUES ('4', '综治办', '综治办 部门\n');
INSERT INTO `mq_department` VALUES ('5', '民政办', '民政办');
INSERT INTO `mq_department` VALUES ('6', '司法办', '司法办');
INSERT INTO `mq_department` VALUES ('7', '计生办', '计生办');

-- ----------------------------
-- Table structure for mq_dict
-- ----------------------------
DROP TABLE IF EXISTS `mq_dict`;
CREATE TABLE `mq_dict` (
  `dict_type` varchar(25) NOT NULL COMMENT '字典分类',
  `dict_code` varchar(20) NOT NULL COMMENT 'code值',
  `dict_value` varchar(50) DEFAULT NULL COMMENT '显示值',
  `remark` varchar(100) DEFAULT NULL COMMENT '备注',
  `seq` int(11) DEFAULT NULL COMMENT '顺序，越大越后面',
  PRIMARY KEY (`dict_type`,`dict_code`),
  UNIQUE KEY `dict_idx1` (`dict_type`,`dict_code`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='系统字段表';

-- ----------------------------
-- Records of mq_dict
-- ----------------------------
INSERT INTO `mq_dict` VALUES ('blood_type', 'A', 'A型', null, '1');
INSERT INTO `mq_dict` VALUES ('blood_type', 'AB', 'AB型', null, '15');
INSERT INTO `mq_dict` VALUES ('blood_type', 'ABRH', 'AB型rh阴性', null, '30');
INSERT INTO `mq_dict` VALUES ('blood_type', 'ARH', 'A型rh阴性', null, '20');
INSERT INTO `mq_dict` VALUES ('blood_type', 'B', 'B型', null, '5');
INSERT INTO `mq_dict` VALUES ('blood_type', 'BRH', 'B型rh阴性', null, '25');
INSERT INTO `mq_dict` VALUES ('blood_type', 'O', 'O型', null, '10');
INSERT INTO `mq_dict` VALUES ('blood_type', 'ORH', 'O型rh阴性', null, '35');
INSERT INTO `mq_dict` VALUES ('blood_type', 'OTHER', '其它', null, '99');
INSERT INTO `mq_dict` VALUES ('economy_code', '10', '正常', null, '1');
INSERT INTO `mq_dict` VALUES ('economy_code', '20', '困难户(包括低保户和低保边缘户)', null, '5');
INSERT INTO `mq_dict` VALUES ('economy_code', '30', '突发事件，经济损失在2万元以上', null, '10');
INSERT INTO `mq_dict` VALUES ('economy_code', '99', '其他', null, '99');
INSERT INTO `mq_dict` VALUES ('education_degree', '187', '博士', null, '1');
INSERT INTO `mq_dict` VALUES ('education_degree', '188', '研究生', null, '5');
INSERT INTO `mq_dict` VALUES ('education_degree', '189', '大学本科', null, '10');
INSERT INTO `mq_dict` VALUES ('education_degree', '190', '大专', null, '15');
INSERT INTO `mq_dict` VALUES ('education_degree', '191', '高中/中专', null, '20');
INSERT INTO `mq_dict` VALUES ('education_degree', '192', '初中', null, '25');
INSERT INTO `mq_dict` VALUES ('education_degree', '193', '小学', null, '30');
INSERT INTO `mq_dict` VALUES ('education_degree', '194', '文盲', null, '35');
INSERT INTO `mq_dict` VALUES ('exception_type', 'economy_code', '经济指标', null, '20');
INSERT INTO `mq_dict` VALUES ('exception_type', 'harmony_code', '和谐指标', null, '10');
INSERT INTO `mq_dict` VALUES ('exception_type', 'health_code', '健康指标', null, '30');
INSERT INTO `mq_dict` VALUES ('handle_status', '10', '登记完成', null, '10');
INSERT INTO `mq_dict` VALUES ('handle_status', '20', '等待处理', null, '20');
INSERT INTO `mq_dict` VALUES ('handle_status', '30', '处理完成', null, '30');
INSERT INTO `mq_dict` VALUES ('handle_status', '40', '挂起', null, '40');
INSERT INTO `mq_dict` VALUES ('handle_status', '50', '终结', null, '50');
INSERT INTO `mq_dict` VALUES ('handle_type', '10', '送传阅', null, '10');
INSERT INTO `mq_dict` VALUES ('handle_type', '20', '送承办', null, '20');
INSERT INTO `mq_dict` VALUES ('handle_type', '40', '挂起', '', '40');
INSERT INTO `mq_dict` VALUES ('handle_type', '90', '结束', null, '50');
INSERT INTO `mq_dict` VALUES ('harmony_code', '10', '正常', null, '1');
INSERT INTO `mq_dict` VALUES ('harmony_code', '20', '家庭内部矛盾', null, '5');
INSERT INTO `mq_dict` VALUES ('harmony_code', '30', '外部纠纷', null, '10');
INSERT INTO `mq_dict` VALUES ('harmony_code', '40', '子女问题', null, '15');
INSERT INTO `mq_dict` VALUES ('harmony_code', '99', '其他', null, '99');
INSERT INTO `mq_dict` VALUES ('health_code', '10', '正常', null, '1');
INSERT INTO `mq_dict` VALUES ('health_code', '20', '患有重大疾病', null, '10');
INSERT INTO `mq_dict` VALUES ('health_code', '30', '患有慢性病', null, '15');
INSERT INTO `mq_dict` VALUES ('health_code', '99', '其他', null, '99');
INSERT INTO `mq_dict` VALUES ('health_condition', '111', '健康', null, '111');
INSERT INTO `mq_dict` VALUES ('health_condition', '112', '体质较弱', null, '112');
INSERT INTO `mq_dict` VALUES ('health_condition', '113', '高血压', null, '113');
INSERT INTO `mq_dict` VALUES ('health_condition', '114', '视力残', null, '114');
INSERT INTO `mq_dict` VALUES ('health_condition', '115', '听力残', null, '115');
INSERT INTO `mq_dict` VALUES ('health_condition', '116', '精神残', null, '116');
INSERT INTO `mq_dict` VALUES ('health_condition', '117', '智力残', null, '117');
INSERT INTO `mq_dict` VALUES ('health_condition', '118', '上肢残', null, '118');
INSERT INTO `mq_dict` VALUES ('health_condition', '119', '语言残', null, '119');
INSERT INTO `mq_dict` VALUES ('health_condition', '120', '下肢残', null, '120');
INSERT INTO `mq_dict` VALUES ('health_condition', '121', '肠胃病', null, '121');
INSERT INTO `mq_dict` VALUES ('health_condition', '122', '糖尿病', null, '122');
INSERT INTO `mq_dict` VALUES ('health_condition', '123', '脑卒中', null, '123');
INSERT INTO `mq_dict` VALUES ('health_condition', '124', '冠心病', null, '124');
INSERT INTO `mq_dict` VALUES ('health_condition', '125', '肿瘤', null, '125');
INSERT INTO `mq_dict` VALUES ('health_condition', '126', '侏儒', null, '126');
INSERT INTO `mq_dict` VALUES ('health_condition', '127', '其他重大疾病', null, '127');
INSERT INTO `mq_dict` VALUES ('health_condition', '128', '已故', null, '128');
INSERT INTO `mq_dict` VALUES ('health_condition', '129', '其他', null, '129');
INSERT INTO `mq_dict` VALUES ('identity_property', '10', '中国共产党党员', null, '10');
INSERT INTO `mq_dict` VALUES ('identity_property', '15', '九三学社社员', null, '15');
INSERT INTO `mq_dict` VALUES ('identity_property', '20', '台湾民主自治同盟盟员', null, '20');
INSERT INTO `mq_dict` VALUES ('identity_property', '25', '无党派民主人士', null, '25');
INSERT INTO `mq_dict` VALUES ('identity_property', '30', '群众', null, '30');
INSERT INTO `mq_dict` VALUES ('identity_property', '35', '中国共产党预备党员', null, '35');
INSERT INTO `mq_dict` VALUES ('identity_property', '40', '中国国民党革命委员会会员', null, '40');
INSERT INTO `mq_dict` VALUES ('identity_property', '45', '中国共产主义青年团团员', null, '45');
INSERT INTO `mq_dict` VALUES ('identity_property', '50', '中国民主同盟盟员', null, '50');
INSERT INTO `mq_dict` VALUES ('identity_property', '55', '中国民主建国会会员', null, '55');
INSERT INTO `mq_dict` VALUES ('identity_property', '60', '中国民主促进会会员', null, '60');
INSERT INTO `mq_dict` VALUES ('identity_property', '65', '中国农工民主党党员', null, '65');
INSERT INTO `mq_dict` VALUES ('identity_property', '70', '中国致公党党员', null, '70');
INSERT INTO `mq_dict` VALUES ('identity_property', '80', '入党积极分子', null, '80');
INSERT INTO `mq_dict` VALUES ('identity_property', '999', '其他', null, '999');
INSERT INTO `mq_dict` VALUES ('industry', '10', '工业', null, '10');
INSERT INTO `mq_dict` VALUES ('industry', '15', '农林牧渔', null, '15');
INSERT INTO `mq_dict` VALUES ('industry', '20', '服务业', null, '20');
INSERT INTO `mq_dict` VALUES ('industry', '25', '娱乐业', null, '25');
INSERT INTO `mq_dict` VALUES ('industry', '30', '制造业', null, '30');
INSERT INTO `mq_dict` VALUES ('industry', '35', '交通运输', null, '35');
INSERT INTO `mq_dict` VALUES ('industry', '40', '信息传输', null, '40');
INSERT INTO `mq_dict` VALUES ('industry', '45', '建筑业', null, '45');
INSERT INTO `mq_dict` VALUES ('industry', '50', '餐饮业', null, '50');
INSERT INTO `mq_dict` VALUES ('industry', '55', '教育', null, '55');
INSERT INTO `mq_dict` VALUES ('industry', '60', '国际组织', null, '60');
INSERT INTO `mq_dict` VALUES ('industry', '65', '采矿业', null, '65');
INSERT INTO `mq_dict` VALUES ('industry', '70', '金融业', null, '70');
INSERT INTO `mq_dict` VALUES ('industry', '75', '房地产业', null, '75');
INSERT INTO `mq_dict` VALUES ('industry', '80', '文化、体育和娱乐业', null, '80');
INSERT INTO `mq_dict` VALUES ('industry', '85', '水利、环境和公共设施管理', null, '85');
INSERT INTO `mq_dict` VALUES ('industry', '90', '公共管理和社会组织', null, '90');
INSERT INTO `mq_dict` VALUES ('industry', '95', '危险品业', null, '95');
INSERT INTO `mq_dict` VALUES ('industry', '999', '其他', null, '999');
INSERT INTO `mq_dict` VALUES ('marital_status', '10', '未婚', null, '10');
INSERT INTO `mq_dict` VALUES ('marital_status', '20', '已婚', null, '20');
INSERT INTO `mq_dict` VALUES ('marital_status', '30', '离婚', null, '30');
INSERT INTO `mq_dict` VALUES ('marital_status', '40', '丧偶', null, '40');
INSERT INTO `mq_dict` VALUES ('marital_status', '50', '其它', null, '50');
INSERT INTO `mq_dict` VALUES ('relation_ship', '1', '户主', null, '1');
INSERT INTO `mq_dict` VALUES ('relation_ship', '10', '孙子(女)', null, '10');
INSERT INTO `mq_dict` VALUES ('relation_ship', '15', '外孙(女)', null, '15');
INSERT INTO `mq_dict` VALUES ('relation_ship', '2', '配偶', null, '2');
INSERT INTO `mq_dict` VALUES ('relation_ship', '20', '儿媳', null, '20');
INSERT INTO `mq_dict` VALUES ('relation_ship', '25', '女婿', null, '25');
INSERT INTO `mq_dict` VALUES ('relation_ship', '3', '子女', null, '3');
INSERT INTO `mq_dict` VALUES ('relation_ship', '30', '曾孙', null, '30');
INSERT INTO `mq_dict` VALUES ('relation_ship', '35', '曾外孙', null, '35');
INSERT INTO `mq_dict` VALUES ('relation_ship', '40', '曾祖父母', null, '40');
INSERT INTO `mq_dict` VALUES ('relation_ship', '45', '外曾祖父母', null, '45');
INSERT INTO `mq_dict` VALUES ('relation_ship', '5', '父母', null, '5');
INSERT INTO `mq_dict` VALUES ('relation_ship', '7', '配偶父母', null, '7');
INSERT INTO `mq_dict` VALUES ('relation_ship', '8', '祖父母', null, '8');
INSERT INTO `mq_dict` VALUES ('relation_ship', '9', '外祖父母', null, '9');
INSERT INTO `mq_dict` VALUES ('relation_ship', '999', '不明', null, '999');
INSERT INTO `mq_dict` VALUES ('sex', '10', '男', null, '10');
INSERT INTO `mq_dict` VALUES ('sex', '20', '女', null, '20');
INSERT INTO `mq_dict` VALUES ('sex', '99', '不明', null, '99');
INSERT INTO `mq_dict` VALUES ('user_type', '1', '管理员', null, '1');
INSERT INTO `mq_dict` VALUES ('user_type', '2', '科室管理员', null, '5');
INSERT INTO `mq_dict` VALUES ('user_type', '3', '科员', null, '10');
INSERT INTO `mq_dict` VALUES ('yes_or_no', '10', '是', null, '10');
INSERT INTO `mq_dict` VALUES ('yes_or_no', '20', '否', null, '20');

-- ----------------------------
-- Table structure for mq_exception_task
-- ----------------------------
DROP TABLE IF EXISTS `mq_exception_task`;
CREATE TABLE `mq_exception_task` (
  `task_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `villager_id` int(11) NOT NULL COMMENT '村民',
  `exception_type` varchar(255) DEFAULT NULL COMMENT '异常类型',
  `exception_code` int(11) DEFAULT NULL COMMENT '异常值',
  `exception_code_text` varchar(2000) DEFAULT NULL COMMENT '异常描述',
  `exception_img` varchar(300) DEFAULT NULL COMMENT '异常图片',
  `handle_type` int(11) DEFAULT NULL COMMENT '处理方式：10 查阅 20 承办',
  `record_user_id` int(11) DEFAULT NULL COMMENT '异常记录人',
  `record_time` datetime DEFAULT NULL COMMENT '登记异常时间',
  `assign_user_id` int(11) DEFAULT NULL COMMENT '分配人',
  `assign_time` datetime DEFAULT NULL,
  `handle_user_id` int(11) DEFAULT NULL COMMENT '待处理人',
  `handle_time` datetime DEFAULT NULL COMMENT '处理时间',
  `finish_user_id` int(11) DEFAULT NULL COMMENT '结束人',
  `finish_time` datetime DEFAULT NULL COMMENT '结束时间',
  `handle_status` int(11) DEFAULT NULL COMMENT '处理状态',
  `receive_user_id` int(11) DEFAULT NULL COMMENT '分配人',
  `handle_result` varchar(3000) DEFAULT NULL COMMENT '处理结果',
  `result_img` varchar(300) DEFAULT NULL COMMENT '结果图片',
  `assign_remark` varchar(2000) DEFAULT NULL COMMENT '分配的内容',
  `exception_condition` varchar(2000) DEFAULT NULL,
  `exception_addr` varchar(250) DEFAULT NULL,
  `exception_process` varchar(2000) DEFAULT NULL,
  `exception_result` varchar(2000) DEFAULT NULL,
  `exception_time` date DEFAULT NULL,
  `update_user_id` int(11) DEFAULT NULL COMMENT '最后处理人',
  `update_time` datetime DEFAULT NULL COMMENT '最后处理时间',
  PRIMARY KEY (`task_id`),
  KEY `mq_exception_task1` (`villager_id`) USING BTREE,
  KEY `mq_exception_task2` (`record_user_id`),
  KEY `mq_exception_task3` (`handle_user_id`),
  KEY `mq_exception_task4` (`record_time`),
  KEY `mq_exception_task5` (`assign_user_id`),
  KEY `mq_exception_task6` (`receive_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='异常民情';

-- ----------------------------
-- Records of mq_exception_task
-- ----------------------------
INSERT INTO `mq_exception_task` VALUES ('94', '1535', 'economy_code', '20', null, null, '20', '7', '2016-01-10 05:55:11', '7', '2016-01-10 15:41:48', null, null, null, null, '20', '1', null, null, '承办意见：承办意见：', null, null, null, null, '2016-01-10', '7', '2016-01-10 15:41:48');
INSERT INTO `mq_exception_task` VALUES ('95', '1537', 'economy_code', '20', null, null, null, '7', '2016-01-10 05:55:11', null, null, null, null, null, null, '10', null, null, null, null, null, null, null, null, '2016-01-10', '7', '2016-01-10 05:55:11');
INSERT INTO `mq_exception_task` VALUES ('96', '1543', 'economy_code', '20', null, null, null, '7', '2016-01-10 05:55:12', null, null, null, null, null, null, '10', null, null, null, null, null, null, null, null, '2016-01-10', '7', '2016-01-10 05:55:12');
INSERT INTO `mq_exception_task` VALUES ('97', '1545', 'economy_code', '20', null, null, null, '7', '2016-01-10 05:55:12', null, null, null, null, null, null, '10', null, null, null, null, null, null, null, null, '2016-01-10', '7', '2016-01-10 05:55:12');

-- ----------------------------
-- Table structure for mq_handle_record
-- ----------------------------
DROP TABLE IF EXISTS `mq_handle_record`;
CREATE TABLE `mq_handle_record` (
  `record_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL COMMENT '任务Id',
  `operation_time` datetime DEFAULT NULL COMMENT '处理时间',
  `record_user_id` int(11) DEFAULT NULL COMMENT '操作人员',
  `operation_name` varchar(200) DEFAULT NULL COMMENT '处理结果',
  `operation_remark` varchar(2000) DEFAULT NULL COMMENT '结果图片',
  `receive_user_id` int(11) DEFAULT NULL COMMENT '接收人',
  PRIMARY KEY (`record_id`),
  KEY `mq_handle_record1` (`record_user_id`) USING BTREE,
  KEY `mq_handle_record2` (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COMMENT='处理纪录';

-- ----------------------------
-- Records of mq_handle_record
-- ----------------------------
INSERT INTO `mq_handle_record` VALUES ('117', '94', '2016-01-10 05:55:11', '7', '登记异常', 's', null);
INSERT INTO `mq_handle_record` VALUES ('118', '95', '2016-01-10 05:55:11', '7', '登记异常', 's', null);
INSERT INTO `mq_handle_record` VALUES ('119', '96', '2016-01-10 05:55:12', '7', '登记异常', 's', null);
INSERT INTO `mq_handle_record` VALUES ('120', '97', '2016-01-10 05:55:12', '7', '登记异常', 's', null);
INSERT INTO `mq_handle_record` VALUES ('121', '94', '2016-01-10 15:41:49', '7', '安排处理异常', '承办意见：承办意见：', '1');

-- ----------------------------
-- Table structure for mq_menu
-- ----------------------------
DROP TABLE IF EXISTS `mq_menu`;
CREATE TABLE `mq_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `doc_id` varchar(100) DEFAULT NULL COMMENT 'html元素Id',
  `parent_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `create_user_id` varchar(255) DEFAULT NULL,
  `is_button` int(11) DEFAULT NULL COMMENT '10:菜单，20:按钮',
  `seq` int(11) DEFAULT NULL COMMENT '排序',
  PRIMARY KEY (`menu_id`),
  KEY `mq_menu1` (`page_url`),
  KEY `mq_menu2` (`parent_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COMMENT='菜单';

-- ----------------------------
-- Records of mq_menu
-- ----------------------------
INSERT INTO `mq_menu` VALUES ('1', '民情信息', 'villager/index', null, '0', '2015-12-14 00:59:18', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('2', '等待处理', 'villager/handle_task', null, '0', '2015-12-17 01:20:42', '1', '20', '20');
INSERT INTO `mq_menu` VALUES ('3', '设置权限', 'menu/set_role_auth', 'set_role_auth', '12', '2015-12-17 01:20:42', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('4', '系统网盘', 'share/index', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('5', '资料共享', 'share/shares', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('6', '通知公告', 'notice/index', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('7', '系统通知', 'notice/system_notice', null, '0', '0000-00-00 00:00:00', '20', '20', '10');
INSERT INTO `mq_menu` VALUES ('8', '用户管理', 'user/index', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('9', '部门管理', 'department/index', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('10', '村庄管理', 'village/index', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('11', '辖区管理', 'popedom/index', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('12', '角色管理', 'menu/role', null, '0', '2015-12-17 01:20:42', '1', '20', '10');
INSERT INTO `mq_menu` VALUES ('13', '新增村民', 'villager/add', 'villager_add', '1', '2015-12-17 01:20:42', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('14', '编辑村民', 'villager/edit', 'villager_edit', '1', '2015-12-17 01:20:42', '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('21', '菜单管理', 'menu/index', null, '0', '2015-12-15 18:25:58', '7', '20', '10');
INSERT INTO `mq_menu` VALUES ('22', '登记异常', 'villager/record_exception', 'record_exception', '1', '2015-12-16 17:52:27', '1', '10', '40');
INSERT INTO `mq_menu` VALUES ('23', 'Excel导入', 'villager/import', 'import', '1', '2015-12-17 01:20:42', '1', '10', '50');
INSERT INTO `mq_menu` VALUES ('24', '导出Excel', 'villager/export', 'export', '1', '2015-12-16 17:59:15', '1', '10', '60');
INSERT INTO `mq_menu` VALUES ('25', '分配处理', 'villager/assign_exception', 'assign_exception', '2', '2015-12-16 18:01:41', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('26', '处理异常', 'villager/sub_handle_task', 'sub_handle_task', '2', '2015-12-16 18:01:53', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('27', '查看处理纪录', 'villager/view_exception', 'view_exception', '2', '2015-12-16 18:02:07', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('28', '查看', 'notice/view', 'notice_view', '6', '2015-12-16 18:03:49', '1', '10', '40');
INSERT INTO `mq_menu` VALUES ('29', '新增', 'notice/add', 'notice_add', '6', '2015-12-16 18:04:03', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('30', '修改', 'notice/edit', 'notice_edit', '6', '2015-12-16 18:04:15', '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('31', '删除', 'notice/delete', 'notice_delete', '6', '2015-12-16 18:04:26', '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('32', '新增文件夹', 'share/mkdir', 'dir_add', '4', '2015-12-16 18:03:49', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('33', '新增', 'notice/sys_add', 'notice_add', '7', '2015-12-16 18:04:03', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('34', '修改', 'notice/sys_edit', 'notice_edit', '7', '2015-12-16 18:04:15', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('35', '删除', 'notice/sys_delete', 'notice_delete', '7', '2015-12-16 18:04:26', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('36', '上传文件', 'share/upload', 'share_add', '4', '2015-12-17 01:09:42', '10', '10', '10');
INSERT INTO `mq_menu` VALUES ('37', '重命名', 'share/edit', 'share_edit', '4', '2015-12-16 18:08:30', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('38', '删除', 'share/delete', 'share_delete', '4', '2015-12-16 18:08:45', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('39', '新增', 'user/add', 'user_add', '8', '2015-12-17 01:20:42', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('40', '编辑', 'user/edit', 'edit_user', '8', '2015-12-17 01:20:42', '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('41', '锁定', 'user/lock', 'lock_user', '8', '2015-12-17 01:20:42', '1', '10', '40');
INSERT INTO `mq_menu` VALUES ('42', '解锁', 'user/unlock', 'unlock_user', '8', '2015-12-17 01:20:42', '1', '10', '50');
INSERT INTO `mq_menu` VALUES ('43', '重置密码', 'user/reset_password', 'reset_password', '8', '2015-12-17 01:20:42', '1', '10', '60');
INSERT INTO `mq_menu` VALUES ('44', '导入Excel', 'user/do_excel', 'do_excel', '8', '2015-12-17 01:20:42', '1', '10', '70');
INSERT INTO `mq_menu` VALUES ('45', '新增', 'department/add', 'department_add', '9', '2015-12-17 01:20:42', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('46', '修改', 'department/edit', 'department_edit', '9', '2015-12-17 01:20:42', '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('47', '新增', 'village/add', 'village_add', '10', '2015-12-17 01:20:42', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('48', '修改', 'village/edit', 'village_edit', '10', '2015-12-17 01:20:42', '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('49', '新增', 'popedom/add', 'popedom_add', '11', '2015-12-16 18:25:07', '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('50', '修改', 'popedom/edit', 'popedom_edit', '11', '2015-12-16 18:25:27', '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('51', '添加村庄', 'popedom/add_village', 'set_villages', '11', '2015-12-16 18:26:45', '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('52', '删除', 'popedom/delete', 'popedom_delete', '11', '2015-12-16 18:36:05', '1', '10', '25');
INSERT INTO `mq_menu` VALUES ('53', '删除', 'village/delete', 'village_delete', '10', '2015-12-17 01:20:42', '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('54', '查看按钮', 'menu/show_buttons', 'show_button', '21', '2015-12-16 18:46:35', '1', '10', '40');
INSERT INTO `mq_menu` VALUES ('55', '删除', 'villager/delete', 'villager_delete', '1', null, '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('56', '删除', 'user/delete', 'user_delete', '8', null, '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('57', '删除', 'department/delete', 'department_delete', '9', null, '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('15', '添加菜单', 'menu/add_menu', 'menu_add', '21', null, '1', '10', '10');
INSERT INTO `mq_menu` VALUES ('16', '编辑菜单', 'menu/edit_menu', 'menu_edit', '21', null, '1', '10', '20');
INSERT INTO `mq_menu` VALUES ('17', '添加按钮', 'menu/button_add', 'button_add', '21', null, '1', '10', '30');
INSERT INTO `mq_menu` VALUES ('58', '查看', 'notice/view', 'notice_view', '7', null, '1', '10', '40');
INSERT INTO `mq_menu` VALUES ('60', '已处理', 'villager/finished_handle_task', null, '0', '2015-12-17 18:12:36', '7', '20', '20');
INSERT INTO `mq_menu` VALUES ('61', '共享', 'share/share_file', 'share_file', '4', null, '1', '10', '50');
INSERT INTO `mq_menu` VALUES ('62', '取消共享', 'share/cancel_share', 'cancel_share', '4', null, null, '10', '60');
INSERT INTO `mq_menu` VALUES ('63', '下载', 'share/download', 'download', '4', null, null, '10', '70');
INSERT INTO `mq_menu` VALUES ('65', '查看处理纪录', 'villager/view_exception', 'view_exception', '60', '2015-12-16 18:02:07', '1', '10', '10');

-- ----------------------------
-- Table structure for mq_notice
-- ----------------------------
DROP TABLE IF EXISTS `mq_notice`;
CREATE TABLE `mq_notice` (
  `notice_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) unsigned DEFAULT '0' COMMENT '部门',
  `notice_title` varchar(150) NOT NULL COMMENT '通知标题',
  `notice_no` varchar(50) DEFAULT NULL COMMENT '发文编号',
  `content` varchar(8000) DEFAULT NULL COMMENT '内容',
  `create_date` datetime DEFAULT NULL,
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `attachment_url` varchar(255) DEFAULT NULL COMMENT '附件地址',
  PRIMARY KEY (`notice_id`),
  KEY `mq_notice1` (`department_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COMMENT='通知';

-- ----------------------------
-- Records of mq_notice
-- ----------------------------

-- ----------------------------
-- Table structure for mq_operation_record
-- ----------------------------
DROP TABLE IF EXISTS `mq_operation_record`;
CREATE TABLE `mq_operation_record` (
  `record_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `related_id` int(11) DEFAULT NULL COMMENT '关联单号',
  `related_type` varchar(50) DEFAULT NULL COMMENT '关联类型：表名',
  `user_id` int(25) NOT NULL COMMENT '登录用户名',
  `operation_date` datetime NOT NULL,
  `operation_name` varchar(50) NOT NULL COMMENT '操作名称',
  `description` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`record_id`),
  KEY `mq_operation_record2` (`related_id`) USING BTREE,
  KEY `mq_operation_record3` (`user_id`) USING BTREE,
  KEY `mq_operation_record1` (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2215 DEFAULT CHARSET=utf8 COMMENT='修改记录表，便于查询';

-- ----------------------------
-- Records of mq_operation_record
-- ----------------------------
INSERT INTO `mq_operation_record` VALUES ('2196', '1535', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '舒金华');
INSERT INTO `mq_operation_record` VALUES ('2197', '1536', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '陈珍燕');
INSERT INTO `mq_operation_record` VALUES ('2198', '1537', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '舒再生');
INSERT INTO `mq_operation_record` VALUES ('2199', '1538', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '柳爱正');
INSERT INTO `mq_operation_record` VALUES ('2200', '1539', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '舒潮辉');
INSERT INTO `mq_operation_record` VALUES ('2201', '1540', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '鲍春兰');
INSERT INTO `mq_operation_record` VALUES ('2202', '1541', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '舒轶潞');
INSERT INTO `mq_operation_record` VALUES ('2203', '1542', 'mq_villager', '7', '2016-01-10 05:55:11', '新增村民信息', '舒轶可');
INSERT INTO `mq_operation_record` VALUES ('2204', '1543', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '陈慧玉');
INSERT INTO `mq_operation_record` VALUES ('2205', '1544', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '吕权');
INSERT INTO `mq_operation_record` VALUES ('2206', '1545', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '舒常仁');
INSERT INTO `mq_operation_record` VALUES ('2207', '1546', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '王桂芹');
INSERT INTO `mq_operation_record` VALUES ('2208', '1547', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '舒锋');
INSERT INTO `mq_operation_record` VALUES ('2209', '1548', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '陈钗钗');
INSERT INTO `mq_operation_record` VALUES ('2210', '1549', 'mq_villager', '7', '2016-01-10 05:55:12', '新增村民信息', '舒晓辉');
INSERT INTO `mq_operation_record` VALUES ('2211', '1550', 'mq_villager', '7', '2016-01-10 06:21:07', '新增村民信息', '舒天华');
INSERT INTO `mq_operation_record` VALUES ('2212', '1551', 'mq_villager', '7', '2016-01-10 06:21:07', '新增村民信息', '舒小明');
INSERT INTO `mq_operation_record` VALUES ('2213', '7', 'mq_user', '7', '2016-01-11 15:08:53', '登录', '127.0.0.1');
INSERT INTO `mq_operation_record` VALUES ('2214', '7', 'mq_user', '7', '2016-01-11 15:46:53', '登录', '127.0.0.1');

-- ----------------------------
-- Table structure for mq_party_step
-- ----------------------------
DROP TABLE IF EXISTS `mq_party_step`;
CREATE TABLE `mq_party_step` (
  `step_id` int(11) NOT NULL AUTO_INCREMENT,
  `villager_id` int(11) NOT NULL,
  `step_index` int(11) NOT NULL COMMENT '进度',
  `record_user_id` int(11) DEFAULT NULL COMMENT '记录人',
  `record_time` datetime DEFAULT NULL COMMENT '记录人',
  PRIMARY KEY (`step_id`),
  UNIQUE KEY `party_step_1` (`villager_id`,`step_index`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='入党进度';

-- ----------------------------
-- Records of mq_party_step
-- ----------------------------

-- ----------------------------
-- Table structure for mq_popedom
-- ----------------------------
DROP TABLE IF EXISTS `mq_popedom`;
CREATE TABLE `mq_popedom` (
  `popedom_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `popedom_name` varchar(50) DEFAULT NULL COMMENT '辖区',
  `remark` varchar(250) DEFAULT NULL,
  `village_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`popedom_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='辖区';

-- ----------------------------
-- Records of mq_popedom
-- ----------------------------
INSERT INTO `mq_popedom` VALUES ('15', '辖区8', '6', '0');
INSERT INTO `mq_popedom` VALUES ('2', '辖区2', null, '1');
INSERT INTO `mq_popedom` VALUES ('7', '辖区3', '备注备注备注备注备注备注备注备注备注备注', null);
INSERT INTO `mq_popedom` VALUES ('9', '辖区4', '黑熊村', '1');
INSERT INTO `mq_popedom` VALUES ('10', '辖区5', null, '1');
INSERT INTO `mq_popedom` VALUES ('11', '辖区6', null, '3');
INSERT INTO `mq_popedom` VALUES ('12', '辖区7', null, '3');
INSERT INTO `mq_popedom` VALUES ('13', '辖区一', '', null);
INSERT INTO `mq_popedom` VALUES ('14', '辖区X', '', '1');

-- ----------------------------
-- Table structure for mq_role
-- ----------------------------
DROP TABLE IF EXISTS `mq_role`;
CREATE TABLE `mq_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mq_role
-- ----------------------------
INSERT INTO `mq_role` VALUES ('1', '超级管理员', null);
INSERT INTO `mq_role` VALUES ('2', '科室管理员', null);
INSERT INTO `mq_role` VALUES ('3', '村干部', null);

-- ----------------------------
-- Table structure for mq_session_record
-- ----------------------------
DROP TABLE IF EXISTS `mq_session_record`;
CREATE TABLE `mq_session_record` (
  `record_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT '用户登录名',
  `login_ip` varchar(50) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL COMMENT '用户实际名称',
  `device_name` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '是否有效：0/失效，1/有效',
  PRIMARY KEY (`record_id`),
  KEY `session_user_id` (`user_id`) USING BTREE,
  KEY `session_2` (`session_id`,`user_id`,`login_ip`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='登录用户';

-- ----------------------------
-- Records of mq_session_record
-- ----------------------------
INSERT INTO `mq_session_record` VALUES ('1', '1a934a114326685e11c38ed9f08eef78', '7', '127.0.0.1', '2016-01-11 15:08:53', null, '1');
INSERT INTO `mq_session_record` VALUES ('2', '67235ced6fc3314ae32d7d4929753ce1', '7', '127.0.0.1', '2016-01-11 15:46:53', null, '1');

-- ----------------------------
-- Table structure for mq_share
-- ----------------------------
DROP TABLE IF EXISTS `mq_share`;
CREATE TABLE `mq_share` (
  `share_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `share_name` varchar(100) NOT NULL COMMENT '共享名称',
  `file_path` varchar(300) DEFAULT NULL COMMENT '村庄地址',
  `file_name` varchar(100) DEFAULT NULL,
  `related_path` varchar(500) DEFAULT NULL COMMENT '相对路径',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  `related_user_id` int(11) DEFAULT NULL,
  `is_shared` int(11) unsigned DEFAULT '0',
  `share_date` datetime DEFAULT NULL,
  `file_size` double(11,0) DEFAULT NULL,
  `file_ext` varchar(20) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL COMMENT '父目录Id',
  `file_type` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `is_directory` tinyint(4) DEFAULT '0' COMMENT '是否目录',
  PRIMARY KEY (`share_id`),
  KEY `mq_share1` (`related_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='共享';

-- ----------------------------
-- Records of mq_share
-- ----------------------------
INSERT INTO `mq_share` VALUES ('1', '李村', 'G:/logs/Noname22.txt', 'Noname22.txt', null, '2015-09-05 22:34:00', null, '1', '1', '2015-12-19 06:10:09', null, null, '0', null, '0');
INSERT INTO `mq_share` VALUES ('2', '村庄的名称', 'G:/logs/Noname22.txt', 'Noname22.txt', null, '2015-09-05 22:34:00', null, '1', '1', '2015-09-13 21:21:14', null, null, '0', null, '0');
INSERT INTO `mq_share` VALUES ('7', '4', 'G:/logs/Noname22.txt', 'Noname22.txt', null, '2015-09-05 22:34:00', null, '1', '1', '2015-09-13 21:21:19', null, null, '0', null, '0');
INSERT INTO `mq_share` VALUES ('8', '5', 'G:/logs/Noname22.txt', 'Noname22.txt', null, '2015-09-05 22:34:00', null, '1', '1', '2015-09-13 21:21:35', null, null, '0', null, '0');
INSERT INTO `mq_share` VALUES ('9', '456', 'G:/logs/Noname22.txt', 'Noname22.txt', null, '2015-09-05 22:34:00', null, '1', '1', '2015-09-13 21:21:45', null, null, '0', null, '0');
INSERT INTO `mq_share` VALUES ('10', 'aaa', 'G:/logs/Noname22.txt', 'Noname22.txt', null, '2015-09-05 22:34:00', '2015-09-05 22:34:00', '1', '1', '2015-09-13 21:21:39', '0', null, '0', null, '0');
INSERT INTO `mq_share` VALUES ('11', '京东员工6000万股受限股近期解封入市 价值8亿美元', 'G:/upload/commons-dbcp-1.5-20140212_.203717-12-bin_.zip', 'commons-dbcp-1.5-20140212_.203717-12-bin_.zip', null, '2015-09-05 22:52:59', '2015-09-06 00:02:05', '1', '1', null, '1974', '.zip', '0', 'application/zip', '0');
INSERT INTO `mq_share` VALUES ('12', '京东员工6000', 'G:/upload/ci-cms-0.2_.0_.0_.zip', 'ci-cms-0.2_.0_.0_.zip', null, '2015-09-06 00:59:46', '2015-09-06 00:59:46', '1', '1', '2015-09-13 21:22:11', '1493', '.zip', '0', 'application/zip', '0');
INSERT INTO `mq_share` VALUES ('13', 'aaay1', 'G:/upload/notShipPackage.txt', 'notShipPackage.txt', null, '2015-09-06 01:00:00', '2015-09-06 01:00:00', '1', '0', null, '251', '.txt', '0', 'text/plain', '0');
INSERT INTO `mq_share` VALUES ('14', '1', 'G:/upload/from.gif', 'from.gif', null, '2015-09-06 01:00:35', '2015-09-06 01:00:35', '1', '1', '2015-09-13 21:21:28', '5', '.gif', '0', 'image/gif', '0');
INSERT INTO `mq_share` VALUES ('15', '2', 'G:/upload/from1.gif', 'from1.gif', null, '2015-09-06 01:00:43', '2015-09-06 01:00:43', '1', '0', null, '5', '.gif', '0', 'image/gif', '0');
INSERT INTO `mq_share` VALUES ('16', '3', 'G:/upload/from2.gif', 'from2.gif', null, '2015-09-06 01:00:55', '2015-09-06 01:00:55', '1', '1', '2015-09-06 01:11:41', '5', '.gif', '0', 'image/gif', '0');
INSERT INTO `mq_share` VALUES ('17', '4', 'G:/upload/from3.gif', 'from3.gif', null, '2015-09-06 01:01:07', '2015-09-06 01:01:07', '1', '0', null, '5', '.gif', '0', 'image/gif', '0');
INSERT INTO `mq_share` VALUES ('18', 'pppoo', 'G:/phpspace/mingqing/images/upload/532263dbebc4a8af7d87a69f46dae920.xls', '532263dbebc4a8af7d87a69f46dae920.xls', 'images/upload/532263dbebc4a8af7d87a69f46dae920.xls', '2015-11-01 15:39:10', '2015-11-01 15:39:10', '7', '0', null, '247', '.xls', '0', 'application/vnd.ms-excel', '0');
INSERT INTO `mq_share` VALUES ('19', '拖箱照片1', 'G:/phpspace/mingqing/images/upload/27f9d2c964239103ddbe5eefb8c3e47c.jpg', '27f9d2c964239103ddbe5eefb8c3e47c.jpg', 'images/upload/27f9d2c964239103ddbe5eefb8c3e47c.jpg', '2015-11-17 00:04:16', '2015-11-17 00:04:16', '7', '0', null, '52', '.jpg', '0', 'image/jpeg', '0');
INSERT INTO `mq_share` VALUES ('20', '文件夹', null, null, null, '2015-11-17 01:10:11', '2015-11-17 02:18:33', '7', '0', null, '0', null, '0', null, '1');
INSERT INTO `mq_share` VALUES ('21', '京东资料1', null, null, null, '2015-11-17 02:10:37', '2015-11-17 02:18:08', '7', '0', null, null, null, '20', null, '1');
INSERT INTO `mq_share` VALUES ('22', '11', 'G:/phpspace/mingqing/images/upload/7420dfa6d27c67ddd5a42ad6254140b2.txt', '7420dfa6d27c67ddd5a42ad6254140b2.txt', 'images/upload/7420dfa6d27c67ddd5a42ad6254140b2.txt', '2015-11-17 02:23:54', '2015-11-17 02:23:54', '7', '1', '2015-12-20 11:51:09', '0', '.txt', '0', 'text/plain', '0');
INSERT INTO `mq_share` VALUES ('23', 'aaa', 'G:/phpspace/mingqing/images/upload/fb48e4c2bb8b41d9158cb5042b249ae7.txt', 'fb48e4c2bb8b41d9158cb5042b249ae7.txt', 'images/upload/fb48e4c2bb8b41d9158cb5042b249ae7.txt', '2015-11-17 02:25:42', '2015-11-17 02:25:42', '7', '0', null, '0', '.txt', '21', 'text/plain', '0');
INSERT INTO `mq_share` VALUES ('24', 'aa333', null, null, null, '2015-11-17 02:26:11', '2015-11-17 02:26:11', '7', '0', null, null, null, '23', null, '1');
INSERT INTO `mq_share` VALUES ('25', '京东资料2', null, null, null, '2015-11-18 01:29:00', '2015-11-18 01:29:00', '7', '0', null, null, null, '20', null, '1');
INSERT INTO `mq_share` VALUES ('26', '京东资料3', null, null, null, '2015-11-18 01:29:19', '2015-11-18 01:29:19', '7', '0', null, null, null, '20', null, '1');
INSERT INTO `mq_share` VALUES ('27', '京东资料2-child1-', 'G:/phpspace/mingqing/images/upload/d86ee917cd377f380088b59f054326c9.xls', 'd86ee917cd377f380088b59f054326c9.xls', 'images/upload/d86ee917cd377f380088b59f054326c9.xls', '2015-11-18 01:29:57', '2015-11-18 01:30:21', '7', '0', null, '248', '.xls', '25', 'application/vnd.ms-excel', '0');
INSERT INTO `mq_share` VALUES ('28', '文件夹_child', 'G:/phpspace/mingqing/images/upload/759aad97e01dee6119cddc7ffa057c71.png', '759aad97e01dee6119cddc7ffa057c71.png', 'images/upload/759aad97e01dee6119cddc7ffa057c71.png', '2015-11-18 01:32:20', '2015-11-18 01:32:20', '7', '0', null, '13', '.png', '20', 'image/png', '0');
INSERT INTO `mq_share` VALUES ('29', '三顿饭', null, null, null, '2015-12-19 08:03:49', '2015-12-19 08:03:49', '7', '0', null, null, null, '0', null, '1');
INSERT INTO `mq_share` VALUES ('31', '字典表', 'G:/phpspace/mingqing/images/upload/3ebc23ae281835111a7dfde179f0fdcd.csv', '3ebc23ae281835111a7dfde179f0fdcd.csv', 'images/upload/3ebc23ae281835111a7dfde179f0fdcd.csv', '2015-12-20 11:52:41', '2015-12-20 11:52:41', '7', '0', null, '8', '.csv', '29', 'application/vnd.ms-excel', '0');
INSERT INTO `mq_share` VALUES ('32', '格式', 'G:/phpspace/mingqing/images/upload/853cbfc4b8f812d952c5f3c0daf9829c.xls', '853cbfc4b8f812d952c5f3c0daf9829c.xls', 'images/upload/853cbfc4b8f812d952c5f3c0daf9829c.xls', '2015-12-20 11:54:04', '2015-12-20 11:54:04', '7', '0', null, '254', '.xls', '29', 'application/vnd.ms-excel', '0');
INSERT INTO `mq_share` VALUES ('33', '新的文档', 'G:/phpspace/mingqing/images/upload/7b483173da3e05e779d62d7900c8f5cb.docx', '7b483173da3e05e779d62d7900c8f5cb.docx', 'images/upload/7b483173da3e05e779d62d7900c8f5cb.docx', '2015-12-20 11:54:32', '2015-12-20 11:54:32', '7', '0', null, '0', '.docx', '29', 'application/vnd.openxmlformats-officedoc', '0');
INSERT INTO `mq_share` VALUES ('34', '新的文档', 'G:/phpspace/mingqing/images/upload/37dafae485a19f961471db50908f5fe9.docx', '37dafae485a19f961471db50908f5fe9.docx', 'images/upload/37dafae485a19f961471db50908f5fe9.docx', '2015-12-20 12:02:09', '2015-12-20 12:02:09', '3', '0', null, '0', '.docx', '0', 'application/vnd.openxmlformats-officedoc', '0');
INSERT INTO `mq_share` VALUES ('35', '文件夹1220', null, null, null, '2015-12-20 12:02:32', '2015-12-20 12:02:32', '3', '0', null, null, null, '0', null, '1');

-- ----------------------------
-- Table structure for mq_user
-- ----------------------------
DROP TABLE IF EXISTS `mq_user`;
CREATE TABLE `mq_user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(25) NOT NULL COMMENT '用户登录名',
  `password` varchar(50) NOT NULL COMMENT '登录密码',
  `full_name` varchar(10) DEFAULT NULL COMMENT '用户实际名称',
  `create_date` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '是否有效：0/失效，1/有效',
  `type` tinyint(3) unsigned DEFAULT '0' COMMENT '用户权限，1:管理员, 2:科室管理员,3:科员',
  `village_id` int(11) unsigned NOT NULL,
  `department_id` int(11) NOT NULL COMMENT '所属部门',
  `login_ip` varchar(50) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `mobile` varchar(40) DEFAULT NULL,
  `home_phone` varchar(40) DEFAULT NULL,
  `work_phone` varchar(40) DEFAULT NULL,
  `super_admin` int(11) DEFAULT NULL COMMENT '是否超级管理员:999超级管理员',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `mq_user1` (`user_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='登录用户';

-- ----------------------------
-- Records of mq_user
-- ----------------------------
INSERT INTO `mq_user` VALUES ('1', '测试账号01', '538069b8c2c05a9c3af5a79974b8247b', '村干部01', '2015-08-15 00:04:59', '10', '2', '10', '2', '127.0.0.1', '2015-12-31 00:26:14', '12345678900', '333333333344433', '222222222', null, '3');
INSERT INTO `mq_user` VALUES ('2', '测试账号02', '538069b8c2c05a9c3af5a79974b8247b', '村干部02', '2015-08-16 21:59:13', '10', '2', '10', '3', '127.0.0.1', '2015-12-31 00:27:26', '11111111123s', '1111122233344', '3234234', null, '3');
INSERT INTO `mq_user` VALUES ('3', '测试账号03', '538069b8c2c05a9c3af5a79974b8247b', '科室管理员03', '2015-09-04 01:24:46', '10', '2', '9', '2', '127.0.0.1', '2015-12-20 14:48:00', '12345678900', '', '', null, '2');
INSERT INTO `mq_user` VALUES ('4', '测试账号04', '03ab5ddf15361b53e9fc02ad1f0dbe83', '测试账号04', '2015-09-04 01:31:51', '5', '1', '1', '2', null, null, '18667187236', '', '', null, '2');
INSERT INTO `mq_user` VALUES ('5', '测试账号05', '538069b8c2c05a9c3af5a79974b8247b', '测试账号05', '2015-09-04 01:34:15', '10', '1', '10', '3', null, null, '18667187236', '', '11111111', null, '2');
INSERT INTO `mq_user` VALUES ('7', 'admin', '538069b8c2c05a9c3af5a79974b8247b', 'admin', '2015-09-04 22:09:05', '10', '1', '0', '2', '127.0.0.1', '2016-01-11 15:46:53', '18667187236', '', '', '999', '1');
INSERT INTO `mq_user` VALUES ('11', '测试账号09', '5e1d834fdde4cf7446a2145d806a4a0e', '测试账号07', '2015-12-03 15:14:03', '10', '3', '11', '3', null, null, '12345678900', '', '', null, '3');
INSERT INTO `mq_user` VALUES ('12', '123456', '03ab5ddf15361b53e9fc02ad1f0dbe83', '很快就好', '2015-12-19 07:58:59', '10', '0', '7', '2', '192.168.1.102', '2015-12-19 08:01:55', '132', '135412.', '1354123', null, '3');

-- ----------------------------
-- Table structure for mq_view_notice
-- ----------------------------
DROP TABLE IF EXISTS `mq_view_notice`;
CREATE TABLE `mq_view_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notice_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `read_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `view_notice_1` (`notice_id`,`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mq_view_notice
-- ----------------------------

-- ----------------------------
-- Table structure for mq_village
-- ----------------------------
DROP TABLE IF EXISTS `mq_village`;
CREATE TABLE `mq_village` (
  `village_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `village_name` varchar(50) DEFAULT NULL COMMENT '村庄名称',
  `address` varchar(200) DEFAULT NULL COMMENT '村庄地址',
  `popedom_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`village_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='村庄';

-- ----------------------------
-- Records of mq_village
-- ----------------------------
INSERT INTO `mq_village` VALUES ('1', '李村', '李村', '11');
INSERT INTO `mq_village` VALUES ('2', '村庄的名称', '村庄的名称', '11');
INSERT INTO `mq_village` VALUES ('7', '蜜蜂王村', '蜜蜂王村', '11');
INSERT INTO `mq_village` VALUES ('8', '第一村', '第一村的地址', '10');
INSERT INTO `mq_village` VALUES ('9', '东丁村', '东丁村', '9');
INSERT INTO `mq_village` VALUES ('10', '坑下村', '坑下村', '14');
INSERT INTO `mq_village` VALUES ('11', '东街村', '东街村', '12');
INSERT INTO `mq_village` VALUES ('12', '社古村', '社古村', '12');
INSERT INTO `mq_village` VALUES ('13', '朱凤村', '朱凤村地址', '2');

-- ----------------------------
-- Table structure for mq_villager
-- ----------------------------
DROP TABLE IF EXISTS `mq_villager`;
CREATE TABLE `mq_villager` (
  `villager_id` int(11) NOT NULL AUTO_INCREMENT,
  `villager_name` varchar(25) NOT NULL COMMENT '姓名',
  `villager_img` varchar(255) DEFAULT NULL COMMENT '头像图片',
  `identity_card` varchar(18) DEFAULT NULL COMMENT '身份证',
  `village_id` int(11) unsigned DEFAULT NULL COMMENT '村庄Id',
  `economy_code` int(11) NOT NULL COMMENT '经济指标',
  `harmony_code` int(11) NOT NULL COMMENT '和谐指标',
  `health_code` int(11) NOT NULL COMMENT '健康指标',
  `economy_value` varchar(50) NOT NULL COMMENT '经济指标',
  `harmony_value` varchar(50) NOT NULL COMMENT '和谐指标名称',
  `health_value` varchar(50) NOT NULL COMMENT '健康指标值',
  `create_date` date DEFAULT NULL COMMENT '登记时间',
  `create_user_id` int(11) DEFAULT NULL,
  `update_date` datetime DEFAULT NULL COMMENT '更新时间',
  `update_user_id` int(11) DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL COMMENT '父亲',
  `mother_id` int(11) DEFAULT NULL COMMENT '母亲',
  `spouse_id` int(11) DEFAULT NULL COMMENT '配偶Id',
  `relation_ship` varchar(20) DEFAULT NULL COMMENT '与户主关系',
  `house_holder_id` int(11) DEFAULT NULL COMMENT '户主Id',
  `birth_day` date DEFAULT NULL COMMENT '出生日期',
  `sex` int(11) DEFAULT NULL COMMENT '性别',
  `address` varchar(250) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `marital_status` varchar(10) DEFAULT NULL COMMENT '婚姻状态',
  `height` double(10,2) DEFAULT NULL COMMENT '身高',
  `education_degree` varchar(10) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `house_no` varchar(30) DEFAULT NULL COMMENT '门牌号',
  `is_work_out` int(11) DEFAULT NULL COMMENT '是否外出工作',
  `work_address` varchar(250) DEFAULT NULL COMMENT '工作地址',
  `remark` varchar(1500) DEFAULT NULL,
  `industry` varchar(10) DEFAULT NULL COMMENT '行业',
  `identity_property` varchar(10) DEFAULT NULL,
  `health_img` varchar(250) DEFAULT NULL COMMENT '健康图片',
  `harmony_img` varchar(250) DEFAULT NULL,
  `economy_img` varchar(250) DEFAULT NULL,
  `special_tech` varchar(150) DEFAULT NULL COMMENT '特长',
  `health_condition` varchar(10) DEFAULT NULL COMMENT '健康情况',
  `exception_condition` varchar(2000) DEFAULT NULL,
  `exception_addr` varchar(250) DEFAULT NULL,
  `exception_result` varchar(2000) DEFAULT NULL,
  `exception_time` date DEFAULT NULL,
  `record_user_id` int(11) DEFAULT NULL COMMENT '异常记录人',
  `record_time` datetime DEFAULT NULL COMMENT '异常记录人',
  `health_code_text` varchar(1000) DEFAULT NULL,
  `economy_code_text` varchar(1000) DEFAULT NULL,
  `harmony_code_text` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`villager_id`),
  KEY `villager_vd` (`village_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1552 DEFAULT CHARSET=utf8 COMMENT='村民表';

-- ----------------------------
-- Records of mq_villager
-- ----------------------------
INSERT INTO `mq_villager` VALUES ('1535', '舒金华', null, '330624195502162775', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, null, '1', null, '1955-02-16', '10', null, 'B', null, '190.00', '188', '13945678901', '13945678901', '1-2', '20', null, '备注15', '20', '10', null, null, null, '特长', '', null, null, null, null, '7', '2016-01-10 05:55:11', null, null, null);
INSERT INTO `mq_villager` VALUES ('1536', '陈珍燕', null, '330624195811062786', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, '1535', '2', '1535', '1958-11-06', '20', null, 'B', '20', '191.00', '', '13945678901', '13945678901', '1-2', '10', null, '备注16', '', '10', null, null, null, '特长', '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1537', '舒再生', null, '330624195301312773', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, null, '1', null, '1953-01-31', '10', null, 'B', null, '192.00', '190', '13945678901', '13945678901', '1-20', '20', null, '备注17', '', '10', null, null, null, '特长', '', null, null, null, null, '7', '2016-01-10 05:55:11', null, null, null);
INSERT INTO `mq_villager` VALUES ('1538', '柳爱正', null, '330624195708222809', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, '1537', '2', '1537', '1957-08-22', '20', null, 'B', '20', '193.00', '', '13945678901', '13945678901', '1-20', '0', null, '备注18', '20', '10', null, null, null, '特长', '115', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1539', '舒潮辉', null, '33062419800805203X', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, '1537', null, '3', '1537', '1980-08-05', '10', null, 'B', null, '194.00', '', '13945678901', '13945678901', '1-20', '0', null, '备注19', '10', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1540', '鲍春兰', null, '330624198306027588', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, null, '20', '1537', '1983-06-02', '20', null, 'B', null, '195.00', '', '13945678901', '13945678901', '1-20', '0', null, '备注20', '', '10', null, null, null, '特长', '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1541', '舒轶潞', null, '330624200407272048', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, null, '10', '1537', '2004-07-27', '20', null, 'B', null, '196.00', '', '13945678901', '13945678901', '1-20', '0', null, '备注21', '25', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1542', '舒轶可', null, '330624201109302047', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:11', '7', null, null, null, '10', '1537', '2011-09-30', '20', null, 'B', null, '197.00', '', '13945678901', '13945678901', '1-20', '0', null, '备注22', '', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1543', '陈慧玉', null, '33062419600327278X', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', null, null, null, '1', null, '1960-03-27', '20', null, 'B', null, '198.00', '', '13945678901', '13945678901', '1-21', '0', null, '备注23', '', '10', null, null, null, null, '111', null, null, null, null, '7', '2016-01-10 05:55:12', null, null, null);
INSERT INTO `mq_villager` VALUES ('1544', '吕权', null, '330624198305112035', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', '1543', null, null, '3', '1543', '1983-05-11', '10', null, 'B', null, '199.00', '', '13945678901', '13945678901', '1-21', '0', null, '备注24', '15', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1545', '舒常仁', null, '330624195010092774', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', null, null, null, '1', null, '1950-10-09', '10', null, 'B', null, '200.00', '', '13945678901', '13945678901', '1-22', '0', null, '备注25', '', '10', null, null, null, null, '', null, null, null, null, '7', '2016-01-10 05:55:12', null, null, null);
INSERT INTO `mq_villager` VALUES ('1546', '王桂芹', null, '330624195708122787', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', null, null, '1545', '2', '1545', '1957-08-12', '20', null, 'B', '20', '201.00', '', '13945678901', '13945678901', '1-22', '0', null, '备注26', '', '10', null, null, null, '特长', '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1547', '舒锋', null, '330624197902112039', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', null, '1545', null, '3', '1545', '1979-02-11', '10', null, 'B', null, '202.00', '', '13945678901', '13945678901', '1-22', '0', null, '备注27', '', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1548', '陈钗钗', null, '330624198301092049', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', null, null, null, '20', '1545', '1983-01-09', '20', null, 'B', null, '203.00', '', '13945678901', '13945678901', '1-22', '0', null, '备注28', '', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1549', '舒晓辉', null, '330624200412122036', '10', '20', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 05:55:12', '7', null, null, null, '10', '1545', '2004-12-12', '10', null, 'B', null, '204.00', '', '13945678901', '13945678901', '1-22', '0', null, '备注29', '', '10', null, null, null, null, '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1550', '舒天华', null, '330624195602132275', '10', '10', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 06:21:07', '7', null, null, null, '1', null, '1956-02-13', '10', null, 'B', null, '190.00', '188', '13945678901', '13945678901', '1-26', '20', null, '备注15', '20', '10', null, null, null, '特长', '', null, null, null, null, null, null, null, null, null);
INSERT INTO `mq_villager` VALUES ('1551', '舒小明', null, '330624198811062536', '10', '99', '10', '10', '', '', '', '2016-01-10', '7', '2016-01-10 06:21:07', '7', null, '1550', null, '3', '1550', '1988-11-06', '10', null, 'B', null, '191.00', '', '13945678901', '13945678901', '1-26', '10', null, '备注16', '95', '10', null, null, null, '特长', '', null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- View structure for v_exception_task
-- ----------------------------
DROP VIEW IF EXISTS `v_exception_task`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_exception_task` AS SELECT t.*, 
  t4.village_name, t3.user_name record_user_name,t2.full_name receive_user_name,
	t6.user_name assign_user_name, t5.user_name handle_user_name,
	f_get_dict('exception_type', t.exception_type) exception_type_value,
	f_get_dict('handle_status', t.handle_status) handle_status_value,
	f_get_dict('handle_type', t.handle_type) handle_type_value,


	t1.villager_name,
	t1.villager_img,
	t1.identity_card,
	t1.village_id,
	t1.create_date,
	t1.create_user_id,
	t1.father_id, t1.mother_id,
	t1.spouse_id, t1.birth_day, ifnull(t1.sex,99) sex,
	t1.address,
	t1.relation_ship,t1.blood_type,t1.marital_status,t1.height,t1.education_degree,
	t1.mobile,t1.phone,t1.house_no,t1.is_work_out,
	t1.work_address, t1.remark, t1.industry, t1.identity_property,
	t1.health_code_text, t1.economy_code_text, t1.harmony_code_text,
	t1.special_tech,
	t1.health_condition,t1.house_holder_id
FROM mq_exception_task t 
left join mq_villager t1 on t.villager_id=t1.villager_id 
left join mq_village t4 on t1.village_id=t4.village_id 
left join mq_user t2 on t2.user_id=t.receive_user_id 
left join mq_user t3 on t3.user_id=t.record_user_id 
left join mq_user t5 on t5.user_id=t.handle_user_id 
left join mq_user t6 on t6.user_id=t.assign_user_id ;

-- ----------------------------
-- View structure for v_handle_record
-- ----------------------------
DROP VIEW IF EXISTS `v_handle_record`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_handle_record` AS select t.*, t1.user_name record_user_name,t2.user_name receive_user_name
FROM mq_handle_record t 
left JOIN mq_user t1 on t.record_user_id = t1.user_id 
left JOIN mq_user t2 on t.receive_user_id = t2.user_id ;

-- ----------------------------
-- View structure for v_notice
-- ----------------------------
DROP VIEW IF EXISTS `v_notice`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_notice` AS select t.*, IFNULL(t1.user_name, '未知') create_user_name, IFNULL(t2.department_name, '未知') department_name
FROM mq_notice t 
left JOIN mq_user t1 on t.create_user_id = t1.user_id
left JOIN mq_department t2 on t.department_id = t2.department_id ;

-- ----------------------------
-- View structure for v_role_auth
-- ----------------------------
DROP VIEW IF EXISTS `v_role_auth`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_role_auth` AS select t.*, t1.auth_id, t2.* 
FROM mq_role t 
inner JOIN mq_auth t1 on t1.role_id = t.role_id
inner JOIN mq_menu t2 on t2.menu_id = t1.menu_id ;

-- ----------------------------
-- View structure for v_share
-- ----------------------------
DROP VIEW IF EXISTS `v_share`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_share` AS select t.*, t1.village_id, t1.department_id, IFNULL(t1.user_name, '未知') create_user_name
FROM mq_share t 
left JOIN mq_user t1 on t.related_user_id = t1.user_id ;

-- ----------------------------
-- View structure for v_user
-- ----------------------------
DROP VIEW IF EXISTS `v_user`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_user` AS select t.*, t1.village_name, t2.department_name, t3.role_name FROM mq_user t 
left JOIN mq_village t1 on t.village_id = t1.village_id
left JOIN mq_department t2 on t.department_id = t2.department_id 
left JOIN mq_role t3 on t.role_id = t3.role_id ;

-- ----------------------------
-- View structure for v_user_auth
-- ----------------------------
DROP VIEW IF EXISTS `v_user_auth`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_user_auth` AS select t.*, t1.auth_id, t1.role_id, t3.user_id, t3.user_name
FROM mq_menu t 
inner JOIN mq_auth t1 on t1.menu_id = t.menu_id
#left JOIN mq_role t2 on t2.role_id = t1.role_id 
inner join mq_user t3 on t3.role_id = t1.role_id ;

-- ----------------------------
-- View structure for v_villager
-- ----------------------------
DROP VIEW IF EXISTS `v_villager`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER  VIEW `v_villager` AS SELECT
	t.*, t1.village_name,
	TIMESTAMPDIFF(YEAR, t.birth_day, NOW()) + 1 age,
	(CASE WHEN T.identity_property = 10 THEN 10 ELSE 20 END) identity_dy,
	f_get_dict('identity_property', t.identity_property) identity_property_value,
	f_get_dict('sex', t.sex) sex_value,
	f_get_dict('relation_ship', t.relation_ship) relation_ship_value
FROM mq_villager t
left join mq_village t1 on t1.village_id = t.village_id ;

-- ----------------------------
-- Procedure structure for p_check_auth
-- ----------------------------
DROP PROCEDURE IF EXISTS `p_check_auth`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_check_auth`(IN `p_user_id` int,IN `p_page_url` varchar(100), OUT `r_auth` varchar(100))
BEGIN
	DECLARE v_menu_id INT;
	DECLARE v_department_id INT;
	DECLARE v_role_id INT;
	DECLARE v_village_id INT;
	DECLARE v_auth_id INT;
	DECLARE v_status INT;
	DECLARE v_auth_count INT;

	select IfNULL(t.department_id,0), IfNULL(t.role_id,0), IfNULL(t.village_id,0), IfNULL(t.status,0)
		into v_department_id, v_role_id, v_village_id, v_status
		from mq_user t where t.user_id = p_user_id;

	SELECT IFNULL(max(t.menu_id),0) INTO v_menu_id from mq_menu t where t.page_url=p_page_url;
	if v_menu_id is not null and v_menu_id > 0 then 
		select count(1) into v_auth_count
		from mq_auth t where t.role_id = v_role_id and t.menu_id = v_menu_id;

		if v_auth_count > 0 then 
			set `r_auth` = CONCAT(v_menu_id, ',', v_department_id, ',', v_role_id, ',', v_village_id, ',', v_status);#有设置权限，且有权限，不控制
		else 
			set `r_auth` = '0';#无权限
		end if;
	else 
		set `r_auth` = CONCAT('999999', ',', v_department_id, ',', v_role_id, ',', v_village_id, ',', v_status);#未设置权限，允许访问
	end if;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for f_get_dict
-- ----------------------------
DROP FUNCTION IF EXISTS `f_get_dict`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_dict`(`p_dict_type` varchar(50),`p_dict_code` varchar(50)) RETURNS varchar(100) CHARSET utf8
BEGIN
DECLARE v_dict_value varchar(100);
SELECT t.dict_value INTO v_dict_value from mq_dict t where t.dict_code=p_dict_code and t.dict_type=p_dict_type ;
RETURN v_dict_value;
END
;;
DELIMITER ;
