<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KSB | Test</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <style type="text/css">
        body {
            overflow: visible;
        }

        iframe {
            height: 600px;
            width: 100%;
            border: 0px;
            padding-top: 8px;
            margin: 0px;
        }

        #timer {
            background-color: #c0c0c0;
            color: #000000;
            font-family: arial;
            font-weight: bold;
            padding: 10px 30px;
            border-radius: 100px;
        }
    </style>

</head>

<body>
    <div id="timer" align="center">
        <a class="fa fa-book"></a> Test Psikolog || Waktu Tersisa <a class="fa fa-clock-o"></a>
        <span id="time"></span>
    </div>

    <span id="form">
        <iframe
            src="https://docs.google.com/forms/d/e/1FAIpQLSfuDdDiMYESfNoIlM1E0A8i4fhFV5KB4eEctyV0QL1hh3qY0w/viewform">Tunggu
            yaa</iframe><br />
    </span>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    function startTimer(duration, display) {
        var timer = duration,
            minutes,
            seconds;
        var batas = timer + 60 * 1;
        setInterval(function() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds + " Menit";

            if (--timer <= 0) {
                document.getElementById("timer").innerHTML = "Waktu Habis";
                console.log("habis");
            }
            if (--batas <= 0) {
                document.getElementById("form").style.visibility = "hidden";
                document.getElementById("timer").style.visibility = "hidden";
                $.ajax({
                    url: '/test-selesai', // Ganti dengan URL yang diinginkan
                    type: 'GET',
                    success: function(result) {
                        console.log('Rz Wuzz Here!');
                        window.location.href = '/test-selesai'; // Ganti dengan URL yang diinginkan
                    },
                    error: function(data) {
                        console.log('Rz Wuzz Error!');
                    }
                });
            }
        }, 1000);
    }

    window.onload = function() {
        var fiveMinutes = 60 * "{{ $diffInMinutes }}", //waktu
            display = document.querySelector("#time");
        startTimer(fiveMinutes, display);
    };
</script>


</html>
