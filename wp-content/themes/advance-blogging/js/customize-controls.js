( function( api ) {

	// Extends our custom "advance-blogging" section.
	api.sectionConstructor['advance-blogging'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );