<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title>Sturdy Carnival</title>
	<link rel="stylesheet" href="sc.css" type="text/css" />  
	<script
	  src="https://code.jquery.com/jquery-3.2.1.min.js"
	  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
	  crossorigin="anonymous">
	 </script>	
	<script  src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="states.js"></script>
	<script src="names.js"></script>
	<script src="script.js"></script>
</head>
<body id="bootstrap-override">
	<div class="container-fluid navbar-fixed-top">
		<div class="navbar-header">
		<a class="navbar-brand" href="#">Sturdy Carnival</a>
		<small>beta</small>
		</div> 
		
	</div>
	<section>
		<div class="container-fluid margin-top-5em">
			<div class="jumbotron text-center">
				<h1>
					Contacting your politicians has never been easier.
				</h1>
				<h4>Sturdy Carnival leverages the <a href="https://projects.propublica.org/api-docs/congress-api/">ProPublica API</a> to present contact information for members of the United States Senate and House of Representatives.</h4>
			</div>
		</div>	
	</section> 
	<section>
		<div class="container">
			<form actison="api.php" method="get">
			<div class="input-group">
				<label for="contact_name_input" class="input-group-addon" id="input_name_label">Name</label>
				<input autocomplete="off" id="contact_name_input" class="form-control" aria-describedby="input_name_label" onkeyup="suggest(this.value)"></input>
			</div>
				<ul id="suggestions">
					<!--Suggestions will be populated here -->
				</ul>
			</form>
			<div class="container-fluid hide">
				<div class="row">
					<div class="col-xs-12 col-sm-4 person_profile text-center">
						<p>
							<span id="person_name">
							</span>
						</p>
						<div class="img-circle center-me" id="person_img"></div>
						<p>
							<span id="prson_dob">
							</span>
						</p>
						<p>
							<span id="person_nxt_election">
							</span>
						</p>	
					</div>			
					<div class="col-xs-12 col-sm-8 person_contact">
					
						<div class="flex-top text-center">
							<div class="col-xs-12 col-sm-4 person_state">
								<span id="person_state">
								</span>			
								<small>State</small>
							</div>
							<div class="col-xs-12 col-sm-4 person_chamber">
								<span id="person_chamber">
								</span>
								<small>Chamber</small>
							</div>
							<div class="col-xs-12 col-sm-4 person_party">
								<span id="person_party">
								</span>
								<small>Party</small>
							</div>
						</div>
						<div class="flex-mid">
							<p>Contact Form:
								<span id="person_contact">
									<a id="person_contact_link" href="#">
									</a>
								</span>
							</p>
							<p>Website:
								<span id="person_website">
									<a id="person_website_link" href="#"></a>
								</span>
							</p>
							<p>Phone: 
								<span id="person_phone">
								</span>
							</p>					
						</div>
						<div class="flex-bottom">
							<div class="row">
								<div class="col-xs-2 social">
									<a id="tt" href=""><img src="icon/twitter.svg" alt="Twitter" /></a>
								</div>
								<div class="col-xs-2 social">
									<a id="fb" href=""><img src="icon/facebook.svg" alt="Facebook" /></a>
								</div>
								<div class="col-xs-2 social">
									<a id="yt" href=""><img src="icon/youtube.svg" alt="YouTube" /></a>
								</div>
				
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<footer>
		<span>
			This project is a collaboration by Andrew Antila, Belany Zhang, Brody Painter and Tanner Comes for MLH Local Hack Day 2017 at Galvanize in Phoenix, Arizona.
		</span>
		<span>
			Social Media Icons acquired from <a href="https://github.com/edent/SuperTinyIcons">Terrence Edent</a>.
		</span>
		<span>
			Congress data acquired from <a href="https://projects.propublica.org/api-docs/congress-api/">ProPublica</a>.
		</span>
	</footer>
</body>
</html>