'use strict';

function areasService($resource) {
	return $resource('/api/areas/:id',{id: '@id'},
		{ query: {method:'GET', isArray:false}, get: {method: "GET"}, destroy: { method: "DELETE" }, update: { method: "PUT" } }
	);

}

areasService.$inject = ['$resource'];

angular
	.module('copya-restaurant')
	.factory('areasService', areasService);
