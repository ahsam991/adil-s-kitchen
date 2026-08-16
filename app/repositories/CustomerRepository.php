<?php
/**
 * Customer Repository
 */

class CustomerRepository {
    private $customerModel;

    public function __construct() {
        $this->customerModel = new Customer();
    }
}
