<?php
class Magentothem_Quickview_AjaxController extends Mage_Core_Controller_Front_Action
{
    protected function _loadQuickviewRedirect()
    {
        $parentUrl = Mage::getSingleton('core/session')->getQuickviewParentUrl();
        $lastUrl   = Mage::getSingleton('core/session')->getLastUrl();
        Mage::getSingleton('core/session')->unsQuickviewParentUrl();
        if ($parentUrl) {
            $this->_redirectUrl($parentUrl);
        } else {
            $this->_redirectUrl($lastUrl);
        }
    }

    protected function _setQuickviewRedirect()
    {
        $lastUrl   = Mage::getSingleton('core/session')->getLastUrl();
        if ((strpos($lastUrl, 'noRoute')===FALSE)) {
            Mage::getSingleton('core/session')->setQuickviewParentUrl($lastUrl);
        }          
    }

    /**
     * Product quickview action
     */
    public function popupAction()
    {
        $productId = (int)$this->getRequest()->getPost('pro_id');
        if (!$productId) {
            $this->_loadQuickviewRedirect();
        } else {
            $this->_setQuickviewRedirect();         
        }
        
        // Get initial data from request
        $specifyOptions = $this->getRequest()->getParam('options');
        if (Mage::getVersion() < '1.5.0.0') {
			$params = new Varien_Object();
			$params->setSpecifyOptions($specifyOptions);
			if ($product = $this->_initProduct14($productId)) {
				if ($specifyOptions) {
					$notice = $product->getTypeInstance(true)->getSpecifyOptionMessage();
					Mage::getSingleton('catalog/session')->addNotice($notice);
				}

				$this->_initProductLayout14($product);
				$this->renderLayout();
			} else {
				if (isset($_GET['store'])  && !$this->getResponse()->isRedirect()) {
					$this->_redirect('');
				} elseif (!$this->getResponse()->isRedirect()) {
					$this->_forward('noRoute');
				}
			}
        } else {
            // Prepare helper and params
            /* @var $viewHelper Mage_Catalog_Helper_Product_View */
            $viewHelper     = Mage::helper('catalog/product_view');
            $params         = new Varien_Object();
            $params->setSpecifyOptions($specifyOptions);

            // Render page
            try {
                $viewHelper->prepareAndRender($productId, $this, $params);
            } catch (Exception $e) {
                if ($e->getCode() == $viewHelper->ERR_NO_PRODUCT_LOADED) {
                    if (isset($_GET['store']) && !$this->getResponse()->isRedirect()) {
                        $this->_redirect('');
                    } elseif (!$this->getResponse()->isRedirect()) {
                        $this->_forward('noRoute');
                    }
                } else {
                    Mage::logException($e);
                    $this->_forward('noRoute');
                }
            }
        }
    }

    /**
     * Initialize product view layout for MAGENTO 1.4
     *
     * @param   Mage_Catalog_Model_Product $product
     * @return  Mage_Catalog_ProductController
     */
	protected function _initProductLayout14($product)
    {
        $update = $this->getLayout()->getUpdate();
        $update->addHandle('default');
        $this->addActionLayoutHandles();

        $update->addHandle('PRODUCT_TYPE_'.$product->getTypeId());
        $update->addHandle('PRODUCT_'.$product->getId());

        $this->loadLayoutUpdates();
        $update->addUpdate($product->getCustomLayoutUpdate());
        $this->generateLayoutXml()->generateLayoutBlocks();

        return $this;
    }

    /**
     * Initialize requested product object for MAGENTO 1.4
     *
     * @return Mage_Catalog_Model_Product
     */
	protected function _initProduct14($productId = 0){
		$product = Mage::getModel('catalog/product')
            ->setStoreId(Mage::app()->getStore()->getId())
            ->load($productId);

        if (!Mage::helper('catalog/product')->canShow($product)) {
            return false;
        }

        if (!in_array(Mage::app()->getStore()->getWebsiteId(), $product->getWebsiteIds())) {
            return false;
        }

        Mage::register('current_product', $product);
        Mage::register('product', $product);

        return $product;
	}

    /**
     * Postdispatch: don't set last visited url
     *
     * @return Mage_Core_Controller_Front_Action
     */
    public function postDispatch(){
        return $this;
    }
}
