<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f4f4;
        }

        .footer {
            padding: 30px;
            color: #2f2f2f;
            background-color: #fff;
            border-top: 1px solid #e5e5e5;
            text-align: center;
        }

        .footer__logo {
            font-weight: 400;
            font-size: 1.5rem;
            margin-bottom: 1em;
        }

        .footer__nav {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 1.5em;
        }

        .footer__nav h2 {
            font-size: 15px;
            font-weight: 400;
            margin-bottom: 0.5em;
        }

        .footer__nav ul {
            list-style: none;
            padding-left: 0;
        }

        .footer__nav li {
            line-height: 2em;
        }

        .footer__nav a {
            text-decoration: none;
            color: #999;
        }

        .footer__addr {
            margin-bottom: 2em;
        }

        .footer__addr p {
            margin: 0;
            font-size: 9px;
            color: #999;
        }

        .footer__addr p span {
            display: block;
        }

        .legal {
            color: #999;
        }

        .heart {
            color: #2f2f2f;
        }
        
        .footer__nav {
          
          width: 60%;
          display: flex;
          flex-direction: row;
          justify-content: space-between;
          align-items: center;
          margin:0 auto;
          color: #999;
        }
    </style>
</head>
<body>
<footer class="footer">
    <div class="footer__addr">
        <h1 class="footer__logo">Carpet Court</h1>
    </div>
  
    <div class="footer__nav">
        <div>
            <h2>Links</h2>
            <ul>
                <li><a href="./home.php">Home</a></li>
                <li><a href="./Contactus.php">Contact us</a></li>
            </ul>
        </div>
        <div>
            <h2>Address</h2>
            <span>
                Carpet Court<br>
                Mumbai, India
            </span>
        </div>
        <div>
            <h2>Reach us</h2>
            <span>
                +91-9056482932<br>
                carpet-court@yahoo.in
            </span>
        </div>
    </div>
  
    <div class="legal">
        <p>&copy;2023 Carpet Court All rights reserved.</p>
        <div>
            <span>Made with <span class="heart">♥</span> from Carpet Court</span>
        </div>
    </div>
</footer>
</
