<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Top 20 Monthly Wagerers</title>
        @include('home.includes.styles')
    </head>
    <body>
        <div class="leaderboard">
            <img src="https://raw.githubusercontent.com/DeejLoaf/SAV21CSGOBIGWAGERLEADERBOARD/b19fdf9c7c9e5f1a8c4a544bdab722103e2e18ea/btx2%20leaderboard.png" alt="Leaderboard Header">
            <div class="timer-container" id="timer">Countdown: 0d 8h 21m 59s</div>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Username</th>
                        <th>Monthly Wager</th>
                        <th>Prizes</th>
                    </tr>
                </thead>
                <tbody id="top5">
                    <tr>
                        <td>1</td>
                        <td>Alexbtx2</td> 
                        <td>$44,614.87</td> 
                        <td class="prize">$400</td> 
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Hulkboost</td> 
                        <td>$18,755.53</td> 
                        <td class="prize">$250</td> 
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Durism</td> 
                        <td>$12,373.42</td> 
                        <td class="prize">$200</td> 
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Vjpxaegxutac</td> 
                        <td>$7,514.52</td> 
                        <td class="prize">$100</td> 
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>NoorZone</td> 
                        <td>$7,063.59</td> 
                        <td class="prize">$50</td> 
                    </tr>
                </tbody>
            </table>
            <div id="viewMoreContainer" class="button-container">
                <button onclick="showAllUsers()" class="signup-button">View More</button>
            </div>
            <div class="button-container">
                <a href="https://bc.game/i-btx2bc-n/" target="_blank" class="signup-button">Sign up for BC.GAME!</a> 
            </div>
            <div class="disclaimer">
                <h3>Rules for Leaderboard</h3>
                <p>Safe wagering (for example) 1.01x bets on dice, Plinko or any other abusive behavior will result in the exclusion from the leaderboard and lead to further investigation through BC.GAME!</p>
                <p>Original games and sportsbook bets count as 25% into total wager!</p>
                <p>MUST BE SIGNED UP UNDER BTx2</p>
            </div>
        </div>
        @include('home.includes.script')
    </body>
</html>