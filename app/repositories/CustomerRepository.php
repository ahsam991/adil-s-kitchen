<?php
/**
 * Customer Repository
 */

class CustomerRepository {
    private Customer $customerModel;

    public function __construct() {
        $this->customerModel = new Customer();
    }
}
