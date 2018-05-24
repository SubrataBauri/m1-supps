<?php
class Uipl_Stockalert_Model_Observer {

    public function getalert($observer) {
        
	$configValue = Mage::getStoreConfig('general/stockalert/active');
		if($configValue!=1){
			Mage::log("Stock alert is disabled from admin general system configuration");
			return false;
		}
		
       $order = $observer->getEvent()->getOrder();
       
       $orders = Mage::getModel("sales/order")->load($order->getId());


        $ordered_items = $orders->getAllItems();
        
        foreach($ordered_items as $item){
            
            $product_id =$item->getProductId();
            //product id
           
            $orderqty= $item->getQtyOrdered();
            $_product = Mage::getModel('catalog/product')->load($product_id);  
           //$qtyStock= $_product->getMinQty();
           
           $num= Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getQty();
           $qtyStock=Mage::getModel('cataloginventory/stock_item')->loadByProduct($_product)->getMinQty();
           $qtyStock=$qtyStock-$orderqty;
                        if($num<=$qtyStock){
                                 $email_to=Mage::getStoreConfig('trans_email/ident_sales/email');
                                $email_to .=",".Mage::getStoreConfig('general/stockalert/otheremails');
                                 $emailTemplate  = Mage::getModel('core/email_template')
						->loadDefault('outofstock_email_template');
                                 
                                 
                                
                                 $expro='<table width="100%" cellpadding="10" cellspacing="10">
                                    <tr><td>Product Id</td><td>Product Name</td><td>SKU</td><td>Product Url</td></tr>
                                ';
                         
                                    $expro .='<tr><td>'.$_product->getId().'</td><td>'.$_product->getName().'</td><td>'.$_product->getSku().'</td><td>'.$_product->getProductUrl().'</td></tr>';
                                    
                              
                                $expro .='</table>';
                        
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
           
           
            //Mage::log('pid='. $product_id." sale qty =".$orderqty." stock qty=".$qtyStock." another qty=".$num.$processedTemplate);
          
            }        
       
    }

}
?>