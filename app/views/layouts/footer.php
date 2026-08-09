<!-- FOOTER -->
<footer id="footer" style="background:#111; color:#aaa; padding-top:60px; padding-bottom:30px;">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="blogo mb-3">
                    <div class="bico" style="background:var(--primary);color:#fff;"><i class="fas fa-birthday-cake"></i></div>
                    <div>
                        <div class="bname text-white">Adil's <span style="color:var(--secondary);">Kitchen</span></div>
                        <div class="bsub text-white-50">Homemade Bakery & Fast Food</div>
                    </div>
                </div>
                <p class="text-white-50 small">Handcrafted celebration cakes, 5-layer dream cakes, soft cupcakes, crispy chicken rolls, burgers and savory samusas prepared fresh daily with pure love.</p>
                <div class="tsoc mt-3">
                    <a href="https://facebook.com/adilskitchen" target="_blank" class="text-white me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/adilskitchen" target="_blank" class="text-white me-2"><i class="fab fa-instagram"></i></a>
                    <a href="https://wa.me/8801303721109" target="_blank" class="text-white me-2"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <h5 class="text-white brand-font mb-3">Quick Links</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/shop" class="text-white-50">Shop Menu</a></li>
                    <li class="mb-2"><a href="/custom-cake" class="text-white-50">Custom Cake Order</a></li>
                    <li class="mb-2"><a href="/gallery" class="text-white-50">Photo Gallery</a></li>
                    <li class="mb-2"><a href="/blog" class="text-white-50">Bakery Blog</a></li>
                    <li class="mb-2"><a href="/testimonials" class="text-white-50">Customer Reviews</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="text-white brand-font mb-3">Our Signature Menu</h5>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/shop?category=1" class="text-white-50">Birthday & Celebration Cakes</a></li>
                    <li class="mb-2"><a href="/shop?category=2" class="text-white-50">Frosted Cup Cakes</a></li>
                    <li class="mb-2"><a href="/shop?category=3" class="text-white-50">Mango & Chocolate Tub Cakes</a></li>
                    <li class="mb-2"><a href="/shop?category=4" class="text-white-50">5-Layer Belgian Dream Cake</a></li>
                    <li class="mb-2"><a href="/shop?category=5" class="text-white-50">Burgers, Rolls & Samusa</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h5 class="text-white brand-font mb-3">Contact & Order</h5>
                <p class="mb-2 small"><i class="fas fa-phone-alt text-warning me-2"></i> 01303721109</p>
                <p class="mb-2 small"><i class="fab fa-whatsapp text-success me-2"></i> 01303721109 (WhatsApp)</p>
                <p class="mb-2 small"><i class="fas fa-envelope text-warning me-2"></i> info@adilskitchen.com</p>
                <p class="mb-0 small"><i class="fas fa-map-marker-alt text-danger me-2"></i> Dhaka, Bangladesh</p>
            </div>
        </div>

        <div class="border-top border-secondary mt-5 pt-3 text-center small text-white-50">
            <p class="mb-0">&copy; <?= date('Y') ?> Adil's Signature Kitchen. All Rights Reserved. "Homemade With Love"</p>
        </div>
    </div>
</footer>

<!-- JS Vendor Scripts -->
<script src="/assets/js/jquery-3.7.1.min.js"></script>
<script src="/assets/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/aos.js"></script>
<script src="/assets/js/swiper-bundle.min.js"></script>
<script src="/assets/js/jquery.magnific-popup.min.js"></script>
<script src="/assets/js/main.js"></script>

<script>
    // Initialize AOS Animate On Scroll
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }

    // Initialize Magnific Popup if exists
    if ($.fn.magnificPopup) {
        $('.popup-youtube, .magnific_popup').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }
</script>

</body>
</html>
