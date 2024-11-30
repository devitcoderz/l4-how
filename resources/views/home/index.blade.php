@extends('home.layouts.app')
@section('content')
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
            <?php echo "<pre>"; print_r($allUsers); echo "</pre>";?>
            {{-- @if (isset($allUsers) && !empty($allUsers))
            @foreach ($allUsers as $k=>$v)
            <tr>
                <td>{{$k+1}}</td>
                <td>{{$v[0]}}</td> 
                <td>${{$v[1]}}</td> 
                <td class="prize">${{$v[2]}}</td> 
            </tr>
            @endforeach
            @endif --}}
        </tbody>
    </table>
    <div id="viewMoreContainer" class="button-container">
        <button onclick="showAllUsers()" class="signup-button">View More</button>
    </div>
    <div class="button-container">
        <a href="https://bc.game/i-sncbc-n/" target="_blank" class="signup-button">Sign up for BC.GAME!</a> 
    </div>
    <div class="disclaimer">
        <h3>Rules for Leaderboard</h3>
        <p>Safe wagering (for example) 1.01x bets on dice, Plinko or any other abusive behavior will result in the exclusion from the leaderboard and lead to further investigation through BC.GAME!</p>
        <p>Original games and sportsbook bets count as 25% into total wager!</p>
        <p>MUST BE SIGNED UP UNDER BTx2</p>
    </div>
</div>
@endsection

@section('scripts')
@include('home.includes.script')
@endsection