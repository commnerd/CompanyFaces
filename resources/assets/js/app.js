
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
    $('.image-drop').html('<img alt="Profile Photo" src="' + response.url + '" />');
    $('input[name="photo"]').val(response.name);
    cropper = new Cropper(document.getElementsByTagName('img')[0], {
        aspectRatio: 1,
        crop: function(e) {
            $('input[name="photo_crop_x"]').val(e.detail.x);
            $('input[name="photo_crop_y"]').val(e.detail.y);
            $('input[name="photo_crop_w"]').val(e.detail.width);
            $('input[name="photo_crop_h"]').val(e.detail.height);
            $('input[name="photo_scale_x"]').val(e.detail.scaleX);
            $('input[name="photo_scale_y"]').val(e.detail.scaleY);
        }
    });
});


$('textarea').each(function(index, area) {
    var content = $(area).html();
    tinymce.init({
        target: area
    });
});

$('a[href="#delete"]').click(function() {
    var form = $(this).parent();
    $('.modal').modal('show');
    $('.modal .btn-danger').click(function() {
        $(form).submit();
    });
    return false;
});

if($('.image-drop > img').length > 0) {
    var img = $('.image-drop > img');
    $(img).remove();
    $('.image-drop .fs-upload-target').html(img);
}

if($('.message').length > 0) {
    setTimeout(function() {
        $('.message').fadeOut(1000, function() {
            $('.message').remove();
        });
    }, 2000);
}
