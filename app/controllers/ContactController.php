<?php
/**
 * Contact Controller
 */

class ContactController extends Controller {
    public function create(): void {
        $this->view('customer/contact', [
            'pageTitle' => "Contact Us - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        if (!$this->validateCsrfToken($_POST['_csrf_token'] ?? null)) {
            $_SESSION['error'] = 'Form validation failed.';
            $this->redirect('/contact');
        }

        $contactModel = new ContactMessage();
        $contactModel->create([
            'name' => $this->sanitizeInput($_POST['name'] ?? ''),
            'email' => filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL),
            'phone' => $this->sanitizeInput($_POST['phone'] ?? ''),
            'subject' => $this->sanitizeInput($_POST['subject'] ?? ''),
            'message' => $this->sanitizeInput($_POST['message'] ?? ''),
            'status' => 'unread'
        ]);

        $_SESSION['success'] = 'Thank you for reaching out! We will reply to your message shortly.';
        $this->redirect('/contact');
    }
}
