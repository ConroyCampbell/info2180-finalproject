<?php
    session_start();

    
    if($_SESSION['ID'] != 6705){
        echo "not admin";
    }else{?>

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
            <ul>
                <li class="sidebar-option" id="home">
                    <img src="images/home-24px.svg" alt="home"/>Home
                </li>
                <li class="sidebar-option" id="user">
                    <img src="images/person_add-24px.svg" alt="add-user"/>Add User
                </li>
                <li class="sidebar-option" id="issue">
                    <img src="images/add_circle-24px.svg" alt="add-issue"/>New Issue
                </li>
                <li class="sidebar-option" id="logout">
                    <img src="images/power_settings_new-24px.svg" alt="logout"/>Logout
                </li>
            </ul>
        </div>
    </aside>

    <div id="grid-wrapper">
        <main>
            <div class="area">
                <form id="add-user" method="post">
                    <h2>New User</h2>

                    <label>Firstname</label>
                    <input id="add-user-fname" type="text" name="fname" required>
                    
                    <label>Lastname</label>
                    <input id="add-user-lname" type="text" name="lname" required>

                    <label>Password</label>
                    <input id="add-user-password" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number,
                                 one uppercase and lowercase letter, and at least 8 or more characters" required>
                    
                    <label>Email</label>
                    <input id="add-user-email" type="email" name="email" required>
                    
                    <button id="addSubmit" name="newUser" type="button">Submit</button>
                </form>
                <div>
                    <div id="invPass" style="display: none; margin-top: 10px; color: red">
                            Password must contain at least one number,
                            one uppercase and lowercase letter, and at least 8 or more characters.
                            Email must be valid & name fields can't be empty string.
                    </div>    
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.getScript("js/app.js");
    </script>
<?php } ?>