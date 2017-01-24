(function(){
  "use strict";

  angular
    .module("reserve.directive", [])
    .directive("initReserve", initReserve);

  function initReserve(){
    return {
			restrict: 'EA',
      templateUrl: 'directives/views/reserve.html',
      controller: 'reserveCtrl',
			link: function(scope, elem, attrs) {
        // some implementation details
			}
		}
  }
})();
