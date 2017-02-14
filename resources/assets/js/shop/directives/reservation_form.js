"use strict";

  angular
    .module("copya-restaurant")
    .directive("initReserve", initReserve);

  function initReserve(){
    return {
			restrict: 'EA',
              templateUrl: '/js/reservation/views/reservation.html',
              controller: 'reserveCtrl',
              link: function(scope, elem, attrs) {
			}
		}
  }

