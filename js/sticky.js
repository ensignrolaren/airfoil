// site header that sticks to the top of the window when the  page scrolls
const debounce = (callback, wait) => {
  let timeoutId = null;
  return (...args) => {
    window.clearTimeout(timeoutId);
    timeoutId = window.setTimeout(() => {
      callback.apply(null, args);
    }, wait);
  };
}
const handleScroll = debounce((ev) => {
	var scrollPosition = window.scrollY;
	var siteHeader = document.getElementsByClassName('site-header')[0];
	scrollPosition = window.scrollY;

	if (scrollPosition >= 10) {
		siteHeader.classList.add('scrolled');
	} else {
		siteHeader.classList.remove('scrolled');
	}
}, 150);
window.addEventListener('scroll', handleScroll);