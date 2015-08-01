<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<title>@yield('title', isset( $subject ) ? $subject : 'GW2Heroes')</title>
	@include('layout.email.html.styles')
</head>

<body style="-ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; background: #f2f2f2; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; height: 100% !important; line-height: 1.6; margin: 0; padding: 0; width: 100% !important" bgcolor="#f2f2f2">

<table class="body" style="-premailer-width: 100%; background: #f2f2f2; border-collapse: separate !important; box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%" bgcolor="#f2f2f2" width="100%">
	<tr>
		<td style="box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top" valign="top"></td>
		<td class="container" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px; vertical-align: top; width: 580px" valign="top">
			<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px">
				<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden; width: 0">
                    @yield('preheader', isset( $subject ) ? $subject : 'GW2Heroes')
                </span>
				<table class="main" style="-premailer-width: 100%; background: #fff; border-collapse: separate !important; border-radius: 3px; border: 1px solid #e5e5e5; box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%" bgcolor="#fff" width="100%">
					<tr>
						<td class="wrapper" style="box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 30px; vertical-align: top" valign="top">
							<table style="-premailer-width: 100%; border-collapse: separate !important; box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt" width="100%">
								<tr>
									<td style="box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top" valign="top">
										@yield('body')
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer" style="box-sizing: border-box; clear: both; width: 100%">
					<table style="-premailer-width: 100%; border-collapse: separate !important; box-sizing: border-box; color: #999; font-size: 12px; mso-table-lspace: 0pt; mso-table-rspace: 0pt" width="100%">
						<tr style="color: #999; font-size: 12px">
							<td class="align-center" style="box-sizing: border-box; color: #999; font-size: 12px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 20px 0; text-align: center; vertical-align: top" align="center" valign="top">
								@section('footer')
									@include('layout.email.html.footer')
								@show
							</td>
						</tr>
					</table>
				</div>
			</div>
		</td>
		<td style="box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top" valign="top"></td>
	</tr>
</table>

</body>
</html>
