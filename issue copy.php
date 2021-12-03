<?php
session_start();

require_once 'dbconfig.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
                <form id="add-issue" method="post">
                    <h2>Create Issue</h2>

                    <label>Title</label>
                    <input id="add-issue-title" type="text" name="title" required>
                    
                    <label>Description</label>
                    <textarea id="add-issue-desc" id="desc" type="text" name="desc" required></textarea>
                    
                    <label>Assigned To</label>
                    <select id="add-issue-assigned" name="assigned">
                    <?php foreach($results as $result){ ?>
                        <option value="<?php echo $result["firstname"]." ".$result["lastname"];?>"><?php echo $result["firstname"]." ".$result["lastname"];?></option>
                    <?php } ?>
                    </select>

                    <label>Type</label>
                    <select id="add-issue-type" name="type">
                        <option value="Bug">Bug</option>
                        <option value="Proposal">Proposal</option>
                        <option value="Task">Task</option>
                    </select>

                    <label>Priority</label>
                    <select id="add-issue-priority" name="priority">
                        <option value="Major">Major</option>
                        <option value="Minor">Minor</option>
                        <option value="Critical">Critical</option>
                    </select>
                    <button id="issueSubmit" name="newIssue" type="button">Submit</button>
                </form>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.getScript("js/app.js");
    </script>
