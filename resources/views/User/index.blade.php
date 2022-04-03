<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

    @include('Components.menuSupport')
    
    <main >
        <div class="text">User</div>

        <div class="content container-h ">
                  
    
            <div class="container-v w-1 m-1">         
              <h4>Support</h4> 
              <form action="" id="form-submit-support" class="container-v">
                @csrf   
                
                <label for="nameSupport">Name: </label>
                <input type="text" name="nameSupport" id="nameSupport">
                <label for="emailSupport">Email: </label>
                <input type="email" name="emailSupport" id="emailSupport">
                <label for="passwordSupport">Password: </label>
                <input type="password" name="passwordSupport" id="passwordSupport">

                <label for="registrationSupport">Registration: </label>
                <input type="text" name="registrationSupport" id="registrationSupport">

                <button class="btn mid mt-1" id="bt-submit-support">Send</button>
                <div class="info-message-support pt-1"></div>
              </form>         
          
          
        </div>

        <div class="container-v w-1 m-1">          
          <h4>Customer</h4>
          <form action="" id="form-submit-customer" class="container-v">
            @csrf             
            

            <label for="nameCustomer">Name: </label>
            <input type="text" name="nameCustomer" id="nameCustomer">
            <label for="emailCustomer">Email: </label>
            <input type="email" name="emailCustomer" id="emailCustomer">
            <label for="passwordCustomer">Password: </label>
            <input type="password" name="passwordCustomer" id="passwordCustomer">

            <label for="ssnCustomer">SSN: </label>
            <input type="text" name="ssnCustomer" id="ssnCustomer">
            <label for="phoneCustomer">Phone: </label>
            <input type="text" name="phoneCustomer" id="phoneCustomer">


            <label for="streetCustomer">Street: </label>
            <input type="text" name="streetCustomer" id="streetCustomer">
            <label for="cityCustomer">City: </label>
            <input type="text" name="cityCustomer" id="cityCustomer">
            <label for="stateCustomer">State: </label>
            <input type="text" name="stateCustomer" id="stateCustomer">
            <label for="zipcodeCustomer">Zip Code: </label>
            <input type="text" name="zipcodeCustomer" id="zipcodeCustomer">
            <label for="countryCustomer">Country: </label>
            <input type="text" name="countryCustomer" id="countryCustomer">

            <button class="btn mid  mt-1" id="bt-submit-customer">Send</button>
            <div class="info-message-customer pt-1"></div>

          </form>         
      
      
    </div>
    </main>
    
</body>
<script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  
  const url = 'http://127.0.0.1:8000'  

    

  async function handleCustomer(value){       
    
    fetch("/api/customer",
    {
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
      },
        method: "POST",
        body: JSON.stringify(
            {_token: "{{ csrf_token() }}", ssn:value.ssn,phone:value.phone,street:value.street,city:value.city,state:value.state,zip_code:value.zip_code,country:value.country,name:value.name,email:value.email,password:value.password}
            )
    })
    .then(function(res){ return res.json(); })
    .then(function(data){      
          
        if(data.status===true){
            // location.reload();      
           
            $("#form-submit-customer").html('<section class="container-v center"><img src="../image/img-success.png" alt="success" width="90px" height="70px"><h3>All Right!</h3>'+'<p class="color-s">'+data.message+'</p></section>');
          
          }
            else{
                $(".info-message-customer").text(data.message);
            }
        
        }).catch(error => {
            $(".info-message").text('There was an error registering User Customer');
               
        })
    
    
    }


    async function handleSupport(value){       
    
    fetch("/api/support",
    {
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
      },
        method: "POST",
        body: JSON.stringify(
            {_token: "{{ csrf_token() }}", registration:value.registration,name:value.name,email:value.email,password:value.password}
            )
    })
    .then(function(res){ return res.json(); })
    .then(function(data){      
          
        if(data.status===true){
            
            $("#form-submit-support").html('<section class="container-v center"><img src="../image/img-success.png" alt="success" width="90px" height="70px"><h3>All Right!</h3>'+'<p class="color-s">'+data.message+'</p></section>');

           

             }
            else{
                $(".info-message-support").text(data.message);
            }
        
        }).catch(error => {
            $(".info-message").text('There was an error registering User Support');
               
        })
    
    
    }

    $("#form-submit-customer").validate({
        rules: {           
          nameCustomer: "required",
          emailCustomer: "required",
          passwordCustomer: "required",
          ssnCustomer: "required",
          phoneCustomer: "required",
          streetCustomer: "required",
          cityCustomer: "required",
          stateCustomer: "required",
          zipcodeCustomer: "required",
          countryCustomer: "required",
           
        },
        messages: {           
          nameCustomer: "Name is required",
          emailCustomer: "E-mail is required",
          passwordCustomer: "Password is required",
          ssnCustomer: "SSN is required",
          phoneCustomer: "Phone is required",
          streetCustomer: "Street is required",
          cityCustomer: "City is required",
          stateCustomer: "State is required",
          zipcodeCustomer: "Zip Code is required",
          countryCustomer: "Country is required",
          
           
        },
        errorClass: 'error-form',
        validClass: 'success',
        errorElement: 'span',
       
        
    });

    $("#form-submit-support").validate({
        rules: {           
          nameSupport: "required",
          emailSupport: "required",
          passwordSupport: "required",
          registrationSupport: "required",
         
           
        },
        messages: {           
          nameSupport: "Name is required",
          emailSupport: "E-mail is required",
          passwordSupport: "Password is required",
          registrationSupport: "Registration is required",        
                     
        },
        errorClass: 'error-form',
        validClass: 'success',
        errorElement: 'span',
       
        
    });

  
    $("#form-submit-support").submit((e)=>{
    
    e.preventDefault();

    let form = $("#form-submit-support" );  
               
               if(form.valid()){           
                      
      console.log('teste2');
    
    let  Support = new Object();

    Support.name = $("#nameSupport").val();
    Support.email = $("#emailSupport").val();  
    Support.password = $("#passwordSupport").val();  
    Support.registration = $("#registrationSupport").val();  
        
        handleSupport(Support);
               }
    })




    $("#form-submit-customer").submit((e)=>{
    
    e.preventDefault();

    let form = $("#form-submit-customer" );  
               
               if(form.valid()){          
               
   
    
      let  Customer = new Object();

      Customer.name = $("#nameCustomer").val();
      Customer.email = $("#emailCustomer").val();   
      Customer.password  = $("#passwordCustomer").val();   
       

      Customer.ssn = $("#ssnCustomer").val();
      Customer.phone = $("#phoneCustomer").val();  

      Customer.street = $("#streetCustomer").val();
      Customer.city = $("#cityCustomer").val();
      Customer.state = $("#stateCustomer").val();
      Customer.zip_code = $("#zipcodeCustomer").val();
      Customer.country = $("#countryCustomer").val();

      handleCustomer(Customer);
         
               }
    })


 




  </script>
</html>