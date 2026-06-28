<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.ajax-add-to-cart').forEach(function (form) {
            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                const button = form.querySelector('button[type="submit"]');
                const originalHtml = button ? button.innerHTML : '';
                const productCard = form.closest('.product-card');
                const productImage = productCard ? productCard.querySelector('.product-image') : null;

                if (button) {
                    button.disabled = true;
                    button.innerHTML = 'Adding...';
                }

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    });

                    let data = {};

                    try {
                        data = await response.json();
                    } catch (jsonError) {
                        data = {
                            success: false,
                            message: 'Something went wrong. Please try again.',
                        };
                    }

                    if (! response.ok) {
                        showCartMessage(data.message || 'Something went wrong.', 'error');
                    } else {
                        flyProductToCart(productImage);

                        setTimeout(function () {
                            showCartMessage(data.message || 'Product added to cart.', 'success');

                            if (typeof data.cart_count !== 'undefined') {
                                document.querySelectorAll('[data-cart-count]').forEach(function (badge) {
                                    badge.innerText = data.cart_count;

                                    if (Number(data.cart_count) > 0) {
                                        badge.classList.remove('hidden');
                                    }
                                });
                            }
                        }, 650);
                    }
                } catch (error) {
                    showCartMessage('Something went wrong. Please try again.', 'error');
                }

                setTimeout(function () {
                    if (button) {
                        button.disabled = false;
                        button.innerHTML = originalHtml;
                    }
                }, 750);
            });
        });

        function getVisibleCartIcon() {
            const icons = document.querySelectorAll('[data-cart-icon]');

            for (const icon of icons) {
                const rect = icon.getBoundingClientRect();

                if (rect.width > 0 && rect.height > 0) {
                    return icon;
                }
            }

            return null;
        }

        function flyProductToCart(productImage) {
            const cartIcon = getVisibleCartIcon();

            if (! productImage || ! cartIcon) {
                return;
            }

            const imageRect = productImage.getBoundingClientRect();
            const cartRect = cartIcon.getBoundingClientRect();

            const flyingImage = productImage.cloneNode(true);

            flyingImage.style.position = 'fixed';
            flyingImage.style.left = imageRect.left + 'px';
            flyingImage.style.top = imageRect.top + 'px';
            flyingImage.style.width = imageRect.width + 'px';
            flyingImage.style.height = imageRect.height + 'px';
            flyingImage.style.objectFit = 'cover';
            flyingImage.style.borderRadius = '20px';
            flyingImage.style.zIndex = '99999';
            flyingImage.style.pointerEvents = 'none';
            flyingImage.style.boxShadow = '0 20px 60px rgba(47, 42, 38, 0.25)';
            flyingImage.style.transition = 'all 0.75s cubic-bezier(.22,.8,.25,1)';

            document.body.appendChild(flyingImage);

            requestAnimationFrame(function () {
                flyingImage.style.left = cartRect.left + cartRect.width / 2 - 18 + 'px';
                flyingImage.style.top = cartRect.top + cartRect.height / 2 - 18 + 'px';
                flyingImage.style.width = '36px';
                flyingImage.style.height = '36px';
                flyingImage.style.opacity = '0.15';
                flyingImage.style.transform = 'rotate(12deg) scale(0.4)';
                flyingImage.style.borderRadius = '9999px';
            });

            setTimeout(function () {
                flyingImage.remove();
                pulseCartIcon(cartIcon);
            }, 780);
        }

        function pulseCartIcon(cartIcon) {
            cartIcon.style.transform = 'scale(1.15)';
            cartIcon.style.transition = 'transform 0.2s ease';

            setTimeout(function () {
                cartIcon.style.transform = 'scale(1)';
            }, 200);
        }

        function showCartMessage(message, type) {
            let box = document.getElementById('cart-message-box');

            if (! box) {
                box = document.createElement('div');
                box.id = 'cart-message-box';
                document.body.appendChild(box);
            }

            box.innerText = message;

            if (type === 'success') {
                box.className = 'fixed top-20 md:top-24 left-4 right-4 md:left-auto md:right-4 z-[9999] px-5 py-4 shadow-lg text-sm font-semibold text-center md:text-left transition bg-[#2f9ea0] text-white';
            } else {
                box.className = 'fixed top-20 md:top-24 left-4 right-4 md:left-auto md:right-4 z-[9999] px-5 py-4 shadow-lg text-sm font-semibold text-center md:text-left transition bg-red-600 text-white';
            }

            box.style.display = 'block';

            setTimeout(function () {
                box.style.display = 'none';
            }, 2200);
        }
    });
</script>