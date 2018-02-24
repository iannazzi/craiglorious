//var env = process.env.APP_ENV || 'development' //could use .dot env but mights as well not....

// var host = window.location.hostname;
//
// var env = 'development';
// console.log(host);
//
// if(host == 'craiglorious.com') {
//     env = 'production';
// }
// if(host == 'www.craiglorious.com') {
//     env = 'production';
// }
// else  if (host == 'staging.craiglorious.com')
// {
//     env = 'staging';
// }

console.log('detected environment at index is ' + craiglorious.env)
var config = {
  development: require('./development.config.js'),
  production: require('./production.config.js'),
  staging: require('./staging.config.js')
}

module.exports = config[craiglorious.env]
