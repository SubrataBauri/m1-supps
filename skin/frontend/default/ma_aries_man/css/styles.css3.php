<?php
    header('Content-type: text/css; charset: UTF-8');
    header('Cache-Control: must-revalidate');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
    $url = $_REQUEST['url'];
?>

.mobilemenu>li.first {
	-webkit-border-radius: 4px 4px 0 0;
	-moz-border-radius: 4px 4px 0 0;
	border-radius: 4px 4px 0 0;
	behavior: url(<?php echo $url; ?>css/css3.htc);
	position: relative;
}
.mobilemenu>li.last {
	-webkit-border-radius:0 0 4px 4px;
	-moz-border-radius: 0 0 4px 4px;
	border-radius: 0 0 4px 4px;
	behavior: url(<?php echo $url; ?>css/css3.htc);
	position: relative;
}
#Example_F {
	-moz-box-shadow: 0 0 5px 5px #888;
	-webkit-box-shadow: 0 0 5px 5px#888;
	box-shadow: 0 0 5px 5px #888;
}


.select-lang:before {
width: 18px;
height: 18px;
background: #fff url(../images/select_lang.png) no-repeat scroll 50% 50%;
content: "";
display: block;
position: absolute;
top: 3px;
right: 3px;
pointer-events: none;
}
.select-lang select{
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
}

.select-sortby:before {
width: 19px;
height: 19px;
background: #fff url(../images/select_toolbar.png) no-repeat scroll 50% 50%;
content: "";
display: block;
position: absolute;
top: 4px;
right: 4px;
pointer-events: none;
}
.select-limiter:before {
width: 19px;
height: 19px;
background: #fff url(../images/select_toolbar.png) no-repeat scroll 50% 50%;
content: "";
display: block;
position: absolute;
top: 4px;
right: 57px;
pointer-events: none;
}

.pt_custommenu div.popup{
    box-shadow: 0 0 5px #ccc;
    -webkit-box-shadow: 0 0 5px #ccc;
    -moz-box-shadow: 0 0 5px #ccc;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
}
.newproductslider-item .item-inner .actions, .products-grid .item .item-inner .actions{
    transition: 1s ease-out;
    -webkit-transition: 1s ease-out;
    -moz-transition: 1s ease-out;
}
.newproductslider-item .item-inner .actions a, .products-grid .item .item-inner .actions a, button.button span, #back-top, .ma-thumbnail-container .flex-direction-nav a, .ma-newproductslider-container .flex-direction-nav a, .ma-brand-slider-contain .flex-direction-nav a, .ma-upsellslider-container .flex-direction-nav a {
    transition: 0.5s ease-out;
    -webkit-transition: 0.5s ease-out;
    -moz-transition: 0.5s ease-out;
}

.top-cart-wrapper, .header .form-search button.button span, .banner-static2 .banner-box2 .content ul li a, .product-view .add-to-cart button.button span {
    transition: background-color 0.5s ease-out;
    -webkit-transition: background-color 0.5s ease-out;
    -moz-transition: background-color 0.5s ease-out;
}
.header .form-search input.input-text, .block-subscribe input.input-text, .block-subscribe .actions button.button span{
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
}
.ma-featuredproductslider-container .flex-direction-nav a, .ma-newproductslider-container .flex-direction-nav a, .ma-upsellslider-container .flex-direction-nav a, #back-top, .top-cart-wrapper, .header .form-search button.button span, .ma-brand-slider-contain .flex-direction-nav a, .banner-static2 .banner-box2 .content ul li a, .pager .pages .current, .ma-thumbnail-container .flex-direction-nav a, .product-view .add-to-cart button.button span {
    border-radius: 40px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
}

.pager .view-mode a.grid,.pager .view-mode a.list{
    transition: background 0.5s ease-out;
    -webkit-transition: background 0.5s ease-out;
    -moz-transition: background 0.5s ease-out;
}

.newproductslider-item .item-inner button.button span, .products-grid button.button span{
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    transform: scale(1);
    transition: all 0.3s ease-out;
    -webkit-transform: scale(1);
    -webkit-transition: all 0.3s ease-out;
    -moz-transform: scale(1);
    -moz-transition: all 0.3s ease-out;
}
.newproductslider-item .item-inner button.button:hover span, .products-grid button.button:hover span {
    -webkit-transform: scale(1.1);
    -webkit-transition: all 0.3s ease-out;
    -moz-transform: scale(1.1);
    -moz-transition: all 0.3s ease-out;
}

.footer-static .footer-static-content .follow-us .content a:hover img, .banner-static2 .banner-box:hover img, .banner-static-contain .banner-box:hover img, .block-banner-left:hover img, .ma-brand-slider-contain .flexslider .slides li:hover img, .featuredproductslider-item .item-inner:hover img, .newproductslider-item .item-inner:hover img, .products-list .product-image:hover img, .products-grid .product-image:hover img, .ma-upsellslider-container .product-image:hover img, .ma-relatedslider-container .product a.product-image:hover img{
    opacity: 0.8;
    -webkit-opacity: 0.8;
    -moz-opacity: 0.8;
}
.static_block_custom_menu .static-menu-img, .banner-static-contain .banner-box, .ma-newproductslider-container, .newproductslider-item .item-inner .actions a, .ma-featured-products, .products-grid .item .item-inner .actions a, .block, .block-tags .block-content .tags-list a, .toolbar, .category-products .product-container, .products-list, .products-list button.button span, .product-view,  .product-view .product-img-box .more-views li.thumbnail-item a, .price-cart, .product-shop .product-options-bottom, .box-account, .fieldset, .my-account, .ma-relatedslider-container .product, .cart .crosssell, .cart .discount, .cart .shipping, .cart .totals, .navbar {
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
}
.banner-static-contain .banner-box, .ma-newproductslider-container, .ma-featured-products, .block, .toolbar, .category-products .product-container, .products-list, .product-view, .box-account, .fieldset, .my-account, .cart .crosssell, .cart .discount, .cart .shipping, .cart .totals, .navbar{
    box-shadow: 0 2px 5px #ccc;
    -webkit-box-shadow: 0 2px 5px #ccc;
    -moz-box-shadow: 0 2px 5px #ccc;
}
.newproductslider-item .item-inner, .newproductslider-item .item-inner button.button span, .products-grid .item .item-inner, .products-list .product-shop .actions-inner, .product-view .product-img-box .product-image {
    border-radius: 8px;
    -webkit-border-radius: 8px;
    -moz-border-radius: 8px;
}

.accordion span.head a{
    border-radius: 3px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
}