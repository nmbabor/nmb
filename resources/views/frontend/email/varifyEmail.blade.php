<h5>Welcome <?php echo $user['name'] ?>!</h5>
<p>

Thank you for signing up for an account on ebusines.com.bd
<br>
<br>
Please click on the link below to verify your email address:
<? 
$email=$user['email'];
$verifyToken=$user['verifyToken'];
 ?>
	<a href='{{URL::to("verify-email/$email/$verifyToken")}}'>{{URL::to("verify-email/$email/$verifyToken")}}</a>
<br>
If you didn't sign up for this account, or you are having trouble with your account, please contact us at support@ebusines.com.bd and we will be happy to help you.
<br>
<br>
Regards,
<br>
The customer support team at ebusines.com.bd
</p>