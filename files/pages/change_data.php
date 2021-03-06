<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Express news!</title>
    
    <link rel="stylesheet" href="../css/myCss.css">
    
    <script type="text/javascript" src="../js/functions.js"></script>

</head>

<?php session_start(); ?>

<body>
    
    <header id="website_header">
        
        <div id="upper_part">

            <div id="logo">
                <a href="../index.php"><img src="../images/newspaper_logo.png" alt="logo"></a>
            </div>
            <div id="links">
                <a href="https://facebook.com"><img src="../logos/facebook_logo.jpg" height="45" alt="facebook"></a>
                <a href="https://twitter.com"><img src="../logos/twitter_logo.png" height="45" alt="twitter"></a>
                <a href="https://youtube.com"><img src="../logos/youtube_logo.png" height="45" alt="youtube"></a>
                <a href="#"><img src="../logos/rss_logo.png" height="45" alt="rss"></a>
            </div>
            
            <?php  

                //Ελέγχουμε αν ο χρήστης είναι εγγεγραμένο μέλος (συνδρομητής ή συντάκτης) ή επισκέπτης
                $id = $_SESSION['logged_in_id'];
                
                //Θα χρησιμοποιήσουμε τη μεταβλητή για να ελέγχουμε αν ο χρήστης είναι συντάκτης ή συνδρομητής
                //Αν είναι συνδρομητής εμφανίζεται το κουμπί "ο λογαριασμός μου", όπου επιτρέπεται η
                //επεξεργασία των στοιχείων του. Αν είναι συντάκτης εμφανίζεται το κουμπί "τα άρθρα μου", 
                //όπου επιτρέπεται η επξεργασία των άρθρων του.
                $username = $_SESSION['logged_in_username'];
                
                //Αν ισχύει τότε είναι συνδρομητής
                if(isset($id)) { ?>
                    <div id="buttons">
                    <?php 
                        //Αν ισχύει τότε είναι συντάκτης
                        if(isset($username)) {  ?>
                        <div id="admin_buttons">
                            <a href="./pages/view_subscriber_xml.php"><button type="button" name="edit_my_articles">XML</button></a>
                            <a href="edit_my_articles.php"><button type="button" name="edit_my_articles">Τα άρθρα μου</button></a>
                            <a href="stats.php"><button type="button" name="stats">Στατιστικά</button></a>
                            <a href="../scripts/logout.php"><button type="button" name="logout">Αποσύνδεση</button></a>
                        </div>
                    <?php } else { ?>
                        <div id="sub_buttons">
                            <a href="edit_my_account.php"><button type="button" name="edit_my_account">Ο λογαριασμός μου</button></a>
                            <a href="edit_my_subs.php"><button type="button" name="edit_my_subs">Οι συνδρομές μου</button></a>
                            <a href="stats.php"><button type="button" name="stats">Στατιστικά</button></a>
                            <a href="../scripts/logout.php"><button type="button" name="logout">Αποσύνδεση</button></a>
                        </div>
                    <?php } ?>    

                    </div>    
                        
                 <?php } else { ?>
                            <div id="buttons">
                                <a href="register.php"><button type="button" name="register">Εγγραφή</button></a>
                                <a href="login.php"><button type="button" name="login">Είσοδος</button></a>
                            </div>
                <?php } ?>

        </div>

        <nav id="top_menu">
            <ul>
                <li><a href="../index.php">Αρχική</a></li>
                <li><a href="politiki.php">Πολιτική</a></li>
                <li><a href="oikonomia.php">Οικονομία</a></li>
                <li><a href="koinonia.php">Κοινωνία</a></li>
                <li><a href="athlitismos.php">Αθλητισμός</a></li>
                <li><a href="politismos.php">Πολιτισμός</a></li>
                <li><a href="kosmos.php">Κόσμος</a></li>
            </ul>
        </nav>
    </header>


        <section id="content_area">
            
            <?php 
            
            $fname = $_SESSION['logged_in_fname'];
            $lname = $_SESSION['logged_in_lname'];
            $email = $_SESSION['logged_in_email'];
            $password = $_SESSION['logged_in_password'];
            $age = $_SESSION['logged_in_age'];
            $sex = $_SESSION['logged_in_sex'];
            
            ?>
            
            <!-- Φόρμα για την αλλαγή των στοιχείων του συνδρομητή -->
            <form action="../scripts/change_data.php" method="post">
                
                <h1>Αλλαγή προσωπικών στοιχείων</h1>
                
                <table id="register_table">

                    <div id="text_inputs">
                        <tr>
                            <td><strong>Όνομα</strong></td>
                            <td><strong><?php echo $fname; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Νέο όνομα</td>
                            <td><input type="text" name="new_fname" id="fname"> </br> </td>
                        </tr>
                        <tr height = 20px></tr>
                        <tr>
                            <td><strong>Επώνυμο</strong></td>
                            <td><strong><?php echo $lname; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Νέο επώνυμο</td>
                            <td><input type="text" name="new_lname" id="lname"></td>
                        </tr>
                        <tr height = 20px></tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td><strong><?php echo $email; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Νέο Email</td>
                            <td><input type="text" name="new_email" id="email" onchange="checkEmail()"></td>
                        </tr>
                        <tr height = 20px></tr>
                        <tr>
                            <td><strong>Κωδικός</strong></td>
                            <td><strong><?php echo $password; ?></strong></td>
                        </tr>
                        <tr>
                            <td>Νέος κωδικός</td>
                            <td><input type="password" name="new_password" id="password" onchange="checkPasswordLength()"></td>
                        </tr>
                        <tr>
                            <td>Επιβεβαίωση νέου κωδικού</td>
                            <td><input type="password" name="new_confirm_password" id="confirm_password" onchange="checkConfirmPassword()"></td>
                        </tr>
                        <tr height = 20px></tr>
                    </div>
                    <tr>
                        <td><strong>Ηλικία</strong></td>
                        <td><strong><?php echo $age; ?></strong></td>
                    </tr>
                    <tr>
                        <td>Νέα ηλικία</td>
                        <td><input type="text" name="new_age" id="age"></td>
                    </tr>
                    <tr height = 20px></tr>
                    <tr>
                        <td><strong>Φύλο</strong></td>
                        <td><strong>
                            <?php
                                if($sex == "M") {
                                    echo 'Άνδρας';
                                } else if($sex == "F") {
                                    echo 'Γυναίκα'; } ?> 
                        </strong></td>
                    </tr>
                    <tr id="radio_button_row">
                        <td>Νέο φύλο</td>
                        <td>
                            <ul>
                                <li><input type="radio" name="new_sex" value="male" id="male"> Άνδρας </li>
                                <li><input type="radio" name="new_sex" value="female" id="female"> Γυναίκα </li>
                            </ul> 
                        </td>
                    </tr>
                </table>
                
                <div id="form_buttons">
                    <button type="submit" name="change_data_submit">Υποβολή</button>
                    <button type="reset">Αρχικοποίηση</button>
                </div>
            </form>

        </section>

        <aside id="ads">
            <ul>
                <li><a href="#"><img src="../images/ad_1.jpg" alt="ad_1"></a></li>
                <li><a href="#"><img src="../images/ad_2.gif" alt="ad_2"></a></li>
            </ul>
        </aside>

    <footer id="website_footer">
        <ul>
            <li><a href="../index.php">ΑΡΧΙΚΗ ΣΕΛΙΔΑ</a>
                <li><a href="#">ΟΡΟΙ ΧΡΗΣΗΣ</a></li>
                <li><a href="#">ΠΡΟΣΤΑΣΙΑ ΠΡΟΣΟΠΙΚΩΝ ΔΕΔΟΜΕΝΩΝ</a></li>
                <li><a href="#">ΕΠΙΚΟΙΝΩΝΙΑ</a></li>
            </li>
        </ul>
    </footer>
    
</body>
</html>