function log() {
	document.getElementById("blueBox").style.height = "110%";
	document.getElementById("greyBox").style.width = "60%";
	document.getElementById("changeble").innerHTML = "<form method=\"post\" action=\"login.php\">Nick: <input type=\"text\" name=\"nick\"><br><br>Hasło: <input type=\"password\" name=\"passcode\"><br><br><button>Zaloguj</button></form>";
}
function reg() {
	document.getElementById("blueBox").style.height = "115%";
	document.getElementById("greyBox").style.width = "70%";
	document.getElementById("changeble").innerHTML = "<form method=\"post\" action=\"register.php\">Nick: <input type=\"text\" name=\"nick\"><br><br>email: <input type=\"email\" name=\"email\"><br><br>Hasło: <input type=\"password\" name=\"passcode\"><br><br>Powtórz Hasło: <input type=\"password\" name=\"passcode2\"><br><br>Akceptuje regulamin: <input type=\"checkbox\" name=\"ch1\"><br><br><button>Zarejestruj</button></form>"
}