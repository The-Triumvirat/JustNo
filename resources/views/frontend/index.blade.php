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

    <br><br>

    <button onclick="copyNo()">Copy</button>
    <button onclick="shareNo()">Share</button>

    <br><br>
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

function copyNo() {
    const text = document.getElementById('reason').innerText;

    navigator.clipboard.writeText(text)
        .then(() => {
            document.getElementById('info').innerText = "Copied to clipboard ✔️";
        })
        .catch(() => {
            document.getElementById('info').innerText = "Copy failed";
        });
}

function shareNo() {
    const text = document.getElementById('reason').innerText;

    if (navigator.share && navigator.canShare?.({ text })) {
        navigator.share({
            title: 'JustNo',
            text: text,
            url: window.location.href
        })
        .then(() => {
            document.getElementById('info').innerText = "Shared successfully";
        })
        .catch((err) => {
            document.getElementById('info').innerText =
                err?.name === "AbortError"
                ? "Share cancelled"
                : "Share failed";
        });

    } else {
        navigator.clipboard.writeText(text)
            .then(() => {
                document.getElementById('info').innerText =
                    "Sharing not supported - copied instead";
            })
            .catch(() => {
                document.getElementById('info').innerText =
                    "Share not supported and copy failed";
            });
    }
}


</script>

</body>
</html>
