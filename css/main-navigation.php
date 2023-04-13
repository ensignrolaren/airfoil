<?php
$absolute_path = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $absolute_path[0] . 'wp-load.php';
require_once($wp_load);

$breakpoint_value = get_field('mobile_menu_breakpoint', 'option');
$mobile_breakpoint = $breakpoint_value . 'px';
$desktop_breakpoint = $breakpoint_value + 1 . 'px';

header('Content-type: text/css');
header('Cache-control: must-revalidate');
?>

@media screen and (min-width: <?php echo $desktop_breakpoint; ?>) { /* Applies ONLY to large screens */
.main-navigation .menu:first-of-type {
display: flex;
height: 100%;
}
.main-navigation .menu:first-of-type > .menu-item {
display: flex;
align-items: flex-start;
border-top: 5px solid transparent;
transition: all 250ms ease;
}
.main-navigation .menu:first-of-type > .menu-item:hover {
border-top: 5px solid hotpink;
}
/* todo do i need this? */
.main-navigation .non-clickable > a {
pointer-events: none;
}
.main-navigation .non-clickable:hover > a {
color: #817e73;
transition: color 100ms ease;
}
.main-navigation .menu-item-has-children > a:after {
content: "\203A";
transform: rotate(90deg);
transition: transform 250ms ease;
display: inline-block;
position: relative;
top: 2px;
left: .75ch;
}
.main-navigation .sub-menu li a:after {
display: none;
}
.main-navigation .sub-menu .menu-item:first-of-type {
position: relative;
}
.main-navigation .sub-menu {
display: none;
background-color: #fff;
width: max-content;
position: absolute;
top: calc(50% + 1.5rem);
left: calc(-50% - 1.5rem);
z-index: 9999;
-webkit-box-shadow: 0 13px 27px -5px rgb(50 50 93 / 25%), 0 8px 16px -8px rgb(0 0 0 / 30%), 0 -6px 16px -6px rgb(0 0 0 / 3%);
box-shadow: 0 13px 27px -5px rgb(50 50 93 / 25%), 0 8px 16px -8px rgb(0 0 0 / 30%), 0 -6px 16px -6px rgb(0 0 0 / 3%);
/* border-bottom: 4px solid #111c35; */
margin: 0;
}
.main-navigation .sub-menu .menu-item:first-of-type::before {
content: "";
position: absolute;
top: -5px;
left: 50%;
right: 50%;
transform: translateX(-50%);
width: 0;
height: 0;
border-left: 7px solid transparent;
border-right: 7px solid transparent;
border-bottom: 5px solid #fff;
}
.main-navigation .sub-menu .menu-item {
border-left: 4px solid transparent;
transition: border 250ms ease-in-out, background-color 250ms ease-in-out;
}
.main-navigation .sub-menu .menu-item:hover {
border-left: 4px solid #000;
background-color: aliceblue;
}
.main-navigation .menu-item-has-children:hover .sub-menu {
display: block;
}
}
/* smaller screen styles & behavior */
@media screen and (max-width: <?php echo $mobile_breakpoint; ?>) {
.js .main-navigation {
justify-content: center;
}
.js #close {
display: flex; /* makes visible */
text-transform: uppercase;
width: 100%;
font-size: 100%;
text-align: right;
border: none;
border-radius: 0;
cursor: pointer;
}
.close-button {
padding: 1rem;
background-color: #343435;
color: #fff;
justify-content: flex-end;
}
.close-button:after {
content: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='-0.94 -21.28 574.94 525.29'%3E%3Cpath d='M574 87.922 542.078 56l-192.08 192.08L157.918 56l-31.922 31.922 192.08 192.08-192.08 192.08 31.922 31.922 192.08-192.08 192.08 192.08L574 472.082l-192.08-192.08z'/%3E%3C/svg%3E%0A");
flex: 0 0 1rem;
margin-left: .5rem;
filter: invert(100%) sepia(100%) saturate(0%) hue-rotate(288deg) brightness(102%) contrast(102%);
}
/* show hamburger on mobile if there's js */
.js button.menu-toggle {
display: block; /* makes visible */
}
.js .main-navigation {
display: flex;
justify-content: flex-end;
align-items: center;
}
.js .main-navigation > div:first-of-type /*this should always be the primary nav */ {
display: flex;
flex-direction: column-reverse;
background-color: #454545;
position: fixed;
left: -300px;
top: 0;
width: 300px;
height: 100%;
transition: all 300ms ease-in-out;
z-index: 999;
justify-content: space-between;
}
/* scooch down to make room for wp admin bar */
.js .logged-in .main-navigation > div:first-of-type {
top: 32px;
height: calc(100% - 32px);
}
.js .main-navigation .menu {
padding: 0 1rem;
}
.js .main-navigation .menu > .menu-item {
padding: 0;
display: block;
border-bottom: 1px solid #e3e3e3;
}
.js .main-navigation .menu .menu-item a {
padding: 1rem;
}
.js .main-navigation .sub-menu {
padding: 0;
margin: 0;
border-top: 1px solid #e3e3e3;
}
.js .main-navigation .non-clickable {
padding: 0;
}
.js .main-navigation .menu .menu-item a {
display: block;
}
/* when the button's clicked */
.js .main-navigation.toggled > div:first-of-type /*this should always be the primary nav */ {
position: fixed;
left: 0;
width: 80%;
}
}
@media screen and (max-width: 781px) {
/* scooch down to make room for wp admin bar */
.js .logged-in .main-navigation > div:first-of-type {
top: 46px;
height: calc(100% - 46px);
}
}