	
	//Function to process order
	function orderprocess() {
		//Declaring and asigning all needed Variables
		var surname = document.getElementById('surname').value;
		var fullnames = document.getElementById('fullnames').value;
		var contact = document.getElementById('contact').value;
		var email = document.getElementById('email').value;
		var destination = document.getElementById('destination').value;
		var VAT =0.15;
		var amountDue = 0;

		//Validation

		//Surname
		if (surname=="" || parseInt(surname)) {
			alert("Please enter a valid Surname!");
			exit();
		}else if (fullnames=="" || parseInt(fullnames)) {			//Full names
			alert("Please enter a valid Name!");
		}else if (contact=="" || isNaN(contact)) {				//Contact Number
			alert("Please enter a valid Contact!");
		}else if (contact.length!=10) {
			alert("Contact must be 10 digits!");
		}else if (email=="" || parseInt(email)) {				//Email
			alert("Please enter a valid Email!");
		}else if (destination==0) {
			alert("Please choose your location!");
		}else {
			//Calculating AMount Due
			var total = destination;
			amountDue = parseFloat((total * VAT) + parseInt(total)).toFixed(2);

			//Desplaying Outputs
			alert("Thank you " + fullnames + ", We will call you shortly on " + contact + " to finish up your order. Delivery fee: R " + total + " | incl VAT: R " + amountDue);
			document.getElementById('status').innerHTML = "Transaction Successfull!";
		}	
	};
