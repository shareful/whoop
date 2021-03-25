<html>
<head>
    <title>Test Api</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<button id="login">Login</button>
<button id="user">User</button>
<button id="invitation">Send Invitation</button>
<script>
    var API_TOKEN = '';

    function setHeader() {
        $.ajaxSetup({
            headers: {
                'Authorization': API_TOKEN
            }
        });
    }

    $('#login').click(function () {
        $.post('http://127.0.0.1:8000/api/user/login', {
            email: "admin@test.com",
            password: "admin"
        }, function (response) {
            API_TOKEN = 'Bearer ' + response.data.api_token;
            console.log(API_TOKEN);
        });
    });
    $('#user').click(function () {
        setHeader();
        $.get('http://127.0.0.1:8000/api/user', function (response) {
            console.log(response);
        });
    });
    $('#invitation').click(function () {
        setHeader();
        $.post('http://127.0.0.1:8000/api/user/invitation', {
            email: "admin2@test.com"
        }, function (response) {
            console.log(response);
        });
    });
</script>
</body>
</html>