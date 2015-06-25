$(document).ready(function()
{

	$("#btnloginsubmit").click(function(event)
	{
		email = document.getElementById('email').value;
		emailError=document.getElementById('emailError');
		validateEmail();
		password = document.getElementById('password').value;
		passwordError=document.getElementById('passwordError');
		validatePassword();
		if( validateEmail() && validatePassword())
		{
			$("#loginform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});


	$("#btnregsubmit").click(function(event)
	{

		validateName();
		email = document.getElementById('regemail').value;
		emailError=document.getElementById('regEmailError');
		validateEmail();
		password = document.getElementById('regpassword').value;
		passwordError=document.getElementById('regPasswordError');
		validatePassword();
		if(validateName() && validateEmail() && validatePassword())
		{
			$("#registerform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});

	$("#btnaddmovie").click(function(event)
	{
		movieName=document.getElementById('addmovie').value;
		movieError=document.getElementById('addmovieerror');
		if(validateMovieName())
		{
			$("#addmovieform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});

	$("#btnaddpost").click(function(event)
	{
		post=document.getElementById('addpost').value;
	 	postError=document.getElementById('posterror');
		if(validatePost())
		{
			$("#addpostform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});

	$("#btneditpostsubmit").click(function(event)
	{
		post=document.getElementById('editedpost').value;
		postError=document.getElementById('editposterror');
		
		if(validatePost())
		{
			$("#editpostform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});

	$("#btnedittopicsubmit").click(function(event)
	{
		movieName=document.getElementById('editedtopic').value;
		movieError=document.getElementById('editTopicError');
		
		if(validateMovieName())
		{
			$("#edittopicform").submit();
		}
		else
		{
			event.preventDefault();
		}
	});

});

// Email validation
function validateEmail()
{
	
	
	pos1=email.indexOf('@');
	pos2=email.indexOf('.');
	var betweenAtAndPeriod=email.substring(pos1+1,pos2);
	if(pos1>0 && pos2>2 && email.length!==0 && betweenAtAndPeriod.length!==0){
		emailError.innerHTML="";
		return true;
	}
	else{
		emailError.innerHTML="Please enter a valid Email";
		return false;
		alert('excuting email function');
	}

}

// Password validation
function validatePassword()
{
	
	if(password.length==0)
	{
		passwordError.innerHTML="Please enter a Password";
		return false;
	}
	if (password.length>20)
	{
		passwordError.innerHTML="Your password is too long. Please try again.";
		return false;
	}
	else
	{
		passwordError.innerHTML="";
		return true;
	}
}

// Name validation
function validateName()
{
	var name = document.getElementById('regusername').value;
	var nameError=document.getElementById('regNameError');
	if(name.length==0 )
	{
		nameError.innerHTML="Please enter a Name";
		return false;
	}
	if (name.length>40) 
	{
		nameError.innerHTML="Your Name is too long. Please try again with a short name.";
		return false;
	}
	else
	{
		nameError.innerHTML="";
		return true;
	}
}

//Movie name validation
function validateMovieName()
{
	
	if(movieName.length==0 )
	{
		movieError.innerHTML="Please enter a movie name";
		return false;
	}
	if (movieName.length>150) 
	{
		movieError.innerHTML="The movie name is too long. Please try again.";
		return false;
	}
	else
	{
		movieError.innerHTML="";
		return true;
	}
}

//Movie reviews validation
function validatePost()
{
	
	if(post.length==0 )
	{
		postError.innerHTML="Please write a review";
		return false;
	}
	if (post.length>700) 
	{
		postError.innerHTML="The review is too long. Please try again.";
		return false;
	}
	else
	{
		postError.innerHTML="";
		return true;
	}

}