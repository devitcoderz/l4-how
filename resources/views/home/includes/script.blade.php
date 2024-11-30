<script>
function startCountdown() {
    const now = new Date();
    const nextMonth = new Date(now.getFullYear(), now.getMonth() + 1, 1);
    const timerElement = document.getElementById('timer');

    function updateTimer() {
        const timeDiff = nextMonth - new Date();
        if (timeDiff <= 0) {
            timerElement.innerHTML = "It's a new month!";
            clearInterval(interval);
            return;
        }

        const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

        timerElement.innerHTML = `Countdown: ${days}d ${hours}h ${minutes}m ${seconds}s`;
    }

    const interval = setInterval(updateTimer, 1000);
    updateTimer();
}

function showAllUsers() {
    const allUsers = {!! json_encode($allUsers) !!};
    console.log(allUsers)
    // const allUsers = [["Alexbtx2",44614.87,400],["Hulkboost",18755.53,250],["Durism",12373.42,200],["Vjpxaegxutac",7514.52,100],["NoorZone",7063.59,50],["xeni xeni",5082.11,""],["Rztvbexivtac",3172.18,""],["ROYCOENEN",3043.17,""],["Blastt325",2278.95,""],["Onmoney",1460.3,""],["btxvk",1390.28,""],["iamkct",1176.18,""],["Mcsnceiuvtac",1097.2,""],["Ria007",992.64,""],["Btxamul",707.71,""],["baigbtx",698.61,""],["dvgurevichBTX",530.23,""],["AyyryFake",516.34,""],["Nuurruuu",424.61,""],["Fathima1",323.77,""]];
    const tableBody = document.getElementById('top5');


    for (let i = 5; i < allUsers.length; i++) {
        const user = allUsers[i];
        const row = document.createElement('tr');
        row.innerHTML = `
        <td>${i + 1}</td>
        <td>${user[0]}</td>
        <td>$${Number(user[1]).toLocaleString()}</td>
        <td class="prize">$ ${Number(user[2]).toLocaleString()}</td>
        `;
        tableBody.appendChild(row);
    }


    document.getElementById('viewMoreContainer').style.display = 'none';
}

startCountdown();
</script>