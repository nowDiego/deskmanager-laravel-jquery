<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Support</title>
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
        <div class="text">Dashboard</div>

        <div class="content">
         
         
          
            <div class="dashboard-s">

              @if(isset($count))                
             
              <div class="count-called">
               <div class="mt-1">
               
                <h2>{{$count}} </h2>
                <h4>Open Calleds</h4>
               
              </div>
                </div>

                @endif
               
               @if (isset($called))
                  
                <div class="latest-called">
                  <i class='bx bx-phone-call icon' ></i>
                  <span >Latest Calleds</span>
                  <div class="mt-1">  
                  @foreach ($called as $item)

                    <div class="latest-called-item">
                        {{$item->protocol}}
                        {{$item->category->name}}
                        {{$item->status->name}}
                    </div>
                        
                    @endforeach
                </div>
              </div>

              @endif

                <div class="report">
                  <i class='bx bxs-report toggle'></i>
                  <span >Report</span>                               
                  
             <fieldset class="mt-1">
                    <input type="radio" id="day" name="report" value="day">
                    <label for="day">Day</label>
                                 
                
                    <input type="radio" id="week" name="report" value="week"
                           checked>
                    <label for="week">Week</label>
                                   
                    <input type="radio" id="month" name="report" value="month">
                    <label for="month">Month</label>
                  <button id="bt-report" class="bt mt-1">Generator</button>
              </fieldset>
                    
                </div>

                <div class="graph">
                  <i class='bx bx-bar-chart-alt toggle'></i>
                  <span >Graph</span>
                   <div class="mt-1">
                    <canvas id="myChart"></canvas>
                  </div>
                  </div>


            </div>

           
          
        </div>
    </main>
    
</body>
<script type="text/javascript" src="{{asset('js/sidebar.js')}}"></script>

<script>
  
  const url = 'http://127.0.0.1:8000'  

  handleGraph();
  
async function handleGraph(){       
    
    fetch("/api/graph",
    {
        headers: {
        'Accept': 'application/json, text/plain, */*',
        'Content-Type': 'application/json'
      },
        method: "GET",      
    })
    .then(function(res){ return res.json(); })
    .then(function(data){      
          console.log(data);
    callbackGraph(data);
   
        })
        
    }

 function callbackGraph(value){

 
    const data = {
      labels: Object.values(value.labels),
      datasets: [{
        label: 'Calleds',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: Object.values(value.data),
        backgroundColor: "#1B98E0",
       borderColor: "#1B98E0",
      }]
    };


      
    const config = {
      type: 'line',
      data: data,
      options: {}
    };

    console.log(config);

  const myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

 }


  async function handleReport(value){       
    
    location.href = url+`/report/${value}`;       
    
    }
        




  $("#bt-report").on("click", function() {
    let report = $("input:radio[name='report']:checked").val();    
    handleReport(report) 
  });


  </script>
</html>