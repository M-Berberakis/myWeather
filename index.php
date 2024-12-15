<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Weather Report</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="card">
            <div class="search">
                <input type="text" placeholder="City"
                spellcheck="false">
                <button><img src="images/search.png" alt=""></button> <!-- The image that is used as a button to confirm the search of the user-->
            </div>
            <div class="error">
                <p>Invalid city name!</p> <!--This message is displayed if the user has typed in a city that does not exist-->
            </div>
            <div class="weather">
                <img src="images/rain.png" class="weather-icon">
                <h1 class="temp">22°C</h1>
                <h2 class="city">Athens</h2>
                <div class="details">
                    <div class="col">
                        <img src="images/humidity.png">
                        <div>
                            <p class="humidity">20%</p>
                            <p>Humidity</p>
                        </div>
                    </div>
                    <div class="col">
                        <img src="images/wind.png">
                        <div>
                            <p class="wind">3 km/h</p>
                            <p>Wind Speed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const API_KEY = ""; // The API key that created by the website openweathermap.org
            const API_URL = "https://api.openweathermap.org/data/2.5/weather?units=metric&q="; // The URL that openweathermap.org provides to extract weather data from cities

            const SEARCH_BOX = document.querySelector(".search input"); // The city that the user typed in will be extracted, and then request it with the API
            const SEARCH_BTN = document.querySelector(".search button");
            const WEATHER_ICON = document.querySelector(".weather-icon");

            async function checkWeather(city){
                const response = await fetch(API_URL + city + `&appid=${API_KEY}`); // The process to fetch the data 

                //If the user types a city that does not exist
                //the UI will be retracted and remove any information
                if (response.status == 404){
                    document.querySelector(".error").style.display = "block";
                    document.querySelector(".weather").style.display = "none";
                }else{
                    var data = await response.json();  

                document.querySelector(".city").innerHTML = data.name;
                document.querySelector(".temp").innerHTML = Math.round (data.main.temp) + "°C"; // The temperature data is extracted and rounded off by using the Math.round() function
                document.querySelector(".humidity").innerHTML = data.main.humidity + "%"; // Extraction of humidity percentage
                document.querySelector(".wind").innerHTML = data.wind.speed + " km/h"; // Extraction of wind speed 


                //Based on the weather on the city the user will search
                //the appropriate immage will be displayed to them
                //e.g. The weather is defined as "Clear", the "clear.png"
                //image will be displayed to the user.

                if(data.weather[0].main == "Clouds"){
                    WEATHER_ICON.src = "images/clouds.png";
                }
                else if(data.weather[0].main == "Clear"){
                    WEATHER_ICON.src = "images/clear.png";
                }
                else if(data.weather[0].main == "Rain"){
                    WEATHER_ICON.src = "images/rain.png";
                }
                else if(data.weather[0].main == "Drizzle"){
                    WEATHER_ICON.src = "images/drizzle.png";
                }else if(data.weather[0].main == "Mist"){
                    WEATHER_ICON.src = "images/mist.png";
                }
                else if(data.weather[0].main == "Snow"){
                    WEATHER_ICON.src = "images/snow.png";
                }

                //When the user first checks the website, the UI will be retracted
                //Once they search for a city, the appropriate data will be dispalyed

                document.querySelector(".weather").style.display = "block";
                document.querySelector(".error").style.display = "none";
                }   
            }
            //Once the user clicks the button (magnifying glass) next to the search bar, the request will be taken in
            SEARCH_BTN.addEventListener("click", () =>{
                checkWeather(SEARCH_BOX.value);
            });

        </script>
    </body>
</html>