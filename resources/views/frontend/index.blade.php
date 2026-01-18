<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JustNo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<div class="card">
    <h1>JustNo</h1>

    <div id="reason" class="reason">
        Loading your No…
    </div>

    <div class="buttons">
        <!-- Primary Row -->
        <div class="action-row-full">
            <button class="btn-primary" onclick="getNo()">Give me another No</button>
        </div>

        <!-- Secondary Row -->
        <div class="action-row-half">
            <div>
                <button class="btn-secondary" onclick="copyNo()">Copy</button>
            </div>
            <div>
                <button class="btn-secondary" onclick="shareNo()">Share</button>
            </div>
        </div>
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

        // store id for sharing
        window.currentNoId = data.id ?? null;

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
    const id = window.currentNoId;

    // Easter egg or no-id fallback
    if (!id) {
        navigator.clipboard.writeText(text);
        document.getElementById('info').innerText =
            "No ID available – copied text instead ✔️";
        return;
    }

    const url = window.location.origin + "/no/" + id;

    if (navigator.share) {
        navigator.share({
            title: "JustNo",
            text: text,
            url: url
        })
        .catch(() => {
            document.getElementById('info').innerText = "Share cancelled";
        });

    } else {
        navigator.clipboard.writeText(url);
        document.getElementById('info').innerText = "Share link copied ✔️";
    }
}   


</script>

</body>
</html>
