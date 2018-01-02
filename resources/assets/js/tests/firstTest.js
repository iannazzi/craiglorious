import Vue from 'vue/dist/vue.js';
import test from 'ava';

import {trim} from '../lib/strings'
import dashboard from '../pages/dashboard/Dashboard.vue'

test('dashboard', t => {
    new Vue(dashboard).$mount();
})

test('it trims a string', t => {
    let p = trim(' allooo ');
    t.is(p,'allooo');
})