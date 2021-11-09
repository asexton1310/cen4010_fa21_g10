<?php
    include_once 'header.php';
?>

<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';
?>

<?php
    if(isset($_GET['exit'])){	 
        //Simple exit message
        //$logout_message = "<div class='msgln'><span class='left-info'>User <b class='user-name-left'>". $_SESSION['userName'] ."</b> has left the chat session.</span><br></div>";
        //file_put_contents("log.html", $logout_message, FILE_APPEND | LOCK_EX);
        
        //session_destroy(); //destroys everything, not just the chat login
        header("Location: chat.php"); //Redirect the user
    }
    if(!isset($_GET['room'])){	 
        //Simple exit message
        header("Location: chat.php"); //Redirect the user
    }
    else(
        // check chatroom_participants table for this roomid and this username, if not there, redirect away
        $roomid = $_GET['room']
    )
?>

<div class="container-fluid">
    <div class="container-sm posts shadow p-3 mb-5 bg-white rounded">
        <div class="container title">
            <h3>Chat. Welcome, <b><?php echo $_SESSION['userName']; ?></b></h3>
            <p class="logout"><a id="exit" href="#">Exit Chatroom</a></p>
        </div>

        <div class="container content">
            <p class="main" id="chatbox"></p>
            <br>  
        </div>

        <div class="container footer">
            <form name="message" action="">
                <input name="userMsg" type="text" id="userMsg" placeholder="Type here to chat." />
                <button name="userSubmit" type="submit" id="userSubmit" class="btn btn-dark">Send</button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="js/chatroom.js"></script>

<?php
  include_once 'footer.php';
?>