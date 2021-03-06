<?php
/*----------------------------------------------------------------------------
    File: joinserver.php
    Description: Does part of the authentication between a player
                 and a multiplayer server.
    
    Contributors: Ryan Sullivan
    Company: Kayotic Labs (www.kayoticlabs.com)
    Webapp: Mineshafter Squared (www.mineshaftersquared.com)
------------------------------------------------------------------------------
    Mineshafter Squared is a replacement for the Minecraft Authentication,
    Skin, and Cape systems.
    Copyright (C) 2011  Ryan Sullivan
    
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-----------------------------------------------------------------------------*/

require_once '../config.php';
require_once '../scripts/functions.php';

$query='
    Select username
    From   `'.$MySQL['database'].'`.`Users`
    Where   session = "'.mysql_real_escape_string($_GET['sessionId']).'"
    And     username = "'.mysql_real_escape_string($_GET['user']).'"
    And     server = "'.mysql_real_escape_string($_GET['serverId']).'";
';

$resource = runQuery($query);

if(mysql_num_rows($resource) == 1){
    echo "OK";
} else {
    $query='
          Update  	`'.$MySQL['database'].'`.`Users`
          Set      	server = "'.mysql_real_escape_string($_GET['serverId']).'"
          Where	        username = "'.mysql_real_escape_string($_GET['user']).'"
          And       session = "'.mysql_real_escape_string($_GET['sessionId']).'"
        ';
        
    $resource = runQuery($query);
    
    if(mysql_affected_rows($MySQL['link']) == 1){
        echo "OK";
    } else {
        echo "Bad login";
    }
}
?>