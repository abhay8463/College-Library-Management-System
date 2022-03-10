const form = document.getElementById('signUpForm');
const name = document.getElementById('name');
const email = document.getElementById('email');
const password = document.getElementById('password');
const lib = document.getElementById("lid")
// const password2 = document.getElementById('password2');

form.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs();
});

function checkInputs() {
	// trim to remove the whitespaces
	const usernameValue = name.value.trim();
	const emailValue = email.value.trim();
    const passwordValue = password.value.trim();
    const libValue = lib.value.trim();
	// const password2Value = password2.value.trim();
	
	if(usernameValue === '') {
		setErrorFor(name, 'Name cannot be blank');
	} else {
		setSuccessFor(name);
	}
	
	if(emailValue === '') {
		setErrorFor(email, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email, 'Not a valid email');
	} else {
		setSuccessFor(email);
	}
	
	if(passwordValue === '') {
		setErrorFor(password, 'Password cannot be blank');
	} else {
		setSuccessFor(password);
	}
    
    if(libValue === '') {
		setErrorFor(lib, 'Lib ID cannot be blank');
    } 
    else if(libValue.length < 6)
        setErrorFor(lib, 'Lib ID cannot be less than 6 digits');
    else if(libValue.length > 6)
        setErrorFor(lib, 'Lib ID cannot be greater than 6 digits');
    else {
		setSuccessFor(lib);
	}
// 	if(password2Value === '') {
// 		setErrorFor(password2, 'Password2 cannot be blank');
// 	} else if(passwordValue !== password2Value) {
// 		setErrorFor(password2, 'Passwords does not match');
// 	} else{
// 		setSuccessFor(password2);
// 	}
}





// SIGN IN FORM

const form2 = document.getElementById('signInForm');
const password2 = document.getElementById('password2');
const email2 = document.getElementById('email2');

form2.addEventListener('submit', e => {
	e.preventDefault();
	
	checkInputs2();
});


function checkInputs2() {
	// trim to remove the whitespaces
	const emailValue = email2.value.trim();
    const passwordValue = password2.value.trim();
	// const password2Value = password2.value.trim();

    if(emailValue === '') {
		setErrorFor(email2, 'Email cannot be blank');
	} else if (!isEmail(emailValue)) {
		setErrorFor(email2, 'Not a valid email');
	} else {
		setSuccessFor(email2);
	}
	
	if(passwordValue === '') {
		setErrorFor(password2, 'Password cannot be blank');
	} else {
		setSuccessFor(password2);
	}
    
}


// COMMMON FOR BOTH FORMS:
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





// SOCIAL PANEL JS
// const floating_btn = document.querySelector('.floating-btn');
// const close_btn = document.querySelector('.close-btn');
// const social_panel_container = document.querySelector('.social-panel-container');

// floating_btn.addEventListener('click', () => {
// 	social_panel_container.classList.toggle('visible')
// });

// close_btn.addEventListener('click', () => {
// 	social_panel_container.classList.remove('visible')
// });

