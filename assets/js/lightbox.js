(() => {
	const $  = (sel, root = document) => root.querySelector(sel);
	const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

	const gallery = $('#gallery');
	const items   = $$('.tile', gallery);

	const images = items.map((tile, idx) => ({
		src: tile.getAttribute('href'),
		alt: $('img', tile) ? .alt || '',
		index: idx
	}));

	const lightbox = $('#lightbox');
	const lbImage  = $('#lbImage');
	const btnPrev  = $('#btnPrev');
	const btnNext  = $('#btnNext');
	const btnClose = $('#btnClose');

	let current       = 0;
	let lastFocusedEl = null;

	const updateLightbox = () => {
		const img        = images[current];
		lbImage.src      = img.src;
		lbImage.alt      = img.alt;
		[current - 1, current + 1].forEach(i => {
			if (i >= 0 && i < images.length) {
				new Image().src = images[i].src;
			}
		});
	};

	const openLightbox = (index) => {
		current        = index;
		lastFocusedEl  = document.activeElement;
		updateLightbox();
		lightbox.setAttribute('aria-hidden', 'false');
		btnClose.focus();
		document.addEventListener('keydown', onKey);
	};

	const closeLightbox = () => {
		lightbox.setAttribute('aria-hidden', 'true');
		document.removeEventListener('keydown', onKey);
		if (lastFocusedEl) {
			lastFocusedEl.focus();
		}
	};

	const next = () => { current = (current + 1) % images.length; updateLightbox(); };
	const prev = () => { current = (current - 1 + images.length) % images.length; updateLightbox(); };

	const onKey = (e) => {
		switch (e.key) {
			case 'Escape': closeLightbox(); break;
			case 'ArrowRight': next(); break;
			case 'ArrowLeft': prev(); break;
		}
	};

	// Bind gallery items
	items.forEach((tile, i) => {
		tile.addEventListener('click', e => { e.preventDefault(); openLightbox(i); });
		tile.addEventListener('keydown', e => {
			if (['Enter',' '].includes(e.key)) {
				e.preventDefault(); openLightbox(i); }
		});
	tile.setAttribute('tabindex','0');
	tile.setAttribute('role','button');
	tile.setAttribute('aria-label','Open image: ' + ($('img', tile) ? .alt || ''));
	});

	// Controls
	btnNext.addEventListener('click', next);
	btnPrev.addEventListener('click', prev);
	btnClose.addEventListener('click', closeLightbox);
	lightbox.addEventListener('click', e => { if (e.target === lightbox) {
			closeLightbox();
	} });

	// Touch swipe
	let startX = 0;
	lbImage.addEventListener('touchstart', e => { startX = e.changedTouches[0].screenX; }, {passive:true});
	lbImage.addEventListener('touchend', e => {
		const dx = e.changedTouches[0].screenX - startX;
		if (Math.abs(dx) > 40) {
			dx < 0 ? next() : prev();
		}
	}, {passive:true});
})();