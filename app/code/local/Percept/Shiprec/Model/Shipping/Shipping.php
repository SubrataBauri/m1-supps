<?php
class Percept_Shiprec_Model_Shipping_Shipping extends Mage_Shipping_Model_Shipping
{   
    public function collectCarrierRates($carrierCode, $request)
    {
        /*$quote = Mage::getModel('checkout/session')->getQuote();
        $shippingData = $quote->getShippingAddress()->getData();
        Mage::log($shippingData, null, 'carrierCode.log', true);*/
        
        if (!$this->_checkCarrierAvailability($carrierCode, $request)) {
            return $this;
        }
        return parent::collectCarrierRates($carrierCode, $request);
    }
 
    protected function _checkCarrierAvailability($carrierCode, $request = null)
    {
        
        if($carrierCode == 'flatrate2'){ 
            return false;
        }
        
        return true;
    }
}
		