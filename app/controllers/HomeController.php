<?php
/**
 * Home Controller
 */

class HomeController extends Controller {

    public function index(): void {
        $db = Database::getInstance();

        // Get categories
        $categories = $db->fetchAll(
            "SELECT * FROM categories WHERE deleted_at IS NULL AND is_active = 1 ORDER BY sort_order ASC"
        );
        if (empty($categories)) {
            $categories = [
                ['id' => 1, 'name' => 'Cake', 'slug' => 'cake', 'image' => '/assets/images/categories/cake.jpg'],
                ['id' => 2, 'name' => 'Cup Cake', 'slug' => 'cup-cake', 'image' => '/assets/images/categories/cupcake.jpg'],
                ['id' => 3, 'name' => 'Tub Cake', 'slug' => 'tub-cake', 'image' => '/assets/images/categories/tubcake.jpg'],
                ['id' => 4, 'name' => 'Dream Cake', 'slug' => 'dream-cake', 'image' => '/assets/images/categories/dreamcake.jpg'],
                ['id' => 5, 'name' => 'Burger', 'slug' => 'burger', 'image' => '/assets/images/categories/burger.jpg'],
                ['id' => 6, 'name' => 'Roll', 'slug' => 'roll', 'image' => '/assets/images/categories/roll.jpg'],
                ['id' => 7, 'name' => 'Samusa', 'slug' => 'samusa', 'image' => '/assets/images/categories/samusa.jpg'],
            ];
        }

        // Get featured products
        $featuredProducts = $db->fetchAll(
            "SELECT p.*, c.name as category_name, c.slug as category_slug
             FROM products p
             LEFT JOIN categories c ON p.category_id = c.id
             WHERE p.featured = 1 AND p.status = 'active' AND p.deleted_at IS NULL
             ORDER BY p.created_at DESC LIMIT 8"
        );
        if (empty($featuredProducts)) {
            $featuredProducts = [
                [
                    'id' => 1,
                    'name' => 'Royal Chocolate Fudge Cake',
                    'slug' => 'royal-chocolate-fudge-cake',
                    'category_name' => 'Cake',
                    'price' => 1200.00,
                    'sale_price' => 1100.00,
                    'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=400&auto=format&fit=crop',
                    'best_seller' => 1
                ],
                [
                    'id' => 2,
                    'name' => '5-Layer Belgian Chocolate Dream Cake',
                    'slug' => '5-layer-belgian-chocolate-dream-cake',
                    'category_name' => 'Dream Cake',
                    'price' => 950.00,
                    'sale_price' => 890.00,
                    'image' => 'https://images.unsplash.com/photo-1535141192574-5d4897c13136?w=400&auto=format&fit=crop',
                    'best_seller' => 1
                ],
                [
                    'id' => 3,
                    'name' => 'Red Velvet Cream Cheese Cupcake (6 Pcs)',
                    'slug' => 'red-velvet-cream-cheese-cupcake-6-pcs',
                    'category_name' => 'Cup Cake',
                    'price' => 450.00,
                    'sale_price' => 420.00,
                    'image' => 'https://images.unsplash.com/photo-1550617931-e17a7b70dce2?w=400&auto=format&fit=crop',
                    'best_seller' => 1
                ],
                [
                    'id' => 4,
                    'name' => 'Special Loaded Chicken Burger',
                    'slug' => 'special-loaded-chicken-burger',
                    'category_name' => 'Burger',
                    'price' => 220.00,
                    'sale_price' => null,
                    'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&auto=format&fit=crop',
                    'best_seller' => 0
                ]
            ];
        }

        $this->view('customer/home', [
            'featuredProducts' => $featuredProducts,
            'categories' => $categories,
            'pageTitle' => "Home - {$this->config['app']['name']}",
        ]);
    }

    public function about(): void {
        $this->view('customer/about', [
            'pageTitle' => 'About Us - ' . $this->config['app']['name'],
        ]);
    }

    public function testimonials(): void {
        $db = Database::getInstance();
        $testimonials = $db->fetchAll(
            "SELECT * FROM testimonials WHERE status = 'approved' AND deleted_at IS NULL ORDER BY created_at DESC"
        );
        if (empty($testimonials)) {
            $testimonials = [
                ['name' => 'Nusrat Jahan', 'role' => 'Verified Customer', 'comment' => 'The Dream Cake from Adil\'s Signature Kitchen was mind blowing! So rich and fresh. 10/10 recommend!', 'rating' => 5],
                ['name' => 'Tanvir Ahmed', 'role' => 'Regular Buyer', 'comment' => 'Ordered a custom cake for my daughter\'s birthday. It was beautifully crafted and tasted delicious.', 'rating' => 5],
                ['name' => 'Farhana Islam', 'role' => 'Foodie', 'comment' => 'Best homemade samusa and burgers in Dhaka. Super hygienic and crispy!', 'rating' => 5],
            ];
        }

        $this->view('customer/testimonials', [
            'testimonials' => $testimonials,
            'pageTitle' => 'Customer Reviews - ' . $this->config['app']['name'],
        ]);
    }

    public function faq(): void {
        $faqs = [
            ['question' => 'How do I place an order?', 'answer' => 'Browse our shop menu or order custom cakes using our Custom Cake Designer.'],
            ['question' => 'What are your delivery charges?', 'answer' => 'We charge a flat delivery fee of ৳60. Free delivery for orders above ৳1500.'],
            ['question' => 'How far in advance should I order custom cakes?', 'answer' => 'Please submit custom cake requests at least 2-3 days in advance.'],
            ['question' => 'Is your food halal?', 'answer' => 'Yes, 100% halal ingredients prepared under strict hygiene.'],
        ];

        $this->view('customer/faq', [
            'faqs' => $faqs,
            'pageTitle' => 'FAQ - ' . $this->config['app']['name'],
        ]);
    }
}
