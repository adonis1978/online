-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2008 年 06 月 09 日 11:40
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `online`
--

-- --------------------------------------------------------

--
-- 表的结构 `big_test`
--

CREATE TABLE IF NOT EXISTS `big_test` (
  `id` int(10) NOT NULL auto_increment,
  `bigtitle` tinyint(2) NOT NULL COMMENT '大题',
  `sscore` int(3) NOT NULL COMMENT '每小题分数',
  `test_subject_id` int(10) NOT NULL COMMENT '所属科目',
  `test_num` int(3) NOT NULL COMMENT '题数',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=23 ;

--
-- 导出表中的数据 `big_test`
--

INSERT INTO `big_test` (`id`, `bigtitle`, `sscore`, `test_subject_id`, `test_num`) VALUES
(17, 4, 3, 10, 10),
(16, 2, 4, 10, 10),
(8, 3, 2, 10, 12),
(9, 5, 12, 10, 0),
(22, 1, 2, 10, 10);

-- --------------------------------------------------------

--
-- 表的结构 `brief_answer`
--

CREATE TABLE IF NOT EXISTS `brief_answer` (
  `id` int(10) NOT NULL auto_increment,
  `brief_topic` text NOT NULL COMMENT '简答问题',
  `brief_ans` text NOT NULL COMMENT '简答答案',
  `subject_id` int(10) NOT NULL COMMENT '所属科目',
  `testkey` varchar(300) NOT NULL COMMENT '关键字',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=105 ;

--
-- 导出表中的数据 `brief_answer`
--


-- --------------------------------------------------------

--
-- 表的结构 `chengji`
--

CREATE TABLE IF NOT EXISTS `chengji` (
  `id` int(10) NOT NULL auto_increment,
  `students` int(10) NOT NULL COMMENT '所属学生',
  `subject` int(10) NOT NULL COMMENT '所属科目',
  `score` int(3) NOT NULL COMMENT '分数',
  `huankao` tinyint(1) NOT NULL default '0' COMMENT '缓考标记',
  `quekao` tinyint(1) NOT NULL default '0' COMMENT '缺考标记',
  `kscore` int(4) NOT NULL COMMENT '客观题分数',
  `zscore` int(4) NOT NULL COMMENT '主观题分数',
  `testdate` date NOT NULL COMMENT '考试时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=12 ;

--
-- 导出表中的数据 `chengji`
--


-- --------------------------------------------------------

--
-- 表的结构 `small_result`
--

CREATE TABLE IF NOT EXISTS `small_result` (
  `id` int(10) NOT NULL auto_increment,
  `smalltitle_c` varchar(150) NOT NULL COMMENT '选项内容',
  `smalltitle_id` int(10) NOT NULL COMMENT '所属小题',
  `xx` varchar(15) NOT NULL COMMENT '选项',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=26 ;

--
-- 导出表中的数据 `small_result`
--


-- --------------------------------------------------------

--
-- 表的结构 `small_test`
--

CREATE TABLE IF NOT EXISTS `small_test` (
  `id` int(10) NOT NULL auto_increment,
  `smalltitle` varchar(300) NOT NULL COMMENT '小题内容',
  `bigtitle_id` tinyint(2) NOT NULL COMMENT '所属大题',
  `bt_answer` varchar(300) NOT NULL COMMENT '本题答案',
  `subject_id` int(10) NOT NULL COMMENT '所属科目',
  `tpans` text NOT NULL COMMENT '填空或判断的答案',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=104 ;

--
-- 导出表中的数据 `small_test`
--


-- --------------------------------------------------------

--
-- 表的结构 `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) NOT NULL auto_increment,
  `stunum` varchar(25) NOT NULL COMMENT '学号',
  `realyname` varchar(20) NOT NULL COMMENT '姓名',
  `passw` varchar(100) NOT NULL COMMENT '密码',
  `stuclass` varchar(50) NOT NULL COMMENT '所属班级',
  `proression` varchar(50) NOT NULL COMMENT '所属专业',
  `kgtestid` varchar(200) NOT NULL COMMENT '客观试题id',
  `zgtestid` varchar(150) NOT NULL COMMENT '主观试题id',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=8 ;

--
-- 导出表中的数据 `students`
--

INSERT INTO `students` (`id`, `stunum`, `realyname`, `passw`, `stuclass`, `proression`, `kgtestid`, `zgtestid`) VALUES
(3, '0540123', '大宇', 'e35cf7b66449df565f93c607d5a81d09', '05401', '计算机应用', '17,100,18,101,19,102,103,20,21,22', '101,102'),
(4, '0540126', 'ffffff', 'e35cf7b66449df565f93c607d5a81d09', '05402', '计算机应用', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `test_subject`
--

CREATE TABLE IF NOT EXISTS `test_subject` (
  `id` int(10) NOT NULL auto_increment,
  `test_sub` varchar(50) NOT NULL COMMENT '考试科目',
  `test_time` int(3) NOT NULL COMMENT '考试时间',
  `addtime` date NOT NULL COMMENT '添加时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=100000 ;

--
-- 导出表中的数据 `test_subject`
--

INSERT INTO `test_subject` (`id`, `test_sub`, `test_time`, `addtime`) VALUES
(10, '操作系统', 60, '2008-04-10');

-- --------------------------------------------------------

--
-- 表的结构 `to_admin`
--

CREATE TABLE IF NOT EXISTS `to_admin` (
  `id` int(4) NOT NULL auto_increment,
  `test_admin` varchar(20) NOT NULL COMMENT '管理员',
  `password` varchar(100) NOT NULL COMMENT '管理员密码',
  `test_notice` text NOT NULL COMMENT '公告',
  `locked` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=4 ;

--
-- 导出表中的数据 `to_admin`
--

INSERT INTO `to_admin` (`id`, `test_admin`, `password`, `test_notice`, `locked`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '注意：\r\n考试中答题后注意提交\r\n提交后（如有简答题也要提交）再点击“交卷退出系统”\r\n否则无成绩！系统不自动收卷，距考试结束五分钟时系统会有提示', 0);
