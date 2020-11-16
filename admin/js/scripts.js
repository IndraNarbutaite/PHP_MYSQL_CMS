// TinyMCE WYSIWYG textarea selector script.
tinymce.init({ selector:'textarea' });


// Select all checkbox script.
$(document).ready(function () {

	$('#selectAllBoxes').click(function (event) {
		if(this.checked) {
			$('.checkboxes').each(function () {
				this.checked = true;
			});
		} else {
			$('.checkboxes').each(function () {
				this.checked = false;
			});
		}
	});

});


// Loader script.
/*
var div_box = "<div id='load-screen'><div id='loading'></div></div>";

$("body").prepend(div_box);

$('#load-screen').delay(450).fadeOut(550, function () {
	$(this).remove();
});
*/


// Users online
/*
function load_users_online() {

	$.get("../includes/navigation.php?onlineusers=result", function(data) {
		$(".usersonline").text(data);
	});

}

setInterval(function() {
	load_users_online();
}, 500);
*/