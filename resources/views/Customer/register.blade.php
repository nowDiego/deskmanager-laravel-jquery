<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer</title>
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
</head>
<body>
    <main>
        <form id="form-submit">

            @csrf
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name"><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" ><br><br>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email"><br>
            <label for="ssn">SSN:</label><br>
            <input type="text" id="ssn" name="ssn"><br>
            <label for="phone">phone:</label><br>
            <input type="text" id="phone" name="phone"><br>

            <label for="street">street:</label><br>
            <input type="text" id="street" name="street"><br>
            <label for="city">city:</label><br>
            <input type="text" id="city" name="city"><br>
            <label for="state">state:</label><br>
            <input type="text" id="state" name="state"><br>
            <label for="zip_code">zip_code:</label><br>
            <input type="text" id="zip_code" name="zip_code"><br>
            <label for="country">country:</label><br>
            <input type="text" id="country" name="country"><br>
          
          
            <button id="bt-submit">Send</button>
          </form> 

        </form>

    </main>
    <footer>
    </footer>
</body>
<script>


async function handleCustomer(value,value2){       
    
    fetch(`/api/customer`,
  {
      headers: {
      'Accept': 'application/json, text/plain, */*',
      'Content-Type': 'application/json'
    },
      method: "POST",
      body: JSON.stringify(
          {_token: "{{ csrf_token() }}",name:value.name,password:value.password,email:value.email,ssn:value.ssn,phone:value.phone,street:value2.street,city:value2.city,state:value2.state,zip_code:value2.zip_code,country:value2.country }
          )
  })
  .then(function(res){ return res.json(); })
  .then(function(data){      

         
    if(data.status===true){
      console.log('ok')

        }  
      
      })
      
  }

  $("#form-submit").submit((e)=>{

e.preventDefault();

let User = new Object();
let Address = new Object();

User.name = $('#name').val();
User.password = $('#password').val();
User.email = $('#email').val();
User.ssn = $('#ssn').val();
User.phone = $('#phone').val();

Address.street = $('#street').val();
Address.city = $('#city').val();
Address.state = $('#state').val();
Address.zip_code = $('#zip_code').val();
Address.country = $('#country').val();


handleCustomer(User,Address);


})



</script>
</html>