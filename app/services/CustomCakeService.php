<?php
/**
 * Custom Cake Service
 */

class CustomCakeService {
    private $customCakeModel;

    public function __construct() {
        $this->customCakeModel = new CustomCake();
    }
}
