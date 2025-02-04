const loginpage = document.getElementById("login");
if (loginpage) {
	const dm = localStorage.getItem("theme-mode");
	if (dm && dm === "darkmode") {
		document.querySelector("body").classList.toggle("darkmode");
	} else {
		document.querySelector("body").classList.toggle("darkmode");
	}
}
