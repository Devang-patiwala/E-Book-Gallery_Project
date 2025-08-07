<script src="js/jquery-1.11.0.min.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/adapters/jquery.js"></script>
	<script>

		CKEDITOR.disableAutoInline = true;

		$( document ).ready( function() {
			$( '#editor1' ).ckeditor(); // Use CKEDITOR.replace() if element is <textarea>.
			$( '#editable' ).ckeditor(); // Use CKEDITOR.inline().
		} );

		function setValue() {
			$( '#editor1' ).val( $( 'input#val' ).val() );
		}
	</script>
		<textarea id="editor1" name="editor1" rows="10" style="width:900px"><?php echo $resview['book_description'];?></textarea>
        