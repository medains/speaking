(function(){
	Reveal.addEventListener( 'fragmentshown', function( event ) {
		if ( event.fragment.dataset.animate != undefined ) {
			document.getElementById( event.fragment.dataset.animate ).contentDocument.next();
		}
	} );

	Reveal.addEventListener( 'fragmenthidden', function( event ) {
		if ( event.fragment.dataset.animate != undefined ) {
			document.getElementById( event.fragment.dataset.animate ).contentDocument.prev();
		}
	} );
})();
