// jQuery Document
$(document).ready(function(){
    //If user sends chat request
    $(".chatinvite").click(function () {
        var recipient = $(this).attr("value");
        $.post("include/script_chatroom.php", { mode: "create"}, function(roomid) {
            //callback function, roomid is sent in response
	    var cleanroomid = roomid.replace(/\s+/g, "");
            $.post("include/script_chatinvite.php", { otherUser: recipient, mode: "invite", room: cleanroomid });
            $.post("include/script_chatroom.php", { mode: "adduser", room: cleanroomid }, function() {
                //callback function that redirects this user to the chatroom they just created
                window.location = "chatroom.php?room=" + roomid;
            });
        })
        $(this).parent().after("Request Sent!"); // add the request sent message after the parent form
        //$(this).parent().remove(); // delete the parent form and all its contents
        return false;
    });

    //If user accepts chat invite
    $(".acceptinvite").click(function () {
        var requestor = $(this).val();
        var roomid = $(this).attr("room");
        $.post("include/script_chatinvite.php", { otherUser: requestor, mode: "accept", room: roomid });
        $.post("include/script_chatroom.php", { mode: "adduser", room: roomid}, function() {
            //callback function that redirects this user to the chatroom they just joined
            window.location = "chatroom.php?room=" + roomid;
        });
        $(this).parent().after("Chat Joined!"); // add the request sent message after the parent form
        $(this).parent().remove(); // delete the parent form and all its contents
        return false;
    });

    //If user rejects chat invite
    $(".rejectinvite").click(function () {
        var requestor = $(this).val();
        $.post("include/script_chatinvite.php", { otherUser: requestor, mode: "reject" });
        $(this).parent().after("Invite rejected."); // add the request sent message after the parent form
        $(this).parent().remove(); // delete the parent form and all its contents
        return false;
    });
});