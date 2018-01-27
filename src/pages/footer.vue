<template>
    <div>
        <div style="margin-top: 125px;">
            <!-- Push Footer -->
        </div>
        <footer class="footer">
            <div class="container" style="color: #777;">
                <!-- Company Information -->
                <div class="pull-left" style="padding-top: 28px;">
                    Copyright &copy; Craig Iannazzi - <router-link to="{ path: '/terms'}">Terms Of Service</router-link>
                </div>
                <!-- Social Icons -->
                <div class="pull-right footer-social-icons">
                    <a href="http://facebook.com/">
                        <i class="fa fa-btn fa-facebook-square"></i>
                    </a>
                    <a href="http://twitter.com/">
                        <i class="fa fa-btn fa-twitter-square"></i>
                    </a>
                    <a href="http://github.com/">
                        <i class="fa fa-github-square"></i>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </footer>
    </div>
</template>
<style>
    .footer {
        background-color: #f5f5f5;
        border-top: 1px solid #e7e7e7;
        bottom: 0;
        height: 80px;
        position: absolute;
        width: 100%;
    }
    .footer-social-icons {
        font-size: 32px;
        padding-top: 18px;

    a {
        color: #777;
    }
    }
</style>
<script>
    module.exports = {
        data: function () {
            return {
                links: {
                    facebook: '',
                    twitter: '',
                    github: ''
                }
            }
        }
    }

</script>