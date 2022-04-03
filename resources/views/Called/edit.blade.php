<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Called</title>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="{{asset('css/global.css')}}">
  <link rel="stylesheet" href="{{asset('css/sidebar.css')}}">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  @include('Components.menuSupport')
    
    <main>
        <div class="text">Called</div>
      @if (isset($called))      
      
        <div class="content">
      <ul class="color-s">
        <li><label>Protocol:</label>{{$called->protocol}} </li>
        <li><label>Description:</label>{{$called->description}} </li>
        <li>  <label>Status:</label>{{$called->status->name}}  </li>
        <li>  <label>Category:</label>{{$called->category->name}}  </li>
        <li> <label>Address:</label> {{$called->address->street}} - {{$called->address->city}} - {{$called->address->zip_code}} </li>
      </ul>
      <input type="hidden" id="calledId" name="calledId" value={{$called->id}}>

      <div id="container-finalize" class="container-v">

        <button id="bt-finalize">finalize</button>

      </div>
     
        </div>
        @endif
     
    
      </main>  
</body>

<script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
  
  const url = 'http://127.0.0.1:8000';

async function handleUpdatedStatusCalled(value,value2){       
    
      fetch(`/api/called`,
    {
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
      },
        method: "PUT",
        body: JSON.stringify(
            {_token: "{{ csrf_token() }}",called:value,observation:value2}
            )
    })
    .then(function(res){ return res.json(); })
    .then(function(data){    
      if(data.status===true){
           
      window.location = `${url}/support/called`     
      }else{
            $('.info-message').text(data.message);
        }

        
        })
        
    }


$("#bt-finalize").on("click", function() {

$("#container-finalize").html("<form id='form-submit' class='flex-v color-s'><label>Observation</label> <textarea id='observation' name='observation' rows='5' cols='33' class='m-1'></textarea> <button id='bt-confirmation'>Confirmation </button>   <div class='info-message pt-1'></div> </form>")
  

});



$(document).on('click', '#bt-confirmation', function() {

  $("#form-submit").validate({
        rules: {
          observation: "required",
           
        },
        messages: {
          observation: "Observation required",            
          
        },
        errorClass: 'error-form',
        validClass: 'success',
        errorElement: 'span',
      


})
});


$(document).on('submit', '#form-submit', function(e) {              

e.preventDefault();

e.preventDefault();
let form = $("#form-submit" );  


if(form.valid()){       

  let called = $("#calledId").val();
    let observation = $("#observation").val();  
   handleUpdatedStatusCalled(called,observation);

}
})



</script>

</html>