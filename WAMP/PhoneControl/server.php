﻿<?php	session_start();	if($_POST["p"] == "phone")	{	/*		if($_SESSION['com']== 0)		{			$_SESSION['com']=1;		}		else		{			$_SESSION['com']=0;		}		*/		$_SESSION['com'] = "dsdsdsd";		echo $_SESSION['com'];	}	else	{		if($_POST['com'] != $_SESSION['com'])		{		/*			if($_SESSION['com']== 1)			{				$_SESSION['com']=0;			}			else			{				$_SESSION['com']=1;			}			*/			//echo $_SESSION['com'];		}				echo $_SESSION['com'] == null;	}?>