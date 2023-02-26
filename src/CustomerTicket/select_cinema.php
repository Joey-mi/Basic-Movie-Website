<?php include 'header.php'?>  
        <div class="page-container-center">
            <h2>Select Location</h2>
            <div class="info-container">
                <form action="select_times.php" method="post">
                    <div class="">
                        <?php
                            include "../logindb_connect.php";

                            $chosen_movie = $_POST['submit'] ?? "";

                            $statement = $con->prepare("SELECT cinema_name FROM shown_in s JOIN theatre_hall t ON s.theatre_num = t.theatre_no WHERE s.m_name LIKE ?;");
                            $statement->bind_param("s", $chosen_movie);
                            $exec = $statement->execute();

                            if(!$exec) {
                                die('Error: ' . mysqli_error($con));
                            }

                            $available_cinemas = $statement->get_result();

                            mysqli_close($con);

                            if($available_cinemas->num_rows > 0) {                           

                                while($listing = $available_cinemas->fetch_array()) {
                                    echo '<input class="button-styles" style="margin: 2vh;" type="submit" name="c_name" value="'.$listing['cinema_name'].'"/>';
                                }
                                echo '<input class="button-styles" type="hidden" name="mov_name" value="'.$chosen_movie.'"/>';
                            } else {
                                echo '<p class="center-header">This movie is not shown at any cinema</p>';
                                echo '<a class="button-styles link-button" href="javascript:history.go(-1)">Return to dashboard</a>';
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
            