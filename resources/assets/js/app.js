
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
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

$(".image-drop").css({
    'height': $('.image-drop').width() + 'px',
    'line-height': $('.image-drop').width() + 'px'
}).upload({
	action: "/api/v1/users/image_upload"
}).on('filecomplete', function(event, something, responseString) {
    var response = JSON.parse(responseString),
        cropper;
    $('.image-drop').html('<img alt="Profile Photo" src="' + response.path + '" /><input type="hidden" name="photo" value="' + response.name + '" />');
    cropper = new Cropper(document.getElementsByTagName('img')[0], {
        aspectRatio: 1,
        crop: function(e) {
            console.log(e.detail.x);
            console.log(e.detail.y);
            console.log(e.detail.width);
            console.log(e.detail.height);
            console.log(e.detail.rotate);
            console.log(e.detail.scaleX);
            console.log(e.detail.scaleY);
        }
    });
});
