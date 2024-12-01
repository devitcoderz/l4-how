<style>
    @import url('https://fonts.googleapis.com/css2?family=Russo+One&display=swap');
    body {
      font-family: 'Russo One', sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('{{$backgroundImg}}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: {{$settings->text_color}};
    }
    .leaderboard {
      width: 95%;
      max-width: 800px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px {{$settings->shadow_color}};
      background-color: rgba(0, 0, 0, 0.8);
      margin: 20px auto;
      padding: 10px;
    }
    .leaderboard img {
      display: block;
      width: 100%;
      height: auto;
      object-fit: cover;
      margin: 0 auto 20px;
    }
    table {
      margin: 20px auto;
      border-collapse: collapse;
      width: 100%;
      font-size: 18px;
      font-weight: normal;
    }
    th {
      background-color: #222;
      color: {{$settings->table_title_color}};
      padding: 10px;
      text-transform: uppercase;
    }
    td {
      padding: 8px;
      text-align: center;
      color: {{$settings->table_text_color}};  
    }
    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.1);
    }
     
    td, th {
      border-left: none;
      border-right: none;
    }
     
    tr {
      border-bottom: 2px solid {{$settings->table_border_color}};
    }
    .signup-button {
      display: inline-block;
      padding: 15px 30px;
      font-family: 'Russo One', sans-serif;
      font-size: 20px;
      color: {{$settings->button_text_color}};
      background-color: {{$settings->button_background_color}};
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }
    .signup-button:hover {
      background-color: {{$settings->button_background_hover_color}};
    }
    .disclaimer {
      font-family: 'Russo One', sans-serif;
      color: {{$settings->text_color}};
      margin-top: 20px;
      text-align: left;
    }
    .disclaimer h3 {
      font-size: 22px;
    }
    .timer-container {
      text-align: center;
      margin: 10px auto;
      color: {{$settings->countdown_color}};
      font-size: 20px;
      font-weight: normal;
    }
    @media (max-width: 600px) {
      .leaderboard {
        width: 100%;
      }
      .signup-button {
        display: block;
        width: 100%;
        margin: 30px auto;
      }
    }
    .button-container {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }
    .prize {
      color: {{$settings->table_prizes_color}};
      font-size: 20px;
      font-weight: bold;
    }
    .socials {
    text-align: center;
    margin: 30px 0;
}

.socials a {
    margin: 0 10px;
    display: inline-block;
}

.socials img {
    width: 40px;
    height: 40px;
    transition: transform 0.3s ease;
}

.socials img:hover {
    transform: scale(1.2);
    filter: drop-shadow(0 0 5px {{$settings->shadow_color}});
}
/* .logo-container {
    position: fixed;
    top: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.8); /* Optional background */
    z-index: 1000; /* Ensures it stays above other elements */
    padding: 10px 0;
} */
.logo-container {
    text-align: center;
    margin: 20px auto;
}

.logo {
    width: 120px; /* Adjust size as needed */
    height: auto;
    border-radius: 10px; /* Optional: gives a slight rounded effect */
    box-shadow: 0 0 10px {{$settings->shadow_color}}; /* Optional: matches leaderboard styling */
}
</style>