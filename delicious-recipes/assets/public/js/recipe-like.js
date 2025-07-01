export function initRecipeLike() {
    // Fetch recipe likes on page load
    const likeElements = document.querySelectorAll('[data-liked_recipe_id]');
    if (likeElements.length) {
        const recipeIds = Array.from(likeElements)
            .map(el => el.getAttribute('data-liked_recipe_id'))
            .filter(Boolean);
        if (recipeIds.length) {
            const formData = new FormData();
            formData.append('action', 'recipe_get_likes');
            recipeIds.forEach(id => formData.append('ids[]', id));
            fetch(delicious_recipes.ajax_url, {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(response => {
                    if (response.success && response.data?.recipes) {
                        for (const recipe_id in response.data.recipes) {
                            const likeEl = document.querySelector(`[data-liked_recipe_id="${recipe_id}"] .dr-likes-total`);
                            const likeBtn = document.querySelector(`[data-liked_recipe_id="${recipe_id}"] .dr_like__recipe`);
                            if (likeEl && likeBtn) {
                                likeEl.textContent = response.data.recipes[recipe_id].likes_count;
                                likeBtn.setAttribute('title', response.data.recipes[recipe_id].likes);
                                likeBtn.classList.remove('loading');
                            }
                        }
                    } else {
                        likeElements.forEach(el => {
                            const btn = el.querySelector('.dr_like__recipe');
                            if (btn) btn.classList.remove('loading');
                        });
                    }
                })
                .catch(() => {
                    likeElements.forEach(el => {
                        const btn = el.querySelector('.dr_like__recipe');
                        if (btn) btn.classList.remove('loading');
                    });
                });
        }
    }

    // Handle recipe like for logged out users
    if (typeof delicious_recipes.isUserLoggedIn !== 'undefined' && delicious_recipes.isUserLoggedIn === '') {
        if (window.location.pathname.includes('/recipe/')) {
            const container = document.querySelector('.dr_like__recipe');
            if (container) {
                const id = container.id.split('-').pop();
                let unique_user_id = '';
                if (typeof Storage !== 'undefined') {
                    unique_user_id = localStorage.getItem('delicious_recipes_user_identifier_for_recipe_likes');
                    if (unique_user_id) {
                        const formData = new FormData();
                        formData.append('action', 'delicious_recipes_check_like_for_logged_out_users');
                        formData.append('id', id);
                        formData.append('unique_user_id', unique_user_id);
                        container.classList.add('loading');
                        fetch(delicious_recipes.ajax_url, {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.data && !data.data.can_like) {
                                    container.classList.toggle('recipe-liked', false);
                                }
                            })
                            .finally(() => {
                                container.classList.remove('loading');
                            });
                    }
                }
            }
        }
    }

    // Like button click handler.
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.dr_like__recipe');
        if (!btn) return;
        e.preventDefault();
        const id = btn.id.split('-').pop();
        let unique_user_id = localStorage.getItem('delicious_recipes_user_identifier_for_recipe_likes');
        if (!unique_user_id) {
            unique_user_id = 'dr_user_identifier_' + Math.random().toString(36).substring(2, 15);
            localStorage.setItem('delicious_recipes_user_identifier_for_recipe_likes', unique_user_id);
        }
        let addRemove;
        btn.classList.toggle('recipe-liked');
        addRemove = btn.classList.contains('recipe-liked') ? 'remove' : 'add';
        btn.classList.add('loading');
        const formData = new FormData();
        formData.append('action', 'recipe_likes');
        formData.append('add_remove', addRemove);
        formData.append('id', id);
        formData.append('unique_user_id', unique_user_id);
        fetch(delicious_recipes.ajax_url, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.data) {
                    btn.setAttribute('title', data.data.likes);
                    const total = btn.querySelector('.dr-likes-total');
                    if (total) total.innerHTML = data.data.likes_count;
                }
            })
            .finally(() => {
                btn.classList.remove('loading');
                // update likes in floatingBarData
                if (typeof recipeProGlobal !== 'undefined') {
                    const likesParent = btn.closest('.dr-floating-box .post-like .single-like');
                    if (likesParent) {
                        const path = window.location.href;
                        const data = recipeProGlobal.filter(item => item.path === path);
                        if (data[0]) {
                            data[0].likes = btn.closest('.single-like').innerHTML;
                        }
                    }
                }
            });
    });
} 