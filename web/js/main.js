$(document).ready(function() {
	fc = new FlashCard('#FlashCard', { req_next_word: 'words-test.json'} );
	console.log(fc);
	
	$(this).bind('keyup', 'space', function(e) {
		e.stopPropagation();  
		e.preventDefault();
		fc.nextStep();
		return false;
	});
	$(this).bind('keyup', 'return', fc.markComplete);
	$(this).bind('keyup', 'h', fc.showHint);
})