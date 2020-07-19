#!/usr/bin/perl
use strict;
use warnings;
use Authen::Captcha;
use CGI ;

my $cgi = new CGI ;

# this directory is not accessible via the web.
my $captcha_datadir = "/home/sites/liamcrosby.co.uk/public_html//../.captcha_data";

# this directory will store the captcha images. This should
# be accessible via the web because it will be included on the page.
my $captcha_outputdir = "/home/sites/liamcrosby.co.uk/public_html/ContactForm/img";

# This directory is the same as above, but using the web accessible
# URL path.
my $image_dir = "/ContactForm/img";

# This should be the location of the FormMail.cgi script.
my $formmail = "/ContactForm/FormMail.cgi";

# This is where the user should be taken to after submitting the form.
my $redirect = "http://liamcrosby.co.uk/ContactForm/email_sent.html";


my $captcha = Authen::Captcha->new(
  data_folder => $captcha_datadir,
  output_folder => $captcha_outputdir,
  );

my ($md5sum, $chars) = $captcha->generate_code(4);
# eliminate ambiguous chars from $chars
my $bad_chars = 1;
while ($bad_chars) {
    if ( $chars =~ m/o|0|O|l|i|1|q|9|6|b|s|S|5|2|Z/) {
        ($md5sum, $chars) = $captcha->generate_code(4);
    } else {
        $bad_chars = 0;
    }
}
my $title      = 'Contact Me' ;
my $recipient  = 'liam\@liamcrosby.co.uk' ;
my $invitation = '
Please fill in the fields and I will get back to you as soon as possible.

' ;
my $email    ;
my $realname  ;

print $cgi->header () ;

print << "END";

<!DOCTYPE html>
<html>
<head>
<title>Contact Me</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="logo-wrap">
<div id="title">
	<h1><a href="#">Liam Crosby </a></h1>
	<h2> Developer</h2>
</div>
</div>

<!--header-->
<div id="header">
	<div id="menu">
		<ul>
			<li class=""><a href="../index">Homepage</a></li>
			<li><a href="../about">About</a></li>
			<li class="current_page_item"><a href="contact.cgi">Contact</a></li>
		</ul>
	</div>
</div>
<!--end header-->
<div id="wrapper">
<div id="wrapper-btm">
<div id="page">
	<!-- start content -->
	<div id="content">
		<div id="banner">&nbsp;</div>
		<div class="post">
			<h1 class="title">Contact Me</h1>
			<div class="entry">
				<p>
				</p>
				<form  action="/ContactForm/FormMail.cgi" method='post'>
				<table>
				<tr><td><label>Your Name </label></td><td><input type='text' name='realname' size=40></td></tr>
				<tr><td><label>Your Email </label></td><td><input type='text' name='email' size=40></td></tr>
				<tr><td><label>Subject </label></td><td><input type='text' name='subject' size=60></td></tr>
				<tr><td><label>Your message </label></td><td><textarea name='message' cols=64 rows=8 wrap=virtual></textarea></td></tr>
				<!-- The following section displays a captcha request  -->
				<tr>
					<td><label>Enter the letters </label></td>
					<td><img src="/ContactForm/img/$md5sum.png" /> <input type="text" size="20" name="captcha-text" id="captcha-text" /><td></td>
				</tr>
        <!-- End section -->
				<tr><td>&nbsp;</td><td aligh='center'> <button value='Send my email'>Send</button></td></tr>
				</table>
				<p> <p>
				<input type='hidden' name='title' value="Contact Me" >
				<input type='hidden' name='recipient' value='liam\@liamcrosby.co.uk' >
				<input type='hidden' name='redirect' value="http://liamcrosby.co.uk/ContactForm/email_sent.html" >
				<input type='hidden' name='captcha-md5sum' value="$md5sum" >
				</form>
				</p>
			</div>
			<div class="meta">
				<p class="byline"></p>				
			</div>
		</div>
		</div>
	</div>
	<!-- end content -->
	<!-- start sidebar -->
	<div id="sidebar">
		<ul>
			<li>
				<ul>
					<li><a href="../programming.php">C#</a></li>
					<li><a href="../web">Web Development</a></li>
					<li><a href="../flash">Flash Animation</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	<div style="clear: both;">&nbsp;</div>
</div>
<!-- end page -->
</div>
</div>
<!-- start footer -->
<div id="footer">
	<div id="footerwrapper">
	<div id="footertext">Design by Liam Crosby</div>
	</div>
</div>
<!-- end footer -->
</body>
</html>

END
