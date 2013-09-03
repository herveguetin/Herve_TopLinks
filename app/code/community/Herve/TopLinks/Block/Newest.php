<?php
/**
 * @category    Herve
 * @package     Herve_TopLinks
 * @copyright   Copyright (c) 2013 Hervé Guétin (http://www.herveguetin.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Herve_TopLinks_Block_Newest extends Mage_Core_Block_Template {

    /**
     * Add a link with the newest product added to the catalog
     *
     * @return Herve_TopLinks_Block_Newest
     */
    public function addBuyNewestLink()
    {
        $parentBlock = $this->getParentBlock();

        $collection = Mage::getResourceModel('catalog/product_collection');
        Mage::getModel('catalog/layer')->prepareProductCollection($collection);
        $collection->setOrder('created_at')
            ->addStoreFilter()
            ->setPageSize(1);

        $newestProduct = $collection->getFirstItem();
        $label = $this->__("Add '%s' to cart now!", $newestProduct->getName());

        $parentBlock->addLink($label, 'checkout/cart/add', $label, true, array('product' => $newestProduct->getId()), 1000);
        return $this;
    }
}