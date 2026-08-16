/* ============================================================
   Adil's Signature Kitchen — main.js
   Every feature is guarded: several blocks target legacy markup
   (search overlay, menu popup, gallery, counters) that does not
   exist in the current views. A missing element must never crash
   the script and kill the features below it (e.g. add-to-cart).
   ============================================================ */

/* ── NAVBAR SCROLL & ACTIVE LINK ─────────────────────────────── */
window.addEventListener('scroll', function() {
    var nav = document.getElementById('nav');
    if (nav) nav.classList.toggle('scrolled', window.scrollY > 60);

    var btt = document.getElementById('btt');
    if (btt) btt.classList.toggle('show', window.scrollY > 300);

    document.querySelectorAll('section[id]').forEach(function(sec) {
        var top = sec.offsetTop - 110,
            bot = top + sec.offsetHeight;
        if (window.scrollY >= top && window.scrollY < bot) {
            document.querySelectorAll('.nav-link').forEach(function(l) {
                l.classList.remove('active');
            });
            var lnk = document.querySelector('.nav-link[href="#' + sec.id + '"]');
            if (lnk) lnk.classList.add('active');
        }
    });
});

/* ── BACK TO TOP ────────────────────────────────────────────── */
var btt = document.getElementById('btt');
if (btt) {
    btt.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

/* ── CART BADGE INIT (hydrate count on every page load) ─────── */
(function initCartBadge() {
    var badge = document.getElementById('cart-badge');
    if (!badge) return;
    fetch('/cart/count')
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data && data.success) {
                badge.textContent = data.cart_count;
                badge.style.display = data.cart_count > 0 ? 'inline-flex' : 'none';
            }
        })
        .catch(function() { /* badge stays hidden — non-critical */ });
})();

/* ── SMOOTH SCROLL + MOBILE NAV CLOSE ────────────────────────── */
document.querySelectorAll('a[href^="#"]').forEach(function(a) {
    a.addEventListener('click', function(e) {
        var href = this.getAttribute('href');
        if (href === '#') return;
        var t = document.querySelector(href);
        if (t) {
            e.preventDefault();
            // Close Bootstrap mobile navbar if open
            var navCollapse = document.getElementById('navmenu');
            if (navCollapse && navCollapse.classList.contains('show')) {
                var bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                } else {
                    navCollapse.classList.remove('show');
                }
            }
            // Scroll after slight delay to let navbar close
            setTimeout(function() {
                window.scrollTo({
                    top: t.offsetTop - 78,
                    behavior: 'smooth'
                });
            }, 50);
        }
    });
});


/* ── SEARCH OVERLAY (guarded — markup optional) ──────────────── */
var searchOv = document.getElementById('searchOv');
var searchClose = document.getElementById('searchClose');
var navSearchBtn = document.getElementById('navSearchBtn');
var searchInput = document.getElementById('searchInput');

function closeSearch() {
    if (searchOv) searchOv.classList.remove('open');
    document.body.style.overflow = '';
}

if (navSearchBtn && searchOv && searchClose && searchInput) {
    navSearchBtn.addEventListener('click', function() {
        searchOv.classList.add('open');
        document.body.style.overflow = 'hidden';
        setTimeout(function() {
            searchInput.focus();
        }, 220);
    });

    searchClose.addEventListener('click', closeSearch);

    // Close when clicking backdrop
    searchOv.addEventListener('click', function(e) {
        if (e.target === searchOv) closeSearch();
    });

    // Category buttons inside search box
    document.querySelectorAll('.sovcat').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.sovcat').forEach(function(b) {
                b.classList.remove('active');
            });
            this.classList.add('active');
            var f = this.getAttribute('data-cat');
            closeSearch();
            setTimeout(function() {
                filterMenu(f);
                var menu = document.getElementById('menu');
                if (menu) {
                    menu.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }, 300);
        });
    });

    // Trending tags fill the search input
    document.querySelectorAll('.sovtrend .ttag').forEach(function(t) {
        t.addEventListener('click', function() {
            searchInput.value = this.textContent.trim();
            searchInput.focus();
        });
    });
}


$(document).ready(function() {
    if ($.fn.magnificPopup && $('.magnific_popup').length) {
        $('.magnific_popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false,
            disableOn: 300
        });
    }
});


function filterMenu(cat) {
    // sync filter buttons
    document.querySelectorAll('.filtbtn').forEach(function(b) {
        b.classList.toggle('active', b.getAttribute('data-f') === cat);
    });
    // sync category cards
    document.querySelectorAll('.catcard').forEach(function(c) {
        c.classList.toggle('active', c.getAttribute('data-filter') === cat);
    });
    // show/hide menu cards
    document.querySelectorAll('.mwrap').forEach(function(w) {
        var c = w.getAttribute('data-c');
        if (cat === 'all' || c === cat) {
            w.classList.remove('gone');
            w.style.opacity = '0';
            w.style.transform = 'translateY(16px)';
            setTimeout(function() {
                w.style.transition = 'opacity .38s,transform .38s';
                w.style.opacity = '1';
                w.style.transform = 'translateY(0)';
            }, 60);
        } else {
            w.classList.add('gone');
        }
    });
}

// Filter buttons
document.querySelectorAll('.filtbtn').forEach(function(btn) {
    btn.addEventListener('click', function() {
        filterMenu(this.getAttribute('data-f'));
    });
});

// Category section cards → scroll + filter
document.querySelectorAll('.catcard').forEach(function(card) {
    card.addEventListener('click', function() {
        var f = this.getAttribute('data-filter');
        var menu = document.getElementById('menu');
        if (!menu) return;
        window.scrollTo({
            top: menu.offsetTop - 80,
            behavior: 'smooth'
        });
        setTimeout(function() {
            filterMenu(f);
        }, 480);
    });
});


/* ── MENU POPUP (guarded — markup optional) ──────────────────── */
var menuPop = document.getElementById('menuPop');
var mpQty = 1;

function openMenuPop(card) {
    var img = card.getAttribute('data-img');
    var title = card.getAttribute('data-title');
    var cat = card.getAttribute('data-cat');
    var price = card.getAttribute('data-price');
    var old = card.getAttribute('data-old');
    var rating = parseFloat(card.getAttribute('data-rating'));
    var reviews = card.getAttribute('data-reviews');
    var cal = card.getAttribute('data-cal');
    var time = card.getAttribute('data-time');
    var desc = card.getAttribute('data-desc');
    var tags = card.getAttribute('data-tags') || '';
    var id = card.getAttribute('data-id');

    document.getElementById('mpImg').setAttribute('src', img);
    document.getElementById('mpCat').textContent = cat;
    document.getElementById('mpTitle').textContent = title;

    var full = Math.round(rating),
        empty = 5 - full;
    document.getElementById('mpStars').innerHTML =
        '<i class="fas fa-star"></i>'.repeat(full) + '☆'.repeat(empty) +
        ' <span style="color:#bbb;font-size:.78rem;">' + rating + ' (' + reviews + ' reviews)</span>';

    document.getElementById('mpDesc').textContent = desc;

    document.getElementById('mpPrice').innerHTML =
        price + (old ? '<small style="color:#ccc;text-decoration:line-through;margin-left:8px;font-size:1rem;">' + old + '</small>' : '');

    document.getElementById('mpMeta').innerHTML =
        '<div class="mpm"><div class="mpmv">' + cal + ' kcal</div><div class="mpml">Calories</div></div>' +
        '<div class="mpm"><div class="mpmv">' + time + ' min</div><div class="mpml">Prep Time</div></div>' +
        '<div class="mpm"><div class="mpmv">' + rating + '/5</div><div class="mpml">Rating</div></div>';

    document.getElementById('mpTags').innerHTML =
        tags.split(',').filter(Boolean).map(function(t) {
            return '<span class="mptag">' + t.trim() + '</span>';
        }).join('');

    mpQty = 1;
    document.getElementById('mpQnum').textContent = 1;
    document.getElementById('mpAddCart').innerHTML = '<i class="fas fa-shopping-cart"></i> Add to Cart';
    document.getElementById('mpAddCart').style.background = '';
    document.getElementById('mpAddCart').setAttribute('data-product-id', id);

    menuPop.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeMenuPop() {
    if (menuPop) menuPop.classList.remove('open');
    document.body.style.overflow = '';
}

if (menuPop) {
    // Card click open popup
    document.querySelectorAll('.mcard').forEach(function(card) {
        card.addEventListener('click', function() {
            openMenuPop(this);
        });
    });

    // + button open popup (stop propagation to avoid double firing)
    document.querySelectorAll('.madd').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            openMenuPop(this.closest('.mcard'));
        });
    });

    // Heart toggle (no popup)
    document.querySelectorAll('.mhrt').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            var ico = this.querySelector('i');
            ico.classList.toggle('far');
            ico.classList.toggle('fas');
            this.style.color = ico.classList.contains('fas') ? 'var(--primary)' : '#ccc';
        });
    });

    // Close popup
    var mpClose = document.getElementById('mpClose');
    if (mpClose) mpClose.addEventListener('click', closeMenuPop);
    menuPop.addEventListener('click', function(e) {
        if (e.target === this) closeMenuPop();
    });

    // Qty +/-
    var mpPlus = document.getElementById('mpPlus');
    var mpMinus = document.getElementById('mpMinus');
    var mpQnum = document.getElementById('mpQnum');
    if (mpPlus) {
        mpPlus.addEventListener('click', function() {
            mpQty++;
            if (mpQnum) mpQnum.textContent = mpQty;
        });
    }
    if (mpMinus) {
        mpMinus.addEventListener('click', function() {
            if (mpQty > 1) mpQty--;
            if (mpQnum) mpQnum.textContent = mpQty;
        });
    }
}

function addToCart(productId, quantity, btn) {
    if (!productId) return;

    var originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    btn.disabled = true;

    var formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);

    fetch('/cart/add', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            btn.innerHTML = '<i class="fas fa-check"></i> Added to Cart!';
            btn.style.background = 'linear-gradient(135deg,var(--green),#1a4a35)';
            btn.style.color = '#fff';

            // Update cart badge
            var badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = data.cart_count;
                badge.style.display = data.cart_count > 0 ? 'inline-flex' : 'none';
            }
            // Fallback for old templates
            var cartCount = document.getElementById('cartCount');
            if (cartCount) cartCount.textContent = data.cart_count;

            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.style.background = '';
                btn.style.color = '';
                btn.disabled = false;
                if (btn.id === 'mpAddCart') closeMenuPop();
            }, 1000);
        } else {
            alert(data.message || 'Error adding to cart');
            btn.innerHTML = originalText;
            btn.disabled = false;
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error while adding to cart');
        btn.innerHTML = originalText;
        btn.disabled = false;
    });
}

// Read quantity from a nearby number input (product details page), else 1
function readQty(btn) {
    var form = btn.closest('form');
    if (!form) return 1;
    var input = form.querySelector('input[type="number"]');
    if (!input) return 1;
    var qty = parseInt(input.value, 10);
    return !isNaN(qty) && qty > 0 ? qty : 1;
}

// Global click delegation for all add-to-cart buttons
// (product-details buttons pick up the page's quantity input)
document.addEventListener('click', function(e) {
    var addBtn = e.target.closest('.btn-add-cart');
    if (addBtn) {
        e.preventDefault();
        e.stopPropagation();
        var productId = addBtn.getAttribute('data-product-id');
        addToCart(productId, readQty(addBtn), addBtn);
    }
});

// Direct Buy — add to cart, then go straight to checkout (guest checkout allowed)
function buyNow(productId, quantity) {
    if (!productId) return;
    var formData = new FormData();
    formData.append('product_id', productId);
    formData.append('quantity', quantity);
    fetch('/cart/add', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            var badge = document.getElementById('cart-badge');
            if (badge) {
                badge.textContent = data.cart_count;
                badge.style.display = data.cart_count > 0 ? 'inline-flex' : 'none';
            }
            window.location.href = '/checkout';
        } else {
            alert(data.message || 'Error adding to cart');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Server error while adding to cart');
    });
}

// Buy Now buttons (product cards + product details)
document.addEventListener('click', function(e) {
    var btn = e.target.closest('.btn-buy-now');
    if (btn) {
        e.preventDefault();
        e.stopPropagation();
        buyNow(btn.getAttribute('data-product-id'), readQty(btn));
    }
});

// Cart quantity update (cart page)
document.querySelectorAll('.cart-qty-input').forEach(function(input) {
    input.addEventListener('change', function() {
        var itemId = this.getAttribute('data-cart-item-id');
        var qty = parseInt(this.value, 10);
        if (!itemId || isNaN(qty) || qty < 1) {
            this.value = 1;
            return;
        }
        var formData = new FormData();
        formData.append('cart_item_id', itemId);
        formData.append('quantity', qty);
        fetch('/cart/update', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) window.location.reload();
            else alert(data.message || 'Could not update quantity');
        })
        .catch(err => {
            console.error(err);
            alert('Could not update quantity');
        });
    });
});

// Add to cart button (Popup)
var mpAddCartBtn = document.getElementById('mpAddCart');
if (mpAddCartBtn) {
    mpAddCartBtn.addEventListener('click', function(e) {
        e.preventDefault();
        var productId = this.getAttribute('data-product-id');
        if (!productId) {
            alert("No product ID found in popup");
            return;
        }
        addToCart(productId, mpQty, this);
    });
}


/* ── RESERVATION / CONTACT buttons (guarded) ─────────────────── */
var resBtn = document.getElementById('resBtn');
if (resBtn) {
    resBtn.addEventListener('click', function() {
        var btn = this;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Booking...';
        btn.disabled = true;
        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-calendar-check"></i> Confirm Reservation';
            btn.disabled = false;
            var ok = document.getElementById('resOk');
            if (ok) {
                ok.style.display = 'block';
                ok.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }, 1500);
    });
}

var ctcBtn = document.getElementById('ctcBtn');
if (ctcBtn) {
    ctcBtn.addEventListener('click', function() {
        var btn = this;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        btn.disabled = true;
        setTimeout(function() {
            btn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
            btn.disabled = false;
            var ok = document.getElementById('ctcOk');
            if (ok) {
                ok.style.display = 'block';
                ok.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }, 1500);
    });
}


/* ── GALLERY POPUP (guarded) ─────────────────────────────────── */
var galPop = document.getElementById('galPop');
var galData = [];
var galIdx = 0;

function openGal(i) {
    if (!galPop) return;
    galIdx = i;
    var g = galData[i];
    document.getElementById('gpImg').setAttribute('src', g.img);
    document.getElementById('gpTitle').textContent = g.title;
    document.getElementById('gpDesc').innerHTML = g.desc;
    galPop.classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeGal() {
    if (galPop) galPop.classList.remove('open');
    document.body.style.overflow = '';
}

if (galPop) {
    document.querySelectorAll('.gitem').forEach(function(item) {
        galData.push({
            img: item.getAttribute('data-gimg'),
            title: item.getAttribute('data-gtitle'),
            desc: item.getAttribute('data-gdesc')
        });
        item.addEventListener('click', function() {
            openGal(parseInt(this.getAttribute('data-gi')));
        });
    });

    var gpClose = document.getElementById('gpClose');
    if (gpClose) gpClose.addEventListener('click', closeGal);
    galPop.addEventListener('click', function(e) {
        if (e.target === this) closeGal();
    });

    var gpPrev = document.getElementById('gpPrev');
    var gpNext = document.getElementById('gpNext');
    if (gpPrev) {
        gpPrev.addEventListener('click', function() {
            openGal((galIdx - 1 + galData.length) % galData.length);
        });
    }
    if (gpNext) {
        gpNext.addEventListener('click', function() {
            openGal((galIdx + 1) % galData.length);
        });
    }
}

/*  ESC key closes everything */
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSearch();
        closeMenuPop();
        closeGal();
        if (typeof $.magnificPopup !== 'undefined') $.magnificPopup.close();
    }
});


/* ── TESTIMONIALS SWIPER (guarded) ───────────────────────────── */
if (document.querySelector('.tesSwiper') && typeof Swiper !== 'undefined') {
    new Swiper('.tesSwiper', {
        slidesPerView: 1,
        spaceBetween: 22,
        loop: true,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
        breakpoints: {
            640: { slidesPerView: 2 },
            1024: { slidesPerView: 3 }
        }
    });
}


/* ── COUNTDOWN (guarded — decorative) ────────────────────────── */
var cdH = document.getElementById('cdH');
if (cdH) {
    var cdM = document.getElementById('cdM');
    var cdS = document.getElementById('cdS');
    var cH = 8, cM = 45, cS = 30;
    setInterval(function() {
        cS--;
        if (cS < 0) { cS = 59; cM--; }
        if (cM < 0) { cM = 59; cH--; }
        if (cH < 0) { cH = 8; cM = 45; cS = 30; }
        if (cdH) cdH.textContent = String(cH).padStart(2, '0');
        if (cdM) cdM.textContent = String(cM).padStart(2, '0');
        if (cdS) cdS.textContent = String(cS).padStart(2, '0');
    }, 1000);
}


/* ── NEWSLETTER (guarded) ────────────────────────────────────── */
var nlBtn = document.getElementById('nlBtn');
if (nlBtn) {
    nlBtn.addEventListener('click', function() {
        var email = document.getElementById('nlEmail');
        if (email && email.value && email.value.includes('@')) {
            var btn = this;
            btn.textContent = '✓ Subscribed!';
            btn.style.background = '#4ade80';
            btn.style.color = '#222';
            email.value = '';
            setTimeout(function() {
                btn.textContent = 'Subscribe';
                btn.style.background = '';
                btn.style.color = '';
            }, 3000);
        }
    });
}

/*  NUMBER COUNTER ANIMATION — counts up [data-count] stats when the hero leaves view */
var numAnimated = false;
window.addEventListener('scroll', function() {
    var hero = document.getElementById('hero');
    if (!numAnimated && hero && window.scrollY > hero.offsetHeight - 300) {
        numAnimated = true;
        document.querySelectorAll('[data-count]').forEach(function(el) {
            var target = parseFloat(el.getAttribute('data-count'));
            var decimals = parseInt(el.getAttribute('data-decimals') || '0', 10);
            var suffix = el.getAttribute('data-suffix') || '';
            if (isNaN(target)) return;
            var dur = 1400;
            var t0 = null;
            function frame(ts) {
                if (!t0) t0 = ts;
                var p = Math.min((ts - t0) / dur, 1);
                var eased = 1 - Math.pow(1 - p, 3); // ease-out cubic
                el.textContent = (target * eased).toFixed(decimals) + suffix;
                if (p < 1) requestAnimationFrame(frame);
            }
            requestAnimationFrame(frame);
        });
    }
});
