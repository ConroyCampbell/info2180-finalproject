var email = document.querySelector("#loginemail");
var password = document.querySelector("#loginpassword");
var btn = document.querySelector("#loginsubmit");
var invalid = $("#invalid");
var xhr = new XMLHttpRequest();

btn.addEventListener("click", function(event){
    $.get("sign-in copy.php?email="+email.value+"&password="+password.value, function(output){
        if(output==1){
            $.get("dashboard copy.php", function(data){
                $("body").html(data);
            });
        }else{
            alert("Invalid email or password");
            invalid.show();
        }
    });
});