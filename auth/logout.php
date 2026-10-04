<?php
require_once __DIR__.'/../includes/bootstrap.php';
session_unset();session_destroy();header('Location: /women_in_tech_php/index.php?lang='.urlencode($lang));exit; ?>