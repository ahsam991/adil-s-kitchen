<?php
/**
 * Dynamic XML Sitemap Generator
 * Adil's Signature Kitchen
 * URL: /sitemap.xml
 */

// ── Bootstrap (constants defined in index.php) ────────────────────────────────
if (!defined('BASE_PATH')) {
    define('BASE_PATH',    dirname(__DIR__));
    define('APP_PATH',     BASE_PATH . '/app');
    define('CONFIG_PATH',  BASE_PATH . '/config');
    define('STORAGE_PATH', BASE_PATH . '/storage');
}

// ── Load DB class ─────────────────────────────────────────────────────────────
if (!class_exists('Database')) {
    require APP_PATH . '/core/Database.php';
}

$baseUrl  = 'https://adilskitchen.com';
$today    = date('Y-m-d');
$db       = Database::getInstance();

header('Content-Type: application/xml; charset=utf-8');

// Fetch dynamic data
$products   = $db->fetchAll("SELECT slug, updated_at FROM products WHERE status='active' AND deleted_at IS NULL");
$categories = $db->fetchAll("SELECT slug, updated_at FROM categories WHERE is_active=1 AND deleted_at IS NULL");
$blogs      = $db->fetchAll("SELECT slug, updated_at FROM blog_posts WHERE status='published' AND deleted_at IS NULL");

// Static pages
$staticPages = [
    ['loc' => '/',              'priority' => '1.0', 'changefreq' => 'daily'],
    ['loc' => '/shop',         'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/custom-cake',  'priority' => '0.9', 'changefreq' => 'weekly'],
    ['loc' => '/gallery',      'priority' => '0.8', 'changefreq' => 'weekly'],
    ['loc' => '/blog',         'priority' => '0.8', 'changefreq' => 'daily'],
    ['loc' => '/testimonials', 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['loc' => '/about',        'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/contact',      'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/faq',          'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/order-tracking','priority' => '0.5', 'changefreq' => 'monthly'],
];

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

<?php foreach ($staticPages as $page): ?>
  <url>
    <loc><?= $baseUrl . $page['loc'] ?></loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq><?= $page['changefreq'] ?></changefreq>
    <priority><?= $page['priority'] ?></priority>
  </url>
<?php endforeach; ?>

<?php foreach ($categories as $cat): ?>
  <url>
    <loc><?= $baseUrl . '/category/' . htmlspecialchars($cat['slug']) ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($cat['updated_at'] ?? 'now')) ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>

<?php foreach ($products as $p): ?>
  <url>
    <loc><?= $baseUrl . '/product/' . htmlspecialchars($p['slug']) ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($p['updated_at'] ?? 'now')) ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.9</priority>
  </url>
<?php endforeach; ?>

<?php foreach ($blogs as $b): ?>
  <url>
    <loc><?= $baseUrl . '/blog/' . htmlspecialchars($b['slug']) ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($b['updated_at'] ?? 'now')) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
<?php endforeach; ?>

</urlset>
