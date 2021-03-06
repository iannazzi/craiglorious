(function (define) {
	'use strict';

	define(function (require) {

		var interceptor;

		interceptor = require('rest/interceptor');

		/**
		 * Authenticates the request using JWT Authentication
		 *
		 * @param {Client} [client] client to wrap
		 * @param {Object} config
		 *
		 * @returns {Client}
		 */
		return interceptor({
			request: function (request, config) {

				// console.log(request);
				var token, headers;

				token = localStorage.getItem('jwt-token');
				headers = request.headers || (request.headers = {});

				if ( token !== null && token !== 'undefined') {
					headers.Authorization = 'Bearer ' + token;
				}

		    	return request;
			},
			response: function (response) {


                // console.log(response);

                // if (response.status && response.status.code == 401) {
				// 	localStorage.removeItem('jwt-token');
				// }
				// if (response.headers && response.headers.Authorization) {
                 //    console.log('set token from header')
                //
                 //    localStorage.setItem('jwt-token', response.headers.Authorization)
				// }
				// if (response.entity && response.entity.token && response.entity.token.length > 10) {
                //
                 //    console.log(response.entity.token)
                //
                 //    console.log('set token from response with extra bearer')
                //
				// 	localStorage.setItem('jwt-token', 'Bearer ' + response.entity.token);
				// }
				return response;
			}
		});

	});

}(
	typeof define === 'function' && define.amd ? define : function (factory) { module.exports = factory(require); }
	// Boilerplate for AMD and Node
));