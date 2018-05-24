<?php
class Magentothem_Quickview_Model_Source_Media_Fancybox_Transition
{
    /**
     * The transition type animations
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'elastic', 'label' => Mage::helper('adminhtml')->__('Elastic')),
            array('value' => 'fade',    'label' => Mage::helper('adminhtml')->__('Fade')),
            array('value' => 'none',    'label' => Mage::helper('adminhtml')->__('none')),
        );
    }

}
