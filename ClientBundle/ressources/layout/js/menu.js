( function ( $ ) {

	var controller = new slidebars();

    controller.init();

    $( '.js-open-left-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.toggle( 'slidebar-1' );
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