@extends('home.layouts.app')
@section('content')
<div class="leaderboard">
    {{-- <div class="logo-container">
        <img src="https://via.placeholder.com/150" alt="Logo" class="logo" />
    </div> --}}
    <img src="{{$bannerImg}}" alt="Leaderboard Header">
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
            @if (isset($allUsers) && !empty($allUsers))
            @foreach ($allUsers as $k=>$v)
            @if ($k < 5)
            <tr>
                <td>{{$k+1}}</td>
                <td>{{$v[0]}}</td> 
                <td>${{$v[1]}}</td> 
                <td class="prize">${{$v[2]}}</td> 
            </tr>
            @endif
            @endforeach
            @endif
        </tbody>
    </table>
    <div id="viewMoreContainer" class="button-container">
        <button onclick="showAllUsers()" class="signup-button">View More</button>
    </div>
    <div class="button-container">
        <a href="{{$settings->bcgame_link}}" target="_blank" class="signup-button">Sign up for BC.GAME!</a> 
    </div>
    <div class="disclaimer">
        <h3>Rules for Leaderboard</h3>
        <p>Safe wagering (for example) 1.01x bets on dice, Plinko or any other abusive behavior will result in the exclusion from the leaderboard and lead to further investigation through BC.GAME!</p>
        <p>Original games and sportsbook bets count as 25% into total wager!</p>
        <p>MUST BE SIGNED UP UNDER {{$settings->code}}</p>
    </div>
    <div class="socials">
        <a href="{{$settings->instagram_link}}" target="_blank">
            <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram" />
        </a>
        <a href="{{$settings->discord_link}}" target="_blank">
            <img src="https://cdn-icons-png.flaticon.com/512/5968/5968756.png" alt="Discord" />
        </a>
        <a href="{{$settings->youtube_link}}" target="_blank">
            <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube" />
        </a>
        <a href="{{$settings->kick_link}}" target="_blank">
            <img src="https://cdn3.emoji.gg/emojis/3600-kick.png" alt="Kick" />
        </a>
    </div>
</div>
@endsection

@section('scripts')
@include('home.includes.script')
@endsection

@section('styles')
@include('home.includes.styles')
@endsection