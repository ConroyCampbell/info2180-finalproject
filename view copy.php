<?php
session_start();
$index = htmlspecialchars(filter_input(INPUT_GET,'index',FILTER_SANITIZE_STRING)); 

require_once 'dbconfig.php';

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

$stmt = $conn->prepare("SELECT * FROM issues WHERE id ='$index'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
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

    <div class="override" id="grid-wrapper">
        <main>
            <div class="area">
                <h2 id="bigger"><?php echo htmlspecialchars_decode($result['title']);?></h2>
                <h4 id="issue-num">Issue #<?php echo $result['id'];?></h4>
                <div>
                    <div id="issue-details">
                        <div id="main-details">
                            <p> 
                                <?php echo $result['description'];?>
                            </p>
                            <div id="dates">
                                <?php   
                                                            
                                $date = date_create($result['created']);

                                $update = date_create($result['updated']);

                                $id = $result["assigned_to"];
                                $stmt = $conn->prepare("SELECT * FROM users WHERE id='$id'");
                                $stmt->execute();
                                $results2 = $stmt->fetch(PDO::FETCH_ASSOC);
                                $assigned_to = $results2["firstname"]." ".$results2["lastname"];

                                $id = $result["created_by"];
                                $stmt = $conn->prepare("SELECT * FROM users WHERE id='$id'");
                                $stmt->execute();
                                $results2 = $stmt->fetch(PDO::FETCH_ASSOC);
                                $created_by = $results2["firstname"]." ".$results2["lastname"];

                                $issue = "Issue created on ".date_format($date,"F d, Y ")."at ".date_format($date,"g:iA")." by ".$created_by;
                                
                                $update = "Last update on ".date_format($update,"F d, Y ")."at ".date_format($update,"g:iA");
                                                            
                                ?>
                                <p class="issue-dates"><?php echo $issue;?></p>
                                <p class="issue-dates"><?php echo $update;?></p>
                            </div>
                        </div>
                        <div id="side-details">
                            <div class="lower" id="meta-details">
                                <div class="aux-details">
                                    <h4>Assigned To:</h4>
                                    <p><?php echo $assigned_to;?></p>
                                </div>
                                <div class="aux-details">
                                    <h4>Type:</h4>
                                    <p><?php echo $result['type'];?></p>
                                </div>
                                <div class="aux-details">
                                    <h4>Priority:</h4>
                                    <p><?php echo $result['priority'];?></p>
                                </div>
                                <div class="aux-details">
                                    <h4>Status:</h4>
                                    <p><?php echo $result['status'];?></p>
                                </div>
                            </div>
                            <form method="post">
                                <input id="issue-id" type="hidden" name="index" value="<?php echo $index;?>">
                                <div class="lower">
                                    <button type="button" name="close" id="close-issue">Mark as Closed</button>
                                </div>
                                <div>
                                    <button type="button" name="in-progress" id="in-progress-issue">Mark In Progress</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.getScript("js/app.js");
    </script>
