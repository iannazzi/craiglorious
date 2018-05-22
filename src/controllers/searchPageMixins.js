import commonMixins from './commonMixins'
export default {
    computed: {
        modelName: commonMixins.modelName,
    },
    // watch: {
    //     $route () {
    //
    //
    //         if (this.$route.query.sort === undefined) {
    //             if (this.$route.meta.reset) {
    //                 //reset was pressed... actually do nothing here
    //                 this.$route.meta['reset'] = false;
    //             }
    //             else {
    //                 this.loading = true;
    //                 this.searchableTable.removeResultsTable();
    //                 this.searchableTable.options.search_query = this.$route.fullPath;
    //                 this.searchableTable.updateSearchPage();
    //             }
    //
    //         }
    //         else {
    //             //sort change just update the table view
    //         }
    //
    //
    //     }
    // }
}


