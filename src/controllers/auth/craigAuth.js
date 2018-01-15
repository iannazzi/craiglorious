export class craigAuth {
    constructor() {
        console.log('constructed....')
        this.craigsockettimer = null;
        this.logintimer = null;

    }
    decodeToken(token){

        var base64Url = token.split('.')[1];
        var base64 = base64Url.replace('-', '+').replace('_', '/');
        return JSON.parse(window.atob(base64));
    }

}