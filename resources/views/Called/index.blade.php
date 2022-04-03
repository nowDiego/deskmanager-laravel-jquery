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
    
    <main >
        <div class="text">Called</div>
 
        <div class="content">
        @csrf
        <table >
            <tr>
            <th>Protocol</th>
            <th>Description</th>
             <th>Status</th>           
              <th>Category</th>
              <th>Address</th>
              <th>Action</th>          
            </tr>
        
        @if (isset($called))                    
        @foreach ($called as $item)
  

        <tr class="active-row">
            <td>{{$item->protocol}}</td>
            <td>{{$item->description}}</td>
            <td>{{$item->status->name}}</td>        
            <td>{{$item->category->name}}</td>
            <td>{{$item->address->street}} - {{$item->address->city}} - {{$item->address->zip_code}}  </td>
            @if($item->status->name=='Aberto')
           <td><button class='btn mid bt-called' data-called="{{$item->id}}"><i class='bx bx-edit-alt icon' ></i></button></td>
                          
            @else
            <td></td>        
            @endif

        </tr>

            
        @endforeach

        </table>
        {{$called->links("pagination::bootstrap-4")}}

        @endif    

        </div>
    </main>
</body>
<script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>
<script>
const url = 'http://127.0.0.1:8000'    


$(".bt-called").on("click", function() {
   let called = $(this).attr('data-called'); 
      window.location = `${url}/support/called/${called}/edit`    

});


</script>
</html>