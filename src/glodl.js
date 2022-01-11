var run = false;
var filelist = [];

$(function() {
		$('#go').on('click', function() {
			if(run == false) {
					$('#go').html("pause");
					run = true;
					console.log('go');
					//filename = $('#filename').val();
					
					filelist = $('#mylist').val().split("\n");
					
					dlstart();
			} else {
					$('#go').html('continue');
					run = false;
			}
		});
});

function dlstart() {
		if(run == false) {
				return;
		}
		
		var filename = "";
		
		if(filelist.length > 0) {
				//Entferne Verzeichnis-Angaben
				while(filelist[0] == '.' || filelist[0] == '..') {
						filelist.shift();
				}
				
				//Hole nächstes Element
				var next_entry = filelist[0];
				filelist.shift();		// Ersten Eintrag im Array entfernen.
				
				filename = next_entry;
		}
		
		var request = $.ajax({
			method: "POST",
			url: "dl.php",
			data: { filename: filename  }
		})
		
		request.done(function( msg ) {
				if(msg == "file done") {
						// do nothing, just downloaded a file..
				} else {
						alert('Dateiliste erhalten. Wir sollten aber keine Dateiliste erhalten!');
				}
				
				setTimeout(function() {
					dlstart();
				}, 10);

		});
		
		request.fail(function() {
			alert('Datei ' + filename + ' konnte nicht heruntergeladen werden.');
			console.log('Datei ' + filename + ' konnte nicht heruntergeladen werden.');
			filelist.push(filename);
			dlstart();
		});
}