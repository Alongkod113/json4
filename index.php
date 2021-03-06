<!DOCTYPE html>
<html>

<head>
    <title>Alongkod_63112379</title>
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
            <p class="text-center h1">สภาพอากาศ</p>
            <br />
            <div class="from-group mb-3 ">
                <span class="from-group-text">Latitude :</span>
                <input type="text" class="form-control" placeholder="ละติจูด" aria-label="Latitude"
                    aria-describedby="Latitude" id="Latitude">
            </div>
            <div class="from-group mb-3">
                <span class="from-group-text">Longitude :</span>
                <input type="text" class="form-control" placeholder="ลองจิจูด" aria-label="Longitude"
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
        var urlDefualt = "https://api.openweathermap.org/data/2.5/weather?lat=8.2710995&lon=98.313486&appid=ec51e8410775f2be680dbd8514677c26";
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
                line += "<img src='https://www.77kaoded.com/wp-content/uploads/2020/10/1188729.jpg' class='card-img-top' ><div class='card-body'>"
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
        var url = "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long + "&appid=ec51e8410775f2be680dbd8514677c26"
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
                line += "<img src='https://mpics.mgronline.com/pics/Images/561000002001301.JPEG.webp' class='card-img-top' ><div class='card-body'>"
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
