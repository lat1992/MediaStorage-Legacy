( function ( $ ) {

	var controller = new slidebars();

    controller.init();

    $( '.js-open-left-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.toggle( 'slidebar-1' );
    } );

    $( '.js-open-right-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.toggle( 'slidebar-2' );
    } );

    $( controller.events ).on( 'opened', function () {
        $( '[canvas="container"]' ).addClass( 'js-close-slidebar' );
        $( 'nav' ).addClass( 'js-close-slidebar' );
    } );

    $( controller.events ).on( 'closed', function () {
        $( '[canvas="container"]' ).removeClass( 'js-close-slidebar' );
        $( 'nav' ).removeClass( 'js-close-slidebar' );
    } );

    $( 'body' ).on( 'click', '.js-close-slidebar', function ( event ) {
        event.stopPropagation();
        controller.close();
    } );

/*

    $( '.js-open-left-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.toggle( 'slidebar-1' );
    } );

    $( controller.events ).on( 'opened', function () {
//        $( '[canvas="container"]' ).addClass( 'js-close-slidebar' );
        $( 'nav' ).addClass( 'js-close-slidebar' );

        var $width = $(document).width() - $('[off-canvas]').width();

        $( '[canvas="container"]' ).css('width', $width);
        $( 'nav' ).css('width', $width);
    } );

    $( controller.events ).on( 'closed', function () {
        $( '[canvas="container"]' ).removeClass( 'js-close-slidebar' );
        $( 'nav' ).removeClass( 'js-close-slidebar' );

        var $width = $(document).width();

        $( '[canvas="container"]' ).css('width', $width);
        $( 'nav' ).css('width', $width);
    } );

    // $( 'body' ).on( 'click', '.js-close-slidebar', function ( event ) {
    //     event.stopPropagation();
    //     controller.close();
    // } );

*/


} ) ( jQuery );

$( document ).ready(function() {

    // if ($('.error_div')) {
    //     setTimeout(function() {
    //         $('.error_div').slideUp('fast');
    //     }, 5000);
    // }

    if ($('.success_div')) {
        setTimeout(function() {
            $('.success_div').slideUp('fast');
        }, 5000);
    }

});
