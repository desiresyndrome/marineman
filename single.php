<?php 
if(in_category('vacancies')) {
include 'single-vacancies.php';
}
elseif(in_category('ships')) {
include 'single-ships.php';
}
elseif(in_category('permanent-vacancies')) {
include 'single-permanent-vacancies.php';
}
else {
include 'single-marine-log.php'; 
}
?>