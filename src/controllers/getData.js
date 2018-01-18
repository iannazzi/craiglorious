
export function getData (options) {


// Configure our HTTP client
    var rest = require('rest')
    var pathPrefix = require('rest/interceptor/pathPrefix')
    var mime = require('rest/interceptor/mime')
    var defaultRequest = require('rest/interceptor/defaultRequest')
    var errorCode = require('rest/interceptor/errorCode')
    var interceptor = require('rest/interceptor')
    var jwtAuth = require('../config/interceptors/jwtAuth')

    // let axios = axios;
    //
    // axios.defaults.headers.common = {
    //     'X-Requested-With': 'XMLHttpRequest'
    // };


    let config = require('../config/index')


    let client = rest.wrap(pathPrefix, { prefix: config.api.base_url })
        .wrap(mime)
        .wrap(defaultRequest, config.api.defaultRequest)
        .wrap(errorCode, { code: 400 })
        .wrap(jwtAuth);



    client({path:options.url, entity:options.entity, params:options.params,method:options.method,}).then(
            function (response) {
                //success
                //bus.$emit('data_received');
                options.onSuccess(response.entity);
            },
            function (response) {
                if (typeof options.onError === 'function')
                {
                    options.onError(response.entity);
                }
                else
                {
                    console.log('there was an error from the request')
                    console.log(response);
                }


            });
    }

