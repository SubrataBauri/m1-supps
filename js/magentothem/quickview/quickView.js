var Quickview = Class.create();
Quickview.prototype = {
    initialize: function(config, cachePrefix) {
        this.config      = config;
        this.cachePrefix = cachePrefix;
        this.showFlag;
        this.closeFlag;
    },

    init: function(){
        this.showFlag  = true;
        this.closeFlag = true;
        var thisQ      = this;
        $$('.quickview-button').each(function(button) {
            button.up().addClassName('quickview-block');
            Event.observe(button, 'click', function(event) {
                var pro_id = button.readAttribute('rel');
                thisQ.ajax(pro_id);
            });
        });
    },

    slide: function(pro_id) {
        var popup   = $('popup').select('.main-popup')[0];
        $('popup').select('.quickview_popup_alpha')[0].setStyle( {height: popup.getStyle('height')} );
        $('popup').select('.quickview_popup_alpha')[0].setStyle( {width: popup.getStyle('width')} );
        $('popup').select('.quickview_popup_alpha')[0].show();

        if ($('popup').select('.next-product-view').size()) {
            $('popup').select('.next-product-view')[0].hide('slow');
        }

        if ($('popup').select('.prev-product-view').size()) {
            $('popup').select('.prev-product-view')[0].hide('slow');
        }

        this.ajax(pro_id);
    },
    
    ajax: function(pro_id) {
        if(this.showFlag){
            this.showFlag  = false;
            this.closeFlag = false;
            loader.show();
            var url  = $('base_url').value + 'quickview/ajax/popup/';
            if(url.search('/index.php/')==-1){
                url  = $('base_url').value + 'index.php/quickview/ajax/popup/';                
            }
            
            var html = this.getCache(pro_id);
            
            if (html) {
                loader.hide();
                this.show(pro_id, html);
            } else {
                var thisQ   = this;
                new Ajax.Request(url, {
                    method:      'post',
                    parameters: {'pro_id': pro_id},
                    onSuccess:  function(transport) {
                        loader.hide();
                        if (!thisQ.closeFlag) {
                            thisQ.show(pro_id, transport.responseText);
                            thisQ.setCache(pro_id, transport.responseText);
                        }
                    }
                });
            }
        }
    },
    
    show: function(pro_id, html) {
        var heightBody = document.getElementsByTagName('body')[0].clientHeight;
        if (this.config.overlay_show) {
            $('quickview-hider').setStyle({height: heightBody + 'px'});
            $('quickview-hider').show();
        }

        this.setPosition();
        $('popup').update(html);
        $('popup').select('.quickview_popup_alpha')[0].hide();
        $('popup').show();

        this.showAfter(pro_id);
    },

    setPosition: function() {
        var scrollPos = _getScroll();
        var topPos    = parseInt(0.1 * document.documentElement.clientHeight + scrollPos['scrollTop']);

        $('popup').setStyle({top: topPos + 'px'});
        if (window.outerWidth < parseInt($('popup').getStyle('width'))) {
            $('popup').setStyle({left: '0px', margin: '0 0 0 20px'});
        } else {
            $('popup').setStyle({left: '', margin: ''});
        }
    },

    close: function() {
        this.closeFlag = true;
        this.showFlag  = true;
        loader.hide();
        this.closeBefore();
        $('popup').update('');
        $('popup').hide();
        $('quickview-hider').hide();
    },

    /* Required javascript initialization after quickview display */
    showAfter: function(pro_id) {
        this.showFlag = true;    
        new Varien.Tabs('.quickview_tabs');
        switch (this.config.media) {
            case 'quickview_media_cloudzoom':
                break;
            case 'quickview_media_fancybox':
                break;
            default:
                Event.observe($$('.popup .product-image img')[0], 'load', function() {
                    var product_zoom = new Product.Zoom('image', 'track', 'handle', 'zoom_in', 'zoom_out', 'track_hint');
                });
        }

        if (this.config.quickview_scroll) {
            var block = $$('.product-essential')[0];
            if ( this.config.max_height >= (parseInt(block.getStyle('height')) + parseInt(block.getStyle('padding-top')) + parseInt(block.getStyle('padding-bottom'))) ) {
                $$('.product-view')[0].removeClassName('quickview_scroll');
            }
        }

//        if (this.config.add_to_cart) {
            q_productAddToCartForm = new VarienForm('product_addtocart_form_' + pro_id);
            $$('body .popup .button').each(function(element) {
                element.setAttribute('onclick', 'q_productAddToCartForm.submit(this)');
            });
//        }
    },

    /* Required javascript initialization before quickview close */
    closeBefore: function() {
        if (this.config.media == 'quickview_media_fancybox') {
            $jq('#fancybox-close').click();
        }
    },
    
    getCache: function(key) {
        return $.jStorage.get(this.cachePrefix + key);
    },
    
    setCache: function(key, value) {
        /*if($.jStorage.storageSize() > 128000)     // Clear cache
            $.jStorage.flush();*/
//        $.jStorage.set(this.cachePrefix + key, value, {TTL: 6});  // Removes a key from the storage after 10 min
        $.jStorage.set(this.cachePrefix + key, value, {TTL: 600000});  // Removes a key from the storage after 10 min
    }
    
}

