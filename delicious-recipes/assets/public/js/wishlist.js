export function initWishlist() {
    // Wishlist click handler
    document.addEventListener('click', function (e) {
        const heart = e.target.closest('.dr-recipe-wishlist span.dr-bookmark-wishlist');
        if (!heart) return;
        e.preventDefault();
        const recipeID = heart.getAttribute('data-recipe-id');
        const isBookmarked = heart.classList.contains('dr-wishlist-is-bookmarked');
        const addRemove = isBookmarked ? 'remove' : 'add';
        heart.classList.add('loading');
        const formData = new FormData();
        formData.append('action', 'delicious_recipes_wishlist');
        formData.append('add_remove', addRemove);
        formData.append('recipe_id', recipeID);
        fetch(delicious_recipes.ajax_url, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data && data.data) {
                    const total = heart.querySelector('.dr-wishlist-total');
                    const info = heart.querySelector('.dr-wishlist-info');
                    if (total) total.innerHTML = data.data.wishlists;
                    if (info) info.innerHTML = data.data.message;
                    // Only toggle the class based on server response
                    if (data.data.isBookmarked || addRemove === 'add') {
                        heart.classList.add('dr-wishlist-is-bookmarked');
                    } else {
                        heart.classList.remove('dr-wishlist-is-bookmarked');
                    }
                }
            })
            .finally(() => {
                heart.classList.remove('loading');
                // update wishlist in floatingBarData
                if (typeof recipeProGlobal !== 'undefined') {
                    const wishlistParent = heart.closest('.dr-floating-box .dr-add-to-wishlist-single .dr-recipe-wishlist');
                    if (wishlistParent) {
                        const path = window.location.href;
                        const data = recipeProGlobal.filter(item => item.path === path);
                        if (data[0]) {
                            data[0].wishlist = heart.closest('.dr-recipe-wishlist').innerHTML;
                        }
                    }
                }
            });
    });

    // Login modal logic
    function setupLoginModal() {
        const popupBtns = document.querySelectorAll('.dr-recipe-wishlist span.dr-popup-user__registration');
        if (!popupBtns.length) return;
        const modal = document.getElementById('dr-user__registration-login-popup');
        if (!modal) return;
        popupBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                modal.style.display = 'block';
            });
        });
        const closeBtn = document.querySelector('.dr-user__registration-login-popup-close');
        if (closeBtn) {
            closeBtn.onclick = function () {
                modal.style.display = 'none';
            };
        }
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
        // Login form submit
        const loginForm = document.querySelector("form[name='dr-form__log-in']");
        if (loginForm) {
            loginForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const username = loginForm.querySelector('input[name="username"]').value;
                const password = loginForm.querySelector('input[name="password"]').value;
                const rememberme = loginForm.querySelector('input[name="rememberme"]').value;
                const login = loginForm.querySelector('input[name="login"]').value;
                const nonce = loginForm.querySelector('input[name="delicious_recipes_user_login_nonce"]').value;
                loginForm.classList.add('dr-loading');
                const successMsg = document.querySelector('.delicious-recipes-success-msg');
                const errorMsg = document.querySelector('.delicious-recipes-error-msg');
                if (successMsg) successMsg.style.display = 'none';
                if (errorMsg) errorMsg.style.display = 'none';
                const formData = new FormData();
                formData.append('action', 'delicious_recipes_process_login');
                formData.append('username', username);
                formData.append('password', password);
                formData.append('rememberme', rememberme);
                formData.append('login', login);
                formData.append('delicious_recipes_user_login_nonce', nonce);
                formData.append('calling_action', 'delicious_recipes_modal_login');
                fetch(delicious_recipes.ajax_url, {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(response => {
                        if (response.success) {
                            document.querySelectorAll('.dr-recipe-wishlist > span').forEach(function (el) {
                                el.classList.remove('dr-popup-user__registration');
                                el.classList.add('dr-bookmark-wishlist');
                            });
                            if (successMsg) {
                                successMsg.innerHTML = response.data.success;
                                successMsg.style.display = 'block';
                            }
                            location.reload();
                        } else {
                            if (errorMsg) {
                                errorMsg.innerHTML = response.data.error;
                                errorMsg.style.display = 'block';
                            }
                        }
                    })
                    .finally(() => {
                        loginForm.classList.remove('dr-loading');
                    });
            });
        }
    }
    setupLoginModal();
} 