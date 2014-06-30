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

//Chatterbot api is located here: https://code.google.com/p/chatter-bot-api/
require 'chatterbotapi.php';


// Get the message contents, decode the json, and lowercase the whole thing ( makes matching much easier )
$cont = file_get_contents( "php://input" );
$json = json_decode( $cont );
$msgText = strtolower( $json->text ); // NOTE NOTE NOTE NOTE NOTE NOTE NOTE NOTE
// The message text is lower cased to make patterns easier to match!
// For case sensitive matches, use $json->text !
$usrName = $json->name

// This is the word array of the whole message
$command = explode( ' ', $msgText );

$quipList = array("I'm different!"); //Why do I always forget semi colons??

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
        case "claptrap": // Cleverbot Response
            $factory = new ChatterBotFactory();
            $bot1 = $factory->create(ChatterBotType::CLEVERBOT);
            $bot1session = $bot1->createSession();
            $response = $bot1session->think($command);
            sendMsg( $response );
            break;
        case "roulette": // Would you like to play a game??
            $quip = array_rand($quipList)
            sendMsg ($quip)
            break;
        case "addtoroulette":
            sendMSG ("This feature hasn't been implemented yet, stop judging poor clapTrap")
    }

// And this is the ugly syntax for checking for keywords in messages. I don't like it, but I don't know a better way
} else if ( substr_count( $msgText, "(.)(.)" ) > 0 ){
    sendMsg( "BOOBIES" );
// Here's the same thing, but with a case-sensitive keyword
} else if ( substr_count( $msgText, "Oblivion!" ) > 0 ){
    sendMsg( "ONLY A DAEDRIC LORD MAY COMMAND THE PLANES OF OBLIVION. GO AWAY." );
}

// Send a message from the bot to the group it's registered in. bot_token comes from config.php
function sendMsg( $msg ){
    $url = "https://api.groupme.com/v3/bots/post";
    $res = \Httpful\Request::post( $url )->sendsJson( )->body( '{"text":"'. $msg .'","bot_id":"' . $bot_token . '"}' )->send( );
}

?>
