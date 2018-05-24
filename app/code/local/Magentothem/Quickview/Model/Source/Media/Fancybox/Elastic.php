<?php
class Magentothem_Quickview_Model_Source_Media_Fancybox_Elastic
{
    /**
     * Transition for elastic animations
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'linear',  'label' => Mage::helper('adminhtml')->__('linear')),
            array('value' => 'swing',   'label' => Mage::helper('adminhtml')->__('Swing')),
        );
    }

}
