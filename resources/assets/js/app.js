/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

/**
 * Globals
 */

$('input[source]').each(function(index, input) {
    $(input).autocomplete({
        source: $(input).attr('source'),
        select: function(event, ui) {
            $('.search-form').submit();
        }
    });
});

$('input[name="terms"]').on('keyup', function(event) {
    if(event.keyCode == 13) {
        $('.search-form').submit();
    }
});

$('section ul').css('min-height', $('aside').height() + 'px');

$('.tabs').tabs();
