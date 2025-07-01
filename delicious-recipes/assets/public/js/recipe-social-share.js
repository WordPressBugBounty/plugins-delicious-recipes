export function initRecipeSocialShare() {
	const socialShare = document.querySelectorAll('.post-share a.meta-title');

	socialShare.forEach(function(metaTitle) {
		metaTitle.addEventListener('click', function(e) {
			e.stopPropagation();
			const socialNetworks = this.parentElement.querySelector('.social-networks');
			if (socialNetworks) {
				if (socialNetworks.classList.contains('active')) {
					socialNetworks.classList.remove('active');
				} else {
					socialNetworks.classList.add('active');
				}
			}
		});
	});
} 