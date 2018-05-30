module.exports = {
    'testing massively' : function (browser) {
        browser
            .url('http://homestead.test')
            .waitForElementVisible('#app', 100)
            .assert.containsText(".hello", "Craig is Working on Craiglorious")
            .clearValue('#company')
            .setValue('#company', 'demo')
            .clearValue('#username')
            .setValue('#username', 'admin')
            .clearValue('#password')
            .setValue('#password', 'secret')
            .click('#login')
            .pause(1000)

            .assert.containsText("#username", "admin")



            .end();
    }
};