<?php
/**
 * Custom Cake Service
 */

class CustomCakeService {
    private CustomCake $customCakeModel;

    public function __construct() {
        $this->customCakeModel = new CustomCake();
    }
}
