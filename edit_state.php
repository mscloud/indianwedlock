<?php
	include("../connect/config2.php");
	include("secure.php");
	include("../BusinessLogic/class.state.php");
	include("../BusinessLogic/class.country.php");
	
	$state_id=$_GET['state_id'];
	
	$ob=new state();	
	if(isset($_POST['submit']) and $_POST['submit']!='')
	{
		$country_id=$_POST['country'];
		$state_name=mysql_real_escape_string($_POST['state']);
		$status=$_POST['status'];
		$ob->update_state($country_id,$state_id,$state_name,$status);
		if(isset($_REQUEST['page']) and $_REQUEST['page']!='')
		{
			echo "<script>window.location='state.php?page=".$_REQUEST['page']."'</script>";
		}
		else
		{
			echo "<script>window.location='state.php'</script>";
		}
	}
	$cnob=new country();
	$rescn=$cnob->get_country_by_status();
	
	$resst=$ob->get_state_by_id($state_id);
	$resrow=mysql_fetch_array($resst);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Matrimonial Script - Admin Panel ::</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript">


$().ready(function() {

	// validate signup form on keyup and submit
	$("#stateform").validate({
		rules: {
			country: "required",
			state: "required",
			status: "required"
			
		},
		messages: {
			country: " Please choose country",
			state: "Please enter state",
			status: " Please select status"
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio"))
				error.appendTo(element.parent().next());
			else if ( element.is(":checkbox") )
				error.appendTo (element.parent());
			else
				error.appendTo(element.parent());
		}
	});


});
</script>
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
               <span class="red_text">Edit State Details</span>
                </td>
            </tr>
            <tr>
            	<td style="border:none;">
				<br />       
					<form id="stateform" action="" method="post">
                    <table style="border:solid 5px #7e0000;" width="530px">
					<tr>
                        <td height="40" width="160px"><font id="star">*</font>&nbsp;<span style="font-size:13px; padding-left:5px;">Country:</span></td>
                        <td class="errormsg">
						  <select name="country" id="country" style="width:150px;">
						  	<option value="">Choose Country</option>
							<?php
								while($row=mysql_fetch_array($rescn))
								{
							?>
							<option value="<?php echo $row['country_id']; ?>" <?php if($resrow['country_id']==$row['country_id']){ ?> selected="selected" <?php } ?>><?php echo $row['country_name']; ?></option>
							<?php
								}
							?>
					      </select>&nbsp;
						</td>
                      </tr>
                        <tr>
                        <td height="40"><font id="star">*</font>&nbsp;<span style="font-size:13px; padding-left:5px;">State Name:</span></td>
                        <td class="errormsg"><input name="state" type="text" id="state" value="<?php echo $resrow['state_name']; ?>" style="width:150px;" />&nbsp;</td>
                       </tr>					   					   
                       <tr>
                        <td height="40"><font id="star">*</font>&nbsp;<span style="font-size:13px; padding-left:5px;">Status:</span></td>
                        <td><table>
						<tr>
						<td style="border:none;" class="text">
						<input name="status" type="radio" value="1" <?php if($resrow['status']==1){ echo "checked"; } ?> />Active&nbsp;&nbsp;<input name="status" type="radio" value="0" <?php if($resrow['status']==0){ echo "checked"; } ?> />Inactive&nbsp;&nbsp;
						</td>
						<td style="border:none;" class="errormsg">
						</td>
						</tr>
						</table></td>
                       </tr>
                       
                       <tr>
                        <td height="40">&nbsp;</td>
                        <td><input type="image" name="submit" src="images/btn_submit.gif" value="submit" /><input type="hidden" name="submit" value="submit" /><img src="images/btn_cancel.gif" onclick="window.location='state.php'" /></td>
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
