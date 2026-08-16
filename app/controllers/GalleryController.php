<?php
/**
 * Gallery Controller
 */

class GalleryController extends Controller {
    public function index(): void {
        $galleryModel = new Gallery();
        $items = $galleryModel->findAll(['is_active' => 1], 'sort_order ASC, created_at DESC');

        $this->view('customer/gallery', [
            'galleryItems' => $items,
            'pageTitle' => "Photo Gallery - {$this->config['app']['name']}",
        ]);
    }
}
