<?php
        function createNavBar() {
            echo "<nav id='navigation'>
                <ul>
                        <li>
                            <img id= 'logo' src='images/logo.png' alt = 'home'/>
                        </li>
                        <li><a id='index' href='index.php'>
                            <img src='icons/home.png' alt = 'home' />
                            Home</a>
                        </li>
                        <li><a id='aboutus' href='aboutus.php'>
                            <img src='icons/us.png' alt = 'about us'/>
                            About us</a>
                        </li>
                        <li><a id='fav' href=''>
                            <img src='icons/fav.png' alt = 'Favourites'/>
                            Favourites</a>
                        </li>
                        <li><a href='login.php'>
                            <img src='icons/signin.png' alt = 'sign in'/>
                            Login</a>
                        </li>
                    </ul>
                </nav>
                <nav id='navigation_mobile' class='show'>
                        <ul>
                                <li>
                                    <img id= 'logo' src='images/logo.png' alt = 'home'/>
                                </li>
                                <li><a id='index' href='index.php'>
                                    Home</a>
                                </li>
                                <li><a id='aboutus' href='aboutus.php'>
                                    About us</a>
                                </li>
                                <li><a id='fav' href=''>
                                    Favourites</a>
                                </li>
                                <li><a href='login.php'>
                                    Login</a>
                                </li>
                                <li>
                                    <img id= 'hamburger' src='icons/hamburger_white.png' alt = 'menu'/>
                                </li>
                            </ul>
                        </nav>";
        }
    ?>
    
    