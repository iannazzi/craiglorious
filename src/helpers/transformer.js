export class transformer {
    removeNull(o) {
        for(var key in o) {
            if( null === o[key] ) o[key] = '';
            if ( typeof o[key] === 'object' ) this.removeNull(o[key]);
        }
    }
}


//Convert null value to empty string
