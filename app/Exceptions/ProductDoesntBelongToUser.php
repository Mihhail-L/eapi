<?php

namespace App\Exceptions;

use Exception;

class ProductDoesntBelongToUser extends Exception
{
    public function render() {
        return ['errors' => 'Product Doens\'t belong to user'];
    }
}
