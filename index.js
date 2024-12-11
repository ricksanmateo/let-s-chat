function _(element) {
  return document.getElementById(element);
}

const signup_button = _("signup_btn");
signup_button.addEventListener("click", collect_data);

function collect_data() {
  signup_button.disabled = true;
  signup_button.value = "Please wait...";

  const my_form = _("my_form");
  const inputs = my_form.getElementsByTagName("input");

  var data = {};
  for (let i = inputs.length - 1; i >= 0; i--) {
    var key = inputs[i].name;

    switch (key) {
      case "username":
        data.username = inputs[i].value;
        break;
      case "email":
        data.email = inputs[i].value;
        break;
      case "gender":
        if (inputs[i].checked) {
          data.gender = inputs[i].value;
        }
        break;
      case "password":
        data.password = inputs[i].value;
        break;
      case "password2":
        data.password2 = inputs[i].value;
        break;
    }
  }

  send_data(data, "signup");
}

function send_data(data, type) {
  var xml = new XMLHttpRequest();
  xml.onload = function () {
    if (xml.readyState == 4 || xml.status == 200) {
      handle_result(xml.responseText);
      signup_button.disabled = false;
      signup_button.value = "Sign Up";
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
