-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- ����: localhost
-- ��������: 2008 �� 06 �� 09 �� 11:40
-- �������汾: 5.0.51
-- PHP �汾: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- ���ݿ�: `online`
--

-- --------------------------------------------------------

--
-- ��Ľṹ `big_test`
--
create database online;
use online;
CREATE TABLE IF NOT EXISTS `big_test` (
  `id` int(10) NOT NULL auto_increment,
  `bigtitle` tinyint(2) NOT NULL COMMENT '����',
  `sscore` int(3) NOT NULL COMMENT 'ÿС�����',
  `test_subject_id` int(10) NOT NULL COMMENT '������Ŀ',
  `test_num` int(3) NOT NULL COMMENT '����',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=23 ;

--
-- �������е����� `big_test`
--

INSERT INTO `big_test` (`id`, `bigtitle`, `sscore`, `test_subject_id`, `test_num`) VALUES
(17, 4, 3, 10, 10),
(16, 2, 4, 10, 10),
(8, 3, 2, 10, 12),
(9, 5, 12, 10, 0),
(22, 1, 2, 10, 10);

-- --------------------------------------------------------

--
-- ��Ľṹ `brief_answer`
--

CREATE TABLE IF NOT EXISTS `brief_answer` (
  `id` int(10) NOT NULL auto_increment,
  `brief_topic` text NOT NULL COMMENT '�������',
  `brief_ans` text NOT NULL COMMENT '����',
  `subject_id` int(10) NOT NULL COMMENT '������Ŀ',
  `testkey` varchar(300) NOT NULL COMMENT '�ؼ���',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=105 ;

--
-- �������е����� `brief_answer`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `chengji`
--

CREATE TABLE IF NOT EXISTS `chengji` (
  `id` int(10) NOT NULL auto_increment,
  `students` int(10) NOT NULL COMMENT '����ѧ��',
  `subject` int(10) NOT NULL COMMENT '������Ŀ',
  `score` int(3) NOT NULL COMMENT '����',
  `huankao` tinyint(1) NOT NULL default '0' COMMENT '�������',
  `quekao` tinyint(1) NOT NULL default '0' COMMENT 'ȱ�����',
  `kscore` int(4) NOT NULL COMMENT '�͹������',
  `zscore` int(4) NOT NULL COMMENT '���������',
  `testdate` date NOT NULL COMMENT '����ʱ��',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=12 ;

--
-- �������е����� `chengji`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `small_result`
--

CREATE TABLE IF NOT EXISTS `small_result` (
  `id` int(10) NOT NULL auto_increment,
  `smalltitle_c` varchar(150) NOT NULL COMMENT 'ѡ������',
  `smalltitle_id` int(10) NOT NULL COMMENT '����С��',
  `xx` varchar(15) NOT NULL COMMENT 'ѡ��',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=26 ;

--
-- �������е����� `small_result`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `small_test`
--

CREATE TABLE IF NOT EXISTS `small_test` (
  `id` int(10) NOT NULL auto_increment,
  `smalltitle` varchar(300) NOT NULL COMMENT 'С������',
  `bigtitle_id` tinyint(2) NOT NULL COMMENT '��������',
  `bt_answer` varchar(300) NOT NULL COMMENT '�����',
  `subject_id` int(10) NOT NULL COMMENT '������Ŀ',
  `tpans` text NOT NULL COMMENT '��ջ��жϵĴ�',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=104 ;

--
-- �������е����� `small_test`
--


-- --------------------------------------------------------

--
-- ��Ľṹ `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(10) NOT NULL auto_increment,
  `stunum` varchar(25) NOT NULL COMMENT 'ѧ��',
  `realyname` varchar(20) NOT NULL COMMENT '����',
  `passw` varchar(100) NOT NULL COMMENT '����',
  `stuclass` varchar(50) NOT NULL COMMENT '�����༶',
  `proression` varchar(50) NOT NULL COMMENT '����רҵ',
  `kgtestid` varchar(200) NOT NULL COMMENT '�͹�����id',
  `zgtestid` varchar(150) NOT NULL COMMENT '��������id',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=8 ;

--
-- �������е����� `students`
--

INSERT INTO `students` (`id`, `stunum`, `realyname`, `passw`, `stuclass`, `proression`, `kgtestid`, `zgtestid`) VALUES
(3, '0540123', '����', 'e35cf7b66449df565f93c607d5a81d09', '05401', '�����Ӧ��', '17,100,18,101,19,102,103,20,21,22', '101,102'),
(4, '0540126', 'ffffff', 'e35cf7b66449df565f93c607d5a81d09', '05402', '�����Ӧ��', '', '');

-- --------------------------------------------------------

--
-- ��Ľṹ `test_subject`
--

CREATE TABLE IF NOT EXISTS `test_subject` (
  `id` int(10) NOT NULL auto_increment,
  `test_sub` varchar(50) NOT NULL COMMENT '���Կ�Ŀ',
  `test_time` int(3) NOT NULL COMMENT '����ʱ��',
  `addtime` date NOT NULL COMMENT '���ʱ��',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=100000 ;

--
-- �������е����� `test_subject`
--

INSERT INTO `test_subject` (`id`, `test_sub`, `test_time`, `addtime`) VALUES
(10, '����ϵͳ', 60, '2008-04-10');

-- --------------------------------------------------------

--
-- ��Ľṹ `to_admin`
--

CREATE TABLE IF NOT EXISTS `to_admin` (
  `id` int(4) NOT NULL auto_increment,
  `test_admin` varchar(20) NOT NULL COMMENT '����Ա',
  `password` varchar(100) NOT NULL COMMENT '����Ա����',
  `test_notice` text NOT NULL COMMENT '����',
  `locked` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gb2312 AUTO_INCREMENT=4 ;

--
-- �������е����� `to_admin`
--

INSERT INTO `to_admin` (`id`, `test_admin`, `password`, `test_notice`, `locked`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'ע�⣺\r\n�����д����ע���ύ\r\n�ύ�����м����ҲҪ�ύ���ٵ���������˳�ϵͳ��\r\n�����޳ɼ���ϵͳ���Զ��վ��࿼�Խ��������ʱϵͳ������ʾ', 0);
