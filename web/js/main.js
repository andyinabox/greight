$(document).keys({
  'Space': space
});

$(document).ready(function() {
	var word_data;
	$.getJSON('/js/words-test.json',
		function(data) {
			console.log(data);
		}
	);
});


function space() {
	$("#content").append("<p>Space is the place!</p>");
}