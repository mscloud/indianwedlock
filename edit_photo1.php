<?php
	include("../connect/config2.php");
	include("secure.php");
	include("../BusinessLogic/class.country.php");
	
	
	
	/*$ob=new country();
	if(isset($_POST['submit']) and $_POST['submit']!='')
	{
		$country_name=mysql_real_escape_string($_POST['country']);
		$status=$_POST['status'];
		$ob->update_country($country_id,$country_name,$status);	
		if(isset($_REQUEST['page']) and $_REQUEST['page']!='')
		{
			echo "<script>window.location='country.php?page=".$_REQUEST['page']."'</script>";
		}
		else
		{
			echo "<script>window.location='country.php'</script>";
		}
	}*/
	
	//$cnres=$ob->get_country_by_id($country_id);
	$photo1_id=$_GET['photo1_id'];	//hor_id
	$fet="SELECT * FROM register WHERE index_id='$photo1_id'";
	$cnres=mysql_query($fet);	
	$cnrow=mysql_fetch_array($cnres);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: <?php echo $info['title']; ?> - Admin Panel ::</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<!--<script src="js/jquery.validate.js" type="text/javascript"></script>-->
<script language="javascript" src="js/edit_photo1.js"></script>


</head>

<body><center>
	<div id="main">
    	<div id="header">
        	<?php include('header.php'); ?>
        </div>
        <div id="menu">
        	<?php include('menu.php'); ?>
        </div>
        <div id="content" style="float:left;">

        <table width="1000px" align="left">
        <tr>
            <td style="border:none;">&nbsp;</td>
            </tr>
        	<tr>
            	<td align="left" style="border:none;">
               <span class="red_text">Edit Horoscope Details</span>
                </td>
            </tr>
            <tr>
            	<td style="border:none;">
				<br />       
					<form id="edit_photo1" action="" method="post" onsubmit="return valid();" enctype="multipart/form-data">
                    <table style="border:solid 5px #7e0000;" width="530px">
                        <tr>
                        <td height="40" width="160" valign="top"><font id="star">*</font>&nbsp;<span style="font-size:13px; padding-left:5px;">Photo Image:</span></td>
                        <td class="errormsg"><img src="../photos/<?php echo $cnrow['photo1']; ?>" style="border:1px #666666 solid" width="100" height="100" /><br />
                          <br />
                        
                        <input type="file" name="photo1"  id="photo1">&nbsp;</td>
                       </tr>
                       
                       
                       <tr>
                        <td height="40">&nbsp;</td>
                        <td><input type="image" name="submit" src="images/btn_submit.gif" value="submit" /><input type="hidden" name="submit" value="submit" /><img src="images/btn_cancel.gif" onclick="window.location='photo1.php'" /></td>
                       </tr>
	                </table>
					</form>
            	</td>
            </tr>
       
        </table>		
        </div>
        <div id="footer" style="margin-top:250px;">
        	<?php include('footer.php'); ?>
        </div>
    </div>
 </center>
</body>
</html>

<?php
	if(isset($_POST['submit']))
	{
		$photo1_id=$_GET['photo1_id'];		
		$photo1_img=$_FILES['photo1']['name'];	
		$photo1_len=strlen($photo1_img);
		
		if($photo1_len==0)
		{
			$r=mysql_query("SELECT * FROM register WHERE index_id='$photo1_id'");
			$f=mysql_fetch_array($r);
			$j=$f['photo1'];
			
			$update=mysql_query("UPDATE register SET photo1='$j' WHERE index_id='$photo1_id'");			
		}
		if($photo1_len>0)
		{
			$k=$photo1_img;			
			move_uploaded_file($_FILES['photo1']['tmp_name'],"../photos/".$_FILES['photo1']['name']);			
			$update=mysql_query("UPDATE register SET photo1='$k' WHERE index_id='$photo1_id'");
			
		}
		echo "<script>window.location='photo1.php';</script>";
	}
?>


