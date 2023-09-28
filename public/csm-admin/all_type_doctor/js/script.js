// alert('ok');
// disable copy 
   $(document).ready(function() {
    // Disable text selection
    $('body').css({
      '-webkit-user-select': 'none',
      '-moz-user-select': 'none',
      '-ms-user-select': 'none',
      'user-select': 'none'
    });

    // Disable right-click context menu
    // $(document).on('contextmenu', function(e) {
    //   e.preventDefault();
    // });
  });

//image preview
//Change this to your no-image file
let noimage =
  "https://ami-sni.com/wp-content/themes/consultix/images/no-image-found-360x250.png";

function readURL(input) {
  console.log(input.files);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $("#img-preview").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  } else {
    $("#img-preview").attr("src", noimage);
  }
}


//otp field
//Code Verification
var verificationCode = [];
$(".verification-code input[type=text]").keyup(function (e) {
  
  // Get Input for Hidden Field
  $(".verification-code input[type=text]").each(function (i) {
    verificationCode[i] = $(".verification-code input[type=text]")[i].value; 
    $('#verificationCode').val(Number(verificationCode.join('')));
    //console.log( $('#verificationCode').val() );
  });

  //console.log(event.key, event.which);

  if ($(this).val() > 0) {
    if (event.key == 1 || event.key == 2 || event.key == 3 || event.key == 4 || event.key == 5 || event.key == 6 || event.key == 7 || event.key == 8 || event.key == 9 || event.key == 0) {
      $(this).next().focus();
    }
  }else {
    if(event.key == 'Backspace'){
        $(this).prev().focus();
    }
  }

}); // keyup

$('.verification-code input').on("paste",function(event,pastedValue){
  console.log(event)
  $('#txt').val($content)
  console.log($content)
  //console.log(values)
});

$editor.on('paste, keydown', function() {http://jsfiddle.net/5bNx4/#run
var $self = $(this);            
              setTimeout(function(){ 
                var $content = $self.html();             
                $clipboard.val($content);
            },100);
     });






    function openWorking() {
    var div = document.getElementById('newWorking');
    div.classList.toggle('hidden');
  }
  function openDay() {
    var div = document.getElementById('newDay');
    div.classList.toggle('hidden');
  }
  function openSocial() {
    var div = document.getElementById('newSocial');
    div.classList.toggle('hidden');
  }

 
  








  function openYes() {
  var divYes = document.getElementById('newSpecial');
  var divNo = document.getElementById('newSpecialno');
  var divDepartment = document.getElementById('newDepartment');
  divYes.classList.remove('hidden');
  divNo.classList.add('hidden');
  divDepartment.classList.add('hidden');
}

function openNo() {
  var divYes = document.getElementById('newSpecial');
  var divNo = document.getElementById('newSpecialno');
  var divDepartment = document.getElementById('newDepartment');
  divYes.classList.add('hidden');
  divNo.classList.remove('hidden');
  divDepartment.classList.add('hidden');
}
function openDepartment() {
    var div = document.getElementById('newDepartment');
    div.classList.toggle('hidden');
  }


