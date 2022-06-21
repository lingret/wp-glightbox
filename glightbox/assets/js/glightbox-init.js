(function() {
	if (galleries = document.querySelectorAll('.wp-block-gallery')) {
		galleries.forEach((gallery, index) => {
			const selector = 'glightbox_' + (index + 1);
			if (imageLinks = gallery.querySelectorAll('a')) {
				imageLinks.forEach(link => {
					link.classList.add(selector);
					if (captionElement = link.nextSibling) {
						if (captionElement.nodeName == 'FIGCAPTION') {
							let description = captionElement.innerText;
							link.dataset.description = description;
							captionElement.style.display = 'none';
						}
					}
				});
				GLightbox({
					selector: '.' + selector,
					touchNavigation: true,
					autoplayVideos: true,
					loop: true
				});
			}
		});
	}
})();
