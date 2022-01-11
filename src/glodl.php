<?php

//////////////////////////////////////////////////////////////////////////
// Copies a file by its name to another server by using curl ftp.
// Part of the dlstart tool, which is a complete downloader.
// See dlstart.php for more information.
// Parameters:
// 	POST['filename'] -> filename of the file
//////////////////////////////////////////////////////////////////////////


?><html>
<head>
<script
	src="https://code.jquery.com/jquery-3.6.0.min.js"
	integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
	crossorigin="anonymous"></script>
<script src="glodl.js"></script>
</head>
<body>
Files to download:
<textarea id="mylist" style="width: 100%; height: 800px;"></textarea>
<button id="go">go</button>
</body>
</html>