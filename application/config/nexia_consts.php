<?php
defined('BASEPATH') OR exit('No direct script access allowed');

define('USER_INACTIVE', 0);
define('USER_ACTIVE',   1);

define('COMPANY_INACTIVE',  0);
define('COMPANY_ACTIVE',    1);

define('NOTIFICATION_ALL',      0); // to all users
define('NOTIFICATION_USER',     1); // to specific user
define('NOTIFICATION_ONLINE',   2); // to all online

define('NOTIFICATION_LVL_INFO',     0);
define('NOTIFICATION_LVL_SUCCESS',  1);
define('NOTIFICATION_LVL_DANGER',   2);
define('NOTIFICATION_LVL_WARNING',  3);