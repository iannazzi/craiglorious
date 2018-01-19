export default {

    modelName(){
        console.log('this.route' + this.route);
        let name = this.route.charAt(0).toUpperCase() + this.route.slice(1)
        return name.substr(0, name.length - 1);
    },
    test(){
        console.log('test');
    },
    computed:{
        modelName(){
            console.log('this.route computed' + this.route);
            let name = this.route.charAt(0).toUpperCase() + this.route.slice(1)
            return name.substr(0, name.length - 1);
        },
    }

}