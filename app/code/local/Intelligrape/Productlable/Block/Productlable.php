<?php
class Intelligrape_Productlable_Block_Productlable extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getProductlable()     
     { 
        if (!$this->hasData('productlable')) {
            $this->setData('productlable', Mage::registry('productlable'));
        }
        return $this->getData('productlable');
        
    }
	
	public function isNewEnable($_product){
		
		if((Mage::getStoreConfig('productlable/sample/enablenew')) && ($_product->news_from_date)){
			return true;
		}
		else{
			return false;
		}
		
	}
	
	public function getLableImage($fileName){
		//$fileName = Mage::getStoreConfig('productlable/sample/newimage');
		$width = 50;
		$height = 50;
		
		$folderURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA);
		$imageURL = $folderURL . $fileName;
		
		$basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA).DS.'theme'.DS.$fileName;
		$newPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . "resized" . DS . $fileName;
		//if width empty then return original size image's URL
		if ($width != '') {
			//if image has already resized then just return URL
			if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {
				$imageObj = new Varien_Image($basePath);
				$imageObj->constrainOnly(TRUE);
				$imageObj->keepAspectRatio(FALSE);
				$imageObj->keepFrame(FALSE);
				$imageObj->keepTransparency(TRUE);
				$imageObj->resize($width, $height);
				$imageObj->save($newPath);
			}
			$resizedURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "resized/".$fileName;
		} else {
			$resizedURL = $imageURL;
		}
		return $resizedURL;
	}
	
	public function isProductOutOfStockEnable($_product){
		
		if((Mage::getStoreConfig('productlable/sample/enableoutofstock')) && (!$_product->isAvailable())){
			return true;
		}
		else{
			return false;
		}
	}
	
	public function getNewImage(){
		$fileName = Mage::getStoreConfig('productlable/sample/newimage');
		$resizedURL = $this->getLableImage($fileName);
		return $resizedURL;
	}
	
	public function getSoldOutImage(){
		$fileName = Mage::getStoreConfig('productlable/sample/outofstockimage');
		$resizedURL = $this->getLableImage($fileName);
		return $resizedURL;
	}
	
	public function getSaleImage(){
		$fileName = Mage::getStoreConfig('productlable/sample/saleimage');
		$resizedURL = $this->getLableImage($fileName);
		return $resizedURL;
	}
	
	public function isSaleEnable($_product){
	
		if((Mage::getStoreConfig('productlable/sample/enablesale')) && ($_product->special_price)){
			return true;
		}
		else{
			return false;
		}
	
	}
	
	
}