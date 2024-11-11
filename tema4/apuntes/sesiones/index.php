<?php

// Sessions are created on the server side, no data from sessions goes to client
// Sessions are stored on files
// Each file is identified by a SID
// The client just store a cookie with the Session ID (SID)
// A client can just open a session
// To access the data we have saved on that file, we use the superglobal var => $_SESSION
// To close a session we MUST delete everything related to the session (file, $_SESSION and the cookie on client side)

?>