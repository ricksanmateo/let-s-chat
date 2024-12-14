<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Chat</title>
    <link rel="stylesheet" href="style.css">
    <meta name="description" content="Chat App">
</head>
<body>
    <div id="wrapper">
        <div id="left_pannel">
            <div id="user_info" style="padding: 10px;">
                <img class="profile_img" src="./images/user1.jpg" alt="">
                <br>
                <span id="user_name">Username</span>
                <br>
                <span id="user_email">email@gmail.com</span>
                <br>
                <br>
                <br>
                <div class="icons">
                    <label for="radio_chat"><img src="./icons/chat.png" alt=""></label>
                    <label for="radio_contacts"><img src="./icons/contacts.png" alt=""></label>
                    <label for="radio_settings"><img src="./icons/settings.png" alt=""></label>
                </div>
            </div>
            <input type="button" value="Logout" id="logout_btn">
        </div>
        <div id="right_pannel">
            <div id="header">Let's Chat</div>
            <div id="container">
                
                <div id="inner_left_pannel"></div>
                <input id="radio_chat" type="radio" name="myRadio" class="myRadio">
                <input id="radio_contacts" type="radio" name="myRadio" class="myRadio">
                <input id="radio_settings" type="radio" name="myRadio" class="myRadio">
                <div id="inner_right_pannel"></div>
            </div>
        </div>
    </div>
</body>
</html>

<script type="text/javascript">
    function _(element) {
        return document.getElementById(element);
    }

    var logout = _("logout_btn");
    logout.addEventListener("click", logout_user);

    function get_data(find, type) {
        var xml = new XMLHttpRequest();
        xml.onload = function () {
            if(xml.readyState == 4 || xml.status == 200) {
                handle_result(xml.responseText, type);
            }
        }
        var data = {};
        data.find = find;
        data.type = type;
        data = JSON.stringify(data)

        xml.open("POST", "api.php", true);
        xml.send();
    }
    function handle_result(result, type) {
        // alert(result);
        // echo(result);
        if (result.trim() != '') {
            var obj = JSON.parse(result);
            if (typeof(obj.logged_in) != 'undefined' && !obj.logged_in) {
                window.location.href = "login.php";
            } else {
                switch(result.data_type) {
                    case 'user_info':
                        _("user_name").innerHTML = obj.username;
                        _("user_email").innerHTML = obj.email;
                        break;
                    case 'contacts':
                        break;
                }
            }
        }
    }

    function logout_user() {
        get_data({}, "logout");
    }

    get_data({}, "user_info");
</script>