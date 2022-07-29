<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Simple Responsive HTML Email Template</title>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
<style>
    *{
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    html,body{
        background: #eeeeee;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
    img{
        max-width: 100%;
    }
    /* This is what it makes reponsive. Double check before you use it! */
    @media only screen and (max-width: 480px){
        table tr td{
            width: 100% !important;
            float: left;
        }
    }
</style>
</head>

 <body style="background: #eeeeee; padding: 10px;"> <!-- font-family: 'Open Sans', sans-serif, Helvetica, Arial;"> -->

<center> <!-- Let's Center it. just in case email client does not support margin: 0 auto -->

<!-- ** Top Message
----------------------------------->
<h3 style="text-align: center; margin: 10px 0;">
<img src="<?=base_url('img/logo.png')?>" /> OTF Online.
</h3>

<!-- ** Table begins here
----------------------------------->
<!-- Set table width to fixed width for Outlook(Outlook does not support max-width) -->
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="FFFFFF" style="background: #ffffff; max-width: 600px !important; margin: 0 auto; background: #ffffff;">
    <tr>
        <td style="padding: 20px; text-align: center; background:#7b3a82;">
            <h1 style="color: #ffffff">Verify email address</h1>
        </td>
    </tr>


    <tr>
        <td style="padding: 20px; text-align: center;">
            <!-- ** 100% width
            ----------------------------------->
            <p style="font-size:30px; margin: 5px;">Hi <?= $data["name"]; ?></p>
            <p>
            Thanks for joining us at <a href="<?=site_url()?>" target="_blank" style="text-decoration: none;">otfonline.com.ng</a><br>
            Click the button below to confirm that this is correct email to reach you.
            </p>
            <p style="border-radius: 10px; -moz-border-radius: 10px; padding: 15px 20px; margin: 10px auto; background: #830190; display: inline-block;font-size: 15px;font-weight: bold;">
                <a style="color: #fff; text-decoration: none;font-size: 15px;font-weight: bold;"  href="<?= $data['reset_link']; ?>" target="_blank" > Verify Email</a>
            </p>
        </td>
    </tr>



    <!-- <tr>
        <td style="padding: 20px;">
            <table border="0" cellpadding="0">
                <tr>
                    <td width="30%" style="width: 30%; padding: 10px;">
                        <img src="http://www.ohsikpark.com/samples/email/profile.jpg" />
                    </td>
                    <td width="70%" style="width: 70%; padding: 10px; text-align: left;">
                        <h3>Say Something | 70% width</h3>
                        <p>Etiam placerat, leo id facilisis facilisis, sem tortor efficitur velit, eget ultrices augue erat id tellus.</p>
                        <p style="color: #666666; font-size: 12px;">Small Font Sample</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr> -->


    <tr>
        <td style="padding: 20px; background:#f7f7f7;">

            <!-- ** 50% and 50%
            ----------------------------------->
            <table border="0" cellpadding="0" cellspacing="0" a>
                <tr>
                    <td width="50%" style="width: 50%; padding: 10px; text-align: left;" valign="top">
                        <h3>About us</h3>
                        <p style="font-size: 11px;color:#6c8293;">
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px; text-decoration:none;">Fast Food</a> | 
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Street Food</a> | 
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Chinese</a> | 
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Continental</a>  |  
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Wines</a> | 
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Cafe</a>  | 
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Grocery</a> |  
                            <a href="#" style="color: #6c8293;font-size: 12px;line-height: 23px;margin: 0 2px;text-decoration:none;">Alcohol</a>
                        </p>
                    </td>
                    <td width="50%" style="width: 50%; padding: 10px; text-align: left;" valign="top">
                        <h3>Contact us</h3>
                        <!-- ** Footer contact
                        ----------------------------------->
                        <table border="0" style="font-size: 14px;">
                            <tr><td>Call: <a href="tel:0808080065" style="color: #6c8293;font-size: 12px; text-decoration: none;">080 808 0065</a></td></tr>
                            <tr><td>Email: <span style="color: #6c8293;font-size: 12px;">info@otfonline.com.ng</span></td></tr>
                        </table>
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>


<!-- ** Bottom Message
----------------------------------->
<p style="text-align: center; color: #666666; font-size: 12px; margin: 10px 0;">
    &copy; Copyright <?php echo date('Y'); ?> OTF Eat. All Rights Reserved<br />
    <b><small> Made with <span style="color:#f32129">&hearts;</span> by
    <a style="color:#f32129; text-decoration:none;" href="javascript:void(0);">Trovolink Tech</a></b>
</p>

</center>

</body>
</html>