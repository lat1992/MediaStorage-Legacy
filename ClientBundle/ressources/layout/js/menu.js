( function ( $ ) {

	var controller = new slidebars();

    controller.init();

    $( '.js-open-left-slidebar' ).on( 'click', function ( event ) {
        event.stopPropagation();
        controller.open( 'slidebar-1' );
    } );

    $( controller.events ).on( 'opened', function () {
        $( '[canvas="container"]' ).addClass( 'js-close-slidebar' );
    } );

    $( controller.events ).on( 'closed', function () {
        $( '[canvas="container"]' ).removeClass( 'js-close-slidebar' );
    } );

    $( 'body' ).on( 'click', '.js-close-slidebar', function ( event ) {
        event.stopPropagation();
        controller.close();
    } );

} ) ( jQuery );