(function(){
  angular
    .module("services", [
      "restmenu.service",
    ]);
})();

(function() {
  'use strict';

	angular
		.module('restmenu.service', [])
		.service('restMenu', restMenu)

	restMenu.$inject = ['$http', '$q'];
	function restMenu($http, $q) {
		return {
			menu: function() {
				var defer = $q.defer();
				$http.get('/api/').then(function(resp) {
					defer.resolve(resp);
				}, function(err) {
					defer.reject(err);
				})
				return defer.promise;
			}
			// ,
			// search: function(merchant) {
			// 	var defer = $q.defer();
			// 	$http.get('/api/merchants?search=' + merchant).then(function(resp) {
			// 		defer.resolve(resp);
			// 	}, function(err) {
			// 		defer.reject(err);
			// 	})
			// 	return defer.promise;
			// }
		}
	}

})();