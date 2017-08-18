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
var timeoutRef;

$('input[source]').on('keyup', function() {
    var input = this;
    if(timeoutRef) {
        clearTimeout(timeoutRef);
    }
    timeoutRef = setTimeout(function() {
        var val = { query: $(input).val() };
            src = $(input).attr('source'),
            autocomplete = $(this).parent().find('.autocomplete-list');

        $.ajax({
            url: src,
            method: 'POST',
            data: val
        }).done(function(data) {
            console.log(data);
        });
    }, 250);
}).after('<ul class="autocomplete-list"></ul>');
