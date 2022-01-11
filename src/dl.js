//////////////////////////////////////////////////////////////////////////
// Copies a file by its name to another server by using curl ftp.
// Part of the dlstart tool, which is a complete downloader.
// See dlstart.php for more information.
// Parameters:
// 	POST['filename'] -> filename of the file
//////////////////////////////////////////////////////////////////////////

var filelist = [];

$(function() {
		$('#go').on('click', function() {
			console.log('test');
			filename = $('#filename').val();
			dlstart(filename);
		});
});

function dlstart(filename) {
		console.log(filename);
		
		var request = $.ajax({
			method: "POST",
			url: "dl.php",
			data: { filename: filename  }
		})
		
		request.done(function( msg ) {
				if(msg == "file done") {
						// do nothing, just downloaded a file..
				} else {
						var newlist = "";
	
						try {
								var newlist = $.parseJSON(msg);
								filelist = filelist.concat(newlist);
						} catch(e) {
								console.log("Dateilist:", msg, "--Ende Dateiliste");
								alert('Dateiliste konnte nicht aus json in Objekt umgewandelt werden. Tu wat! Siehe Konsole für aktuelle filelist.');
						}
				}
				
				if(filelist.length > 0) {
						//Entferne Verzeichnis-Angaben
						while(filelist[0] == '.' || filelist[0] == '..') {
								filelist.shift();
						}
						
						//Hole nächstes Element
						var next_entry = filelist[0];
						filelist.shift();		// Ersten Eintrag im Array entfernen.
						
						var complete_filename = next_entry;

						setTimeout(function() {
							dlstart(complete_filename);
						}, 200);
				}
		});
		
		request.fail(function() {
			alert('Datei ' + filename + ' konnte nicht heruntergeladen werden.');
		});
}