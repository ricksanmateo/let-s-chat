<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="signup_wrapper">
        <div class="signup_header">Login</div>
        <div id="error"></div>
        <form action="" id="my_form">
            
            <input type="text" name="email" placeholder="Email"><br>
            
            <input type="password" name="password" placeholder="Password"><br>
    
            <input type="button" value="Login" id="login_btn"><br>
        </form>
    </div>
    <script type="text/javascript">
        function _(element) {
  return document.getElementById(element);
}

const login_button = _("login_btn");
login_button.addEventListener("click", collect_data);

function collect_data() {
    login_button.disabled = true;
    login_button.value = "Please wait...";

  const my_form = _("my_form");
  const inputs = my_form.getElementsByTagName("input");

  var data = {};
  for (let i = inputs.length - 1; i >= 0; i--) {
    var key = inputs[i].name;

    switch (key) {

      case "email":
        data.email = inputs[i].value;
        break;
     
      case "password":
        data.password = inputs[i].value;
        break;
    }
  }

  send_data(data, "login");
}

function send_data(data, type) {
  var xml = new XMLHttpRequest();
  xml.onload = function () {
    if (xml.readyState == 4 || xml.status == 200) {
      handle_result(xml.responseText);
      login_button.disabled = false;
      login_button.value = "Login";
    }
  };
  data.data_type = type;
  var data_string = JSON.stringify(data);
  xml.open("POST", "api.php", true);
  xml.send(data_string);
}

function handle_result(result) {
  var data = JSON.parse(result);
  if (data.data_type == "error") {
    var error = _("error");
    error.innerHTML = data.message;
    error.style.display = "block";
  } else {
    window.location.href = "index.php";
  }
}

    </script>
</body>
</html>