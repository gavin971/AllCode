<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>DayPics</title>
<link rel='stylesheet' type='text/css' href='__ROOT__/DayPics/css/pc.css'>
<link rel='stylesheet' type='text/css' href='__ROOT__/DayPics/css/cube.css'>
<link rel='stylesheet' type='text/css' href='__ROOT__/DayPics/css/widget/tips.css'>
<style></style>
<script type="text/javascript">
var cur_url = "__URL__";
var web_root = "__ROOT__";
</script>
<script type="text/javascript" src="__ROOT__/DayPics/js/jquery-1.3.2.js"></script>
<script type="text/javascript" src="__ROOT__/DayPics/js/cube.js"></script>
<script type="text/javascript" src="__ROOT__/DayPics/js/widget/tips.js"></script>
<script type="text/javascript">
$(function(){
	$("#cube_container").addTips({word: "拖拽鼠标，移动立方体。", position: "left", margin: "-150px 0 0 20px", stayDuration: "neverHide"});
});
</script>
</head>
<body onload="start()">
<div id="header">
	<img id="logo" alt="DayPics" src="__ROOT__/DayPics/img/drawing-logo-text.png" />
	<span id="subheading" class="second_font">Drawing is nothing but a sprite of imagenation.</span>
	<p id="current_date"></p>
	<ul id="menu">
		<li><a href="__ROOT__/DayPics">Home</a></li>
		<li><a href="__APP__/Labs">Labs</a></li>
		<li><a href="__APP__/Drawing">Drawing</a></li>
		<li><a href="__APP__/About">About Me</a></li>
	</ul>
	<div id="contact">
		<span class="title underline">I Am a Geek on User Experience</span>
		<ul>
			<li class="name"><h2 class="zkj">张可竞</h2><span class="whu">(武汉大学)</span></li>
			<li><h2>专业: </h2><span>软件工程</span></li>
			<li><h2>方向: </h2><em>用户体验 Web前端</em></li>
			<li><h2>联系方式: </h2><span>邮箱: ronaldinhokj@gmail.com</span></li>
		</ul>	
	</div>
</div>
<div id="main">
	<div id="cube_container">
		<p class="front">
			<em>基本概况</em><br/>
			<span>1. 熟练掌握JavaScript, 以及相关前端技术HTML、CSS、Ajax等<span class="experience">总经验</span><span class="year">3年</span></span><br/>
			<span>2. 熟悉后端开发技术php，java，使用过ThinkPHP, Smarty框架，SSH框架<span class="experience">总经验</span><span class="year">2.5年</span></span><br/>
			<span>3. 掌握相应视觉设计能力，在百度实习期间发布百度输入法默认皮肤，熟练掌握Photoshop<span class="experience">总经验</span><span class="year">5年</span></span><br/>
			<span>4. 对用户体验有一定的实习经验和理解，包括用户研究和交互设计<span class="experience">总经验</span><span class="year">1.5年</span></span>
		</p>
		
		<p class="back">
			<em>相关技能经验</em><br/>
			<span id="skill">
				<b class="label">JavaScript</b>
				<b class="label">HTML5</b>
				<b class="label">CSS3</b>
				<b class="label">Photoshop</b>
				<b class="label">PHP</b>
				<b class="label">Ajax</b>
				<b class="label">Java</b>
				<b class="label">前端开发</b>
				<b class="label">视觉设计</b>
				<b class="label">用户体验</b>
			</span>
		</p>
		<p class="left">
			<em>实习经历</em><br/>
			<span>1. 百度PC客户端部</span><span class="experience">时间</span><span class="year">2011.03.05-2011.06.30</span>
			<span class="description">· 担任视觉设计师，主要作品是百度输入法默认皮肤。</span>
			<span class="description">· 同时也参与到百度下载，百度压缩等软件的设计中，以及协助整理客户端软件UI库。</span>
			<span class="description">· 搭建PC客户端用户体验规范网站。</span><br/>
			<span>2. 腾讯CDC</span><span class="experience">时间</span><span class="year">2010.07.15-2010.09.30 </span>
			<span class="description">· 担任Prowork人力和项目管理系统前端开发。</span>
			<span class="description">· 兼顾Prowork网站的界面设计。</span>
			<span class="description">· 协助即时通讯部门测试网站改进交互设计。</span>
			</p>
		<p class="right">
			<em>项目经验</em><br/>
			<span>1. 常州GIS电子政务系统</span><br/><span class="experience time">时间</span><span class="year"> 2010.10.04-2011.03.14</span>
			<span class="description">· 担任工作：前端表现层使用Flex+ArcGis，布局页面和功能实现。后端使用Java进行服务实现，数据库采用Oracle。</span>
			<span>2. 基于Google Map新闻系统(本科毕业设计)</span><br/><span class="experience time">时间</span><span class="year">2010.03.04-2010.05.30</span>
			<span class="description">· 担任工作：页面设计，前端开发，前端技术主要是Ajax和GoogleMap API的调用，同时也包括HTML和CSS。</span>
			<span>3. 胜利街8号电子商务系统</span><br/><span class="experience time">时间</span><span class="year">2009.07.10-2009.09.10</span>
			<span class="description">· 担任职务：前端js脚本编写，辅助页面交互的进行，以及布局网页。</span>	
		</p>
		<p class="top"></p>
		<p class="bottom"><img id="top-logo" alt="DayPics" src="__ROOT__/DayPics/img/logo-100.png" /></p>
	</div>
</div>

<div id="bottom" class="second_font">-- By Ronaldinho 2011 --</div>

</body>
</html>