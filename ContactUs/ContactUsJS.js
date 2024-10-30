document.getElementById('Contact-Form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the values of the inputs
    const Name = document.getElementById('Name').value;
    const nameError = document.getElementById('Name-Error');
    const nameBorder = document.getElementById('Name');
    const Email = document.getElementById('Email').value;
    const emailError = document.getElementById('Email-Error');
    const emailBorder = document.getElementById('Email');
    const Message = document.getElementById('Message').value;
    const messageError = document.getElementById('Message-Error');
    const messageBorder = document.getElementById('Message');
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    var emailCorrect = true;

    if (!(emailRegex.test(Email))) {
        editErrors(emailError,emailBorder,"Invalid email address. Please enter a valid email.","2px solid #FF0000");
        emailCorrect = false;
    }

    if(Name ===''){
        editErrors(nameError,nameBorder,"Please enter your Name.","2px solid #FF0000");
    }else{
        editErrors(nameError,nameBorder,"","0");
    }

    if(Email ===''){
        editErrors(emailError,emailBorder,"Please enter your Email.","2px solid #FF0000");
    }else if(emailCorrect){
        editErrors(emailError,emailBorder,"","0");                   
    }

    if(Message ===''){
        editErrors(messageError,messageBorder,"Please enter your Message.","2px solid #FF0000");
    }else{
        editErrors(messageError,messageBorder,"","0");
        
    }

    if ((!(Name === '' || Email === '' || Message === ''))&&emailCorrect){
        const output = `Name: ${Name}<br>
                        Email: ${Email}<br>
                        Message: ${Message}`;
        
        editErrors(nameError,nameBorder,"","0");
        editErrors(emailError,emailBorder,"","0");  
        editErrors(messageError,messageBorder,"","0");

        
        // Display the output in a paragraph
        document.getElementById('output').innerHTML = output;
    }
});

function editErrors(errorName, borderName, errorMessage, borderStyle){
    errorName.innerHTML = errorMessage;
    borderName.style.border = borderStyle;
}

