// jQuery Document
$(document).ready(function(){
    //extract roomid from url
    var searchParams = new URLSearchParams(window.location.search);
    var room;
    if (searchParams.has('room')) {
        room = searchParams.get('room');
    }

    //this section of code makes sure the room is active before displaying any page content
    var statusInterval;
    //get room status and html to display from script_getroomstatus.php as json
    function updateRoom(){
        $.get("include/script_getroomstatus.php", { roomid: room }, function(data){
            var json = JSON.parse(data);
            $("#holdseverything").html(json["html"]); //Insert html into the page

            if (json["roomstatus"] == -1) {
                //do nothing, just let the returned html tell the user the room is closed
            }
            else if (json["roomstatus"] == 0) {
                // if interval is not set, set one
                if (!statusInterval){
                    statusInterval = setInterval(updateRoom, 2500);	//refresh updateRoom every 2500 ms (2.5s)
                }
            }
            else if (json["roomstatus"] == 1) {
                clearInterval(statusInterval);  // room is active, so we do not need to keep checking
                assignHandlers(); //html is in the page now, so assign handlers to make the chat work
            }
        });
    }
    updateRoom();

    //send a chat invite without redirecting or creating a new room
    $(".chatinvite").click(function () {
        var recipient = $(this).val();
        $.post("include/script_chatinvite.php", { otherUser: recipient, mode: "invite", room: room });
        $(this).after("Request Sent!"); // add the request sent message after the parent form
        $(this).remove(); // delete the parent form and all its contents
        return false;
    });

    //this function assigns click handlers once the chatroom is active
    function assignHandlers() {
        //If user wants to end session
        $("#exit").click(function(){
            var exit = confirm("Are you sure you want to leave the chatroom? You will not be able to return unless you are invited again.");
            if(exit==true){
                if (participantCount > 2) {
                    //just remove the user
                    $.post("include/script_chatroom.php", { mode: "removeuser", room: room}, function() {
                        window.location = 'chat.php'; //redirect the user out of the chatroom
                    });
                }
                else {
                    //delete the entire chatroom
                    $.post("include/script_chatroom.php", { mode: "closeroom", room: room}, function() {
                        window.location = 'chat.php'; //redirect the user out of the chatroom
                    });
                }
            }		
        });
        //If user submits the form
        $("#userSubmit").click(function () {
            var clientmsg = $("#userMsg").val();
            $.post("include/script_postchat.php", { roomid: room, text: clientmsg });
            $("#userMsg").val("");
            return false;
        });
        //Load the file containing the chat log
        function loadLog(){		
            var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request I think the 20 is for padding or margin maybe
            $.get("include/script_getchat.php", { roomid: room }, function(data){
                $("#chatbox").html(data); //Insert chat log into the #chatbox div

                //Auto-scroll			
                var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
                if(newscrollHeight > oldscrollHeight){
                    $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
                }				
            });    
        }
        setInterval(loadLog, 2500);	//Reload file every 2500 ms (2.5s)

        var participantCount;
        function getParticipants(){		
            $.post("include/script_chatroom.php", { mode: "getparticipants", room: room}, function(data){
                participantCount = data;
                if (participantCount < 2) {
                    window.location = 'chat.php'; //redirect the user out of the chatroom
                }
            });
        }
        setInterval(getParticipants, 2500);	//Reload file every 2500 ms (2.5s)*/
    }
});