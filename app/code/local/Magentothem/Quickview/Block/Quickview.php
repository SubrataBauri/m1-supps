<?php
class Magentothem_Quickview_Block_Quickview extends Mage_Catalog_Block_Product_View
{
    /**
     * The main extension settings
     *
     * @var array
     */
    protected $_settings = array();

    /**
     * Product ids for next/previous quickview navigation
     *
     * @var array
     */
    protected $_productsPosition = array();

    /**
     * Previous product id for quickview navigation
     *
     * @var int
     */
    protected $_previousProductId = 0;

    /**
     * Next product id for quickview navigation
     *
     * @var int
     */
    protected $_nextProductId = 0;

    /**
     * Set main quickview settings
     * Set quickview navigation options
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
        $this->_settings = $this->helper('quickview')->getSettings();
        $this->searchNextPrevious();
    }

    /**
     * Get product category with max level
     *
     * @param Mage_Catalog_Model_Product
     * @return Mage_Catalog_Model_Category
     */
    public function getProductCategory($product)
    {
        $catIds     = $product->getCategoryIds();
        /* @var $categories Mage_Catalog_Model_Resource_Category_Collection */
        $categories = Mage::getModel('catalog/category')->getCollection()
            ->addFieldToFilter('entity_id', array("in" => $catIds))
            ->addAttributeToSort('level', 'DESC');
        return $categories->getLastItem();
    }

    /**
     * Create array of product ids for search next and previous products identifiers
     *
     * @return boolean
     */
    public function createNavigationCollection()
    {
        $products       = Mage::getSingleton('core/session')->getCurrentCategoryProducts();
        /* @var $product Mage_Catalog_Model_Product */
        $product        = $this->getProduct();
        if (!is_array($products)) {
            $products   = $this->getProductCategory($product)
                                    ->getProductCollection()
                                    ->getColumnValues('entity_id');
        }
        
        $this->_productsPosition = $products;
        return count($products);
    }

    /**
     * Search next and previous products identifiers 
     */
    public function searchNextPrevious()
    {
        $product = $this->getProduct();
        if ($this->_settings['navigation']) {
            if ($this->createNavigationCollection()) {
                $current_pid = $product->getId();
                $curpos      = array_search($current_pid, $this->_productsPosition);
                
                // ---------- get next product
                $id          = 0;
                if (isset($this->_productsPosition[$curpos+1])) {
                    $pos     = $curpos;
                    do {
                        $pos++;
                        $id      = $this->_productsPosition[$pos];
                        /* @var $product Mage_Catalog_Model_Product */
                        $product = Mage::getModel('catalog/product')->load($id);
                    } while ( !$product->isVisibleInCatalog() || $product->getVisibility()==1 || $product->getVisibility()==3 );
                    $this->_nextProductId = $id;
                }

                // ---------- get prev product
                $id          = 0;
                if (isset($this->_productsPosition[$curpos-1])) {
                    $pos     = $curpos;
                    do {
                        $pos--;
                        if ($pos==-1) {
                            $id = 0;
                        } else {
                            $id = $this->_productsPosition[$pos];
                        }

                        /* @var $product Mage_Catalog_Model_Product */
                        $product = Mage::getModel('catalog/product')->load($id);
                    } while ( !$product->isVisibleInCatalog() || $product->getVisibility()==1 || $product->getVisibility()==3 );
                    $this->_previousProductId = $id;
                }
            }
        }
    }

}