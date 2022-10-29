<?php

Session::destroy();
header('location:'.routeTo());
die();