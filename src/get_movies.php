<?php
    if (isset($_POST['getData'])) {
        include "logindb_connect.php";

        $start = $con->real_escape_string($_POST['start']);
        $limit = $con->real_escape_string($_POST['limit']);

        $statement = $con->prepare("SELECT DISTINCT genre FROM movie LIMIT ?, ?");
        $statement->bind_param("ss", $start, $limit);
        $exec = $statement->execute();
        if (!$exec) {
            die('Error: ' . mysqli_error());
        }

        $sql_genre = $statement->get_result();

        if ($sql_genre->num_rows > 0) {

            $response = "";

            while($selected_genre = $sql_genre->fetch_array()) { 
                $a_genre = $selected_genre['genre'];
                
                $statement = $con->prepare("SELECT DISTINCT movie_name, movie_path FROM movie WHERE genre LIKE ? LIMIT ?, ?");
                $statement->bind_param("sss", $a_genre, $start, $limit);
                $exec = $statement->execute();
                if (!$exec) {
                    die('Error: ' . mysqli_error());
                }
                $sql_movie = $statement->get_result();

                $response .= '
                    <div class="row movie-row-container">
                        <hr />
                        <h3>'.$a_genre.'</h3>
                ';

                if ($sql_movie->num_rows > 0) {
                    while($data = $sql_movie->fetch_array()) {
                        $response .= '
                                <div class="custom-col">                                   
                                        <img class="movie-style" src="'.$data['movie_path'].'" alt="'.$data['movie_name'].'" Poster />                                   
                                        <input id="'.$data['movie_name'].'-submit" type="submit" name="submit" value="'.$data['movie_name'].'" class="movie-titles"/>                                   
                                </div>
                        ';
                    }
                    $response .= '
                        </div>
                    ';
                } 
            }
            mysqli_close($con);
            exit($response);
        } else {
            exit('reachedMax');
        } 
    }
?>