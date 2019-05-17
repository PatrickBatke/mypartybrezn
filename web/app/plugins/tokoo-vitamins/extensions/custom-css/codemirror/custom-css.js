jQuery( function ( $ ) {
    var editor = CodeMirror.fromTextArea( $( '#custom-css-textarea' ).get( 0 ), {
        mode: "css",
        theme: "monokai",
        lineNumbers: true
    } );
} )