require('./bootstrap');

import angular from 'angular';

import {
    AccountCtrl
} from './controllers';

angular.module('dashboard', [

])

.controller('AccountCtrl', AccountCtrl)