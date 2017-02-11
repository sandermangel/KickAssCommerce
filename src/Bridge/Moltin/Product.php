<?php

namespace KickAss\Commerce\Bridge\Moltin;

use Moltin\SDK\Facade\Product as MoltinProduct;

class Product implements \KickAss\Commerce\Application\ProductInterface
{
    /**
     * @param array $filter
     * @return array
     */
    public function getProductList(array $filter = array())
    {
        return MoltinProduct::Search($filter);
    }
    /**
     * @param int $identifier
     * @return array
     */
    public function getProductItem(int $identifier)
    {
        return MoltinProduct::Get($identifier);
    }
}