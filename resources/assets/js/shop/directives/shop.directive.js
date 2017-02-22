"use strict";

  angular
    .module("copya-shop")
    .directive("initShop", initShop);

  function initShop(){
    return {
			restrict: 'EA',
              templateUrl: '/js/shop/views/shop.view.html',
              controller: 'shopCtrl',
              link: function(scope, elem, attrs) {
			}
		}
  }

