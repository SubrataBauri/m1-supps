<?php
class Magentothem_Quickview_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * The main extension settings
     *
     * @var array
     */
    private $_settings    = array();
    
    const DEFAULT_QUICKVIEW_MAX_HEIGHT  = 400;
    const FANCYBOX_EASING_IN_SWING      = 'easeOutBack';
    const FANCYBOX_EASING_OUT_SWING     = 'easeInBack';

    /**
     * Load the main extension settings
     */
    public function __construct()
    {
        $this->_settings = $this->getQuickviewSettings();
    }

    /**
     * Is the extension enabled?
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return Mage::getStoreConfig('quickview/settings/enabled', Mage::app()->getStore());
    }

    /**
     * Current media type of displaying pictures
     *
     * @return string
     */
    public function getMediaType()
    {
        return Mage::getStoreConfig('quickview/media/active', Mage::app()->getStore());
    }

    /**
     * Get the main extension settings
     *
     * @return array
     */
    public function getSettings()
    {
        return $this->_settings;
    }

    /**
     * Get json representation of
     *
     * @return string
     */
    public function getJsonSettings()
    {
        return Mage::helper('core')->jsonEncode($this->_settings);
    }

    /**
     * Create the main extension setings
     *
     * @return array
     */
    private function getQuickviewSettings()
    {
        $store      = Mage::app()->getStore();
        $settings   = array(
            'media'             => $this->getMediaType(),
            'navigation'        => (int)Mage::getStoreConfig('quickview/settings/navigation', $store),
            'overlay_show'      => (int)Mage::getStoreConfig('quickview/settings/overlay_show', $store),
            'overlay_color'     =>      Mage::getStoreConfig('quickview/settings/overlay_color', $store),
            'overlay_opacity'   => (float)str_replace(',', '.', Mage::getStoreConfig('quickview/settings/overlay_opacity', $store))
        );

        $settings   = $this->checkDefaultQuickviewSettings($settings);
        return $settings;
    }

    /**
     * Check default main settings of extension
     *
     * @param array The main extension settings 
     * @return array
     */
    private function checkDefaultQuickviewSettings($settings)
    {
        if (!$settings['max_height']) {
            $settings['max_height'] = self::DEFAULT_QUICKVIEW_MAX_HEIGHT;
        }

        if (!$settings['overlay_show']) {
            unset($settings['overlay_opacity']);
            unset($settings['overlay_color']);
        }

        return $settings;
    }

    /**
     * Create 'Cloud Zoom' settings of displaying pictures
     *
     * @return array
     */
    public function getCloudZoomSettings()
    {
        $modulName     = Mage::app()->getRequest()->getModuleName();
        $store         = Mage::app()->getStore();
        if ($modulName == 'quickview') {
            $pageType  = '_quickview';
        } else {
            $pageType  = '';
        }

        $settings = array(
            'zoomWidth'    =>   (int)Mage::getStoreConfig('quickview/cloudzoom/zoom_width' . $pageType, $store),
            'zoomHeight'   =>   (int)Mage::getStoreConfig('quickview/cloudzoom/zoom_height' . $pageType, $store),
            'position'     =>        Mage::getStoreConfig('quickview/cloudzoom/position' . $pageType, $store),
            'adjustX'      =>   (int)Mage::getStoreConfig('quickview/cloudzoom/adjust_x' . $pageType, $store),
            'adjustY'      =>   (int)Mage::getStoreConfig('quickview/cloudzoom/adjust_y' . $pageType, $store),
            'tint'         =>        Mage::getStoreConfig('quickview/cloudzoom/tint', $store),
            'softFocus'    =>   (int)Mage::getStoreConfig('quickview/cloudzoom/soft_focus', $store),
            'smoothMove'   =>   (int)Mage::getStoreConfig('quickview/cloudzoom/smooth_move', $store),
            'showTitle'    =>   (int)Mage::getStoreConfig('quickview/cloudzoom/show_title', $store),
            'tintOpacity'  => (float)str_replace(',', '.', Mage::getStoreConfig('quickview/cloudzoom/tint_opacity', $store)),
            'lensOpacity'  => (float)str_replace(',', '.', Mage::getStoreConfig('quickview/cloudzoom/lens_opacity', $store)),
            'titleOpacity' => (float)str_replace(',', '.', Mage::getStoreConfig('quickview/cloudzoom/title_opacity', $store))
        );
        if (!$settings['position']) {
            $settings['position']   = Mage::getStoreConfig('quickview/cloudzoom' . $pageType . '/position_element', $store);
        }

        $settings = $this->checkDefaultCloudZoomSettings($settings);
        return $settings;
    }

    /**
     * Check default 'Cloud Zoom' settings of displaying pictures
     *
     * @param array 'Cloud Zoom' settings
     * @return array
     */
    private function checkDefaultCloudZoomSettings($settings)
    {
        if (!$settings['zoomWidth']) {
            unset($settings['zoomWidth']);
        }

        if (!$settings['zoomHeight']) {
            unset($settings['zoomHeight']);
        }

        if (!$settings['smoothMove']) {
            unset($settings['smoothMove']);
        }

        if ($settings['position'] == "0") {
            $settings['position'] = Mage::getStoreConfig('quickview/cloudzoom/position_element', $store);
        }

        $store    = Mage::app()->getStore();
        $tintShow = (int)Mage::getStoreConfig('quickview/cloudzoom/tint_show', $store);
        if (!$tintShow) {
            unset($settings['tint']);
            unset($settings['tintOpacity']);
        }

        return $settings;
    }

    /**
     * Create 'FancyBox' settings of displaying pictures
     *
     * @return array
     */
    public function getFancyBoxSettings()
    {
        $store      = Mage::app()->getStore();
        $settings   = array(
            'padding'        =>   (int)Mage::getStoreConfig('quickview/fancybox/padding', $store),
            'margin'         =>   (int)Mage::getStoreConfig('quickview/fancybox/margin', $store),
            'cyclic'         =>   (int)Mage::getStoreConfig('quickview/fancybox/cyclic', $store),
            'overlayShow'    =>   (int)Mage::getStoreConfig('quickview/fancybox/overlay_show', $store),
            'overlayColor'   =>        Mage::getStoreConfig('quickview/fancybox/overlay_color', $store),
            'titleShow'      =>   (int)Mage::getStoreConfig('quickview/fancybox/title_show', $store),
            'titlePosition'  =>        Mage::getStoreConfig('quickview/fancybox/title_position', $store),
            'transitionIn'   =>        Mage::getStoreConfig('quickview/fancybox/transition_in', $store),
            'easingIn'       =>        Mage::getStoreConfig('quickview/fancybox/transition_in_elastic', $store),
            'transitionOut'  =>        Mage::getStoreConfig('quickview/fancybox/transition_out', $store),
            'easingOut'      =>        Mage::getStoreConfig('quickview/fancybox/transition_out_elastic', $store),
            'opacity'        =>   (int)Mage::getStoreConfig('quickview/fancybox/opacity', $store),
            'speedIn'        =>   (int)Mage::getStoreConfig('quickview/fancybox/speed_in', $store),
            'speedOut'       =>   (int)Mage::getStoreConfig('quickview/fancybox/speed_out', $store),
            'overlayOpacity' => (float)str_replace(',', '.', Mage::getStoreConfig('quickview/fancybox/overlay_opacity', $store))
        );
    
        $settings   = $this->checkDefaultFancyBoxSettings($settings);
        return $settings;
    }

    /**
     * Check default 'FancyBox' settings of displaying pictures
     *
     * @param array 'FancyBox' settings
     * @return array
     */
    private function checkDefaultFancyBoxSettings($settings)
    {
        if (!$settings['overlayShow']) {
            unset($settings['overlayOpacity']);
            unset($settings['overlayColor']);
        }

        if (!$settings['titleShow']) {
            $settings['titleShow'] = FALSE;
            unset($settings['titlePosition']);
        }

        if ($settings['titleShow'] && $settings['titlePosition']=="outside") {
            unset($settings['titleShow']);
            unset($settings['titlePosition']);
        }

        if ($settings['easingIn'] == "swing") {
            $settings['easingIn'] = self::FANCYBOX_EASING_IN_SWING;
        }

        if ($settings['easingOut'] == "swing") {
            $settings['easingOut'] = self::FANCYBOX_EASING_OUT_SWING;
        }

        return $settings;
    }

    /**
     * Get prefix for javascript storage cache
     */
    public function getJsCachePrefix()
    {
        return Mage::helper('core/url')->getCurrentBase64Url();
    }
}