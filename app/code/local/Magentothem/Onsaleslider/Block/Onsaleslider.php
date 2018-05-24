<?php
class Magentothem_Onsaleslider_Block_Onsaleslider extends Mage_Catalog_Block_Product_Abstract
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getOnsaleslider()     
     { 
        if (!$this->hasData('onsaleslider')) {
            $this->setData('onsaleslider', Mage::registry('onsaleslider'));
        }
        return $this->getData('onsaleslider');
        
    }
	public function getProducts()
    {
		$todayDate  = Mage::app()->getLocale()->date()->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
	$storeId    = Mage::app()->getStore()->getId();
		$products = Mage::getResourceModel('catalog/product_collection')
			->addAttributeToSelect(Mage::getSingleton('catalog/config')->getProductAttributes())
			->addMinimalPrice()
			->addUrlRewrite()
			->addTaxPercents()			
			->addStoreFilter()
			->addAttributeToFilter('special_to_date', array('date'=>true, 'from'=> $todayDate));
			
        Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($products);
        Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($products);
        $products->setPageSize($this->getConfig('qty'))->setCurPage(1);
        $this->setProductCollection($products);
    }
	public function getConfig($att) 
	{
		$config = Mage::getStoreConfig('onsaleslider');
		if (isset($config['onsaleslider_config']) ) {
			$value = $config['onsaleslider_config'][$att];
			return $value;
		} else {
			throw new Exception($att.' value not set');
		}
	}
}