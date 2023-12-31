<?php // -*- coding: utf-8 -*-

/*

  **************************************************************
  *                     PHP Shell 2.1                          *
  **************************************************************

  PHP Shell is an interactive PHP script that will execute any command
  entered.  See the files README, INSTALL, and SECURITY or
  http://mgeisler.net/php-shell/ for further information.

  Copyright (C) 2000-2005 Martin Geisler <mgeisler@mgeisler.net>

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.
  
  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.
  
  You can get a copy of the GNU General Public License from this
  address: http://www.gnu.org/copyleft/gpl.html#SEC1
  You can also write to the Free Software Foundation, Inc., 59 Temple
  Place - Suite 330, Boston, MA  02111-1307, USA.
  
*/

/* There are no user-configurable settings in this file anymore, please see
 * config.php instead. */


/* This error handler will turn all notices, warnings, and errors into fatal
 * errors, unless they have been suppressed with the @-operator. */
function error_handler($errno, $errstr, $errfile, $errline, $errcontext) {
    /* The @-opertor (used with chdir() below) temporarely makes
     * error_reporting() return zero, and we don't want to die in that case.
     * We do note the error in the output, though. */
    if (error_reporting() == 0) {
        $_SESSION['output'] .= $errstr . "\n";
    } else {
        die('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>PHP Shell 2.1</title>
  <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
  <h1>Fatal Error!</h1>
  <p><b>' . $errstr . '</b></p>
  <p>in <b>' . $errfile . '</b>, line <b>' . $errline . '</b>.</p>

  <hr>

  <p>Please consult the <a href="README">README</a>, <a
  href="INSTALL">INSTALL</a>, and <a href="SECURITY">SECURITY</a> files for
  instruction on how to use PHP Shell.</p>

  <hr>

  <address>
  Copyright &copy; 2000&ndash;2005, <a
  href="mailto:mgeisler@mgeisler.net">Martin Geisler</a>. Get the latest
  version at <a
  href="http://mgeisler.net/php-shell/">mgeisler.net/php-shell/</a>.
  </address>

</body>
</html>');
    }
}

/* Installing our error handler makes PHP die on even the slightest problem.
 * This is what we want in a security critical application like this. */
set_error_handler('error_handler');


function logout() {
    /* Empty the session data, except for the 'authenticated' entry which the
     * rest of the code needs to be able to check. */
    $_SESSION = array('authenticated' => false);

    /* Unset the client's cookie, if it has one. */
//    if (isset($_COOKIE[session_name()]))
//        setcookie(session_name(), '', time()-42000, '/');

    /* Destroy the session data on the server.  This prevents the simple
     * replay attach where one uses the back button to re-authenticate using
     * the old POST data since the server wont know the session then.*/
//    session_destroy();
}


function stripslashes_deep($value) {
    if (is_array($value))
        return array_map('stripslashes_deep', $value);
    else
        return stripslashes($value);
}

if (get_magic_quotes_gpc())
    $_POST = stripslashes_deep($_POST);

/* Initialize some variables we need again and again. */
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$nounce   = isset($_POST['nounce'])   ? $_POST['nounce']   : '';

$command  = isset($_POST['command'])  ? $_POST['command']  : '';
$rows     = isset($_POST['rows'])     ? $_POST['rows']     : 24;
$columns  = isset($_POST['columns'])  ? $_POST['columns']  : 80;


/* Load the configuration. */
$ini = parse_ini_file('config.php', true);

if (empty($ini['settings']))
    $ini['settings'] = array();

/* Default settings --- these settings should always be set to something. */
$default_settings = array('home-directory'   => '.');

/* Merge settings. */
$ini['settings'] = array_merge($default_settings, $ini['settings']);


session_start();

/* Delete the session data if the user requested a logout.  This leaves the
 * session cookie at the user, but this is not important since we
 * authenticates on $_SESSION['authenticated']. */
if (isset($_POST['logout']))
    logout();

/* Attempt authentication. */
if (isset($_SESSION['nounce']) && $nounce == $_SESSION['nounce'] && 
    isset($ini['users'][$username])) {
    if (strchr($ini['users'][$username], ':') === false) {
        // No seperator found, assume this is a password in clear text.
        $_SESSION['authenticated'] = ($ini['users'][$username] == $password);
    } else {
        list($fkt, $salt, $hash) = explode(':', $ini['users'][$username]);
        $_SESSION['authenticated'] = ($fkt($salt . $password) == $hash);
    }
}


/* Enforce default non-authenticated state if the above code didn't set it
 * already. */
if (!isset($_SESSION['authenticated']))
    $_SESSION['authenticated'] = false;


if ($_SESSION['authenticated']) {  
    /* Initialize the session variables. */
    if (empty($_SESSION['cwd'])) {
        $_SESSION['cwd'] = realpath($ini['settings']['home-directory']);
        $_SESSION['history'] = array();
        $_SESSION['output'] = '';
    }
  
    if (!empty($command)) {
        /* Save the command for late use in the JavaScript.  If the command is
         * already in the history, then the old entry is removed before the
         * new entry is put into the list at the front. */
        if (($i = array_search($command, $_SESSION['history'])) !== false)
            unset($_SESSION['history'][$i]);
        
        array_unshift($_SESSION['history'], $command);
  
        /* Now append the commmand to the output. */
        $_SESSION['output'] .= '$ ' . $command . "\n";

        /* Initialize the current working directory. */
        if (ereg('^[[:blank:]]*cd[[:blank:]]*$', $command)) {
            $_SESSION['cwd'] = realpath($ini['settings']['home-directory']);
        } elseif (ereg('^[[:blank:]]*cd[[:blank:]]+([^;]+)$', $command, $regs)) {
            /* The current command is a 'cd' command which we have to handle
             * as an internal shell command. */

            if ($regs[1]{0} == '/') {
                /* Absolute path, we use it unchanged. */
                $new_dir = $regs[1];
            } else {
                /* Relative path, we append it to the current working
                 * directory. */
                $new_dir = $_SESSION['cwd'] . '/' . $regs[1];
            }
      
            /* Transform '/./' into '/' */
            while (strpos($new_dir, '/./') !== false)
                $new_dir = str_replace('/./', '/', $new_dir);

            /* Transform '//' into '/' */
            while (strpos($new_dir, '//') !== false)
                $new_dir = str_replace('//', '/', $new_dir);

            /* Transform 'x/..' into '' */
            while (preg_match('|/\.\.(?!\.)|', $new_dir))
                $new_dir = preg_replace('|/?[^/]+/\.\.(?!\.)|', '', $new_dir);
      
            if ($new_dir == '') $new_dir = '/';
      
            /* Try to change directory. */
            if (@chdir($new_dir)) {
                $_SESSION['cwd'] = $new_dir;
            } else {
                $_SESSION['output'] .= "cd: could not change to: $new_dir\n";
            }
      
        } elseif (trim($command) == 'exit') {
            logout();
        } else {

            /* The command is not an internal command, so we execute it after
             * changing the directory and save the output. */
            chdir($_SESSION['cwd']);

            // We canot use putenv() in safe mode.
            if (!ini_get('safe_mode')) {
                // Advice programs (ls for example) of the terminal size.
                putenv('ROWS=' . $rows);
                putenv('COLUMNS=' . $columns);
            }

            /* Alias expansion. */
            $length = strcspn($command, " \t");
            $token = substr($command, 0, $length);
            if (isset($ini['aliases'][$token]))
                $command = $ini['aliases'][$token] . substr($command, $length);
    
            $io = array();
            $p = proc_open($command,
                           array(1 => array('pipe', 'w'),
                                 2 => array('pipe', 'w')),
                           $io);

            /* Read output sent to stdout. */
            while (!feof($io[1])) {
                $_SESSION['output'] .= htmlspecialchars(fgets($io[1]),
                                                        ENT_COMPAT, 'UTF-8');
            }
            /* Read output sent to stderr. */
            while (!feof($io[2])) {
                $_SESSION['output'] .= htmlspecialchars(fgets($io[2]),
                                                        ENT_COMPAT, 'UTF-8');
            }
            
            fclose($io[1]);
            fclose($io[2]);
            proc_close($p);
        }
    }

    /* Build the command history for use in the JavaScript */
    if (empty($_SESSION['history'])) {
        $js_command_hist = '""';
    } else {
        $escaped = array_map('addslashes', $_SESSION['history']);
        $js_command_hist = '"", "' . implode('", "', $escaped) . '"';
    }
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>PHP Shell 2.1</title>
  <link rel="stylesheet" href="style.css" type="text/css">

  <script type="text/javascript">
  <?php if ($_SESSION['authenticated']) { ?>

  var current_line = 0;
  var command_hist = new Array(<?php echo $js_command_hist ?>);
  var last = 0;

  function key(e) {
    if (!e) var e = window.event;

    if (e.keyCode == 38 && current_line < command_hist.length-1) {
      command_hist[current_line] = document.shell.command.value;
      current_line++;
      document.shell.command.value = command_hist[current_line];
    }

    if (e.keyCode == 40 && current_line > 0) {
      command_hist[current_line] = document.shell.command.value;
      current_line--;
      document.shell.command.value = command_hist[current_line];
    }

  }

  function init() {
    document.shell.setAttribute("autocomplete", "off");
    document.shell.output.scrollTop = document.shell.output.scrollHeight;
    document.shell.command.focus();
  }

  <?php } else { ?>

  function init() {
    document.shell.username.focus();
  }

  <?php } ?>
  </script>
</head>

<body onload="init()">
<form name="shell" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

<?php
if (!$_SESSION['authenticated']) {
    /* Genereate a new nounce every time we preent the login page.  This binds
     * each login to a unique hit on the server and prevents the simple replay
     * attack where one uses the back button in the browser to replay the POST
     * data from a login. */
    $_SESSION['nounce'] = mt_rand();

?>

<fieldset>
  <legend>Authentication</legend>

  <?php
  if (!empty($username))
      echo '  <p class="error">Login failed, please try again:</p>' . "\n";
  else
      echo "  <p>Please login:</p>\n";
  ?>

  <p>Username: <input name="username" type="text" value="<?php echo $username
  ?>"></p>

  <p>Password: <input name="password" type="password"></p>

  <p><input type="submit" value="Login"></p>

  <input name="nounce" type="hidden" value="<?php echo $_SESSION['nounce']; ?>">

</fieldset>

<?php } else { /* Authenticated. */ ?>

<fieldset>
  <legend>Current Working Directory: <code><?php
     echo  htmlspecialchars($_SESSION['cwd'], ENT_COMPAT, 'UTF-8');
    ?></code></legend>


<div id="terminal">
<textarea name="output" readonly="readonly" cols="<?php echo $columns ?>" rows="<?php echo $rows ?>">
<?php
$lines = substr_count($_SESSION['output'], "\n");
$padding = str_repeat("\n", max(0, $rows+1 - $lines));
echo rtrim($padding . $_SESSION['output']);
?>
</textarea>
<p id="prompt">
  $&nbsp;<input name="command" type="text"
                onkeyup="key(event)" size="<?php echo $columns-2 ?>" tabindex="1">
</p>
</div>

<p>
  <span style="float: right">Size: <input type="text" name="rows" size="2"
  maxlength="3" value="<?php echo $rows ?>"> &times; <input type="text"
  name="columns" size="2" maxlength="3" value="<?php echo $columns
  ?>"></span>
  
<input type="submit" value="Execute Command">
  <input type="submit" name="logout" value="Logout">
</p>

</fieldset>

<?php } ?>

</form>


</body>
</html>
