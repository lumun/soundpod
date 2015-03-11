<!DOCTYPE html>
<html>

<head>
	<title>Group 5: University of Puget Sound Databases 2015</title>
	<link rel="stylesheet" href="/assets/stylesheets/screen.css">
</head>

<body>
	<!-- faitwrapper class is necessary on ALL pages for sticky footer -->
    <div id="faitwrapper">
    	<!-- Header inserter here -->
    	<?php include '_header.php'; ?>

    	<div class="content">
			<ol type="a" class="question_list">

				<li><i>What command can you type into the terminal to check if apache is current running?</i><br><b><code>sudo service httpd status</code></b></li>

				<li><i>What is the difference between ServerRoot and DocumentRoot?</i><br><b>ServerRoot is the top level directory for Apache, where the configuration files and error logs are kept. DocumentRoot is the to directory where files to be served are stored. These can include HTML, CSS, or PHP files along with any external files (like images) we could want.</b></li>

				<li><i>What port does your web server listen to for HTTP connections from browsers?</i><br><b>This server uses port 80</b></li>

				<li><i>In what directory do you need to place all of your HTML and PHP documents for apache to serve them up?</i><br><b>For our server, it's <code>/var/www/html</code></b></li>

				<li><i>What file contains all the traffic logs? What about error logs?</i><br><b>The access logs are combined into one file and are located at <code>(ServerRoot)/logs/access_log</code>. The error logs are located in <code>(ServerRoot)/logs/error_log</code>.</b></li>

				<li><i>What is a directory index file? Why would it be nice to have one in each directory?</i><br><b>It is the "default" file to serve for each directory. It's nice to have an <code>index.html</code> in each directory because it ensures that *something* is served on most pages, and reduces 404s.</b></li>

				<li><i>How do you give every user on your Linux machine their own web space? Look into public html</i><br><b>Use the UserDir command, and in the configuration file Include conf/extra/httpd-userdir.conf. This allows urls with ~username to be replaced with some directory in the server's home directory.</b></li>

				<li><i>How do you create a password protected directory (like I did for the class notes)? Look into htpasswd and .htaccess files.</i><br><b><code> htpasswd -c /etc/htpasswd/.htpasswd user1</code> <br> This command will create a new htpasswd file for user1, and will prompt for that user's password after that. A .htaccess file can be used to give a specific directory access to certain users only.</b></li>

				<li><i>When the browser tries to access a page that doesn't exist, the HTTP protocol issues a 404 error code. There's a way to send the browser to a particular document upon issuing this error (like on our http://cs.pugetsound.edu site). How? Look into ErrorDocument in the config file.</i><br><b>In the config file, set ErrorDocument to be the filepath to an error file (404.html or somesuch). On error, it redirects to the error file. We have implemented this, feel free to text it out or just click the button below.</b></li>
				
				<li><i>Apache implements the HTTP protocol. The protocol is extremely simple, with just a few commands. What is the difference between the GET, POST, and HEAD commands?</i><br>
					<ul>
						<li>
						<p><strong>GET</strong> is a request for data from another computer using the HTTP protocol. It returns a HTTP header and a body of data. The header data includes information about the success or failure of the request, as well as other potentially relevant data. </p>
						</li>
						<li>
						<p><strong>POST</strong> submits data relevant data to another machine to be used</p>
						</li>
						<li>
						<p><strong>HEAD</strong> is the same as GET but only requests the header data from another computer, and does not receive the body of the text</p>
						</li>
					</ul>
				</li>
			</ol>
		</div>

		<div id="faitpush"></div>
	</div>
	<div id="faitfooter">
		<?php include '_footer.php'; ?>
	</div>
</body>
</html>