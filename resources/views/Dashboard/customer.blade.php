<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Customer</title>
    <script
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  </head>
<body>
  @include('Components.menuCustomer')

  
<main >
    <div class="text">Dashboard</div>
    <div class="content">

      <div class="dashboard-c">

        <section class="content-dashboard-c">
          <div class="content-dashboard-c-top">
        
            <div class="content-dashboard-c-called" id="bt-called">
              <i class='bx bx-phone-call icon' ></i>
              <h1>CALLED</h1>
            </div>             
         
                    <div class="content-dashboard-c-profile" id="bt-profile">
              <i class='bx bx-user icon' ></i>
              <h1>MY PROFILE</h1>
            </div>
         
          </div> 
          <div class="content-dashboard-c-bottom">
             
          </div> 
          
        </section>

        <section class="image-dashbord-c">
          <img src="/image/img-one.png" alt="image">
        </section>



      </div>

    </div>
  </main>

 <script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>

 <script>
  
  const url = 'http://127.0.0.1:8000';  


  $("#bt-called").on("click", function() {
    location.href = url+'/customer/called'
  });


  $("#bt-profile").on("click", function() {
    location.href = url+'/customer/profile'
  });



  </script>

</body>
</html>