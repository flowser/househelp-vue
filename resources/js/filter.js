
import moment from 'moment';
import Vue from 'vue';
Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1);
 });

 Vue.filter('dateformat', function(created){
   return moment(created).format('MMM Do YYYY');
 });

 Vue.filter('sortlength', function(text, length, suffix){
   return text.substring(0,length)+suffix;
 });

 Vue.filter('createdAt', function(value){
    return moment(value).fromNow();
});

 Vue.filter('PassedDaystoExpiry', function(Expiry_value, createdate_value, ){
    var expiryDate = moment(createdate_value).add(Expiry_value, 'd');
    var now = moment();
    return  expiryDate.diff(now, 'days');
});

 Vue.filter('ExpiryDate', function(Expiry_value, createdate_value, ){
    var expiryDate = moment(createdate_value).add(Expiry_value, 'd');
    return  moment(expiryDate).format('MMM Do YYYY');
});
