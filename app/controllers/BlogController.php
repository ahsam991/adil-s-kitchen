<?php
/**
 * Blog Controller
 */

class BlogController extends Controller {
    public function index(): void {
        $blogModel = new Blog();
        $blogs = $blogModel->findAll(['status' => 'published'], 'published_at DESC');

        $this->view('customer/blog', [
            'blogs' => $blogs,
            'pageTitle' => "Bakery Blog & Recipes - {$this->config['app']['name']}",
        ]);
    }

    public function show(string $slug): void {
        $blogModel = new Blog();
        $blog = $blogModel->findBySlug($slug);

        if (!$blog) {
            $this->redirect('/blog');
        }

        $this->view('customer/blog-details', [
            'blog' => $blog,
            'pageTitle' => "{$blog['title']} - {$this->config['app']['name']}",
        ]);
    }
}
