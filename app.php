<?php
session_start();

require 'config.php';

require BASE_DIR . '/libs/db.php';

require BASE_DIR . '/functions/findUser.php';
require BASE_DIR . '/functions/getComments.php';
require BASE_DIR . '/functions/findLikes.php';
require BASE_DIR . '/models/BaseModel.php';
require BASE_DIR . '/models/Follower.php';
require BASE_DIR . '/models/Friends.php';
require BASE_DIR . '/models/Posts.php';
require BASE_DIR . '/models/Users.php';
require BASE_DIR . '/models/Account.php';
require BASE_DIR . '/models/Likes.php';
require BASE_DIR . '/models/Comments.php';
require BASE_DIR . '/controllers/BaseController.php';
require BASE_DIR . '/functions/cookies.php';

//User is logged in?
