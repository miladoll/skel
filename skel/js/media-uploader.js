var skel = skel || {};
skel.DICT = {};
skel.set_dict = function ( dict_name ) {
    dict_data_role = 'data-skel-gettextdict';
    dict_name = dict_name || '_default';
    if ( skel.DICT[dict_name] ) {
        return;
    }
    skel.DICT[dict_name] = {};
    $ = jQuery;
    var elem;
    if ( dict_name == '_default' ) {
        elem = $('['+dict_data_role+']').get(0);
    } else {
        elem = $('['+dict_data_role+'="' + dict_name + '"]').get(0);
    }
    if ( !elem || !elem.attributes ) {
        return;
    }
    for ( var i=0; i<elem.attributes.length; i++ ) {
        var name = elem.attributes[i].nodeName;
        var value = elem.attributes[i].nodeValue;
        if ( ! name.match(/^data-skel-gettext-/) ) {
            continue;
        }
        name = name.replace( /^data-skel-gettext-/, '' );
        skel.DICT[dict_name][name] = value;
    }
};
skel.__ = function ( key, dict_name ) {
    dict_name = dict_name || '_default';
    if (
        ( ! skel.DICT[dict_name] )
        || ( ! skel.DICT[dict_name][key] )
    ) {
        return( key );
    }
    return( skel.DICT[dict_name][key] );
}
skel.admin = skel.admin || {};
skel.admin.media_uploader = skel.admin.media_uploader || {};
skel.admin.media_uploader.SELECTOR_STRING = {
    'igniter' : '.skel--adm--image-uploaders',
    'prefix_image_list' : '#skel--adm--image-uploader-',
    'image_list' : '.skel--adm--image-uploader-image-lists',
    'attr_url' : 'data-skel-image-url'
};
skel.admin.media_uploader.TEMPLATE_IMAGE_ITEM = '\
<div\
    class="skel--adm--image-uploader-image-items"\
>\
    <a\
        href="%%url%%"\
        target="_blank"\
        title="%%i18n:show-in-new-window%%"\
    >\
        <img src="%%url%%">\
        <button\
            onclick="\
                this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode);\
                return( false );\
            "\
        >\
            %%i18n:dismiss%%\
        </button>\
    </a>\
    <input\
        type="hidden"\
        name="%%this_attr_name%%"\
        value="%%url%%"\
    >\
</div>\
';
skel.admin.media_uploader._get_html_image_item = function( item ) {
    var i18n =
        skel.admin.media_uploader.TEMPLATE_IMAGE_ITEM
    ;
    i18n = i18n.replace(
        /%%i18n:([^%]+)%%/g,
        function( a, $1 ) {
            return( skel.__( $1 ) );
        }
    );
    return(
        i18n
            .replace( /%%url%%/g, item.url )
            .replace( /%%this_attr_name%%/g, item.this_attr_name )
    );
};
skel.admin.media_uploader.set_html_of_registered_images = function ( that ) {
    $ = jQuery;
    var this_attr_id = $(that).attr('id');
    var this_attr_name = $(that).attr('name');
    var elem_image_list = $(
            skel.admin.media_uploader.SELECTOR_STRING.prefix_image_list
            + this_attr_id
        )
    ;
    var already_registered_images =
        $(that).find('ul li')
    ;
    for( var i=0; i<already_registered_images.length; i++ ) {
        var item = already_registered_images[i];
        elem_image_list.append(
            skel.admin.media_uploader._get_html_image_item( {
                'url' : $(item).attr(
                        skel.admin.media_uploader.SELECTOR_STRING.attr_url
                    ),
                'this_attr_name' : this_attr_name
            } )
        );
    }
};
skel.admin.media_uploader._function_caller = function(e, that) {
    $ = jQuery;
    var custom_uploader;
    if ( custom_uploader ) {
        custom_uploader.open();
        return;
    }
    var this_attr_name = $(that).attr('name');
    var this_attr_id = $(that).attr('id');
    var is_multiple =
        (
            $(that).attr('data-skel-image-multiple') != 'false'
        )
        ? true
        : false
    ;
    var elem_image_list =
        $(
            skel.admin.media_uploader.SELECTOR_STRING.prefix_image_list
            + this_attr_id
        )
    ;
    custom_uploader = wp.media({
        title: skel.__('choose-image'),
        library: {
            type: 'image'
        },
        button: {
            text: skel.__('choose-image')
        },
        multiple: is_multiple
    });
    custom_uploader.on(
        'select',
        function() {
            var images =
                custom_uploader.state().get('selection')
            ;
            if ( is_multiple == false ) {
                elem_image_list.empty();
            }
            images.each(function(file){
                elem_image_list.append(
                    skel.admin.media_uploader._get_html_image_item( {
                        'url' : file.get('url'),
                        'this_attr_name' : this_attr_name
                    } )
                );
            });
        }
    );
    custom_uploader.open();
};
skel.admin.media_uploader.on_ready = function() {
    $ = jQuery;
    var custom_uploader;
    event_namespace = '.skel-admin-media-uploader';
    $( skel.admin.media_uploader.SELECTOR_STRING.igniter )
        .off( 'click.' + event_namespace )
    ;
    $( skel.admin.media_uploader.SELECTOR_STRING.igniter )
        .on(
            'click.' + event_namespace,
            function(e) {
                e.preventDefault();
                skel.admin.media_uploader._function_caller(e, this);
            }
        )
    ;
};
//
jQuery(document).ready( function(){
    skel.set_dict();
    skel.admin.media_uploader.on_ready()
} );
