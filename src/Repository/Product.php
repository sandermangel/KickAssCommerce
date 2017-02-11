<?php

namespace KickAss\Commerce\Repository;

class Product implements ProductInterface
{
    /**
     * @var \KickAss\Commerce\Application\ProductInterface
     */
    private $product;

    /**
     * @var \Symfony\Component\Serializer\Normalizer\ObjectNormalizer
     */
    private $normalizer;

    public function __construct(
        \KickAss\Commerce\Application\ProductInterface $product,
        \Symfony\Component\Serializer\Normalizer\ObjectNormalizer $normalizer
    ) {
        $this->product = $product;
        $this->normalizer = $normalizer;
    }

    /**
     * @param int $id
     * @return \KickAss\Commerce\Map\Product
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function load($id)
    {
        $productInfo = $this->product->getProductItem($id);
        return $this->normalizer->denormalize($productInfo['result'], \KickAss\Commerce\Map\Product::class);
    }

    /**
     * @param array $filters
     * @return \KickAss\Commerce\Map\Product[]
     */
    /**
     * @param array $filters
     * @return \KickAss\Commerce\Map\Product[]
     * @throws \Symfony\Component\Serializer\Exception\UnexpectedValueException
     */
    public function search(array $filters = array())
    {
        $productInfo = $this->product->getProductList($filters);
        $products = [];
        foreach ($productInfo['result'] as $product) {
            $products[] = $this->normalizer->denormalize($product, \KickAss\Commerce\Map\Product::class);
        }
        return $products;
    }
}