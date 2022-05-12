<!--Weather App -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Weather App </title>
</head>
<style>
    .weather table{
        padding: 50px 25px;
        border-radius: 20px 20px 20px 20px;
        color:black;
        font-size: x-large;
        background-color: rgba(255, 248, 220, 0.363);
        
        
        

    }
    #g1{
        color : black
    }
    #back{
         background-image: url('./1.jpeg');
         background-size: 1540px 750px;
         background-repeat: no-repeat;
         
         
    }
    .icon{
       
       margin-left: 125px;
    }
    h1{
        color: black;
    }
    
    </style>
    <!--With the help of this code, you can retrieve live weather data from the OpenWeatherMap API -->

    <!-- <script>
        fetch('http://localhost/prototype/myapi.php?city=Tucson')
        .then (function(response){
            return response.json();
        
    
        })
        .then (function(info){
            
    
            document.getElementById("description").innerHTML=info.weather_condition
            document.getElementById("tem").innerHTML=info.temperature+"°C"
            document.getElementById("humidity").innerHTML=info.humidity + "%"
            document.getElementById("speed").innerHTML=info.wind_speed+"km/hr"
            document.getElementById("pre").innerHTML=info.pressure + " hPa"
            document.getElementById("dt").innerHTML=info.weather_datetimes
    
    
        })
    
    </script> -->

    <script>
        // Register service worker
    if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
    navigator.serviceWorker.register('servicefile.js').then(function(registration) {
    // Registration was successful
    console.log('ServiceWorker registration successful');
    }, function(err) {
    // registration failed :(
    console.log('ServiceWorker registration failed: ', err);
    });
    });
    
    }
    
    // Check browser cache first, use if there and less than 10 seconds old
    if(localStorage.when != null
    && parseInt(localStorage.when) + 1000 > Date.now()) {
    let freshness = Math.round((Date.now() - localStorage.when)/1000) + " second(s)";
            document.getElementById("description").innerHTML=localStorage.description
            document.getElementById("tem").innerHTML=localStorage.tem + "°C"
            document.getElementById("humidity").innerHTML=localStorage.humidity + "%"
            document.getElementById("speed").innerHTML=localStorage.speed + "km/hr"
            document.getElementById("pre").innerHTML=localStorage.pre + " hPa"
            document.getElementById("dt").innerHTML=localStorage.dt
    document.getElementById("mylastupdate").innerHTML = freshness;
    // No local cache, access network
    } else {
    // Fetch weather data from API for given city
    fetch('myapi.php?city=Tucson') //retrive the data from the php.
    // Convert response string to json object
    .then(response => response.json())
    .then(response => {
    // Copy one element of response to our HTML paragraph
            document.getElementById("description").innerHTML=response.weather_condition
            document.getElementById("tem").innerHTML=response.temperature + "°C"
            document.getElementById("humidity").innerHTML=response.humidity + "%"
            document.getElementById("speed").innerHTML=response.wind_speed + "km/hr"
            document.getElementById("pre").innerHTML=response.pressure + " hPa"
            document.getElementById("dt").innerHTML=response.weather_datetimes
    
    // Save new data to browser, with new timestamp
    localStorage.description = response.weather_condition;
    localStorage.tem = response.temperature + '';
    localStorage.when = Date.now(); // milliseconds since January 1 1970
    localStorage.humidity = response.humidity;
    localStorage.speed = response.wind_speed;
    localStorage.pre = response.pressure;
    localStorage.dt = response.weather_datetimes;
    
    
    })
    .catch(err => {
        if(localStorage.when != null) {
    // Get data from browser cache
    let freshness = Math.round((Date.now() - localStorage.when)/1000) + " second(s)";
            document.getElementById("description").innerHTML=localStorage.description
            document.getElementById("tem").innerHTML=localStorage.tem + "°C"
            document.getElementById("humidity").innerHTML=localStorage.humidity + "%"
            document.getElementById("speed").innerHTML=localStorage.speed + "km/hr"
            document.getElementById("pre").innerHTML=localStorage.pre + " hPa"
            document.getElementById("dt").innerHTML=localStorage.dt
            document.getElementById("mylastupdate").innerHTML = freshness; 
    } else {
    // Display errors in console
    console.log(err);
    }
    
    
    });
    }
    </script>

<body id="back">
    <h1 align="center">Weather App</h1>
    <!--structure of the application-->
    <div class="weather">
        <table align="center">
            
            <tr>
                <th id="g1">Live Weather of Tucson </th>
            </tr>
            <tr>
                <td><img class ="icon" src=""></td>
                
            </tr>
            <tr>
                <td>Weather Condition:</td>
                <td id = 'description'></td>
                
            </tr>
            <tr>
                <td >Temperature :</td>
                <td id = "tem"></td>
            </tr>
        
            <tr>
                <td >Pressure :</td>
                <td id = "pre"></td>
            </tr>
            <tr>
                <td >Humidity :</td>
                <td id = "humidity"></td>
            </tr>
            <tr>
                <td >Wind Speed :</td>
                <td id = "speed"></td>
            </tr>   
            <tr>
                <td >Datetimes :</td>
                <td id = "dt"></td>
            </tr>
            <tr>
                <td >Last Update :</td>
                <td id = "mylastupdate"></td>
            </tr>         
        </table>

        

    </div>
</body>
</html>