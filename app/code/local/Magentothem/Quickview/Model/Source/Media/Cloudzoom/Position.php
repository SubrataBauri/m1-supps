<?php
class Magentothem_Quickview_Model_Source_Media_Cloudzoom_Position
{
    /**
     * Specifies the position of the zoom window relative to the small image
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'right',   'label' => Mage::helper('adminhtml')->__('right')),
            array('value' => 'left',    'label' => Mage::helper('adminhtml')->__('left')),
            array('value' => 'top',     'label' => Mage::helper('adminhtml')->__('top')),
            array('value' => 'bottom',  'label' => Mage::helper('adminhtml')->__('bottom')),
            array('value' => 'inside',  'label' => Mage::helper('adminhtml')->__('inside')),
            array('value' => '0',       'label' => Mage::helper('adminhtml')->__('id of an html element')),
        );
    }

}
