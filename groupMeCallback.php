<?php
/*************************************************************************************
* GroupMeCallback.php
* Basic callback 
* 
* Copyright (C) 2014 by Eric Osburn.
* The redistribution terms are provided in the LICENSE file that must
* be distributed with this source code.
*************************************************************************************/

include( './httpful.phar' );
include( './config.php' );

// Get the message contents, decode the json, and lowercase the whole thing ( makes matching much easier )
$cont = file_get_contents( "php://input" );
$json = json_decode( $cont );
$msgText = strtolower( $json->text );
$usrName = $json->name

// This is the word array of the whole message
$command = explode( ' ', $msgText );


// Check the very first letter for a colon
if ( substr( $command[ 0 ], 0, 1 ) == ":" ){
    $cmd = substr( $command[ 0 ], 1 );

    // This is the switch for : commands. Add what you will.
    switch ( $cmd ){
        case "lmgtfy": // Let me google that for you
            sendMsg( "http://lmgtfy.com/?q=" . implode( '+', array_slice( $command, 1 ) ) );
                // Index starting at 1 to not grab the command word
            break;
        case "google": // Google search
            sendMsg( "https://google.com/search?q=" . implode( '+', array_slice( $command, 1 ) ) );
            break;
    }

// And this is the ugly syntax for checking for keywords in messages. I don't like it, but I don't know a better way
} else if ( substr_count( $msgText, "(.)(.)" ) > 0 ){
    sendMsg( "BOOBIES" );
}

// Send a message from the bot to the group it's registered in. bot_token comes from config.php
function sendMsg( $msg ){
    $url = "https://api.groupme.com/v3/bots/post";
    $res = \Httpful\Request::post( $url )->sendsJson( )->body( '{"text":"'. $msg .'","bot_id":"' . $bot_token . '"}' )->send( );
}

?>
