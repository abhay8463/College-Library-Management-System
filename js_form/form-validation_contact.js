const form = document.getElementById('contactForm');
const name = document.getElementById('from-name');
const email = document.getElementById('from-email');
const ph = document.getElementById("from-phone")

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const nameVal = name.value.trim();
	const emailVal = email.value.trim();
    const phValue = ph.value.trim();

    if(nameVal === '') {
		setErrorFor(name, '! Name cannot be blank');
	} else {
		setSuccessFor(name);
    }
    
    if(emailVal === '') {
		setErrorFor(email, '! Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, '! Not a valid email');
	} else {
		setSuccessFor(email);
    }

    if(phValue === '') {
		setErrorFor(ph, '! Phone cannot be blank');
    } 
    else if(phValue.length > 10)
        setErrorFor(ph, '! Phone cannot be greater than 10 digits');
    else {
		setSuccessFor(ph);
	}

}
    

function setErrorFor(input, message) {
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');
	// formControl.className = 'form-control error';
	small.innerText = message;
}

function setSuccessFor(input) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    small.innerText = "";
	// formControl.className = 'form-control success';
}
	
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

