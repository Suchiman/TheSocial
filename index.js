window.onload = function()
{
	inhalt = document.getElementById("inhalt");
	menu = document.getElementById("menu");
	login = document.getElementById("login");
	login_feld();
}

function chat()
{
	var temp = get("empfangen.php");
	if(document.getElementById("chatbox").value != temp)
	{
		document.getElementById("chatbox").value = temp;
	}
	setTimeout("chat()", 1000);
}

function senden(e){
	var taste=e.keyCode || e.which;
	if (taste==13){
		e.cancelBubble = true;
		e.returnValue = false;
		var nachricht = document.getElementById("chat_message").value;
		document.getElementById("chat_message").value="";
		get("senden.php?nachricht="+nachricht);
		return e.returnValue;
	}
}

function tastendruck(e){
	var taste=e.keyCode || e.which;
	if (taste==13){
		e.cancelBubble = true;
		e.returnValue = false;
		lade('login.php?name='+document.getElementById('name').value+'&pw='+document.getElementById('pw').value);
		setTimeout('login_feld()',1000);
		return e.returnValue;
	}
}

function lade(seite)
{
	if(seite.indexOf("?") != -1)
	{
		var paraseite = seite.split("?");
		var laden = new XMLHttpRequest();
		laden.open("POST",paraseite[0],true);
		laden.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		laden.setRequestHeader("Content-length", paraseite[1].length);
		laden.setRequestHeader("Connection", "close");
		laden.onreadystatechange=function(){
			if (laden.readyState==4 && laden.status==200){
				if(laden.responseText == "0")
				{
					login_feld();
				}
				else
				{
					inhalt.innerHTML = laden.responseText;
				}
			}
		}
		laden.send(paraseite[1]);
	}
	else
	{
		var laden = new XMLHttpRequest();
		laden.open("POST",seite,true);
		laden.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		laden.setRequestHeader("Content-length", 0);
		laden.setRequestHeader("Connection", "close");
		laden.onreadystatechange=function(){
			if (laden.readyState==4 && laden.status==200){
				if(laden.responseText == "0")
				{
					login_feld();
				}
				else
				{
					inhalt.innerHTML = laden.responseText;
				}
			}
		}
		laden.send("");
	}
}

function get(seite)
{
	if(seite.indexOf("?") != -1)
	{
		var paraseite = seite.split("?");
		var get = new XMLHttpRequest();
		get.open("POST",paraseite[0],true);
		get.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		get.setRequestHeader("Content-length", paraseite[1].length);
		get.setRequestHeader("Connection", "close");
		get.send(paraseite[1]);
		return get.responseText;
	}
	else
	{
		var get = new XMLHttpRequest();
		get.open("POST",seite,false);
		get.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		get.setRequestHeader("Content-length", 0);
		get.setRequestHeader("Connection", "close");
		get.send("");
		return get.responseText;
	}
}

function nachrichten_check()
{
	setTimeout("nachrichten_check()",1000);
	if(get("login_check.php")=="1")
	{
		var anzahl = get("nachrichten_check.php");
		if(anzahl != "0")
		{
			document.getElementById("messenger").innerHTML = "Messenger (" + anzahl + ")";
		}
		else
		{
			document.getElementById("messenger").innerHTML = "Messenger";
		}
	}
}

function like(id)
{
	get("like.php?id=" + id + "&like=y");
}

function dislike(id)
{
	get("like.php?id=" + id + "&like=n");
}

function login_feld()
{
	if(get("login_check.php")=="1")
	{
		login.innerHTML = "Willkommen " + get("username.php") + ", <a href=\"#\" onclick=\"lade('logout.php');setTimeout('login_feld()',1000);\">Logout</a>";
		menu.innerHTML = "<table><tr><td><a href=\"#\" onclick=\"lade('startseite.php')\">Pinnwand</a> | </td><td><a href=\"#\" onclick=\"lade('profil.php')\">Profil</a> | </td><td><a href=\"#\" onclick=\"lade('leute.php')\">Leute</a> | </td><td><a href=\"#\" onclick=\"lade('messenger.php')\"><span id=\"messenger\">Messenger</span></a></td><td> | <a href=\"#\" onclick=\"lade('chat.php');setTimeout('chat()',1000);\"><span id=\"chat\">Chat</span></a></td></tr></table>";
		nachrichten_check();
		lade("startseite.php");
	}
	else
	{
		login.innerHTML = "<input type='text' id='name' value='Benutzername' onkeypress=\"tastendruck(event)\" onfocus='if(this.value==\"Benutzername\")this.value=\"\";' onblur='if(this.value==\"\")this.value=\"Benutzername\";'> <input type='text' id='pw' value='Passwort' onkeypress=\"tastendruck(event)\" onfocus='if(this.value==\"Passwort\")this.value=\"\";this.setAttribute(\"type\",\"password\");' onblur='if(this.value==\"\"){this.setAttribute(\"type\",\"text\");this.value=\"Passwort\";}'> <input type='button' value='Login' onclick=\"lade('login.php?name='+document.getElementById('name').value+'&pw='+document.getElementById('pw').value);setTimeout('login_feld()',1000);\">";
		menu.innerHTML = "Registriere dich jetzt und finde neue Freunde";
		inhalt.innerHTML = "<img src=\"bilder/world.png\" width=60% alt=\"Die Welt\"><div id=\"register\"><input type=\"text\" value=\"Dein Benutzername\" id=\"nick_inpage\"  onfocus='if(this.value==\"Dein Benutzername\")this.value=\"\";' onblur='if(this.value==\"\")this.value=\"Dein Benutzername\";'><br><br><input type=\"text\" value=\"Deine E-Mail\" id=\"email_inpage\" onfocus='if(this.value==\"Deine E-Mail\")this.value=\"\";' onblur='if(this.value==\"\")this.value=\"Deine E-Mail\";'><br><br><input type=\"text\" value=\"Dein Passwort\" id=\"pw1_inpage\" onfocus='if(this.value==\"Dein Passwort\")this.value=\"\";this.setAttribute(\"type\",\"password\");' onblur='if(this.value==\"\"){this.setAttribute(\"type\",\"text\");this.value=\"Dein Passwort\";}'><br><br><input type=\"text\" value=\"Passwort widerholen\" id=\"pw2_inpage\" onfocus='if(this.value==\"Passwort widerholen\")this.value=\"\";this.setAttribute(\"type\",\"password\");' onblur='if(this.value==\"\"){this.setAttribute(\"type\",\"text\");this.value=\"Passwort widerholen\";}'><br><br><br><center><a href=\"#\"  onclick=\"lade('registrieren.php?name='+document.getElementById('nick_inpage').value+'&pw1='+document.getElementById('pw1_inpage').value+'&pw2='+document.getElementById('pw2_inpage').value+'&email='+document.getElementById('email_inpage').value)\">Registrieren!</a></center></div>";
	}
}