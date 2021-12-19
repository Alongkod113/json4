<!DOCTYPE html>
<html>

<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>
    .br {
        background-color: cyan
    }
</style>

<body class="br">
    <div class="container mt-5 col-4">
        <div class="container mx-auto">

            <p class="text-center h1">สภาพอากาศในพื้นที่ต่างๆ</p>
            <br />
            <div class="from-group mb-3 ">
                <span class="from-group-text">Latitude :</span>
                <input type="text" class="form-control" placeholder="ละติจูด " aria-label="Latitude"
                    aria-describedby="Latitude" id="Latitude">
            </div>
            <div class="from-group mb-3">
                <span class="from-group-text">Longitude :</span>
                <input type="text" class="form-control" placeholder=" ลองจิจูด" aria-label="Longitude"
                    aria-describedby="Longitude" id="Longitude">
            </div>
            <div class="container-fluid mt-5  d-flex justify-content-center">
                <button type="button" class="btn btn-primary" id="btnSearch">ค้นหา</button>
            </div>
        </div>
        <br />
        <div class="container mt-5 d-flex justify-content-center">
            <div class="card" id="cardWeather" style="width: 30rem; ">
            </div>

        </div>
    </div>

</body>
<script>

    function setDefault() {
        var urlDefualt = "https://api.openweathermap.org/data/2.5/weather?lat=8.4196647&lon=99.961212&appid=d1ffd4a48d1871c9b8d00735829b6d84";
        $.getJSON(urlDefualt)
            .done((data) => {
                var datetime = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(0) + " °C");
                var humid = (data.main["humidity"] + "%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);

                    }
                })


                var line = "<div id='dataWeather'>";
                line += "<img src='data:image/jpeg;base64,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' class='card-img-top' ><div class='card-body'>"
                line += "<h5 class='card-title my-3 '>" + place + "</h5>";
                line += "<p class='card-text'>อุณหภูมิ : " + temp + "</p>";
                line += "<p class='card-text'>ความชื้นสัมพัทธ์ : " + humid + "</p>";
                line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : " + sunrise + "</p>";
                line += "<p class='card-text'>อาทิตย์ตกเวลา : " + sunset + "</p>";
                line += "<p class='card-text'>เวลา: " + datetime + "</p>";



                line += "</div>"
                $("#cardWeather").append(line);
            }).fail((xhr, status, error) => { })
    }

    function LoadForcast() {
        var lat = $("#Latitude").val();
        var long = $("#Longitude").val();
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=d1ffd4a48d1871c9b8d00735829b6d84"
        $.getJSON(url)
            .done((data) => {
                var datetime = convertHMS(data.dt);
                var sunrise = convertHMS(data.sys["sunrise"]);
                var sunset = convertHMS(data.sys["sunset"]);
                var place = (data.name);
                var windSpeed = (data.wind["speed"]);
                var temp = ((data.main["temp"] - 273).toFixed(0) + " °C");
                var humid = (data.main["humidity"] + "%");
                $.each(data.weather[0], (key, value) => {
                    for (let i = 0; i < (data.weather[0]).length; i++) {
                        console.log(value);

                    }
                })
                var line = "<div id='dataWeather'>";
                line += "<img src='https://cdn.pixabay.com/photo/2016/12/18/13/44/download-1915749_960_720.png' class='card-img-top' ><div class='card-body'>"
                line += "<h5 class='card-title my-3'> " + place + "</h5>";
                line += "<p class='card-text'>อุณหภูมิ : " + temp + "</p>";
                line += "<p class='card-text'>ความชื้นสัมพัทธ์ : " + humid + "</p>";
                line += "<p class='card-text'>อาทิตย์ขึ้นเวลา : " + sunrise + "</p>";
                line += "<p class='card-text'>อาทิตย์ตกเวลา : " + sunset + "</p>";
                line += "<p class='card-text'>เวลา : " + datetime + "</p>";



                line += "</div>"
                $("#cardWeather").append(line);

            }).fail((xhr, status, error) => { })
    }

    function convertHMS(value) {
        let time = value;
        var convert = new Date(time * 1000);
        var hours = convert.getHours();
        var minutes = "0" + convert.getMinutes();
        var seconds = "0" + convert.getSeconds();
        return (hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2));

    }








    $(() => {
        setDefault();
        $("#btnSearch").click(() => {
            LoadForcast();
            $("#dataWeather").hide();

        });
    });
</script>

</html>
