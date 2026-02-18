const url = "https://api.openweathermap.org/data/2.5/weather"; // openweathermap base url
const apiKey = "XXXXXXXXXXXXXXXXXX"; // API Key

async function verifyData(cityName, stateName) // Verify that the provided input has a valid output
{
    const inputData = `${url}?q=${cityName},${stateName}&appid=${apiKey}&units=imperial`; //Out together full API request
    try {
        const res = await fetch(inputData); // Try to fetch data given the input
        const data = await res.json(); // Return promise
        if (res.ok) {
            showWeatherData(data);
            sendDataToDB()
        } 
        else {
            alert(`${cityName} not found in ${stateName}. Please try again.`); // Alert the user if the city can't be found 
        }
	} 
    catch (error) {
		console.error("Error fetching weather data:", error); // Miscelaneous error catch
	}
}

async function sendDataToDB(weatherData, stateName) // Send data to be stored in the DB
{
    const dataToSend = {
        city: weatherData.name,
        state: stateName,
        temperature: weatherData.main.temp,
        description: weatherData.weather[0].description,
        wind_speed: weatherData.wind.speed
    }

    try {
            const response = await fetch('logweather.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json',},
            body: JSON.stringify(dataToSend)
        });
        
        const result = await response.json();
        if (result.succes){
            console.log("Data successfully sent to DB")
        }
        else
        {
            console.error("Error sending data to DB")
        }
    } 
    catch (error) {
        console.error("Error sending data to DB: ", error)
    }
}

function showWeatherData(data) // Assign vars for use with HTML
{
    $('#city-name').text(data.name); // City Name
    $('#date').text(moment().format('MMMM Do YYYY, h:mm:ss a')); // Date (Month, Day, Year, Time)
    $('#temperature').html(`${Math.round(data.main.temp)}°F`); // Temperature
    $('#description').text(data.weather[0].description); // Weather description
    $('#wind-speed').html(`Wind Speed: ${data.wind.speed} mph`); // Wind speed
}