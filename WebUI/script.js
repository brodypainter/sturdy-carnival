// var items = getNames();

//retrieves potential names based on the input
function suggest(input) {
	$(".suggestion").remove();
	var hits = [];
	names.forEach(function(val) {
		let regex = new RegExp(input,'i'); 
		let name = val.first_name + " " + val.last_name;
		if(regex.test(name)) {
			hits.push(name);
		}
	});
	hits.forEach(function(hit) {
		let $ele = $("<li>", {class:"suggestion"});
		$ele.text(hit);
		$("#suggestions").append($ele);
	});
}

//removes suggestions and populates input with the suggestion
$(document).on("click", ".suggestion", function(e) {
	let name = e.target.innerText;
	$("#contact_name_input").val(name);
	$(".suggestion").remove();
	let contact = getContact(process(name));
});
	
function getContact(contact) {	

	let contactData = {};
	$.ajax({
		url:"https://tannercomes.com/sc/api/call_brody.php?name=" + contact.split(" ").join("")
	}).done(function(response){
		updateContactCard(response);	
	});
}

function getNames2() {
	$.ajax({
		url:"https://tannercomes.com/sc/api/get_names.php",
		async:false
	}).done(function(response){
		console.log(JSON.parse(response));
		setItem(response);
		return JSON.parse(response);
	});

}

function getNames() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		document.write(xhttp.responseText);
    }
};
xhttp.open("GET", "https://tannercomes.com/sc/api/get_names.php" , true);
xhttp.send();
}

//prep the name for retrieval by api.
function process(name) {
	return name.split(" ").join("").toLowerCase();
}


function updateContactCard(contact) {
	contact = JSON.parse(contact);
	
	let first_name = contact.first_name ? contact.first_name : "";
	let middle_name = contact.middle_name ? contact.middle_name : "";
	let last_name = contact.last_name ? contact.last_name : "";
	let suffix = contact.suffix ?  contact.suffix : "";
	let name = first_name + " " + middle_name + " " + last_name + " " + suffix;
	$("#person_name").text(name);
	
	let id = contact.id;
	let imageurl = "http://bioguide.congress.gov/bioguide/photo/" + id[0] + "/" + id + ".jpg";
	$("#person_img")
		.css({backgroundImage: "url(" + imageurl + ")"})
		.attr("alt", name);
	
	let dob = contact.dob ? new Date(contact.dob).toDateString() : "Unknown";
	$("#person_dob").text(dob);
	
	let next_election = contact.next_election ? new Date(contact.next_election).toDateString() : "Unknown";
	$("#person_next_election").text(next_election);
		
	
	$("#person_website_link")
		.attr("href", contact.url)
		.text(contact.url);
		
	$("#person_contact_link")
		.attr("href",contact.contact_form)
		.text(contact.contact_form);
		
	$("#person_phone").text(contact.phone);
	
	$("#person_state").text(getStateFromAbbr(contact.state));
	
	let chamber = (contact.chamber == "house" ? "House of Representatives" : "Senate");
	$("#person_chamber").text(chamber);
	$("#person_party").text(contact.party);
	
	$(".hide").removeClass("hide");
}
