'use strict';

function productsService($resource) {
	return $resource('/api/products/:id',{id: '@id'},
		{ query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

productsService.$inject = ['$resource'];

angular
	.module('copya-shop')
	.factory('productsService', productsService);
