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
        source: $(input).attr('source')
    });
});

//var timeoutRef;


/*
$('input[source]').on('keyup', function(event) {
    var val = { query: $(this).val() },
        src = $(this).attr('source'),
        autocomplete = $(this).parent().find('.autocomplete-list');
    if(timeoutRef) {
        clearTimeout(timeoutRef);
    }
    $(autocomplete).css('display', 'none').empty();
    timeoutRef = setTimeout(function() {
        $.ajax({
            url: src,
            method: 'POST',
            data: val
        }).done(function(data) {
            if(data.length > 0) {
                console.log(data.length);
                $(data).each(function(index, user) {
                    $(autocomplete).append('<li>'+user.supervisorLabel+'</li>');
                });
                $(autocomplete).css('display', 'block');
            }
        });
    }, 250);
}).after('<ul class="autocomplete-list"></ul>');
*/
