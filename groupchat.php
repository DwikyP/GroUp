<?php 
 	include 'connection.php';
  	session_start();

  	if(!isset($_SESSION['login'])){
      header("Location: index.php");
      exit;
   }
 ?>

<html>
<head>
	<title>Group Chat</title>
	<style>
	body{width:600px;font-family:calibri; background-color: black;  background-image: url("img/background.jpg");
  background-size:cover}
	.error {color:#FF0000;}
	.chat-connection-ack{color: #26af26;}
	.chat-message {border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;
	}
	#btnSend {background: #000000;border: #ffffff 1px solid;	border-radius: 4px;color: #FFF;display: block;margin: 15px 0px;padding: 10px 50px;cursor: pointer;  font-weight: bold;
  font-size: 18px;
	}
	#chat-box {background: #ffffff;border: 1px solid #cccccc;border-radius: 4px;border-bottom-left-radius:0px;border-bottom-right-radius: 0px;min-height: 300px;padding: 10px;overflow: auto;
	}
	.chat-box-html{color: #000000;margin: 10px 0px;font-size:0.8em;}
	.chat-box-message{color: #ffffff;padding: 5px 10px; background-color: #b6b6b6;border: 1px solid #353535;border-radius:4px;display:inline-block;}
	.chat-input{border: 1px solid #cccccc;border-top: 0px;width: 100%;box-sizing: border-box;padding: 10px 8px;color: #191919;
	}
	.contain{background: #ffffff; margin-left: 60%; width: 600px; margin-top: 0px; border-radius:10px;overflow: auto; }
	ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	  overflow: hidden;
	}

	li {
	  float: left;
	}

	li a {
	  display: block;
	  color: white;
	  text-align: center;
	  padding: 14px 16px;
	  text-decoration: none;
	}
	</style>	
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script>  
	function showMessage(messageHTML) {
		$('#chat-box').append(messageHTML);
	}

	$(document).ready(function(){
		//create a new WebSocket object.
		var websocket = new WebSocket("ws://localhost:6969/NSPProject/server.php"); 
		
		websocket.onopen = function(event) { // connection is open 
			showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		
		}
		// Message received from server
		websocket.onmessage = function(event) {
			var Data = JSON.parse(event.data);
			showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
			$('#chat-message').val('');
		};
		
		websocket.onerror = function(event){
			showMessage("<div class='error'>Problem due to some Error</div>");
		};
		websocket.onclose = function(event){
			showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
		}; 
		
		//Send message
		$('#frmChat').on("submit",function(event){
			event.preventDefault();
			//$('#chat-user').attr("type","hidden");		
			var messageJSON = {
				chat_user: <?php echo json_encode($_SESSION['username']) ?>,
				chat_message: $('#chat-message').val()
			};
			websocket.send(JSON.stringify(messageJSON));
		});
	});
	</script>
	</head>
	<body>
		<ul>
  			<li><a class="active" href="index.php"><img src='img/home.png' width='35' height='35'></a></li>
		</ul>
		<form name="frmChat" id="frmChat">
			<div class="contain">
				<div id="chat-box"></div>
				<!-- <input type="text" name="chat-user" id="chat-user" placeholder="Name" class="chat-input" required />-->
				<input type="text" name="chat-message" id="chat-message" placeholder="Message"  class="chat-input chat-message" required />
				<center><input type="submit" id="btnSend" name="send-chat-message" value="Send" ></center>	
				<br/>			
			</div>
				
		</form>
</body>
</html>