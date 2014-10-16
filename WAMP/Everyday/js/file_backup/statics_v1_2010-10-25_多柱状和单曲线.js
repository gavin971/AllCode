﻿(function(){canvas = document.getElementById("canvas");ctx=canvas.getContext("2d");/**************************************************************************数据数组******************************///event=[["足球",4,5,6], ["电影",1,3,2], ["逛街",7,2,5], ["学习",5,1,9], ["睡觉",1,8,2], ["运动",1,3,2]];event=[["一月",4,5,6], ["二月",1,3,2], ["三月",7,2,5], ["四月",5,1,9], ["五月",1,8,2], ["六月",1,3,2]];items=["足球","电影","逛街"];//event=[["足球",4,], ["电影",1], ["逛街",7]];/**************************************************************************柱状图*****************************/histogramBgColor = "#fffefa";//柱状图背景色histogramBorderColor = "#888";//柱状图边框颜色histogramBorderWidth = 1;//柱状图边框颜色histogramMarginLeft = 40;//柱状图左边距histogramMarginRight = 60;//柱状图右边距histogramMarginBottom = 100;//柱状图底边距histogramMarginTop = 80;//柱状图顶边距histogramWidth = 540;//柱状图宽度histogramHeight = 240;//柱状图高度/***************************************************************************画布******************************/canvas.style.background="#DDD";//画布背景颜色canvas.width = histogramWidth+histogramMarginLeft+histogramMarginRight;//画布宽度canvas.height = histogramHeight+histogramMarginTop+histogramMarginBottom;//画布高度histogramXaxle=canvas.height-histogramMarginBottom;//柱状图X轴位置/****************************************************************************分组*****************************/histoGroupSum = event.length;//分组总数histoGroupBorderColor = 'red';//分组边框颜色histoGroupBorderWidth = 0.1;//分组边框宽度histoSum = event[0].length-1;//组内柱总数histoGroupWidth = 50;//组宽度/****************************************************************************刻度标尺梯度****************************/maxGraduation = 40||50;//最大刻度graduationLevel = 5;//梯度graduationColor = '#BBB';//等高线颜色graduationWidth = 0.2;//等高线粗细unit = histogramHeight/maxGraduation;//单位高度/*****************************************************************************柱****************************/histoWidth=10;//柱宽度histoHeight=0;//柱高度histoColor=['#ff4848', '#fff04a', '#49ffdf', '#4c48ff']//柱颜色/*****************************************************************************曲线图***************************/diagramColor="blue";//曲线图曲线颜色diagramWidth=3;//曲线图曲线宽度diagramNodeColor="blue";//曲线节点颜色/*****************************************************************************坐标定位***************************/groupSpace = histogramWidth/histoGroupSum;histoSpace = histoGroupWidth/histoSum;groupX=[];groupY=[];histoX=[];/*****************************************************************************色块标记***************************/histoNoteWidth = 12;//色块标记宽度histoNoteHeight = 10;//色块标记高度histoNoteMarginLeft = 6;//色块标记左边距histoNoteMarginRight = 8;//色块标记右边距histoNoteMarginTop = 8;//色块标记顶边距histoNoteMarginBottom = 8;//色块标记顶边距/*****************************************************************************文字说明***************************/leftCharNum = 4;//左侧文字字符个数bottomCharWidth = 'auto';//底侧文字字符宽度leftWord = "单位(小时)";//左侧文字说明bottomWord = "(事件)";//底侧文字说明leftWordMarginLeft = 0;//左侧文字左边距leftWordMarginTop = 50;//左侧文字顶边距bottomWordMarginRight = 50;//底侧文字右边距bottomWordMarginBottom = 76;//底侧文字底边距with(ctx){	//图背景	fillStyle = histogramBgColor;	fillRect(histogramMarginLeft, histogramMarginTop,  histogramWidth, histogramHeight);	//等高线	heightStep = histogramHeight/graduationLevel;	beginPath();	strokeStyle = graduationColor;	lineWidth = graduationWidth;	for(var i=1; i<graduationLevel; i++){		a = heightStep*i+histogramMarginTop;		moveTo(histogramMarginLeft,a);		lineTo(histogramMarginLeft + histogramWidth,a);	}	stroke();	//等高线左侧数字	var w = $("#histogramContainer").width($(canvas).width()).width();	positionStep = histogramHeight/graduationLevel;	graduationStep = maxGraduation/graduationLevel	for(var k=0; k<=graduationLevel; k++)	{		var tmp_l = (k*graduationStep).toString();		$("#histogramContainer").prepend('<span>' + tmp_l.substring(0,leftCharNum) + '</span>');		var l = $("#histogramContainer span").eq(0).height()/2;		$("#histogramContainer span").eq(0).css({			right:(w-histogramMarginLeft+6)+"px",			top:(histogramXaxle-k*positionStep-l)+"px"		});	}	//柱状描绘	for(var g=0; g<histoGroupSum; g++)	{		if(g==0)		{			groupX[g] = groupSpace/2-histoGroupWidth/2+histogramMarginLeft;		}		else		{			groupX[g] = groupX[g-1]+groupSpace;		}		var maxHeight = 0;//获取最高的柱		for(var h=0; h<histoSum; h++)		{			if(h==0)			{				histoX[h] = histoSpace/2-histoWidth/2+groupX[g];			}			else			{				histoX[h] = histoX[h-1]+histoSpace;			}			histoHeight=event[g][h+1]*unit;			fillStyle = histoColor[h];			fillRect(histoX[h], histogramXaxle-histoHeight, histoWidth, histoHeight);						if(maxHeight < histoHeight)			{				maxHeight = histoHeight;			}			groupY[g] = maxHeight;					}		//曲线图		if(g>0)		{			//画线			beginPath();			strokeStyle = diagramColor;			lineWidth = diagramWidth;			moveTo(groupX[g-1]+histoGroupWidth/2,histogramXaxle-groupY[g-1]);			lineTo(groupX[g]+histoGroupWidth/2,histogramXaxle-groupY[g]);			stroke();			//节点			fillStyle = diagramNodeColor;			beginPath();			arc(groupX[g]+histoGroupWidth/2, histogramXaxle-groupY[g], 4, 0, 360, false); 			fill();		}		else		{			fillStyle = diagramNodeColor;			beginPath();			arc(groupX[0]+histoGroupWidth/2, histogramXaxle-groupY[0], 4, 0, 360, false);			fill();		}				//下侧文字描述		$("#histogramContainer").prepend('<span>' + event[g][0] + '</span>');		var e = $("#histogramContainer span:first-child");		e.css({			left:(groupX[g]-e.width()/2+histoGroupWidth/2)+"px",			top:(histogramXaxle+10)+"px"		});		//分组边框描绘		strokeStyle = histoGroupBorderColor;		lineWidth = histoGroupBorderWidth;		strokeRect(groupX[g], histogramXaxle-maxHeight, histoGroupWidth, maxHeight);	}	//图外边框	strokeStyle = histogramBorderColor;	lineWidth = histogramBorderWidth;	strokeRect(histogramMarginLeft, histogramMarginTop,  histogramWidth, histogramHeight);		//色块标记柱状图	for(var it=0; it<histoSum; it++)	{		fillStyle = histoColor[it];		var t_x = canvas.width-histoNoteMarginRight-histoNoteWidth;		var t_y = histogramMarginTop+it*(histoNoteHeight+histoNoteMarginBottom);		fillRect(t_x, t_y, histoNoteWidth, histoNoteHeight);		$("#histogramContainer").prepend('<span>' + items[it] + '</span>');		var n = $("#histogramContainer span:first-child");		n.css({			right:(histoNoteMarginLeft+histoNoteWidth+histoNoteMarginRight)+"px",			top:(t_y+histoNoteHeight/2-n.height()/2)+"px"		});	}	$("#histogramContainer").prepend('<span style="left:' + leftWordMarginLeft + 'px; top:' + leftWordMarginTop + 'px;">' + leftWord + '</span>');	$("#histogramContainer").prepend('<span style="right:' + bottomWordMarginRight + 'px; bottom:' + bottomWordMarginBottom + 'px;">' + bottomWord + '</span>');}})()