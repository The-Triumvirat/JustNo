<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JustNo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('frontend/style.css') }}" rel="stylesheet">
</head>

<body>

<div class="card">
    <h1>JustNo</h1>

    <div id="reason" class="reason">
        Loading your No…
    </div>

    <button onclick="getNo()">Give me another No</button>

    <br>
    <small id="info"></small>
</div>


<script>
async function getNo() {
    const reasonBox = document.getElementById('reason');
    const info = document.getElementById('info');

    reasonBox.innerText = "Please wait…";
    info.innerText = "";

    try {
        const res = await fetch('/api/v1/no');

        if (res.status === 429) {
            const data = await res.json();
            reasonBox.innerText = data.reason ?? "Too many requests - chill";
            info.innerText = "Rate limit active";
            return;
        }

        const data = await res.json();
        reasonBox.innerText = data.reason ?? "The API had no motivation to provide a reason :(";

    } catch {
        reasonBox.innerText = "Something went wrong :(";
        info.innerText = "";
    }
}

document.addEventListener('DOMContentLoaded', getNo);
</script>

</body>
</html>
