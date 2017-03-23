var config = {
  env: 'staging',
  api: {
    base_url: 'http://craiglorious.dev:89/api',
    defaultRequest: {
      headers: {
        'X-Requested-With': 'rest.js',
        'Content-Type': 'application/json'
      }
    }
  },
  social: {
    facebook: '',
    twitter: '',
    github: ''
  },
  debug: true
}
module.exports = config
