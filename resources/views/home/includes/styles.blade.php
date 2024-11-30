<style>
    @import url('https://fonts.googleapis.com/css2?family=Russo+One&display=swap');
    body {
      font-family: 'Russo One', sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('https://raw.githubusercontent.com/DeejLoaf/SAV21CSGOBIGWAGERLEADERBOARD/b19fdf9c7c9e5f1a8c4a544bdab722103e2e18ea/btx2%20background.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      color: white;
    }
    .leaderboard {
      width: 95%;
      max-width: 800px;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 0 20px limegreen;
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
      color: limegreen;
      padding: 10px;
      text-transform: uppercase;
    }
    td {
      padding: 8px;
      text-align: center;
      color: white;  
    }
    tr:nth-child(even) {
      background-color: rgba(255, 255, 255, 0.1);
    }
     
    td, th {
      border-left: none;
      border-right: none;
    }
     
    tr {
      border-bottom: 2px solid limegreen;
    }
    .signup-button {
      display: inline-block;
      padding: 15px 30px;
      font-family: 'Russo One', sans-serif;
      font-size: 20px;
      color: white;
      background-color: #222;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      margin-top: 20px;
      transition: background-color 0.3s ease;
    }
    .signup-button:hover {
      background-color: limegreen;
    }
    .disclaimer {
      font-family: 'Russo One', sans-serif;
      color: white;
      margin-top: 20px;
      text-align: left;
    }
    .disclaimer h3 {
      font-size: 22px;
    }
    .timer-container {
      text-align: center;
      margin: 10px auto;
      color: limegreen;
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
      color: limegreen;
      font-size: 20px;
      font-weight: bold;
    }
</style>