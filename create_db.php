<?php
include("konfiguration.php");
mysql_connect($mysql_server,$mysql_nutzer,$mysql_passwort);
mysql_query("DROP DATABASE `thesocial`");
mysql_query("CREATE DATABASE `thesocial`");
mysql_select_db("thesocial");
mysql_query("CREATE TABLE `nutzer` (`id` int(255) NOT NULL AUTO_INCREMENT, `name` varchar(40) NOT NULL, `passwort` char(128) NOT NULL, `email` varchar(255) NOT NULL, `regdatum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `letzterlogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00', PRIMARY KEY (`id`))");
mysql_query("CREATE TABLE `profil` (`id` int(255) NOT NULL,`nachname` varchar(30) NOT NULL,`vorname` varchar(30) NOT NULL,`geschlecht` int(1) NOT NULL,`beziehung` varchar(30) NOT NULL,`geburtsdatum` date NOT NULL,PRIMARY KEY (`id`))");
mysql_query("CREATE TABLE `nachrichten` (`id` int(255) NOT NULL AUTO_INCREMENT,`an` int(255) NOT NULL,`von` int(255) NOT NULL,`betreff` varchar(50) NOT NULL,`nachricht` text NOT NULL,`datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,`gelesen` int(1) NOT NULL,PRIMARY KEY (`id`))");
mysql_query("CREATE TABLE `like` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`userid` bigint(20) unsigned NOT NULL,`postid` bigint(20) unsigned NOT NULL,PRIMARY KEY (`id`))");
mysql_query("CREATE TABLE `dislike` (`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,`userid` bigint(20) unsigned NOT NULL,`postid` bigint(20) unsigned NOT NULL,PRIMARY KEY (`id`))");
mysql_query("CREATE TABLE `chat` (`id` int(11) NOT NULL AUTO_INCREMENT,`von` int(11) NOT NULL,`nachricht` varchar(255) NOT NULL,`datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`))");
mysql_query("CREATE TABLE `blog` (`id` int(255) NOT NULL AUTO_INCREMENT,`von` int(255) NOT NULL,`nachricht` text NOT NULL,`datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,PRIMARY KEY (`id`))");
?>