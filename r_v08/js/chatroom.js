// jQuery Document
$(document).ready(function(){
    //extract roomid from url
    var searchParams = new URLSearchParams(window.location.search);
    var room;
    if (searchParams.has('room')) {
        room = searchParams.get('room');
    }

	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit==true){window.location = 'chatroom.php?exit=true';}		
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
    setInterval (loadLog, 2500);	//Reload file every 2500 ms (2.5s)
});