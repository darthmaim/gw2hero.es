<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	@section('title')
		<title>Pagetitle &bull; gw2hero.es</title>
	@show
	<style type="text/css">
		img{
			-ms-interpolation-mode: bicubic; max-width: 100%;
		}

		body{
			font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; height: 100% !important; line-height: 1.6; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; width: 100% !important;
		}

		.ExternalClass{
			width: 100%;
		}

		.ExternalClass{
			line-height: 100%;
		}

		body{
			background-color: #f2f2f2;
		}

		@media only screen and (max-width: 620px){
			table[class=body] h1{
				font-weight: 600 !important;
			}

			table[class=body] h2{
				font-weight: 600 !important;
			}

			table[class=body] h3{
				font-weight: 600 !important;
			}

			table[class=body] h4{
				font-weight: 600 !important;
			}

			table[class=body] h1{
				font-size: 22px !important;
			}

			table[class=body] h2{
				font-size: 18px !important;
			}

			table[class=body] h3{
				font-size: 16px !important;
			}

			table[class=body] .content{
				padding: 10px !important;
			}

			table[class=body] .wrapper{
				padding: 10px !important;
			}

			table[class=body] .container{
				padding: 0 !important; width: 100% !important;
			}

			table[class=body] .btn{
				width: 100% !important;
			}
		}
	</style>
</head>

<body style="-ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; background: #f2f2f2; font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; height: 100% !important; line-height: 1.6; margin: 0; padding: 0; width: 100% !important" bgcolor="#f2f2f2">

<table class="body" style="-premailer-width: 100%; background: #f2f2f2; border-collapse: separate !important; box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%" bgcolor="#f2f2f2" width="100%">
	<tr>
		<td style="box-sizing: border-box; mso-table-lspace: 0pt; mso-table-rspace: 0pt; vertical-align: top" valign="top"></td>
		<td class="container" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; mso-table-lspace: 0pt; mso-table-rspace: 0pt; padding: 10px; vertical-align: top; width: 580px" valign="top">
			<div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 580px; padding: 10px">
				<span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden; width: 0">
                    @yield('preheader')
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
								@yield('footer')
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