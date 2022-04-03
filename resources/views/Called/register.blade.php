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
    @include('Components.menuCustomer')

    <main >
        <div class="text">Called</div>

        <div class="content container-h">
            <div class="container">
                <h4 class="color-s">Register Called :</h4>    
        <form action="" id="form-submit">
            @csrf        
            <label for="description">Description:</label><br>
            <textarea id='description' name='description' rows='5' cols='33' class="w-2"></textarea><br>
          
            <label for="category" class="form-label">Category:</label><br>
            <select name="category" id="category" class="w-2">
                @foreach ($categories as $item)               
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select><br>
      
            <label for="address" class="form-label">Address:</label><br>         
         
            <fieldset id="group2">                        

            @foreach ($customer->address as $item)              
          
            <input type="radio" name="group2" value="{{$item->id}}">
            <label>{{$item->street}} - {{$item->city}}</label><br>           
           
            @endforeach
        </fieldset>
           <button class="btn mid w-2" id="bt-submit">Send</button>
           <div class="info-message pt-1"></div>
          </form> 
        </div>
   
        <div class="container">
           <h4 class="color-s">My Calleds :</h4>
           @if (isset($customer))                         
            @foreach ($customer->called as $item)  
               <div class="box">
              
                  <div><label>Protocol:</label>{{$item->protocol}}</div>
                <div><label>Description:</label>{{$item->description}}</div>
            <div> <label>Status:</label>{{$item->status->name}}</div>
            </div>
            @endforeach
            @endif
        </div>
        </div>
    </main>
   
</body>
<script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>  


    async function handleRegister(value,value2,value3){       
    
    fetch("/api/called",
    {
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
      },
        method: "POST",
        body: JSON.stringify(
            {_token: "{{ csrf_token() }}", description:value,category:value2,address:value3}
            )
    })
    .then(function(res){ return res.json(); })
    .then(function(data){      
          
        if(data.status===true){
            location.reload();       
           

             }
            else{
                $(".info-message").text(data.message);
            }
        
        }).catch(error => {
            $(".info-message").text('There was an error registering Called');
               
        })
    
    
    }

    $("#form-submit").validate({
        rules: {           
            description: "required",
            category: "required",
            group2: "required"
           
           
        },
        messages: {           
            description: "description is required",
            category: "category is required",
            group2: "required"
           
          },  
          errorClass: 'error-form',
        validClass: 'success',
        errorElement: 'span',
           
            
        
    });
        
    $("#form-submit").submit((e)=>{
    
    e.preventDefault();

    let form = $("#form-submit" );  
               
               if(form.valid()){           
               
    
   
    let description = $('#description').val();
    let category = $('#category').val();
    let address = $("input:radio[name='group2']:checked").val();  

    handleRegister(description,category,address);
               }
        
    })
    
    
    </script>
</html>