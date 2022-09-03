// source: https://stackoverflow.com/questions/30489594/prevent-100vw-from-creating-horizontal-scroll/41615816#41615816
function handleWindow() {
	var body = document.querySelector('body');

	if (window.innerWidth > body.clientWidth + 5) {
		body.classList.add('has-scrollbar');
		body.setAttribute('style', '--scroll-bar: ' + (window.innerWidth - body.clientWidth) + 'px');
	} else {
		body.classList.remove('has-scrollbar');
	}
}
handleWindow();