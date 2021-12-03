<?php
    session_start();

    require_once 'dbconfig.php';

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $stmt = $conn->prepare("SELECT * FROM issues");
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
                <div>
                    <h2 class="iTitle">Issues</h2>
                    <button id="c-new-issue" class="iTitle">Create New Issue</button>
                </div>
                <div class="filter-area">
                    <h5 class="filter">Filter by: </h5>    
                    <button id="all-filter" class="filter active">ALL</button>
                    <button id="open-filter" class="filter">OPEN</button>
                    <button id="tickets-filter" class="filter">MY TICKETS</button>
                </div>
                <div>
                    <table>
                        <thead id="table-header">
                            <tr>
                                <th id="title">Title</th>
                                <th id="type">Type</th>
                                <th id="issue-status">Status</th>
                                <th id="assigned-to">Assigned To</th>
                                <th id="created">Created</th>
                            </tr>
                            </thead>

                        <!-- Dynamically insert rows here -->
                        <tbody id="issues-table-body">
                            <div id="results">
                                <?php foreach($results as $result){ ?>

                                <?php if($result["assigned_to"] == $_SESSION['ID'] && $result["status"]=="Open"){ ?>
                                    <tr class="all this-open mytickets">
                                <?php } elseif($result["status"]=="Open"){?>
                                    <tr class="all this-open">
                                <?php } elseif($result["assigned_to"] == $_SESSION['ID'] && $result["status"]!="Open"){ ?>
                                    <tr class="all mytickets">
                                <?php }else{ ?>
                                    <tr class="all">
                                <?php } ?>
                                        <input class="views_id" type="hidden" value="<?php echo $result['id'];?>"/>
                                        <td><strong>#<?php echo $result["id"]." ";?></strong><a class="views" style="cursor:pointer;"><?php echo htmlspecialchars_decode($result["title"]);?></a></td>
                                        <td><?php echo $result["type"];?></td>

                                        <?php if($result["status"]=="Open"){?>
                                            <td id="issue-button"><button class="no-fade" id="open">OPEN</button></td>
                                        <?php } ?>
                                        <?php if($result["status"]=="Closed"){?>
                                            <td id="issue-button"><button class="no-fade" id="closed">CLOSED</button></td>
                                        <?php } ?>
                                        <?php if($result["status"]=="In Progress"){?>
                                            <td id="issue-button"><button class="no-fade" id="progress">IN PROGRESS</button></td>
                                        <?php } ?>

                                        <?php     
                                            $id = $result["assigned_to"];
                                            $stmt = $conn->prepare("SELECT * FROM users WHERE id='$id'");
                                            $stmt->execute();
                                            $results2 = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $name = $results2["firstname"]." ".$results2["lastname"];
                                        ?>
                        
                                        <td><?php echo $name; ?></td>
                                        
                                        <?php 
                                            $date = date_create($results2["created"]);
                                            $new = date_format($date,"Y-m-d");
                                        ?>
                                        <td><?php echo $new;?></td>
                                    </tr>
                                <?php } ?>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $.getScript("js/app.js");
    </script>
