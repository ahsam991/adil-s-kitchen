<?php
/**
 * Unit Test for CartService
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class CartServiceTest extends TestCase
{
    private $cartService;

    protected function setUp(): void
    {
        // Mock the Cart model dependency
        $this->cartService = new \CartService();
    }

    /**
     * Test getCartTotal with empty items
     */
    public function testGetCartTotalWithEmptyItems(): float
    {
        $items = [];
        $total = $this->cartService->getCartTotal($items);
        $this->assertEquals(0.00, $total);
        return $total;
    }

    /**
     * Test getCartTotal with single item at regular price
     */
    public function testGetCartTotalWithSingleItemRegularPrice(): void
    {
        $items = [
            [
                'price' => 50.00,
                'sale_price' => null,
                'quantity' => 1
            ]
        ];
        $total = $this->cartService->getCartTotal($items);
        $this->assertEquals(50.00, $total);
    }

    /**
     * Test getCartTotal with sale price
     */
    public function testGetCartTotalWithSalePrice(): void
    {
        $items = [
            [
                'price' => 50.00,
                'sale_price' => 40.00,
                'quantity' => 1
            ]
        ];
        $total = $this->cartService->getCartTotal($items);
        $this->assertEquals(40.00, $total);
    }

    /**
     * Test getCartTotal with multiple items
     */
    public function testGetCartTotalWithMultipleItems(): void
    {
        $items = [
            [
                'price' => 50.00,
                'sale_price' => null,
                'quantity' => 2
            ],
            [
                'price' => 30.00,
                'sale_price' => 25.00,
                'quantity' => 1
            ]
        ];
        $total = $this->cartService->getCartTotal($items);
        // (50 * 2) + (25 * 1) = 125
        $this->assertEquals(125.00, $total);
    }

    /**
     * Test getCartTotal with zero sale_price should use regular price
     */
    public function testGetCartTotalWithZeroSalePrice(): void
    {
        $items = [
            [
                'price' => 50.00,
                'sale_price' => 0,
                'quantity' => 1
            ]
        ];
        $total = $this->cartService->getCartTotal($items);
        $this->assertEquals(50.00, $total);
    }
}
