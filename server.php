<?php
define('HOST_NAME',"localhost"); //assign host
define('PORT',"6969"); //assign port
$null = NULL;

require_once("class.chathandler.php");
$chatHandler = new ChatHandler();

//Create TCP/IP sream socket
$socketResource = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//reuseable port
socket_set_option($socketResource, SOL_SOCKET, SO_REUSEADDR, 1);

//bind socket to specified host
socket_bind($socketResource, 0, PORT);
//listen to port
socket_listen($socketResource);

//create & add listning socket to the list
$clientSocketArray = array($socketResource);

//start endless loop, so that our script doesn't stop
while (true) {
	//manage multiples connections
	$newSocketArray = $clientSocketArray;
	//returns the socket resources in $newScoketArray array
	socket_select($newSocketArray, $null, $null, 0, 10);

	//check for new socket
	if (in_array($socketResource, $newSocketArray)) {
		$newSocket = socket_accept($socketResource);//accpet new socket
		$clientSocketArray[] = $newSocket; //add socket to client array
		
		$header = socket_read($newSocket, 1024);//read data sent by the socket
		$chatHandler->doHandshake($header, $newSocket, HOST_NAME, PORT);//perform websocket handshake
		
		socket_getpeername($newSocket, $client_ip_address);//get ip address of connected socket
		$connectionACK = $chatHandler->newConnectionACK($client_ip_address);
		
		$chatHandler->send($connectionACK);//notify all users about new connection
		
		//make room for new socket
		$newSocketIndex = array_search($socketResource, $newSocketArray);
		unset($newSocketArray[$newSocketIndex]);
	}
	
	//loop through all connected sockets
	foreach ($newSocketArray as $newSocketArrayResource) {	
		//check for any incomming data
		while(socket_recv($newSocketArrayResource, $socketData, 1024, 0) >= 1){
			$socketMessage = $chatHandler->unseal($socketData);
			$messageObj = json_decode($socketMessage);//json decode 
			
			//prepare data to be sent to client
			$chat_box_message = $chatHandler->createChatBoxMessage($messageObj->chat_user, $messageObj->chat_message);
			$chatHandler->send($chat_box_message);//send data
			break 2;//exit this loop
		}
		
		$socketData = @socket_read($newSocketArrayResource, 1024, PHP_NORMAL_READ);
		if ($socketData === false) { // check disconnected client
			// remove client for $clients array
			socket_getpeername($newSocketArrayResource, $client_ip_address);
			//notify all users about disconnected connection
			$connectionACK = $chatHandler->connectionDisconnectACK($client_ip_address);
			$chatHandler->send($connectionACK);
			// remove client for $clients array
			$newSocketIndex = array_search($newSocketArrayResource, $clientSocketArray);
			unset($clientSocketArray[$newSocketIndex]);			
		}
	}
}
// close the listening socket
socket_close($socketResource);