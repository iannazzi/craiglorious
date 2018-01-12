<template>
    <div>
        <nav-component></nav-component>
        <div class="container app-screen">
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane">
                        <div class="panel panel-default">
                            <router-view></router-view>
                        </div>
                    </div><!-- End tab panel -->
                </div><!-- End tab content -->
            </div><!-- End tab panes col-md-9 -->
        </div><!-- End container -->
        <footer-component></footer-component>
    </div>
</template>