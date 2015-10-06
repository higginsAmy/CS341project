/**
 * 
 */

$(document).ready(function()
		{
	$("#auth").click(function(e){
		e.preventDefault();
		e.stopPropagation();
		loginRecord();
	});
		});


//Define database options
var dbOptions = {
		fileName: "holmenRobotics.db",
		version: "1.0",
		displayName: "Holmen Robotics DataBase",
		maxSize: 1024
};
//Now that we have our database properties defined, let's
//open our database, getting a reference to the
//generated connection.

//NOTE: This might throw errors, but we're not going to
//worry about that for this example.
var db = openDatabase(
		dbOptions.fileName,
		dbOptions.version,
		dbOptions.displayName,
		dbOptions.maxSize
);

function loginRecord(){

	db.transaction(function(tx){
		var user=$('#username').val();
		var pwd=$('#password').val();
		var x='SELECT * FROM Users WHERE username="'+user+'" ';
		console.log(x);
		var y='SELECT * FROM Users WHERE username="'+user+'" AND password="'+pwd+'" '; //to get the username and password from the login table
		console.log(y);
		tx.executeSql(x,[],function(tx,result){
			if (result.rows.length > 0){
				console.log(result.rows[0]);
				alert("Username : " +  result.rows[0].username);
				alert("Password: " + result.rows[0].password); 
			}else{
				alert("User not found!");
			}
		});
	});
}