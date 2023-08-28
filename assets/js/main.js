$(document).ready(function(){
  $('.like, .unlike').on('click', function(){
    var postid = $(this).data('id');
    $post = $(this);

    var isLiked = $post.hasClass('like'); // Check if it's a like or unlike action

    $.ajax({
      url: 'index.php',
      type: 'post',
      data: {
        'liked': isLiked ? 1 : 0,
        'postid': postid
      },
      success: function(response){
        $post.parent().find('span.likes_count').text(response); // Update the likes count without " likes"
      }
    });
  });
});





$(document).ready(function() {
  $('.msg').animate({
    opacity: 1
  }, 500);

  setTimeout(function() {
      $('.msg').animate({
        opacity: 0
      }, 500, function() {
        $(this).remove();
      });
    }, 2000);

    $('.prev').click(function() {
      $('#myCarousel').carousel('prev');
    });
    
    $('.next').click(function() {
      $('#myCarousel').carousel('next');
    });
    
  });

function validateField(input, fieldName, regex = null) {
  const value = input.value.trim();
  if (!value) {
    showError(input, `The ${fieldName} is required`);
    return false;
  }
  if (regex && !regex.test(value)) {
    showError(input, `The ${fieldName} is invalid`);
    return false;
  }
  return true;
}

function validateLogin() {
  const emailInput = document.getElementById("email");
  const passwordInput = document.getElementById("password");
  const emailRegx = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;


  document.querySelectorAll(".error").forEach((element) => element.remove());

  const isEmailValid = validateField(emailInput, "email", emailRegx);
  const isPasswordValid = validateField(passwordInput, "password");

  return isEmailValid && isPasswordValid;
}

function validateRegistration() {
  const usernameInput = document.getElementById("reg-username");
  const emailInput = document.getElementById("reg-email");
  const passwordInput = document.getElementById("reg-password");
  const passwordConfirmInput = document.getElementById("reg-password-confirmation");
  const usernameRegx = /^[a-zA-Z][a-zA-Z0-9]{3,15}$/;
  const emailRegx = /^\S+@\S+\.\S+$/;

  document.querySelectorAll(".error").forEach((element) => element.remove());

  const isUsernameValid = validateField(usernameInput, "username", usernameRegx);
  const isEmailValid = validateField(emailInput, "email", emailRegx);
  const isPasswordValid = validateField(passwordInput, "password");
  const isPasswordConfirmValid = validateField(passwordConfirmInput, "password confirmation");

  if (isPasswordConfirmValid && passwordInput.value.trim() !== passwordConfirmInput.value.trim()) {
    showError(passwordConfirmInput, "The password and password confirmation does not match");
    return false;
  }

  return isUsernameValid && isEmailValid && isPasswordValid && isPasswordConfirmValid;
}


function showError(inputElement, errorMessage) {
  const errorDiv = document.createElement("div");
  inputElement.classList.add("error-border"); 
  errorDiv.innerText = errorMessage;
  errorDiv.classList.add("error");
  inputElement.parentNode.insertBefore(errorDiv, inputElement.nextElementSibling);
  inputElement.setAttribute("data-error", errorMessage);
  
 
  inputElement.addEventListener('input', function() {
    const errorDiv = inputElement.parentNode.querySelector('.error');
    if (errorDiv) errorDiv.remove();
    inputElement.classList.remove('error-border');
    inputElement.removeAttribute("data-error"); 
  });
}

function checkEmailAvailability() {
    var email = $("#reg-email").val();
    $.ajax({
        type: "POST",
        url: "checkEmailAvailability.php",
        data: {email: email},
        success: function(response){
            if(response=="Email available.") {
                $('#email-availability-status').html('<span class="text-success">'+response+'</span>').show();
            } else {
                $('#email-availability-status').html('<span class="text-danger">'+response+'</span>').show();
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error: " + textStatus);
        }
    });
}

function showReplyForm(self) {
  var commentId = self.getAttribute("data-id");
  var form = document.getElementById("form-" + commentId);
  if (form.style.display === "block") {
    form.style.display = "none";
  } else {
    form.style.display = "block";
  }
}

function showReplyForReplyForm(element) {
  var commentId = element.getAttribute("data-id");
  var name = element.getAttribute("data-name");

  var form = document.getElementById("form-" + commentId);
  if (form.style.display === "none") {
    form.style.display = "block";
  } else {
    form.style.display = "none";
  }
  var textarea = document.querySelector("#form-" + commentId + " textarea[name=comment]");
  textarea.value = "@" + name;
  form.scrollIntoView();
}

