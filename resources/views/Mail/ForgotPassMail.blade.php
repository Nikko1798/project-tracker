
<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>New Account Email Template</title>
    <meta name="description" content="New Account Email Template.">
    <style type="text/css">
        a:hover {text-decoration: underline !important;}
    </style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
    <!-- 100% body table -->
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
        style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: 'Open Sans', sans-serif;">
        <tr>
            <td>
                <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0"
                    align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                style="max-width:670px; background:#fff; border-radius:3px;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="padding:0 35px;">
                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif; text-align: center;">MABUHAY
                                        </h1>
                                        <p style="font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;">
                                            You are receiving this email because we received a password reset request for your NCCA Project Status Tracker account.
											<br></p>
										<div align="center">
										<a href="{{$data['reset_link']}}"
											style="background:#2A52BE;
													text-decoration:none !important;
													display:inline-block;
													font-weight:500;
													margin-top:24px;
													color:#fff;
													text-transform:uppercase;
													font-size:14px;
													padding:10px 24px;
													border-radius:50px;
													text-align:center;">
											Reset your password
										</a>
										</div>
										<br>


										<p style="font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;">
											This password reset link will expire in 60 minutes.
										</p>
										<p style="font-size:15px; color:#455056; margin:8px 0 0; line-height:24px;">
											If you did not request a password reset, no further action is required.
										</p>

										<br>
										<p>
											If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web browser:
											{{$data['reset_link']}}
										</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:40px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:20px;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;"> </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:80px;">&nbsp;</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--/100% body table-->
</body>

</html>