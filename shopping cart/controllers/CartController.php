<?php
/**
 * Created by PhpStorm.
 * User: Yuchen Yao
 * Date: 23/01/2019
 * Time: 2:36 PM
 */

namespace app\controllers;
session_start();

class CartController
{
    protected $cart_contents = array();

    function _construct()
    {
        $this->cart_contents = !empty($_SESSION['cart_contents']) ? $_SESSION['cart_contents'] : NULL;
        if ($this->cart_contents === NULL) {
            $this->cart_contents = array(
                'cart_total' => 0,
                'total_items' => 0
            );
        }
    }

    /*
     * Cart contents: Return the entire cart array
     * @param bool
     * @return array
     */
    function contents()
    {
        //rearrange the first item
        $cart = array_reverse($this->cart_contents);
        unset($cart['cart_total']);
        unset($cart['total_items']);
        return $cart;
    }

    /*
     * Get Cart Items: Returns a specific cart item details
     * @param string $row_id
     * @return array
     */
    function getItem($row_id)
    {
        return (in_array($row_id, array('total_items', 'cart_total'), TRUE)
            OR !isset($this->cart_contents[$row_id])) ? FALSE : $this->cart_contents[$row_id];
    }

}