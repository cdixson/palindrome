<!doctype html>
<html lang="en">
	<head>
<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
		<title>Palindrome Checker</title>
	</head>
	<body>
		<div class="container">
			<h1>Palindrome Checker</h1>
    <?php
    function checkIfPalindrome($palInput) {
			//make string lowercase and strip all whitespace
			$palInput = strtolower(preg_replace('/\s/','', $palInput));  
			
			//strip out apostrophes that were converted to '&#39;' during data sanitization process 
			$palInput = str_replace("&#39;","",$palInput); //necessary to check palindromic sentences like, "Madam I'm Adam"
			
			//if $palInput contains chars other than letters or numbers, strip them out using a regex.
			$palInput = preg_replace( '/[^0-9a-z]+/i','', $palInput);
			
			//reverse $palInput, e.g., abc becomes cba
			//this is the core of the function. if the two strings match, then it's a palindrome. 
			//this means that nonsense text could also be a palindrome, e.g., ChrissirhC - I'm not taking that into account
			$palInputReversed = strrev($palInput);

			if ($palInputReversed == $palInput) {
				return true; //we have a palindrome
			} else {
				return false;
			}
    }
    //MAIN
	if(isset($_POST["userInput"])) {
			$userStr = filter_var($_POST['userInput'], FILTER_SANITIZE_STRING);  //santize the user input. see, http://php.net/manual/en/function.filter-var.php

			if (checkIfPalindrome($userStr)) {
				echo '<div class="alert alert-success" role="alert"><strong>'.$userStr.'</strong> is a palindrome!</div>';
			} else {
				echo '<div class="alert alert-danger" role="alert"><strong>'.$userStr.'</strong> is not a palindrome!</div>';
			}
	}
    ?>
	<form method="POST" action="/palindrome.php" class="needs-validation" novalidate>
		<div class="form-group">
			<label for="userInput">
				Enter a word or a phrase below. Numbers, apostrophes, and spaces are allowed.
			</label>
			<input type="text" class="form-control" name="userInput" id="userInput" placeholder="Your text here..." minlength="2" pattern="^[a-zA-Z0-9 '\-,!]*$" required autofocus> 
			<div class="invalid-feedback">
				You must enter at least two characters. Special characters (!@#.>$%^&amp;*()_+, etc.) are not allowed. 
			</div>
		</div>
		<button type="submit" class="btn btn-primary">
			Check it!
		</button>
	</form>
	<br />
	<strong>Some common palindromes</strong>
		<ul>
			<li>Radar</li>
			<li>Madam I'm Adam</li>
			<li>Anna</li>
			<li>Stats</li>
			<li>Don't nod</li>
			<li>Rotator</li>
			<li>10201</li>
			<li>My gym</li>
			<li>Step on no pets</li>
			<li>Top spot</li>
		</ul>
    <footer class="d-flex justify-content-center mt-auto">        
		<div class="align-right small text-muted">Chris Dixson - December 2018</div>
    </footer>
	</div>

		<script>
		// JavaScript for disabling form submission if we encounter invalid field(s)
		(function() {
		  'use strict';
		  window.addEventListener('load', function() {
			// Fetch all forms and apply custom Bootstrap validation styles
			var forms = document.getElementsByClassName('needs-validation');
	
			// Loop over forms and prevent submission. In this case we only have one form 
			var validation = Array.prototype.filter.call(forms, function(form) {
			  form.addEventListener('submit', function(event) {
				if (form.checkValidity() === false) {
				  event.preventDefault();
				  event.stopPropagation();
				}
				form.classList.add('was-validated');
			  }, false);
			});
		  }, false);
		})();
		</script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	</body>
</html>