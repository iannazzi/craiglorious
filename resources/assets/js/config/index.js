//var env = process.env.APP_ENV || 'development' //could use .dot env but mights as well not....

var host = window.location.hostname;

var env = 'development';
console.log(host);

if(host == 'craiglorious.com') {
    env = 'production';
}
else  if (host == 'staging.craiglorious.com')
{
    env = 'staging';
}

console.log('detected environment is ' + env)
var config = {
  development: require('./development.config'),
  production: require('./production.config'),
  staging: require('./staging.config')
}

module.exports = config[env]
