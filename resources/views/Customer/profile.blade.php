<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    @include('Components.menuCustomer')

    <main>
        <div class="text">Profile</div>
        @if (isset($customer))           
       
        <div class="content container-h center">

            <div class="container container-v ">
                <div class="box color-s">
                    <ul>
                        <li><label>Name:</label> {{ $customer->user->name }} </li>
                        <li><label>E-mail:</label> {{ $customer->user->email }}</li>
                        <li><label>Phone:</label> {{ $customer->phone }}</li>
                    </ul>
                </div>
                <div id="container-password" class="box">
                    <button class="btn mid" id="bt-password">Change Password</button>
                </div>

                <div id="container-address" class="box">
                    <button class="btn mid" id="bt-address">New Address</button>
                </div>
               

            </div>
            <div class="container container-v pl-1">
                @foreach ($customer->address as $item)
                    <div class="box container-h">
                        <ul class="w-3">
                            <li>
                                {{ $item->street }}
                            </li>
                            <li>{{ $item->city }}</li>
                            <li>{{ $item->state }}</li>
                            <li>{{ $item->zip_code }}</li>
                            <li>{{ $item->country }}</li>
                        </ul>
                        <span>
                        <i class='bx bx-trash icon btn-trash' data-id={{ $item->id }}></i>
                    </span>

                    </div>
                @endforeach

            </div>

        </div>
        @endif
    </main>

</body>
<script type="text/javascript" src="{{ asset('js/sidebar.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    const url = 'http://127.0.0.1:8000'

    async function handleNewAddress(value) {

        fetch(`/api/customer/address`, {
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}",
                    street: value.street,
                    city: value.city,
                    state: value.state,
                    zip_code: value.zip_code,
                    country: value.country
                })
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {
                if (data.status === true) {

                        location.reload();

                }

            })

    }


    async function handleChangePassword(value,value2) {

fetch(`/api/customer/password/reset`, {
        headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
        },
        method: "POST",
        body: JSON.stringify({
            _token: "{{ csrf_token() }}",
            password: value,
            password_confirmation: value2,          
        })
    })
    .then(function(res) {
        return res.json();
    })
    .then(function(data) {

        if (data.status === true) {           
            $("#container-password").html('<h4>Change Password</h4><p>'+data.message+'</p>');

        }

    })

}



    async function handleRemoveAddress(value) {

fetch(`/api/customer/address/${value}/destroy`, {
        headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
        },
        method: "GET",
    })
    .then(function(res) {
        return res.json();
    })
    .then(function(data) {

        if (data.status === true) {
            location.reload();
           

        } else {
            console.log(data);            
        }

    })

}



    $(".btn-trash").on("click", function() {
       
        let id = $(this).attr("data-id");      
        handleRemoveAddress(id)

    });


    
$("#bt-password").on("click", function() {

$("#container-password").html(
    "<h4>Change Password</h4> <form id='form-submit-password'> <div ><label>New Password: </label> <input type='password' id='password' name='password' /></div> <div > <label>Confirmation Password:</label> <input type='password' id='password_confirm' name='password_confirm' /></div><button id='bt-confirmation-password'>Change</button></div> <div class='row info-message'> </div>  </form>"
    )

});

    $("#bt-address").on("click", function() {

        $("#container-address").html(
            "<h4>New Address</h4> <form id='form-submit'> <div class='row'><label>Street: </label> <input type='text' id='street' name='street' /></div> <div class='row'> <label>City: </label> <input type='text' id='city' name='city' /></div> <div class='row'><label>State: </label> <input type='text' id='state' name='state' /></div> <div class='row'> <label>Zip_code: </label> <input type='text' id='zip_code' name='zip_code' /></div> <div class='row'><label>Country: </label> <input type='text' id='country' name='country' /></div> <div class='row'><button id='bt-confirmation'>Confirmation </button></div> <div class='row info-message'> </div>  </form>"
            )

    });


    $(document).on('submit', '#form-submit', function(e) {

        e.preventDefault();

        e.preventDefault();
        let form = $("#form-submit");


        if (form.valid()) {


            let Address = new Object();
            Address.street = $("#street").val();
            Address.city = $("#city").val();
            Address.state = $("#state").val();
            Address.zip_code = $("#zip_code").val();
            Address.country = $("#country").val();

            handleNewAddress(Address);

        }
    })


    $(document).on('submit', '#form-submit-password', function(e) {

e.preventDefault();

e.preventDefault();
let form = $("#form-submit-password");

if (form.valid()) {
    
    password = $("#password").val();
    password_confirmation = $("#password_confirmation").val();
    

    handleChangePassword(password,password_confirmation);

}
})


    $(document).on('click', '#bt-confirmation-password', function() {

$("#form-submit-password").validate({
    rules: {
        password:{
            required: true                    
                },
        password_confirm:{            
            required: true, 
            equalTo : "#password"
        }
    },
    errorClass: 'error-form',
        validClass: 'success',
        errorElement: 'span',
});

});
    

    $(document).on('click', '#bt-confirmation', function() {


        $("#form-submit").validate({
            rules: {
                street: "required",
                city: "required",
                state: "required",
                zip_code: "required",
                country: "required",
            },
            messages: {
                street: "Street required",
                city: "City is required",
                state: "State required",
                zip_code: "Zip Code is required",
                country: "Country required",

            },
            errorClass: 'error-form',
        validClass: 'success',
        errorElement: 'span',


        });

    });
</script>

</html>
