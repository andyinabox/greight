var FlashCard = new Class({
	Implements: Options,
	
	options: {
		req_next_word : '/words/next',
	},
	
	jQuery: 'flash_card',
	
	initialize: function(selector, options) {
		this.setOptions(options);
		this.jqueryObject = jQuery(selector);
	},
	
	nextStep: function(options) {
		console.log("Get next word!");
		console.log(this.options.req_next_word);
		$.getJSON(this.options.req_next_word, function(data) {
			console.log(data);
		});
	},
	
	markComplete: function(options) {
		console.log("Mark complete.");
	},
	
	showHint: function(options) {
		console.log("Show hint.");
	}
	
});