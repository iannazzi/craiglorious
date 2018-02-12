<template>
    <div>
        <nav-component></nav-component>
        <div>
            <div class="hello">
                <h2 >Craig is Working on Craiglorious</h2>
                <div >
                    <p>Thanks for visiting! Craiglorious is a combined business and accounting system originally designed for Embrasse-Moi. The name <b>Craiglorious</b> was coined by the Embrasse-moi team for the incredible system I have created for them. I am working on porting code from Embrasse-moi's system to Craiglorious for your use. To see my progress, log in. Use the company named <b>demo</b> and any of the following users: <b>Admin Owner Trainee Guest Accountant Sales John.Doe</b>. The password is <b>secret</b>. The different users demonstrate restricted access to functionality. </p>
                </div>
            </div>
        </div>
        <div class="container app-screen login_top">
            <div class="col-md-9 col-md-offset-1 ">
                <div class="tab-content">
                    <div class="tab-pane">
                        <div class="panel panel-default ">
                            <router-view></router-view>
                        </div>
                    </div><!-- End tab panel -->
                </div><!-- End tab content -->
            </div><!-- End tab panes col-md-9 -->
        </div><!-- End container -->

        <div class="hello">
            <p>This system is in heavy development with updates occurring daily. Some views have been coded, some have not. I have the general workflow completed. I am currently working on releasing payroll processing which includes a calendar with easy shift scheduling. After that I will re-code our awesome purchase order functionality, which will in turn solidify the accounting functionality. Finally I will integrate my point of sale code along with general invoicing. If you would like me to add your company to my development/alpha/beta list email me at craig.iannazzi@gmail.com and I will create for you a custom login and populate your database with your data! Due to taxation complexities I am only able to support New York businesses at the moment. Thanks for your support!</p>
        </div>


        <footer-component></footer-component>
    </div>
</template>
<style>
    .login_top{
        padding-top:20px;
    }
    .hello
    {
        text-align:center;
        padding: 10px 100px 10px 100px;
    }
    .hello p{
        font-size:18px;
    }
    .hello h2{
    }
</style>