<pre>
<?php 

print_r(apache_get_modules());

/*

echo "<pre>";
require_once('app/Mage.php');
    Mage::app();

$category_id = 7 ;

$products = Mage::getModel('catalog/category')->load($category_id)
 ->getProductCollection()
 ->addAttributeToSelect('*');
 
print_r();
foreach ($products->getData() as $value) {
	echo $value['sku'];
	echo "<br>";
}


?>
