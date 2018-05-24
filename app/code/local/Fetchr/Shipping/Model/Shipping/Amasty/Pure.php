<?php /* added automatically by conflict fixing tool */ if (Mage::getConfig()->getNode('modules/Amasty_Shiprestriction/active')) {
                class Fetchr_Shipping_Model_Shipping_Amasty_Pure extends Amasty_Shiprestriction_Model_Shipping_Shipping {}
            } else { class Fetchr_Shipping_Model_Shipping_Amasty_Pure extends Mage_Shipping_Model_Shipping {} } ?>