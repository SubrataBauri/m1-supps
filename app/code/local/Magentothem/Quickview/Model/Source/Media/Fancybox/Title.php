<?php
class Magentothem_Quickview_Model_Source_Media_Fancybox_Title
{
    /**
     * The position of title
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'outside',   'label' => Mage::helper('adminhtml')->__('Outside')),
            array('value' => 'inside',    'label' => Mage::helper('adminhtml')->__('Inside')),
            array('value' => 'over',      'label' => Mage::helper('adminhtml')->__('Over')),
        );
    }

}
