<?php
session_start();

//Generic function of creating common nevigation bar(both desktop and mobile) on each page, method also responsible to check if customer has logged in to acquire their fav list count
        function createNavBar() {
            echo "<nav id='navigation'>
                <ul>
                        <li>
                            <img id= 'logo' src='images/web/logo.png' alt = 'home'/>
                        </li>
                        <li><a id='index' href='index.php'>
                            <img src='icons/home.png' alt = 'home' />
                            Home</a>
                        </li>
                        <li><a id='aboutus' href='aboutus.php'>
                            <img src='icons/us.png' alt = 'about us'/>
                            About us</a>
                        </li>";
                        if (isset($_SESSION['sessionID'])){ //check if session exist, meaning logged in
                            $customerID = $_SESSION['sessionID'];
                            $clientName = $_SESSION['customerName'];
                            $favourites = $_SESSION['favPaintingID'];
                            $items = 0;
                            foreach ($favourites[$customerID] as $key){ //fav items count
                                $items += 1;
                            }
                        echo "<li><a id='fav' href='favourites.php'>
                            <img src='icons/fav.png' alt = 'Favourites'/>
                            Favourites
                            <div id='favNumbers'>$items</div>
                            </a>
                        </li>
                        <li id='clientName'>Hello, $clientName</li>
                        <li><a href='services/logout.php'>
                            <img src='icons/logout.png' alt = 'logout'/>
                            Logout</a>
                        </li>";
                        }else{ //not logged in
                        echo "<li id='clientName'>Hello, Guest</li>";
                        echo "<li><a href='login.php'>
                            <img src='icons/signin.png' alt = 'sign in'/>
                            Login</a>
                        </li>";
                        }
                echo "</ul>
                </nav>";
                echo "<nav id='navigation_mobile' class='show'>
                        <ul>
                                <li>
                                    <img id= 'logo' src='images/web/logo.png' alt = 'home'/>
                                </li>
                                <li><a id='index_mobile' href='index.php'>
                                    Home</a>
                                </li>
                                <li><a id='aboutus' href='aboutus.php'>
                                    About us</a>
                                </li>";
                                if (isset($_SESSION['sessionID'])){ //logged in
                                    $customerID = $_SESSION['sessionID'];
                                    $clientName = $_SESSION['customerName'];
                                    $favourites = $_SESSION['favPaintingID'];
                                    $items = 0;
                                    foreach ($favourites[$customerID] as $key){//count fav items
                                        $items += 1;
                                    }
                                    echo "<li><a id='fav' href='favourites.php'>
                                    Favourites <div id='favNumbers'>$items</div>
                                    </a>
                                    </li>
                                    <li id='clientName'>Hello, $clientName</li>
                                    <li><a href='services/logout.php'>
                                    Logout</a>
                                    </li>
                                    <li>
                                    <img id= 'hamburger' src='icons/hamburger_white.png' alt = 'menu'/>
                                    </li>";
                                }else{ //not logged in
                                echo "<li id='clientName'>Hello, Guest</li>
                                <li><a href='login.php'>
                                    Login</a>
                                </li>
                                <li>
                                    <img id= 'hamburger' src='icons/hamburger_white.png' alt = 'menu'/>
                                </li>";
                                }
                        echo "</ul>
                        </nav>";
            }
    ?>
    
    