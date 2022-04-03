<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <header></header>
    <main>


        <div class="container-l">

            <form action="" id="form-submit">
                @csrf
                <label for="name">Name:</label><br>
                <input type="text" id="name" name="name"><br>
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br><br>
                <button id="bt-submit">Sign in</button>
                <div class="info-message pt-1"></div>
            </form>
        </div>

        <div class="container-r">
            <img src="/image/logo.png" alt="logo">
            <h1>Desk Manager</h1>
        </div>
    </main>
    <footer></footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>



<script>
    async function login(value, value2) {


        fetch("/api/auth", {
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    name: value,
                    password: value2
                })
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {

                const url = 'http://127.0.0.1:8000'

                if (data.status === true) {
                    if (data.data.role.role === 'customer') {

                        window.location = `${url}/dashboard/customer`
                    }
                    if (data.data.role.role === 'Support') {

                        window.location = `${url}/dashboard/support`
                    }

                } else {
                    $('.info-message').text(data.message);
                }

            })
            .catch(error => console.log('Authorization failed : ' + error.message));

    }



    $("#form-submit").validate({
        rules: {
            name: "required",
            password: "required",
        },
        messages: {
            name: "Name required",
            password: "Password is required",
        }
        
    });


    $("#form-submit").submit((e) => {

        e.preventDefault();
        let form = $("#form-submit" );  
               
        if(form.valid()){           
        
        let name = $('#name').val();
        let password = $('#password').val();     
        login(name, password);
        }


    })
</script>

</html>
