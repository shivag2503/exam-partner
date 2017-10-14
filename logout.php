<?php

session_start();

session_unset();

session_destroy();

header("Location: /");
/* for setting up the location at which users data will store.*/
