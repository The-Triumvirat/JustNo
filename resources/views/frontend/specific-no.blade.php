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
</div>


<script>
const id = {{ $id }};

// Load specific NO
async function loadNo() {
    const reasonBox = document.getElementById('reason');

    try {
        const res = await fetch(`/api/v1/no/${id}`);

        if (res.status === 404) {
            reasonBox.innerText = "This No does not exist 🥲";
            return;
        }

        const data = await res.json();
        reasonBox.innerText = data.reason;
        window.currentNoId = data.id;

    } catch {
        reasonBox.innerText = "Failed to load No 😢";
    }
}

document.addEventListener('DOMContentLoaded', loadNo);


// Copy
function copyNo() {
    const text = document.getElementById('reason').innerText;

    navigator.clipboard.writeText(text).then(() => {
        document.getElementById('info').innerText = "Copied ✔️";
    });
}

// Share
function shareNo() {
    const text = document.getElementById('reason').innerText;
    const url = window.location.href;

    if (navigator.share) {
        navigator.share({
            title: "JustNo",
            text: text,
            url: url
        }).catch(() => {
            document.getElementById('info').innerText = "Share cancelled";
        });

    } else {
        navigator.clipboard.writeText(url);
        document.getElementById('info').innerText = "Link copied ✔️";
    }
}

</script>

</body>
</html>
