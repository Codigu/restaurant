'use strict';

function cartService($resource) {
	return $resource('/api/session/cart/:id',{id: '@id'},
		{ save: {method: 'POST'},query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

cartService.$inject = ['$resource'];

angular
	.module('copya-shop')
	.factory('cartService', cartService);
