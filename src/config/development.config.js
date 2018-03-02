var config = {
  env: 'development',
    url: 'homestead.test',
    socket_port: '3000',
  api: {
    base_url: 'http://homestead.test/api',
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
