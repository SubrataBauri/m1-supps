<?php
class Uipl_Stockalert_Model_Cron{	
	public function SendAlert(){
		
		$configValue = Mage::getStoreConfig('general/stockalert/active');
		if($configValue!=1){
			Mage::log("Stock alert is disabled from admin general system configuration");
			return false;
		}
		$emailTemplate  = Mage::getModel('core/email_template')
						->loadDefault('outofstock_email_template');
            $collection = Mage::getModel('catalog/product')
                        ->getCollection()->addFieldToFilter('visibility', Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
                        ->addAttributeToSelect('*')->addAttributeToFilter('status', array('eq'=>'1'));
			
			 $expro='<table width="100%" cellpadding="10" cellspacing="10">
                                    <tr><td>Product Id</td><td>Product Name</td><td>SKU</td><td>Product Url</td></tr>
                                ';
			foreach($collection as $_product){
				 $_product = Mage::getModel('catalog/product')->load($_product->getId());  
				
				
				$num= Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getQty();
				$qtyStock=Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getMinQty();
				$qtyStock=$qtyStock-$orderqty;
					     if($num<=$qtyStock){
						
						  $expro .='<tr><td>'.$_product->getId().'</td><td>'.$_product->getName().'</td><td>'.$_product->getSku().'</td><td>'.$_product->getProductUrl().'</td></tr>';
                                    
					     }
				
			}
			
			 $expro .='</table>';
			 
			 $email_to=Mage::getStoreConfig('trans_email/ident_sales/email');
			 $email_to .=",".Mage::getStoreConfig('general/stockalert/otheremails');
			  $email_template_variables = array(
                                 'alertGrid' => $expro,
                                
                                 
                                 );
                                 
                                 
                                 $sender_name = Mage::getStoreConfig('trans_email/ident_general/name'); ;
                                 
                                 $sender_email = Mage::getStoreConfig('trans_email/ident_general/email');
                                 
                                  $emailTemplate->setSenderName($sender_name);
				$emailTemplate->setSenderEmail( $sender_email);
                                 
                                  $processedTemplate = $emailTemplate->getProcessedTemplate($email_template_variables);
                               
                                $emailTemplate->send($email_to,'Product Low Stock Notification', $email_template_variables);
				
            
            
               
	} 
}