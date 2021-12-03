<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>final2180 - project</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <ul>
            <li><img src="images/bug_report-white-18dp.svg" alt="bug" /></li>
            <li>
                <h3>BugMe Issue Tracker</h3>
            </li>
        </ul>
    </header>

    <aside>
        <!-- Sidebar -->
        <div id="sidebar-contents">
        </div>
    </aside>

    <div id="grid-wrapper">
        <main>
            <div class="area">
                <form method="post">
                    <h2>User Login</h2>

                    <label>Email</label>
                    <input id="loginemail" type="email" name="email" required>
                    
                    <label>Password</label>
                    <input id="loginpassword" type="password" name="password" required>
                    
                    <button id="loginsubmit" name="login" type="button">Submit</button>
                </form>
                <div id="invalid" style="display: none; color: red; margin-top:20px">Inavlid Email or Password</div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
         $.getScript("js/results.js");
    </script>
</body>
</html>