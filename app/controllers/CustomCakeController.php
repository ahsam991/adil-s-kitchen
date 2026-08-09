<?php
/**
 * Custom Cake Controller
 */

class CustomCakeController extends Controller {
    public function create(): void {
        $this->view('customer/custom-cake', [
            'pageTitle' => "Custom Cake Order - {$this->config['app']['name']}",
            'csrfToken' => $this->csrfToken(),
        ]);
    }

    public function store(): void {
        if (!$this->validateCsrfToken($_POST['_csrf_token'] ?? null)) {
            $_SESSION['error'] = 'Invalid form submission. Please try again.';
            $this->redirect('/custom-cake');
        }

        $customCakeModel = new CustomCake();
        $photoPath = null;

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $filename = 'cake_' . time() . '_' . rand(1000, 9999) . '.' . strtolower($ext);
            $uploadDir = __DIR__ . '/../../uploads/cakes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $filename);
            $photoPath = '/uploads/cakes/' . $filename;
        }

        $id = $customCakeModel->create([
            'customer_name' => $this->sanitizeInput($_POST['customer_name'] ?? ''),
            'customer_email' => filter_var($_POST['customer_email'] ?? '', FILTER_SANITIZE_EMAIL),
            'customer_phone' => $this->sanitizeInput($_POST['customer_phone'] ?? ''),
            'shape' => $this->sanitizeInput($_POST['shape'] ?? 'Round'),
            'flavor' => $this->sanitizeInput($_POST['flavor'] ?? 'Vanilla'),
            'weight' => $this->sanitizeInput($_POST['weight'] ?? '1 Kg'),
            'cream_type' => $this->sanitizeInput($_POST['cream_type'] ?? 'Whipped Cream'),
            'decoration' => $this->sanitizeInput($_POST['decoration'] ?? 'Standard'),
            'photo' => $photoPath,
            'occasion' => $this->sanitizeInput($_POST['occasion'] ?? 'Birthday'),
            'cake_message' => $this->sanitizeInput($_POST['cake_message'] ?? ''),
            'delivery_date' => $_POST['delivery_date'] ?? date('Y-m-d', strtotime('+3 days')),
            'budget' => (float)($_POST['budget'] ?? 0),
            'notes' => $this->sanitizeInput($_POST['notes'] ?? ''),
            'status' => 'pending'
        ]);

        $_SESSION['success'] = "Thank you! Your custom cake request #{$id} has been submitted. Our baker will contact you shortly on WhatsApp/Phone.";
        $this->redirect('/custom-cake');
    }
}
