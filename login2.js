/**
 * 
 */
var db;

$(document).ready(function(){
	initDB();
	$("#auth").click(function(e){
		e.preventDefault();
		e.stopPropagation();
		loginRecord();
	});
});

function initDB(){
	try {
		if (!window.openDatabase) {
			alert('not supported');
		} else {
			//Define database options
			var dbOptions = {
					fileName: "holmenRobotics",
					version: "1.0",
					displayName: "Holmen Robotics DataBase",
					maxSize: 1024
			};
			db = openDatabase(
					dbOptions.fileName,
					dbOptions.version,
					dbOptions.displayName,
					dbOptions.maxSize
			);
		}
	} catch(e) {
		// Error handling 
		alert("Error opening the database");
	}
}

function loginRecord(){
	console.log(db);
	db.transaction(function(tx){
		var user=$('#username').val();
		var pwd=$('#password').val();
		var x='SELECT username FROM Users WHERE username="'+user+'" ;';
		var y='SELECT username, password, auth FROM Users WHERE username="'+user+'" AND password="'+pwd+'" ;';
		tx.executeSql('CREATE TABLE IF NOT EXISTS Users (id INTEGER PRIMARY KEY AUTOINCREMENT,' + 
				' username TEXT UNIQUE, password TEXT , auth TEXT)');
		tx.executeSql('SELECT username FROM Users WHERE username="admin"',
				[], function(tx, result){
				if (result.rows.length == 0){
					tx.executeSql('INSERT INTO Users (username, password, auth) VALUES' +
						'("admin", "password", "A")');
				}
		});
		tx.executeSql('SELECT username FROM Users WHERE username="student"',
				[], function(tx, result){
				if (result.rows.length == 0){
					tx.executeSql('INSERT INTO Users (username, password, auth) VALUES' +
						'("student", "password", "S")');
				}
		});
		tx.executeSql('SELECT username FROM Users WHERE username="volunteer"',
				[], function(tx, result){
				if (result.rows.length == 0){
					tx.executeSql('INSERT INTO Users (username, password, auth) VALUES' +
						'("volunteer", "password", "V")');
				}
		});
		tx.executeSql(x,[],function(tx,result){
			console.log(result.rows.length);
			var h=result.rows.item(0);
			if (result.rows.length > 0){
				alert("Username : " +  h['username']); 
				tx.executeSql(y,[],function(tx,result){
					console.log(result.rows.length);
					if (result.rows.length > 0){
						var h=result.rows.item(0);
						if (h['auth'] == "A"){
							var redirect = new String(window.location.href);
							redirect = redirect.replace("Login.html", "Admin.html");
							window.location.assign(redirect);
						} 
						else if (h['auth'] == "V"){
							var redirect = new String(window.location.href);
							redirect = redirect.replace("Login.html", "Volunteer.html");
							window.location.assign(redirect);
						}
						else if (h['auth'] == "S"){
							var redirect = new String(window.location.href);
							redirect = redirect.replace("Login.html", "Student.html");
							window.location.assign(redirect);
						}
						else {
							alert("Your username currently has no authorization."+
									" Please contact your administrator for help.");
						}
					}else{
						alert("Invalid Password!");
					}
				});
			}else{
				alert("User not found!");
			}
		});
	});
}