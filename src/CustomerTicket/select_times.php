<?php include 'header.php'?>    
        <div class="page-container vertical-scroller">
            <h2>Select Time and Location</h2>
                <?php
                    include "../logindb_connect.php";
                    $chosen_location = $_POST['c_name'] ?? "";
                    $chosen_movie = $_POST['mov_name'] ?? "";
                
                    $statement = $con->prepare("SELECT s_date, s_time, t.theatre_no 
                    FROM ((movie m JOIN show_time s ON m.movie_name = s.movie_name) 
                    JOIN shown_in sh ON m.movie_name = sh.m_name) 
                    JOIN theatre_hall t ON theatre_num = t.theatre_no
                    WHERE m.movie_name LIKE ? AND t.cinema_name LIKE ?;");
                    $statement->bind_param("ss", $chosen_movie, $chosen_location);
                    $exec = $statement->execute();

                    if (!$exec) {
                        die('Error: ' . mysqli_error());
                    }

                    $movie_times = $statement->get_result();

                    mysqli_close($con);

                    if($movie_times->num_rows > 0) {                           

                        while($times = $movie_times->fetch_array()) {
                            echo '<form class="form-arrangement" action="select_seats.php" method="post">';
                            echo date('D F d Y', strtotime($times['s_date']))." AT ". date('H:i', strtotime($times['s_time']))."<br>";
                            echo '<input type="submit" name="selection" value="Select Time"/>';
                            echo '<input type="hidden" name="the_date" value="'.$times['s_date'].'"/>'; 
                            echo '<input type="hidden" name="the_time" value="'.$times['s_time'].'"/>'; 
                            echo '<input type="hidden" name="the_hall" value="'.$times['theatre_no'].'"/>';
                            echo '<input type="hidden" name="the_movie" value="'.$chosen_movie.'"/>';    
                            echo '<input type="hidden" name="the_cinema" value="'.$chosen_location.'"/>'; 
                            echo '</form>';   
                            echo '<hr style="width: 50vh;">';                     
                        }
                    }
                ?>
            </div>
        </div>
    </body>
</html>