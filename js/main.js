var band = new Audio('/../AppAcademyAPI/audio/cantina-band.mp3');
var roar = new Audio('/../AppAcademyAPI/audio/chewie-roar.mp3');
window.onload = function () {
	band.play();
};

window.onbeforeunload = function () {
	roar.play();
};
